<?php

namespace App\Http\Requests;
use Session;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
        Session::flash('warning','Vérifiez que vos champs sont tous remplit');
        return [
            'nom'  => 'required',
            'email'  => 'required|email',
            'description'  => 'required',
            'password'  => 'required',
            'adresse'  => 'required',
            'logo'  => 'required',
            'tele'  => 'required',
            'gerant'  => 'required'
        
        ];
    }
    public function messages(){
        return [
            'nom.required'=>'le champ nom est obligatoire',
            'email.required'=>'le champ email est obligatoire',
            'description.required'=>'le champ description est obligatoire',
            'password.required'=>'le champ password est obligatoire',
            'adresse.required'=>'le champ description est obligatoire',
            'logo.required'=>'le champ description est obligatoire',
            'tele.required'=>'le champ télephone est obligatoire',
            'gerant.required'=>'le champ nom gérant est obligatoire'

      
        ];
      }

}
