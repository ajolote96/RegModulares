<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'paterno' => ['required', 'string',  'max:100'],
            'materno' => ['required', 'string',  'max:100'],
            'codigo' => ['required','min:9' ,'max:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'nombre' => $input['name'],
            'email' => $input['email'],
            'codigo' => $input['codigo'],
            'paterno' => $input['paterno'],
            'materno' => $input['materno'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
