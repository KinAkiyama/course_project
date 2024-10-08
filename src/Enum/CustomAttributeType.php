<?php

namespace App\Enum;

enum CustomAttributeType: string {

    use EnumToArrayTrait;

    case Integer = 'INT';
    case String = 'STRING';
    case Boolean = 'BOOL';
    case Date = 'DATE';
    case Text = 'TEXT';
}