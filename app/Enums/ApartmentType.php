<?php

namespace App\Enums;

enum ApartmentType: int
{
    case OneRoom   = 1;
    case TwoRoom   = 2;
    case ThreeRoom = 3;
    case FourRoom  = 4;

    public function label(): string
    {
        return match($this) {
            self::OneRoom   => '1-комнатная',
            self::TwoRoom   => '2-х комнатная',
            self::ThreeRoom => '3-х комнатная',
            self::FourRoom  => '4-х комнатная',
        };
    }
}