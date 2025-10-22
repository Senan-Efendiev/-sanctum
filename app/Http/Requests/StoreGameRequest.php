<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'developer_id' => 'required|exists:developers,id',
            'genre_id' => 'required|exists:genres,id',
            'platform' => 'required|string|max:50',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id'
        ];
    }
}
