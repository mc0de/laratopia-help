<?php

namespace App\Http\Requests;

use App\Models\Package;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePackageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('package_create'),
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
                'unique:packages,name',
            ],
            'ads' => [
                'string',
                'nullable',
            ],
            'post' => [
                'string',
                'nullable',
            ],
            'design' => [
                'string',
                'nullable',
            ],
            'video' => [
                'string',
                'nullable',
            ],
            'platforms' => [
                'string',
                'nullable',
            ],
            'story' => [
                'string',
                'nullable',
            ],
        ];
    }
}
