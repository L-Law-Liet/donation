<?php

namespace App\Rules;

use App\Models\Field;
use App\Models\Option;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OptionExists implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $attrs = explode('.', $attribute);
        $field = request()->input('filter.fields.'.$attrs[count($attrs) - 1])['id'];
        if (!Option::where([
            'field_id' => $field,
            'id' => $value,
        ])->exists()) {
            $fail('Option not exist.');
        }
    }
}
