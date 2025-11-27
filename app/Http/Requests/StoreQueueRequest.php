<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\QueueType;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class StoreQueueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        try {
            $queue = QueueType::fromFrontend($this->queue_type)->value;
        } catch (\Throwable $e) {
            $queue = null;
        }

        $phone = $this->phone_number;
        if (!empty($phone)) {
            $digits = preg_replace('/\D/', '', $phone);

            if (strlen($digits) === 9) {
                $digits = '996' . $digits;
            } elseif (strlen($digits) === 10) {
                $digits = '7' . $digits;
            } elseif (!in_array(strlen($digits), [12, 11]) || !preg_match('/^(996|7)/', $digits)) {
                $digits = null;
            }

            $phone = $digits ? '+' . $digits : null;
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
            'phone_number' => ['required', 'regex:/^\+(996\d{9}|7\d{10})$/'],
            'curator_id' => 'nullable|string|max:50',
            'inn' => 'required|string|max:14',
            'document_number' => 'required|string|max:7',
            'document_series' => 'required|in:ID,AN',
            'issued_by' => 'required|string|max:255',
            'issue_date' => 'required|date_format:d.m.Y',
            'monthly_payment_no_down' => 'nullable|in:40000,60000,80000,other',
            'custom_monthly_payment' => 'nullable|required_if:monthly_payment_no_down,other|integer|min:0',
//            'monthly_payment_custom' => 'nullable|numeric|min:60000',
            'down_payment' => 'nullable|required_if:queue_type,'.QueueType::WithDownPayment->value.'|integer|min:1000000',
            'payment_term' => 'nullable|required_if:queue_type,'.QueueType::WithDownPayment->value.'|in:2,4,5,6',
        ];
    }
    public function messages()
    {
        return [
            'queue_type.required' => 'Выберите тип очереди',
            'queue_type.in' => 'Некорректный тип очереди',
            'apartment_type.required' => 'Выберите тип квартиры',
            'apartment_type.in' => 'Некорректный тип квартиры',
            'first_name.required' => 'Введите имя',
            'first_name.string' => 'Имя должно быть строкой',
            'first_name.max' => 'Имя не должно превышать 100 символов',
            'last_name.required' => 'Введите фамилию',
            'last_name.string' => 'Фамилия должна быть строкой',
            'last_name.max' => 'Фамилия не должна превышать 100 символов',
            'phone_number.required' => 'Введите номер телефона',
            'phone_number.regex' => 'Номер телефона должен быть в формате: +996XXXXXXXXX или +7XXXXXXXXXX',
            'curator_id.max' => 'Некорректный куратор',
            'inn.required' => 'Введите ИНН',
            'inn.max' => 'ИНН не должен превышать 14 символов',
            'document_number.required' => 'Введите номер документа',
            'document_number.max' => 'Номер документа не должен превышать 7 символов',
            'document_series.required' => 'Выберите серию документа',
            'document_series.in' => 'Некорректная серия документа',
            'issued_by.required' => 'Укажите кем выдан документ',
            'issued_by.max' => 'Поле превышает допустимую длину',
            'issue_date.required' => 'Укажите дату выдачи',
            'issue_date.date_format' => 'Дата должна быть в формате ДД.ММ.ГГГГ',
            'monthly_payment_no_down.required_if' => 'Выберите ежемесячный платеж',
            'monthly_payment_no_down.in' => 'Некорректный ежемесячный платеж',
            'custom_monthly_payment.required_if' => 'Введите сумму ежемесячного платежа',
            'custom_monthly_payment.integer' => 'Значение должно быть числом',
            'custom_monthly_payment.min' => 'Значение не может быть меньше 0',
            'monthly_payment_custom.numeric' => 'Сумма должна быть числом',
            'monthly_payment_custom.min' => 'Минимальная сумма — 60000',
            'down_payment.required_if' => 'Введите сумму первоначального взноса',
            'down_payment.integer' => 'Значение должно быть числом',
            'down_payment.min' => 'Минимальная сумма — 1 000 000',
            'payment_term.required_if' => 'Выберите срок оплаты',
            'payment_term.in' => 'Некорректный срок оплаты',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        Log::error('StoreQueueRequest validation failed', [
            'errors' => $validator->errors()->toArray(),
            'input' => $this->all(),
        ]);

        throw new HttpResponseException(
            redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
        );
    }

}
