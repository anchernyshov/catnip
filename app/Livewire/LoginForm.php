<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginForm extends Component
{
    public $login;
    public $password;

    public $rules = [
        'login' => 'required',
        'password' => 'required'
    ];

    public function submit()
    {
        $this->validate();

        $user = \App\Models\User::with('role')->where('name', '=', strtolower($this->login))->first();

        if (!$user) {
            $this->addError('result', 'User not found!');
            return;
        }

        $password_valid = Hash::check($this->password, $user->password);

        if ($password_valid) {
            Auth::login( $user );
            return \Redirect::to('/');
        } else {
            $this->addError('result', 'Invalid password!');
        }
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
