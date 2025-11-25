<?php
namespace App\Enums;

enum QueueType: int
{
    case WithoutDownPayment = 1;
    case WithDownPayment    = 2;

    public function label(): string
    {
        return match($this) {
            self::WithoutDownPayment => 'Без первоначального взноса',
            self::WithDownPayment    => 'С первоначальным взносом',
        };
    }

    public function frontendValue(): string
    {
        return match($this) {
            self::WithoutDownPayment => 'without_down_payment',
            self::WithDownPayment    => 'with_down_payment',
        };
    }

    public static function fromFrontend(string $value): self
    {
        return match($value) {
            'without_down_payment' => self::WithoutDownPayment,
            'with_down_payment'    => self::WithDownPayment,
        };
    }
}
