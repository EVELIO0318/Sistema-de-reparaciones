<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'username'=>'required|unique:users,username',
            'password'=>'required|min:8',
            'password_confirmation'=>'required|same:password',
        ];
    }


        public function messages()
        {
            return [
                'name.required'=>'Por favor ingrese el Nombre',
                'email.required'=>'Por favor ingrese el Correo',
                'email.unique'=>'Ya existe un usuario con este correo',
                'username.required'=>'Por favor Ingrese el Nombre de usuario',
                'username.unique'=>'Ya existe este Nombre de usuario',
                'password.required'=>'La contraseña debe llevar minimo 8 carácteres',
                'password.min'=>'La contraseña debe llevar minimo 8 carácteres',
                'password_confirmation.required'=>'Las contraseñas no coinciden',
                'password_confirmation.same'=>'Las contraseñas no coinciden',
                
            ];
        }


    // protected function failedValidation(Validator $validator)
    // {
    //     foreach ($validator->errors()->messages() as $message) {

    //         // flash()->addError($message[0], __('error'));
    //         dd($validator);
    //     }
    // }
}
