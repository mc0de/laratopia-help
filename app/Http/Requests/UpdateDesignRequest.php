<?php

namespace App\Http\Requests;

use App\Models\Design;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDesignRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('design_edit'),
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
            'project_id' => [
                'integer',
                'exists:projects,id',
                'nullable',
            ],
            'post_id' => [
                'integer',
                'exists:posts,id',
                'nullable',
            ],
            'statues' => [
                'nullable',
                'in:' . implode(',', array_keys(Design::STATUES_RADIO)),
            ],
            'confirmation' => [
                'nullable',
                'in:' . implode(',', array_keys(Design::CONFIRMATION_RADIO)),
            ],
            'note' => [
                'string',
                'nullable',
            ],
            'review' => [
                'nullable',
                'in:' . implode(',', array_keys(Design::REVIEW_RADIO)),
            ],
            'team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }
}
