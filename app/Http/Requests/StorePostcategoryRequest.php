<?php

namespace App\Http\Requests;

use App\Models\Postcategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostcategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('postcategory_create'),
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
                'unique:postcategories,name',
            ],
        ];
    }
}
