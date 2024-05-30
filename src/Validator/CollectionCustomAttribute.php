<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
class CollectionCustomAttribute extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = "Collection of attributes should contain no more than {{max}} attributes of a {{type}}. It contains {{count}}.";

    public int $maxItemPerType = 3;
}
