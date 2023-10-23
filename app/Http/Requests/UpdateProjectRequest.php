<?php

namespace App\Http\Requests;

use App\Models\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProjectRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('project_edit'),
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
                'unique:projects,name,' . request()->route('project')->id,
            ],
            'owner_id' => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'package' => [
                'required',
                'array',
            ],
            'package.*.id' => [
                'integer',
                'exists:packages,id',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'statues' => [
                'nullable',
                'in:' . implode(',', array_keys(Project::STATUES_RADIO)),
            ],
            'assignee' => [
                'required',
                'array',
            ],
            'assignee.*.id' => [
                'integer',
                'exists:users,id',
            ],
            'team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }
}
