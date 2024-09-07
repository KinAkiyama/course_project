<?php

namespace App\Enum;

trait EnumToArrayTrait
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::names(), self::values());
    }

    public static function name(self $enum): string
    {
        return $enum->name;
    }

    public static function value(self $enum): string
    {
        return $enum->value;
    }
}