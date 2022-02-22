<?php

namespace App\Rules;

use Carbon\Carbon;
use InvalidArgumentException;
use Illuminate\Contracts\Validation\Rule;

class YoungerThan implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->maxAge = 90;
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
        try {
            return Carbon::now()->diff(Carbon::parse($value))->y < $this->maxAge;
        } catch (InvalidArgumentException $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.YoungerThan', ['age' => $this->maxAge]);
    }
}
