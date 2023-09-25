<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DueDate implements ValidationRule
{
    /**
     * Determine if the validation rule passes.
     *
     * This method checks if the provided value (date) matches one of the allowed formats.
     * The allowed formats include YYYY-MM-DD, YYYYMMDD, and DDMMYYYY.
     * If the value does not match any of these formats, the validation fails.
     *
     * @param string $attribute The name of the attribute being validated.
     * @param mixed $value The value of the attribute being validated.
     * @param Closure $fail The closure to call if validation fails.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Use a regular expression to check if the value matches one of the allowed formats
        if (! preg_match('/^(\d{4}-\d{2}-\d{2}|\d{8}|(\d{2})(\d{2})(\d{4}))$/', $value)) {
            // If the value does not match any of the allowed formats, validation fails
            $fail('The :attribute must be a valid date.');
        }
    }
}
