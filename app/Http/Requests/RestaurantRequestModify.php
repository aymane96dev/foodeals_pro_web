<?php

namespace App\Http\Requests;
use Session;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequestModify extends FormRequest
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


    public function rules()
    {
        Session::flash('warning','Vérifiez que vos champs sont tous remplis');
        return [
            'nom1'  => 'required',
            'email1'  => 'required|email',
            'description1'  => 'required',
            'adresse1'  => 'required',
            'tele1'  => 'required',
            'gerant1'  => 'required'

            
        
        ];
    }
    public function messages(){
        return [
            'nom1.required'=>'le champ nom est obligatoire',
            'email1.required'=>'le champ email est obligatoire',
            'description1.required'=>'le champ description est obligatoire',
            'adresse1.required'=>'le champ description est obligatoire',
            'tele1.required'=>'le champ télephone est obligatoire',
            'gerant1.required'=>'le champ nom gérant  est obligatoire'

      
        ];
      }
}
