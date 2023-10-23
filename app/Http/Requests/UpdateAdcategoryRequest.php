<?php

namespace App\Http\Requests;

use App\Models\Adcategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAdcategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('adcategory_edit'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:adcategories,name,' . request()->route('adcategory')->id,
            ],
        ];
    }
}
