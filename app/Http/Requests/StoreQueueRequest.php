<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\QueueType;
use Illuminate\Validation\Rule;

class StoreQueueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $queue = $this->queue_type;

        try {
            $queue = QueueType::fromFrontend($queue)->value;
        } catch (\Throwable $e) {
            $queue = null;
        }

        $phone = $this->phone_number;
        if (!empty($phone)) {
            $digits = preg_replace('/\D/', '', $phone);
            if (strlen($digits) === 9) {
                $digits = '996'.$digits;
            } elseif (!str_starts_with($digits, '996')) {
                $digits = '996'.$digits;
            }
            $phone = '+'.$digits;
        }

        $this->merge([
            'queue_type' => $queue,
            'phone_number' => $phone,
        ]);
    }

    public function rules()
    {
        return [
            'queue_type' => 'required|in:'.implode(',', array_column(QueueType::cases(), 'value')),
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
            'monthly_payment_no_down' => 'nullable|required_if:queue_type,'.QueueType::WithoutDownPayment->value.'|in:40000,60000,80000,other',
            'custom_monthly_payment' => 'nullable|required_if:monthly_payment_no_down,other|integer|min:0',
            'monthly_payment_custom' => 'nullable|numeric|min:60000',
            'down_payment' => 'nullable|required_if:queue_type,'.QueueType::WithDownPayment->value.'|integer|min:1000000',
            'payment_term' => 'nullable|required_if:queue_type,'.QueueType::WithDownPayment->value.'|in:2,4,5,6',
        ];
    }
}
