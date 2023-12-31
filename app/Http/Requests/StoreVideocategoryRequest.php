<?php

namespace App\Http\Requests;

use App\Models\Videocategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVideocategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('videocategory_create'),
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
                'unique:videocategories,name',
            ],
        ];
    }
}
