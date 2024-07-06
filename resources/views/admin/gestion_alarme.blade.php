@extends('layouts.admin')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-full lg:w-72 bg-gray-800 shadow-lg rounded-r-lg lg:rounded-r-none mb-4 lg:mb-0">
        <div class="p-8">
            <div class="text-white text-xl font-bold mb-6">{{ __('Admin Navigation') }}</div>
            <nav class="mt-10">
                <ul>
                    <!-- Gestion des données Dropdown -->
                    <li x-data="{ open: false }" class="mb-4">
                        <a @click="open = !open" href="#" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                            <span class="font-semibold">{{ __('Gestion des données') }}</span>
                            <i :class="{ 'fa-chevron-up': open, 'fa-chevron-down': !open }" class="fas"></i>
                        </a>
                        <ul x-show="open" class="pl-4 mt-2 space-y-2">
                            <li>
                                <a href="{{ route('admin.courant') }}" class="block text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition duration-200">
                                    {{ __('Courant') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.tension') }}" class="block text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition duration-200">
                                    {{ __('Tension') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.puissance') }}" class="block text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition duration-200">
                                    {{ __('Puissance') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.energie') }}" class="block text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition duration-200">
                                    {{ __('Energie') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.facteur_puissance') }}" class="block text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition duration-200">
                                    {{ __('Facteur de Puissance') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.frequence') }}" class="block text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition duration-200">
                                    {{ __('Frequence') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Rapports -->
                    <li class="mb-4">
                        <a href="{{ route('admin.rapport') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                            <span class="font-semibold">{{ __('Rapports') }}</span>
                            <i class="fas fa-chart-bar"></i>
                        </a>
                    </li>

                    <!-- Réglage Dropdown -->
                    <li x-data="{ open: false }" class="mb-4">
                        <a @click="open = !open" href="#" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                            <span class="font-semibold">{{ __('Réglage') }}</span>
                            <i :class="{ 'fa-chevron-up': open, 'fa-chevron-down': !open }" class="fas"></i>
                        </a>
                        <ul x-show="open" class="pl-4 mt-2 space-y-2">
                            <li>
                                <a href="{{ route('admin.gestion_alarme') }}" class="block text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition duration-200">
                                    {{ __('Gestion d\'alarme') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.gestion_utilisateur') }}" class="block text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition duration-200">
                                    {{ __('Gestion d\'utilisateur') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                    <a href="{{ route('admin.historique_alarme') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                        <span class="font-semibold">{{ __('Historique Alarme') }}</span>
                    </a>
                    </li>
                </ul>
                
            </nav>
        </div>
    </aside>

   <!-- Main Content -->
<div class="flex-grow p-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-8">{{ __('Gestion des alarmes') }}</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-lg flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m1 0a9 9 0 11-8 4.4m-1.74 3.32a7.5 7.5 0 118-3.14"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.gestion_alarme.update') }}" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $fields = [
                    'courant' => 'Limite de Courant',
                    'tension' => 'Limite de Tension',
                    'puissance' => 'Limite de Puissance',
                    'energie' => 'Limite d\'Energie',
                    'frequence' => 'Limite de Frequence',
                    'facteur_puissance' => 'Limite de Facteur de Puissance'
                ];
            @endphp

            @foreach($fields as $field => $label)
                <div class="relative">
                    <label for="{{ $field }}" class="block text-gray-700 font-medium mb-2">{{ __($label) }}</label>
                    <input id="{{ $field }}" type="number" step="0.01" name="{{ $field }}" value="{{ $alarmeSettings->$field ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150" required>
                    <svg class="w-6 h-6 absolute top-0 right-0 mt-2 mr-2 text-gray-400 hover:text-gray-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="hidden absolute top-8 right-0 mt-2 w-64 p-2 bg-white border border-gray-300 rounded-lg shadow-lg text-sm text-gray-700">
                        {{ __("Entrez la valeur maximale pour $label.") }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-end mt-8">
            <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-blue-700 transition duration-200">
                {{ __('Mettre à jour') }}
            </button>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('svg').forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.nextElementSibling.classList.remove('hidden');
        });
        icon.addEventListener('mouseleave', function() {
            this.nextElementSibling.classList.add('hidden');
        });
    });
</script>

@endsection
