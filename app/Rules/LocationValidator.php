<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LocationValidator implements ValidationRule
{
    protected ?string $lat;
    protected ?string $lng;
    public function __construct($latlong=",")
    {
        $this->lat = !empty($latlong)? explode(",",$latlong)[0]:null;
        $this->lng = !empty($latlong)? explode(",",$latlong)[1]:null;
    }
    
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $latitudeRegex = '/^-?([1-8]?[0-9](\.\d+)?|90(\.0+)?)$/';
        $longitudeRegex = '/^-?((1[0-7][0-9]|[1-9]?[0-9])(\.\d+)?|180(\.0+)?)$/';

        if(empty($this->lat) || empty($this->lng)){
            $fail("The $attribute field is required.");
        }
        if (!preg_match($latitudeRegex, $this->lat)) {
            $fail("The $attribute.latitude is not a valid latitude.");
        }

        if (!preg_match($longitudeRegex, $this->lng)) {
            $fail("The $attribute.longitude is not a valid longitude.");
        }
    }
}
