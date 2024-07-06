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
                                    <span class="font-semibold">{{ __('Frequence') }}</span>
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
                    <h2 class="text-lg font-semibold mb-4">Consommation de Tension (Mois)</h2>
                    <div class="flex justify-center">
                        <canvas id="tensionChart" width="900" height="450"></canvas>
                    </div>
                    <div class="mt-4">
                        <form method="GET" action="{{ route('tension') }}" class="flex flex-col lg:flex-row items-center">
                            <div class="flex flex-col lg:flex-row items-center mb-6 lg:mb-0">
                                <div class="mr-4">
                                    <label for="fromDatet" class="text-sm font-semibold text-gray-600">Du:</label>
                                    <input type="date" name="fromDatet" id="fromDatet" class="ml-2 border border-gray-300 rounded-md px-3 py-1" value="{{ request('fromDatet') }}">
                                </div>
                                <div class="mr-4">
                                    <label for="toDatet" class="text-sm font-semibold text-gray-600">Au:</label>
                                    <input type="date" name="toDatet" id="toDatet" class="ml-2 border border-gray-300 rounded-md px-3 py-1" value="{{ request('toDatet') }}">
                                </div>
                            </div>
                            <div class="ml-4">
                                    <button type="submit" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded">Filtrer</button>
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
        function getCurrentMonthData(tensions) {
            const currentDate = new Date();
            const currentMonthData = tensions.filter(tension => {
                const tensionDate = new Date(tension.created_at);
                return tensionDate.getMonth() === currentDate.getMonth() && tensionDate.getFullYear() === currentDate.getFullYear();
            });
            return currentMonthData;
        }

        // Initial data from Laravel
        const tensions = @json($tensions);

        // Generate labels and data for the current month
        const labels = getCurrentMonthLabels();
        const currentMonthData = getCurrentMonthData(tensions);
        
        const tensionAtelieData = labels.map(day => {
            const dataPoint = currentMonthData.find(tension => new Date(tension.created_at).getDate() === day);
            return dataPoint ? dataPoint.tension_atelie : null;
        });
        
        const tensionAdminData = labels.map(day => {
            const dataPoint = currentMonthData.find(tension => new Date(tension.created_at).getDate() === day);
            return dataPoint ? dataPoint.tension_admin : null;
        });
        
        const usineData = labels.map(day => {
            const dataPoint = currentMonthData.find(tension => new Date(tension.created_at).getDate() === day);
            return dataPoint ? dataPoint.usine : null;
        });
        
        const magasinData = labels.map(day => {
            const dataPoint = currentMonthData.find(tension => new Date(tension.created_at).getDate() === day);
            return dataPoint ? dataPoint.magasin : null;
        });

        // Prepare the data for the chart
        const tensionData = {
            labels: labels,
            datasets: [
                {
                    label: 'Tension Atelie',
                    data: tensionAtelieData,
                    borderColor: '#4299E1',
                    borderWidth: 2,
                    pointRadius: 3,
                    spanGaps: true,
                    tension: 0 // Set tension to 0 for consistent lines
                },
                {
                    label: 'Tension Admin',
                    data: tensionAdminData,
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

        const tensionConfig = {
            type: 'line',
            data: tensionData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 500 // Adjust max value as needed
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

        var tensionChart = new Chart(
            document.getElementById('tensionChart'),
            tensionConfig
        );

        // Function to update the chart based on the selected date range
        function updateChart() {
            const fromDate = document.getElementById('fromDate').value;
            const toDate = document.getElementById('toDate').value;

            // Send AJAX request to your Laravel backend
            fetch(`/tension-data?fromDate=${fromDate}&toDate=${toDate}`)
                .then(response => response.json())
                .then(data => {
                    // Update Chart.js chart with new data
                    tensionChart.data.labels = data.labels;
                    tensionChart.data.datasets[0].data = data.tensionAtelieData;
                    tensionChart.data.datasets[1].data = data.tensionAdminData;
                    tensionChart.data.datasets[2].data = data.usineData;
                    tensionChart.data.datasets[3].data = data.magasinData;
                    tensionChart.update();
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

