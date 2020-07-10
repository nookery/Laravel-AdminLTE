<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Keyword implements Rule
{
    /*
    |--------------------------------------------------------------------------
    | 通用的搜索关键词的校验规则
    |--------------------------------------------------------------------------
    |
    */

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
            $attribute => 'string|min:1|max:50'
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
