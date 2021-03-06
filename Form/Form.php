<?php

namespace Mosaab\MVC\Form;

use Mosaab\MVC\Model;

class Form
{
    public static function begin($action, $method): Form
    {
        echo sprintf('<form action="%s" method="%s">' , $action, $method);
        return new self();
    }

    public static function end(): void
    {
        echo '</form>';
    }

    public function field(Model $model , $attribute): InputField
    {
        return new InputField($model, $attribute);
    }
}