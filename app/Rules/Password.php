<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * 本系统的用户密码规则
 *
 * Class Password
 * @package App\Rules
 */
class Password implements Rule
{
    /**
     * 错误信息
     *
     * @var
     */
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $validator = Validator::make([$attribute => $value], [
            $attribute => ['string', 'min:8', 'max:128', new AlphaDashDot]
        ]);

        if ($validator->fails()) {
            $this->message = $validator->errors()->first();
        }

        return !$validator->fails();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
