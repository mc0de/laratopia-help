<?php

namespace App\Http\Requests;

use App\Models\Video;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVideoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('video_create'),
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
            'category' => [
                'array',
            ],
            'category.*.id' => [
                'integer',
                'exists:videocategories,id',
            ],
            'status' => [
                'nullable',
                'in:' . implode(',', array_keys(Video::STATUS_RADIO)),
            ],
            'confirmation' => [
                'nullable',
                'in:' . implode(',', array_keys(Video::CONFIRMATION_RADIO)),
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'review' => [
                'nullable',
                'in:' . implode(',', array_keys(Video::REVIEW_RADIO)),
            ],
            'team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }
}
