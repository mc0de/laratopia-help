<?php

namespace App\Http\Requests;

use App\Models\Post;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('post_create'),
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
            'title' => [
                'string',
                'nullable',
            ],
            'content' => [
                'string',
                'nullable',
            ],
            'category' => [
                'array',
            ],
            'category.*.id' => [
                'integer',
                'exists:postcategories,id',
            ],
            'status' => [
                'nullable',
                'in:' . implode(',', array_keys(Post::STATUS_RADIO)),
            ],
            'confirmation' => [
                'nullable',
                'in:' . implode(',', array_keys(Post::CONFIRMATION_RADIO)),
            ],
            'note' => [
                'string',
                'nullable',
            ],
            'review' => [
                'nullable',
                'in:' . implode(',', array_keys(Post::REVIEW_RADIO)),
            ],
            'team_id' => [
                'integer',
                'exists:teams,id',
                'required',
            ],
        ];
    }
}
