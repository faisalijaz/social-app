<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class UpdatePostRequest extends Request
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
        Request::merge(array('user_id' => Auth::id()));

        return [
            'title' => 'required|string|min:3|max:250',
            'short_description' => 'required',
            'upload_image' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
    }
}
