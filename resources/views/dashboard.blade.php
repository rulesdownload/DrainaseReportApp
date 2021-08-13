<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Selamat Datang di Aplikasi Layanan Aduan Saluran Air Bermasalah di Manado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @livewire('list-dashboard') 
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
