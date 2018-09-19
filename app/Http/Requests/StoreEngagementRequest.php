<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreEngagementRequest extends FormRequest
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
        $rules['client_id'] = 'required|exists:clients,id';
        $rules['pet_id'] = 'required|exists:pets,id';
        $rules['services'] = 'required|array|min:1';
        $rules['date'] = 'required|date_format:Y-m-d';

        if (!empty($this->input('services'))) {
            if(in_array('consultation', $this->input('services'))){
                $rules['details.consultation.users'] = 'required|array|min:1';
                $rules['details.consultation.users.*'] = 'exists:users,id';
                if ($this->input('details.consultation.products.0') == Product::where('name', 'LIKE', 'CONSULTA SIN COSTO')->first()->id) {
                    $rules['details.consultation.without_cost'] = 'required';
                }
                if ($this->input('home_service') !== 'on') {
                    $rules['details.consultation.start_time'] = 'required';
                    $rules['details.consultation.end_time'] = 'required';
                }
            }

            if(in_array('services', $this->input('services'))){
                $rules['details.services.users'] = 'required|array|min:1';
                $rules['details.services.users.*'] = 'exists:users,id';
                $rules['details.services.products'] = 'required|array|min:1';
                $rules['details.services.products.*'] = 'exists:products,id';
                if ($this->input('home_service') !== 'on') {
                    $rules['details.services.start_time'] = 'required';
                    $rules['details.services.end_time'] = 'required';
                }
            }

            if(in_array('surgery', $this->input('services'))){
                $rules['details.surgery.users'] = 'required|array|min:1';
                $rules['details.surgery.users.*'] = 'exists:users,id';
                $rules['details.surgery.products'] = 'required|array|min:1';
                $rules['details.surgery.products.*'] = 'exists:products,id';
                if ($this->input('home_service') !== 'on') {
                    $rules['details.surgery.start_time'] = 'required';
                    $rules['details.surgery.end_time'] = 'required';
                }
            }

            if(in_array('aesthetic', $this->input('services'))){
                $rules['details.aesthetic.users'] = 'required|array|min:1';
                $rules['details.aesthetic.users.*'] = 'exists:users,id';
                $rules['details.aesthetic.products'] = 'required|array|min:1';
                $rules['details.aesthetic.products.*'] = 'exists:products,id';
            }
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'services.required' => 'Selecciona por lo menos 1 servicio'
        ];
    }
}
