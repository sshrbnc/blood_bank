<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;

class StoreDonorsRequest extends FormRequest
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
        return [
            'name' => 'min:1|max:30|required',

            'blood_type' => 'required',            
            'birthday' => 'required|date_format:'.config('app.date_format'),
            'sex' => 'required',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/(09|\+639)\d{9}$/'],
        ];
    }
}
