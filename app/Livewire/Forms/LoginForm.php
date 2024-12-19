<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    public string $email = '';

    #[Validate('required|string')]
    public string $username = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $user = User::where('username', $this->username)->first();

        if (isset($user->id)) {
            $this->email =  $user?->email;
        } else {
            throw ValidationException::withMessages([
                'form.username' => 'Usuario no encontrado'
            ]);
        }

        if (!Auth::attempt($this->only(['email', 'password']), $this->remember)) {

            throw ValidationException::withMessages([
                'form.username' => 'Credenciales incorrectas',
            ]);
        }
    }
}
