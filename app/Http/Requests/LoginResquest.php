<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory As ValidationFactory;

class LoginResquest extends FormRequest
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
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function getCredential()
    {
        // traemos las credenciales aqui
        $username = $this->get('username');

        // validamos si es correo o usuario
        if ($this->isEmail($username)) {
            return 
                ['email'=> $username,
                'password' => $this->get('password'),
                ];
        }
        return $this->only('username','password');
    }


    //en esta funcion veremos si el valor es email o username
    public function isEmail($value)
    {
        $factory=$this->container->make(ValidationFactory::class);

        return !$factory->make(['username'=>$value],['username'=>'email'])->fails();
    }
}
