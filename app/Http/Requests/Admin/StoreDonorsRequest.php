<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
            'patient' => 'min:1|max:30|required',
            'patient_id' => 'required|integer',
            'phone_number' => 'required',
            'status' => 'required',
            'last_donation' => 'required|date_format:'.config('app.date_format'),
        ];
    }
}
