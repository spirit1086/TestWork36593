<?php
namespace App\Api\Book\Validation;

use Illuminate\Support\Facades\Validator;

class Validation
{
    public static function fields(array $data,array $rules)
    {
        $validator = Validator::make($data, $rules);

        if($validator->fails()){
            return $validator->errors()->all();
        }
        return true;
    }
}
