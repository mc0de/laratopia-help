<?php

namespace App\Http\Requests;

use App\Models\Videocategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVideocategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('videocategory_edit'),
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
                'unique:videocategories,name,' . request()->route('videocategory')->id,
            ],
        ];
    }
}
