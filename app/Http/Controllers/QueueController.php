<?php

namespace App\Http\Controllers;

use App\Enums\QueueType;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class QueueController extends Controller
{
    public function index()
    {
        return view('queue.index');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $data['queue_type'] = QueueType::fromFrontend($data['queue_type'])->value;
        } catch (\Throwable $e) {
            Log::warning('Validation failed: Invalid queue_type received', [
                'input' => $request->only('queue_type'),
                'error' => $e->getMessage(),
            ]);
            return back()->with('error', 'Неверный тип очереди')->withInput();
        }


        if (!empty($data['phone_number'])) {
            $digits = preg_replace('/\D/', '', $data['phone_number']);

            // Логика добавления '996'
            if (strlen($digits) === 9) {
                $digits = '996' . $digits;
            } elseif (str_starts_with($digits, '996')) {
                // Если код страны уже есть
                $digits = $digits;
            } else {
                // Если пользователь ввел номер в другом формате, пробуем добавить 996
                $digits = '996' . $digits;
            }

            $data['phone_number'] = '+' . $digits;
        }


        $validator = Validator::make($data, [
            'queue_type' => 'required|in:' . implode(',', array_column(QueueType::cases(), 'value')),
            'apartment_type' => 'required|in:1,2,3,4',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone_number' => ['required', 'regex:/^\+996\d{9}$/'],
            'curator_id' => 'nullable|string|max:50',
            'inn' => 'required|string|max:14',
            'document_number' => 'required|string|max:7',
            'document_series' => 'required|in:ID,AN',
            'issued_by' => 'required|string|max:255',
            'issue_date' => 'required|date_format:d.m.Y',
            'monthly_payment_no_down' => 'nullable|required_if:queue_type,' . QueueType::WithoutDownPayment->value . '|in:40000,60000,80000,other',
            'custom_monthly_payment' => 'nullable|required_if:monthly_payment_no_down,other|integer|min:0',
            'down_payment' => 'nullable|required_if:queue_type,' . QueueType::WithDownPayment->value . '|integer|min:1000000',
            'payment_term' => 'nullable|required_if:queue_type,' . QueueType::WithDownPayment->value . '|in:2,4,5,6',
        ]);

        if ($validator->fails()) {
            // --- ЛОГИРОВАНИЕ ОШИБКИ ВАЛИДАЦИИ ---
            Log::warning('Queue submission failed validation.', [
                'errors' => $validator->errors()->all(),
                // Логируем только безопасные данные. Паспортные данные исключаем.
                'data_submitted' => $request->except(['inn', 'document_number', 'document_series', 'issued_by', '_token']),
                'ip' => $request->ip(),
            ]);
            // ------------------------------------

            return back()->withErrors($validator)->withInput();
        }

        $exists = Queue::where('inn', $data['inn'])
            ->orWhere('document_number', $data['document_number'])
            ->exists();

        if ($exists) {
            Log::info('Queue submission blocked: Duplicate document data.', [
                'inn' => $data['inn'],
                'document_number' => $data['document_number'],
                'phone_number' => $data['phone_number'] ?? 'N/A',
                'ip' => $request->ip(),
            ]);
            // ---------------------------------------

            return back()->with('error', 'Заявка с таким ИНН или номером документа уже существует')->withInput();
        }

        $queue = Queue::create($data);

        $popup_data = [
            'queue_number' => str_pad($queue->id, 4, '0', STR_PAD_LEFT),
            'queue_type' => match($queue->queue_type) {
                QueueType::WithoutDownPayment->value => 'Без взноса',
                QueueType::WithDownPayment->value => 'С первоначальным взносом',
                default => $queue->queue_type
            },
            'apartment_type' => $queue->apartment_type . '-комнатная',
            'full_name' => $queue->last_name . ' ' . $queue->first_name . ' ' . ($queue->patronymic ?? ''),
            'phone_number' => $queue->phone_number,
            'monthly_payment' => $queue->monthly_payment_no_down ?? $queue->custom_monthly_payment,
            'manager' => $queue->curator_id ?? 'Менеджер не назначен'
        ];

        Log::info('New queue submission created successfully.', [
            'queue_id' => Queue::latest()->first()->id,
            'inn' => $data['inn'],
            'queue_type' => $data['queue_type'],
        ]);

        return redirect()->back()
            ->with('popup', true)
            ->with('popup_data', $popup_data);

    }

}
