@extends('layouts.admin')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-full lg:w-72 bg-gray-800 shadow-lg rounded-r-lg lg:rounded-r-none mb-4 lg:mb-0">
        <div class="p-8">
            <div class="text-white text-xl font-bold mb-6">{{ __('Navigation') }}</div>
            <nav class="mt-10">
                <ul>
                    <li x-data="{ open: false }" class="mb-4">
                        <a @click="open = !open" href="#" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                            <span class="font-semibold">{{ __('Gestion des données') }}</span>
                            <span>
                                <i :class="{ 'fa-chevron-up': open, 'fa-chevron-down': !open }" class="fas"></i>
                            </span>
                        </a>
                        <ul x-show="open" class="pl-4">
                            <a href="{{ route('admin.courant') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                <span class="font-semibold">{{ __('Courant') }}</span>
                            </a>
                            <a href="{{ route('admin.tension') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                <span class="font-semibold">{{ __('Tension') }}</span>
                            </a>
                            <a href="{{ route('admin.puissance') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                <span class="font-semibold">{{ __('Puissance') }}</span>
                            </a>
                            <a href="{{ route('admin.energie') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                <span class="font-semibold">{{ __('Énergie') }}</span>
                            </a>
                            <a href="{{ route('admin.facteur_puissance') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                <span class="font-semibold">{{ __('Facteur de Puissance') }}</span>
                            </a>
                            <a href="{{ route('admin.frequence') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                <span class="font-semibold">{{ __('Fréquence') }}</span>
                            </a>
                        </ul>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.rapport')}}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                            <span class="font-semibold">{{ __('Rapports') }}</span>
                            <span><i class="fas fa-chart-bar"></i></span>
                        </a>
                    </li>
                    <li x-data="{ open: false }" class="mb-4">
                        <a @click="open = !open" href="#" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                            <span class="font-semibold">{{ __('Réglage') }}</span>
                            <span>
                                <i :class="{ 'fa-chevron-up': open, 'fa-chevron-down': !open }" class="fas"></i>
                            </span>
                        </a>
                        <ul x-show="open" class="pl-4">
                            <li>
                                <a href="{{ route('admin.gestion_alarme') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Gestion d\'alarme') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.gestion_utilisateur') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Gestion d\'utilisateur') }}</span>
                                </a>
                            </li>   
                    </li>
                </ul>
                <li>
                    <a href="{{ route('admin.historique_alarme') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                        <span class="font-semibold">{{ __('Historique Alarme') }}</span>
                    </a>
                    </li>
            </nav>
        </div>
    </aside>
    <!-- Main Content Area -->
    <div class="px-20 py-14">
            <div class="max-w-5xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">Consommation de Facteur de Puissance (Mois)</h2>
                    <div class="flex justify-center">
                        <canvas id="facteurChart" width="900" height="450"></canvas>
                    </div>
                    <div class="flex justify-between mt-4">
                        <form method="GET" action="{{ route('admin.facteur_puissance') }}">
                            <div class="flex">
                                <div>
                                    <label for="fromDatefc" class="text-sm font-semibold text-gray-600">Du:</label>
                                    <input type="date" name="fromDatefc" id="fromDatefc" class="ml-2 border border-gray-300 rounded-md px-3 py-1" value="{{ request('fromDatefc') }}">
                                </div>
                                <div class="ml-4">
                                    <label for="toDatefc" class="text-sm font-semibold text-gray-600">Au:</label>
                                    <input type="date" name="toDatefc" id="toDatefc" class="ml-2 border border-gray-300 rounded-md px-3 py-1" value="{{ request('toDatefc') }}">
                                </div>
                                <div class="ml-4">
                                    <button type="submit" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded">Filtrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function getCurrentMonthLabels() {
            const currentDate = new Date();
            const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
            return Array.from({ length: daysInMonth }, (_, i) => i + 1);
        }

        function getCurrentMonthData(facteurDePuissances) {
            const currentDate = new Date();
            return facteurDePuissances.filter(facteur => {
                const facteurDate = new Date(facteur.created_at);
                return facteurDate.getMonth() === currentDate.getMonth() && facteurDate.getFullYear() === currentDate.getFullYear();
            });
        }

        const facteurDePuissances = @json($facteurs);
        const labels = getCurrentMonthLabels();
        const currentMonthData = getCurrentMonthData(facteurDePuissances);

        const facteurAtelieData = labels.map(day => {
            const dataPoint = currentMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
            return dataPoint ? dataPoint.facteur_atelie : null;
        });

        const facteurAdminData = labels.map(day => {
            const dataPoint = currentMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
            return dataPoint ? dataPoint.facteur_admin : null;
        });

        const usineData = labels.map(day => {
            const dataPoint = currentMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
            return dataPoint ? dataPoint.usine : null;
        });

        const magasinData = labels.map(day => {
            const dataPoint = currentMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
            return dataPoint ? dataPoint.magasin : null;
        });

        const facteurData = {
            labels: labels,
            datasets: [
                {
                    label: 'Facteur Atelie',
                    data: facteurAtelieData,
                    borderColor: '#4299E1',
                    borderWidth: 2,
                    pointRadius: 3,
                    spanGaps: true,
                    tension: 0
                },
                {
                    label: 'Facteur Admin',
                    data: facteurAdminData,
                    borderColor: '#E53E3E',
                    borderWidth: 2,
                    pointRadius: 3,
                    spanGaps: true,
                    tension: 0
                },
                {
                    label: 'Usine',
                    data: usineData,
                    borderColor: '#38B2AC',
                    borderWidth: 2,
                    pointRadius: 3,
                    spanGaps: true,
                    tension: 0
                },
                {
                    label: 'Magasin',
                    data: magasinData,
                    borderColor: '#ED8936',
                    borderWidth: 2,
                    pointRadius: 3,
                    spanGaps: true,
                    tension: 0
                }
            ]
        };

        const facteurConfig = {
            type: 'line',
            data: facteurData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 1
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                layout: {
                    padding: {
                        left: -1
                    }
                }
            }
        };

        var facteurChart = new Chart(
            document.getElementById('facteurChart'),
            facteurConfig
        );
    });
</script>
@endsection