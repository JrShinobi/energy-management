<!-- facteur_puissance.blade.php -->

<x-app-layout>
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
                                <a href="{{ route('courant') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Courant') }}</span>
                                </a>
                                <a href="{{ route('tension') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Tension') }}</span>
                                </a>
                                <a href="{{ route('puissance') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Puissance') }}</span>
                                </a>
                                <a href="{{ route('energie') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Énergie') }}</span>
                                </a>
                                <a href="{{ route('facteur_puissance') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Facteur de Puissance') }}</span>
                                </a>
                                <a href="{{ route('frequence') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Fréquence') }}</span>
                                </a>
                            </ul>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('rapport')}}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                <span class="font-semibold">{{ __('Rapports') }}</span>
                                <span><i class="fas fa-chart-bar"></i></span>
                            </a>
                        </li>
                        <li>
                    <a href="{{ route('historique_alarme') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                        <span class="font-semibold">{{ __('Historique Alarme') }}</span>
                    </a>
                    </li>
                    </ul>
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
                        <form method="GET" action="{{ route('facteur_puissance') }}">
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
</x-app-layout>

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
        function getCurrentMonthData(facteurDePuissances) {
            const currentDate = new Date();
            const currentMonthData = facteurDePuissances.filter(facteur => {
                const facteurDate = new Date(facteur.created_at);
                return facteurDate.getMonth() === currentDate.getMonth() && facteurDate.getFullYear() === currentDate.getFullYear();
            });
            return currentMonthData;
        }

        // Initial data from Laravel
        const facteurDePuissances = @json($facteurDePuissances);

        // Generate labels and data for the current month
        const labels = getCurrentMonthLabels();
        const currentMonthData = getCurrentMonthData(facteurDePuissances);
        
        console.log('Labels:', labels); // Debugging
        console.log('Current Month Data:', currentMonthData); // Debugging
        
        const facteurAtelieData = labels.map(day => {
            const dataPoint = currentMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
            console.log('Facteur Atelie Data Point for Day', day, ':', dataPoint); // Debugging
            return dataPoint ? dataPoint.facteur_atelie : null;
        });
        
        const facteurAdminData = labels.map(day => {
            const dataPoint = currentMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
            console.log('Facteur Admin Data Point for Day', day, ':', dataPoint); // Debugging
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

        // Prepare the data for the chart
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
                    tension: 0 // Set tension to 0 for consistent lines
                },
                {
                    label: 'Facteur Admin',
                    data: facteurAdminData,
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

        const facteurConfig = {
            type: 'line',
            data: facteurData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 1 // Adjust the max value as needed
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

        // Update data and labels when a new month starts
        function updateChartData() {
            const newLabels = getCurrentMonthLabels();
            const newMonthData = getCurrentMonthData(facteurDePuissances);
            const newFacteurAtelieData = newLabels.map(day => {
                const dataPoint = newMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
                return dataPoint ? dataPoint.facteur_de_puissance_atelie : null;
            });
            const newFacteurAdminData = newLabels.map(day => {
                const dataPoint = newMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
                return dataPoint ? dataPoint.facteur_de_puissance_admin : null;
            });
            const newUsineData = newLabels.map(day => {
                const dataPoint = newMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
                return dataPoint ? dataPoint.usine : null;
            });
            const newMagasinData = newLabels.map(day => {
                const dataPoint = newMonthData.find(facteur => new Date(facteur.created_at).getDate() === day);
                return dataPoint ? dataPoint.magasin : null;
            });
            facteurChart.data.labels = newLabels;
            facteurChart.data.datasets[0].data = newFacteurAtelieData;
            facteurChart.data.datasets[1].data = newFacteurAdminData;
            facteurChart.data.datasets[2].data = newUsineData;
            facteurChart.data.datasets[3].data = newMagasinData;
            facteurChart.update();
        }

        // Call updateChartData when the month changes
        window.addEventListener('DOMContentLoaded', updateChartData);
    });
</script>

