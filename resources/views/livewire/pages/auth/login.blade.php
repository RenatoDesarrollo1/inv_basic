<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <div class="mt-4">
            <x-input label="Usuario" type="text" wire:model="form.username" :error="$errors->first('form.username')" />
        </div>
        <div class="mt-4">
            <x-input label="Contraseña" type="password" wire:model="form.password" :error="$errors->first('form.password')" />
        </div>


        <div class="w-full flex items-center justify-end mt-4">

            <x-button color="primary">
                Ingresar
            </x-button>
        </div>
    </form>
</div>
