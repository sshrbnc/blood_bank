<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;

class StoreBloodsRequest extends FormRequest
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
        // return [
        //     'donor_id' => 'numeric',
        //     'blood_type' => 'required',
        //     'component' => 'required',
        //     'date_donated' => 'required|date_format:'.config('app.date_format'),
        //     'exp_date' => 'required|date_format:'.config('app.date_format'),
        // ];
    }
}
