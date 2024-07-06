@extends('layouts.admin')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-full lg:w-72 bg-gray-800 shadow-lg rounded-r-lg lg:rounded-r-none mb-4 lg:mb-0">
        <div class="p-8">
            <div class="text-white text-xl font-bold mb-6">{{ __('Admin Navigation') }}</div>
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
                            <li>
                                <a href="{{ route('admin.courant') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Courant') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.tension') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Tension') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.puissance') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Puissance') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.energie') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Energie') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.facteur_puissance') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Facteur de Puissance') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.frequence') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Frequence') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.rapport') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
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
    <div class="flex-1">
        <div class="px-6 py-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <!-- Carte de Consommation d'Électricité pour le Mois -->
                    <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200 transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-700">Consommation d'Électricité (Mois)</h2>
                            <i class="fas fa-calendar-alt fa-2x text-gray-400"></i>
                        </div>
                        <p class="text-6xl font-extrabold text-gray-800 mb-2">
                            {{ $monthData->sum('energie_atelie') + $monthData->sum('energie_admin') + $monthData->sum('usine') + $monthData->sum('magasin') }} KW
                        </p>
                        <p class="text-gray-500" id="monthDate">Date: </p>
                    </div>

                    <!-- Carte de Consommation d'Électricité pour la Semaine -->
                    <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200 transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-700">Consommation d'Électricité (Semaine)</h2>
                            <i class="fas fa-calendar-week fa-2x text-gray-400"></i>
                        </div>
                        <p class="text-6xl font-extrabold text-gray-800 mb-2">
                            {{ $weekData->sum('energie_atelie') + $weekData->sum('energie_admin') + $weekData->sum('usine') + $weekData->sum('magasin') }} KW
                        </p>
                        <p class="text-gray-500" id="weekDate">Date: </p>
                    </div>

                    <!-- Carte de Consommation d'Électricité pour Aujourd'hui -->
                    <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200 transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-700">Consommation d'Électricité (Aujourd'hui)</h2>
                            <i class="fas fa-calendar-day fa-2x text-gray-400"></i>
                        </div>
                        <p class="text-6xl font-extrabold text-gray-800 mb-2">
                            {{ $todayData->sum('energie_atelie') + $todayData->sum('energie_admin') + $todayData->sum('usine') + $todayData->sum('magasin') }} KW
                        </p>
                        <p class="text-gray-500" id="todayDate">Date: </p>
                    </div>
                </div>
            </div>
            <br>
            <!-- Courant Chart -->
            <div class="bg-white rounded-lg shadow-lg p-4 border border-gray-200 transform transition duration-500 hover:scale-100 hover:shadow-2xl">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Courant (Aujourd'hui)</h2>
                    <i class="fas fa-bolt fa-2x text-gray-400"></i>
                </div>
                <div class="flex justify-center p-2" style="margin-top: -10px;">
                    <canvas id="courantChart" width="275" height="100"></canvas>
                  </div>
            </div>
            </div>
        
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to get labels for the current month
        function getCurrentMonthLabels() {
            const currentDate = new Date();
            const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
            return Array.from({ length: daysInMonth }, (_, i) => i + 1);
        }

        // Function to get data for the current month
        function getCurrentMonthData(courants) {
            const currentDate = new Date();
            const currentMonthData = courants.filter(courant => {
                const courantDate = new Date(courant.created_at);
                return courantDate.getMonth() === currentDate.getMonth() && courantDate.getFullYear() === currentDate.getFullYear();
            });
            return currentMonthData;
        }

        // Initial data from Laravel
        const courants = @json($courants);

        // Generate labels and data for the current month
        const labels = getCurrentMonthLabels();
        const currentMonthData = getCurrentMonthData(courants);
        const courantAtelieData = labels.map(day => {
            const dataPoint = currentMonthData.find(courant => new Date(courant.created_at).getDate() === day);
            return dataPoint ? dataPoint.courant_atelie : null;
        });
        const courantAdminData = labels.map(day => {
            const dataPoint = currentMonthData.find(courant => new Date(courant.created_at).getDate() === day);
            return dataPoint ? dataPoint.courant_admin : null;
        });
        const usineData = labels.map(day => {
            const dataPoint = currentMonthData.find(courant => new Date(courant.created_at).getDate() === day);
            return dataPoint ? dataPoint.usine : null;
        });
        const magasinData = labels.map(day => {
            const dataPoint = currentMonthData.find(courant => new Date(courant.created_at).getDate() === day);
            return dataPoint ? dataPoint.magasin : null;
        });

        // Prepare the data for the chart
        const courantData = {
            labels: labels,
            datasets: [
                {
                    label: 'Courant Atelie',
                    data: courantAtelieData,
                    borderColor: '#4299E1',
                    borderWidth: 2,
                    pointRadius: 3,
                    spanGaps: true,
                    tension: 0 // Set tension to 0 for consistent lines
                },
                {
                    label: 'Courant Admin',
                    data: courantAdminData,
                    borderColor: '#E53E3E',
                    borderWidth: 2,
                    pointRadius: 3,
                    spanGaps: true,
                    tension: 0 // Set tension to 0 for consistent lines
                },
                {
                    label: 'Usine',
                    data: usineData,
                    borderColor: '#38B2AC',
                    borderWidth: 2,
                    pointRadius: 3,
                    spanGaps: true,
                    tension: 0 // Set tension to 0 for consistent lines
                },
                {
                    label: 'Magasin',
                    data: magasinData,
                    borderColor: '#ED8936',
                    borderWidth: 2,
                    pointRadius: 3,
                    spanGaps: true,
                    tension: 0 // Set tension to 0 for consistent lines
                }
            ]
        };

        // Configuration for the chart
        const courantConfig = {
            type: 'line',
            data: courantData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 100 // Set the max value to 100A
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                layout: {
                    padding: {
                        left: -2
                    }
                }
            }
        };

        // Create the chart
        var courantChart = new Chart(
            document.getElementById('courantChart'),
            courantConfig
        );

        // Update data and labels when a new month starts
        function updateChartData() {
            const newLabels = getCurrentMonthLabels();
            const newMonthData = getCurrentMonthData(courants);
            const newCourantAtelieData = newLabels.map(day => {
                const dataPoint = newMonthData.find(courant => new Date(courant.created_at).getDate() === day);
                return dataPoint ? dataPoint.courant_atelie : null;
            });
            const newCourantAdminData = newLabels.map(day => {
                const dataPoint = newMonthData.find(courant => new Date(courant.created_at).getDate() === day);
                return dataPoint ? dataPoint.courant_admin : null;
            });
            const newUsineData = newLabels.map(day => {
                const dataPoint = newMonthData.find(courant => new Date(courant.created_at).getDate() === day);
                return dataPoint ? dataPoint.usine : null;
            });
            const newMagasinData = newLabels.map(day => {
                const dataPoint = newMonthData.find(courant => new Date(courant.created_at).getDate() === day);
                return dataPoint ? dataPoint.magasin : null;
            });
            courantChart.data.labels = newLabels;
            courantChart.data.datasets[0].data = newCourantAtelieData;
            courantChart.data.datasets[1].data = newCourantAdminData;
            courantChart.data.datasets[2].data = newUsineData;
            courantChart.data.datasets[3].data = newMagasinData;
            courantChart.update();
        }

        // Call updateChartData when the month changes
        window.addEventListener('DOMContentLoaded', updateChartData);
    });


    function updateDate() {
        const todayDate = new Date().toLocaleDateString();
        document.getElementById('todayDate').textContent = `Date: ${todayDate}`;

        const weekDate = new Date(new Date().setDate(new Date().getDate() - new Date().getDay())).toLocaleDateString();
        document.getElementById('weekDate').textContent = `Date: ${weekDate}`;

        const monthDate = new Date(new Date().getFullYear(), new Date().getMonth(), 1).toLocaleDateString();
        document.getElementById('monthDate').textContent = `Date: ${monthDate}`;
    }

    document.addEventListener('DOMContentLoaded', updateDate);
</script>