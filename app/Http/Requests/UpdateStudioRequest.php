<?php

namespace App\Http\Requests;

use App\Models\Studio;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudioRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('studio_edit'),
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
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'date' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'time' => [
                'nullable',
                'date_format:' . config('project.time_format'),
            ],
            'status' => [
                'string',
                'nullable',
            ],
            'team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }
}
