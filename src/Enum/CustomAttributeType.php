<?php

namespace App\Enum;

enum CustomAttributeType: string {

    use EnumToArrayTrait;

    case Integer = 'INT';
    case String = 'STRING';
    case Boolean = 'BOOLEAN';
    case Date = 'DATE';
    case Text = 'TEXT';
}