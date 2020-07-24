<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * 规则：验证字段可能包含字母、数字、点，以及破折号 (-) 和下划线 ( _ )
 *
 * @package App\Rules
 */
class AlphaDashDot implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        return preg_match('/^[\.\pL\pM\pN_-]+$/u', $value) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.alpha_dash_dot');
    }
}
