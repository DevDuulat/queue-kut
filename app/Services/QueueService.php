<?php

namespace App\Services;

use App\Enums\QueueType;
use App\Models\Queue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class QueueService
{
    public function create(array $data)
    {
        if ($this->exists($data['inn'], $data['document_number'])) {
            return ['exists' => true];
        }

        if (isset($data['monthly_payment_custom']) && $data['queue_type'] === QueueType::WithDownPayment->value) {
            $data['custom_monthly_payment'] = $data['monthly_payment_custom'];
        }

        $queue = Queue::create($data);

        $monthly_payment = $queue->queue_type === QueueType::WithoutDownPayment->value
            ? ($data['monthly_payment_no_down'] === 'other'
                ? number_format($data['custom_monthly_payment'] ?? 0, 0, '', ' ')
                : number_format($data['monthly_payment_no_down'] ?? 0, 0, '', ' '))
            : number_format($data['custom_monthly_payment'] ?? 0, 0, '', ' ');

        $down_payment = $queue->queue_type === QueueType::WithDownPayment->value
            ? number_format($data['down_payment'] ?? 0, 0, '', ' ')
            : null;

        $curators = Cache::remember('curators', 3600, function () {
            $response = Http::get('https://base.kutstroy.kg/api/get-curators');
            return $response->successful() ? $response->json() : [];
        });

        $manager = collect($curators)->firstWhere('id', $queue->curator_id)['name'] ?? 'Менеджер не назначен';

        $payload = [
            'queue_number' => str_pad($queue->id, 4, '0', STR_PAD_LEFT),
            'queue_type' => $this->typeText($queue->queue_type),
            'apartment_type' => $queue->apartment_type.'-комнатная',
            'full_name' => $queue->last_name.' '.$queue->first_name.' '.($queue->patronymic ?? ''),
            'phone_number' => $queue->phone_number,
            'monthly_payment' => $monthly_payment,
            'down_payment' => $down_payment,
            'manager' => $manager
        ];

        return [
            'exists' => false,
            'queue' => $queue,
            'payload' => $payload
        ];
    }

    protected function exists($inn, $doc)
    {
        return Queue::where('inn', $inn)
            ->orWhere('document_number', $doc)
            ->exists();
    }

    protected function typeText($type)
    {
        return match ($type) {
            QueueType::WithoutDownPayment->value => 'Без взноса',
            QueueType::WithDownPayment->value => 'С первоначальным взносом',
            default => $type
        };
    }
}
