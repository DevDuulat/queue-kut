<?php

namespace App\Http\Controllers;

use App\Enums\QueueType;
use App\Http\Requests\StoreQueueRequest;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class QueueController extends Controller
{
    public function index()
    {
        $curators = Cache::remember('curators', 3600, function () {
            $response = Http::get('https://base.kutstroy.kg/api/get-curators');
            return $response->successful() ? $response->json() : [];
        });

        return view('queue.index', compact('curators'));
    }

    public function store(StoreQueueRequest $request)
    {
        $data = $request->validated();

        $exists = Queue::where('inn', $data['inn'])
            ->orWhere('document_number', $data['document_number'])
            ->exists();

        if ($exists) {
            return back()
                ->with('error', 'Заявка с таким ИНН или номером документа уже существует')
                ->withInput();
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

        $managerName = collect($curators)->firstWhere('id', $queue->curator_id)['name'] ?? 'Менеджер не назначен';

        $popup_data = [
            'queue_number' => str_pad($queue->id, 4, '0', STR_PAD_LEFT),
            'queue_type' => match($queue->queue_type) {
                QueueType::WithoutDownPayment->value => 'Без взноса',
                QueueType::WithDownPayment->value => 'С первоначальным взносом',
                default => $queue->queue_type
            },
            'apartment_type' => $queue->apartment_type.'-комнатная',
            'full_name' => $queue->last_name.' '.$queue->first_name.' '.($queue->patronymic ?? ''),
            'phone_number' => $queue->phone_number,
            'monthly_payment' => $monthly_payment,
            'down_payment' => $down_payment,
            'manager' => $managerName
        ];

        return redirect()->back()
            ->with('popup', true)
            ->with('popup_data', $popup_data);
    }




}
