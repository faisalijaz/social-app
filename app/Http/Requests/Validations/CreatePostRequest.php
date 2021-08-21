<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreatePostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Request::merge(['user_id' => Auth::id()]);

        return [
            'title' => 'required|string|min:3|max:250',
            'short_description' => 'required',
            'upload_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
    }
}
