<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;

class StoreDonationsRequest extends FormRequest
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
            'date_donated' => 'required|date_format:'.config('app.date_format'),
            'donor_id' => 'required',
            // 'patient_id' => 'required', 
            // 'trans_code' => 'required',  
            'weight' => 'required',
            'blood_count' => 'required',
            'result' => 'required',
            'status' => 'required',
            'flag' => 'required',
        ];
    }
}
