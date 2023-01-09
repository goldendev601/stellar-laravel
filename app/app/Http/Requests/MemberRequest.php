<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = request()->route('id');
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:member,email,' . $id . ',id',
            'msisdn' => 'required',
            'zipcode' => 'required',
            'interests' => 'nullable|string',
            'image' => 'nullable|image|max:20000',
            'member_status_id' => 'required|exists:member_status,id'
        ];
    }
}
