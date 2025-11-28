<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $table = 'queue';

    protected $fillable = [
        'queue_type',
        'apartment_type',
        'first_name',
        'last_name',
        'middle_name',
        'phone_number',
        'curator_id',
        'inn',
        'document_series',
        'document_number',
        'issued_by',
        'monthly_payment_no_down',
        'custom_monthly_payment',
        'down_payment',
        'payment_term',
        'birth_date',
        'address',
        'issue_date',
    ];

    protected $casts = [
        'queue_type' => 'integer',
        'apartment_type' => 'integer',
        'custom_monthly_payment' => 'integer',
        'down_payment' => 'integer',
        'payment_term' => 'integer',
        'issue_date' => 'date',
        'birth_date' => 'date',
    ];
}
