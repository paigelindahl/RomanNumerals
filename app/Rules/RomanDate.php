<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RomanDate implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $parts = explode('-', $value);

        if (count($parts) !== 3) {
            return false;
        }

        list($day, $month, $year) = $parts;

        return $this->isValidRoman($day) && $this->isValidRoman($month) && $this->isValidRoman($year);
    }

    /**
     * Validate the string is valid roman numerals
     *
     * @param  string  $roman
     * @return bool
     */
    private function isValidRoman($roman)
    {
        $romanRegex = '/^(?=[MDCLXVI])M*(C[MD]|D?C{0,3})(X[CL]|L?X{0,3})(I[XV]|V?I{0,3})$/i';
        return preg_match($romanRegex, $roman);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid Roman numeral date in the format D-M-Y. eg. XII-V-MMXX';
    }
}
