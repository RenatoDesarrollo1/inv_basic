<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div x-data="{ open: false }">
    <nav class="fixed top-0 left-0 w-full bg-white border-b border-gray-300 z-[8]">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-12">
                <button @click="open = ! open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

            </div>
        </div>

    </nav>
    <div x-show="open" x-on:click="open = ! open" class="fixed inset-0 transform z-[5]">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div :class="{ '-translate-x-72': !open, 'translate-x-0': open, 'shadow-[6px_11px_12px_4px_#00000024]': open }"
        class="fixed top-12 left-0 h-full w-72 bg-white py-4 transition-all transform -translate-x-72 p-5 z-[5] shadow-[6px_11px_12px_4px_#00000024]">
        <!-- Settings Dropdown -->
        <div class="flex flex-col">
            <div class="mb-2">
                <a href="/"
                    class="block px-4 py-2 font-medium text-gray-800 hover:bg-gray-200 transition duration-300 rounded">
                    Inicio
                </a>
                <a href="/inventario"
                    class="block px-4 py-2 font-medium text-gray-800 hover:bg-gray-200 transition duration-300 rounded">
                    Inventario
                </a>
                <a href="/personal"
                    class="block px-4 py-2 font-medium text-gray-800 hover:bg-gray-200 transition duration-300 rounded">
                    Personal
                </a>
                {{-- <a href="/activos"
                    class="block px-4 py-2 font-medium text-gray-800 hover:bg-gray-200 transition duration-300 rounded">
                    Activos
                </a> --}}
                <a href="/salidas"
                    class="block px-4 py-2 font-medium text-gray-800 hover:bg-gray-200 transition duration-300 rounded">
                    Salidas
                </a>


                <div class="mt-4">
                    <x-button color="danger" wire:click="logout"
                        class="w-full flex justify-center items-center px-4 py-2 text-red-600 hover:text-white hover:bg-red-600 transition duration-300 rounded">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 me-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>

                        Cerrar sesión
                    </x-button>
                </div>
            </div>
        </div>
    </div>
