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
                                <li>
                                    <a href="{{ route('courant') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                        <span class="font-semibold">{{ __('Courant') }}</span>
                                    </a>
                                </li>
                                <a href="{{ route('tension') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Tension') }}</span>
                                </a>
                                <a href="{{ route('puissance') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Puissance') }}</span>
                                </a>
                                <a href="{{ route('energie') }}" class="flex items-center justify-between text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-3 rounded-lg transition duration-200">
                                    <span class="font-semibold">{{ __('Energie') }}</span>
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
        <div class="flex-1 p-8">
            <form action="/filter" method="get">
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Choisir la date') }}</h2>
                    <div class="flex items-center">
                        <label class="mr-4">{{ __('Du') }}</label>
                        <input type="date" class="rounded-lg p-2 border-gray-300 border focus:outline-none focus:border-blue-500" id="dateFrom" name="dateFrom">
                        <label class="mx-4">{{ __('Au') }}</label>
                        <input type="date" class="rounded-lg p-2 border-gray-300 border focus:outline-none focus:border-blue-500" id="dateTo" name="dateTo">
                        <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2 ml-4">{{ __('Filtrer') }}</button>
                    </div>
                </div>
            </form>

            <!-- Tables for each data type -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Consommation Courant') }}</h2>
                <button onclick="exportToPDF()" class="bg-green-500 text-white rounded-lg px-4 py-2 mb-4">{{ __('Exporter en PDF') }}</button>
                <table id="consumptionTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('ID') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Courant Atelier') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Courant Admin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Usine') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Magasin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Created At') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courants as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->courant_atelie}}</td>
                                <td>{{$data->courant_admin}}</td>
                                <td>{{$data->usine}}</td>
                                <td>{{$data->magasin}}</td>
                                <td>{{$data->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Consommation Puissance') }}</h2>
                <button onclick="exportToPDF()" class="bg-green-500 text-white rounded-lg px-4 py-2 mb-4">{{ __('Exporter en PDF') }}</button>
                <table id="consumptionTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('ID') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Puissance Atelier') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Puissance Admin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Usine') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Magasin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Created At') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($puissances as $data)
                            <tr>
                            <td>{{$data->id}}</td>
                                <td>{{$data->puissance_atelie}}</td>
                                <td>{{$data->puissance_admin}}</td>
                                <td>{{$data->usine}}</td>
                                <td>{{$data->magasin}}</td>
                                <td>{{$data->created_at}}</td>  
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Consommation Tension') }}</h2>
                <button onclick="exportToPDF()" class="bg-green-500 text-white rounded-lg px-4 py-2 mb-4">{{ __('Exporter en PDF') }}</button>
                <table id="consumptionTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('ID') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Tension Atelier') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Tension Admin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Usine') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Magasin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Created At') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tensions as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->tension_atelie}}</td>
                                <td>{{$data->tension_admin}}</td>
                                <td>{{$data->usine}}</td>
                                <td>{{$data->magasin}}</td>
                                <td>{{$data->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Consommation Energie') }}</h2>
                <button onclick="exportToPDF()" class="bg-green-500 text-white rounded-lg px-4 py-2 mb-4">{{ __('Exporter en PDF') }}</button>
                <table id="consumptionTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('ID') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Energie Atelier') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Energie Admin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Usine') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Magasin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Created At') }}</th>
                        </tr>
                    </thead>
                    <tbody id="consumptionData">
                        @foreach($energies as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->energie_atelie}}</td>
                                <td>{{$data->energie_admin}}</td>
                                <td>{{$data->usine}}</td>
                                <td>{{$data->magasin}}</td>
                                <td>{{$data->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Consommation Fréquence') }}</h2>
                <button onclick="exportToPDF()" class="bg-green-500 text-white rounded-lg px-4 py-2 mb-4">{{ __('Exporter en PDF') }}</button>
                <table id="consumptionTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('ID') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Frequence Atelier') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Frequence Admin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Usine') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Magasin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Created At') }}</th>                        </tr>
                    </thead>
                    <tbody>
                        @foreach($frequences as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->frequence_atelie}}</td>
                                <td>{{$data->frequence_admin}}</td>
                                <td>{{$data->usine}}</td>
                                <td>{{$data->magasin}}</td>
                                <td>{{$data->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-4">{{ __('Consommation Facteur de Puissance') }}</h2>
                <button onclick="exportToPDF()" class="bg-green-500 text-white rounded-lg px-4 py-2 mb-4">{{ __('Exporter en PDF') }}</button>
                <table id="consumptionTable" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('ID') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Facteur Atelier') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Facteur Admin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Usine') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Magasin') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Created At') }}</th>                        </tr>
                    </thead>
                    <tbody>
                        @foreach($facteurs as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->facteur_atelie}}</td>
                                <td>{{$data->facteur_admin}}</td>
                                <td>{{$data->usine}}</td>
                                <td>{{$data->magasin}}</td>
                                <td>{{$data->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
<script>
    function exportToPDF() {
        // Initialize jsPDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const logo = new Image();
        logo.src = 'https://lab4sys.ma/wp-content/uploads/2021/06/cropped-cropped-logo-lab4sys-1.png';


        // Add a title to the PDF
        doc.text('Rapport de consommation', 10, 63);
        
        // Add export date
        const today = new Date();
        const exportDate = today.toLocaleDateString('fr-FR'); // Format the date according to French locale
        doc.setFontSize(12);
        const dateTextWidth = doc.getStringUnitWidth(`Date: ${exportDate}`) * 12 / doc.internal.scaleFactor; // Calculate the width of the date text
        const pageWidth = doc.internal.pageSize.getWidth();
        const dateXCoordinate = pageWidth - dateTextWidth - 10; // Adjust the position of the date text to fit in the top-right corner
        doc.text(`Date : ${exportDate}`, dateXCoordinate, 10);

        // Get the HTML content of the table
        const consumptionTable = document.getElementById('consumptionTable');

        // Use autoTable to add the table to the PDF
        doc.autoTable({ html: consumptionTable, startY: 70 }); // Adjust startY to position the table further below the title

        // Add company details
        const companyDetails = `LABASYS SARL - 14, AVENUE TIZI OUSLI N°7 AIN SEBAA,
            Casablanca - Tel : +212 (0) 5 22 35 27 26
            E-mail: contact@lab4sys.ma RC 498481 - Patente 35604463 - IF 50174053 - CNSS 2532084  
            ICE 002789889000093`;
        doc.setFontSize(10);
        doc.text(companyDetails, doc.internal.pageSize.getWidth() / 2.1, doc.internal.pageSize.getHeight() - 25, { align: 'center' });

        // Save the PDF
        doc.save('rapport.pdf');
    }
</script>
