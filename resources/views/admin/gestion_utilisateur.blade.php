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
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">{{ __('Gestion des utilisateurs') }}</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <button onclick="document.getElementById('addUserModal').classList.remove('hidden')" class="bg-blue-500 text-white rounded-lg px-4 py-2 mb-4">{{ __('Ajouter Utilisateur') }}</button>

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('ID') }}</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Nom') }}</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Email') }}</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <button onclick="editUser({{ $user }})" class="bg-yellow-500 text-white rounded-lg px-4 py-2">{{ __('Editer') }}</button>
                        <form method="POST" action="{{ route('admin.gestion_utilisateur.delete') }}" class="inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <button type="submit" class="bg-red-500 text-white rounded-lg px-4 py-2">{{ __('Supprimer') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg p-6">
                <form method="POST" action="{{ route('admin.gestion_utilisateur.add') }}">
                    @csrf
                    <h2 class="text-xl font-bold mb-4">{{ __('Ajouter Utilisateur') }}</h2>
                    <label class="block text-gray-700">{{ __('Nom') }}</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4" required>
                    
                    <label class="block text-gray-700">{{ __('Email') }}</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4" required>
                    
                    <label class="block text-gray-700">{{ __('Mot de passe') }}</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4" required>
                    
                    <label class="block text-gray-700">{{ __('Confirmer Mot de passe') }}</label>
                    <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4" required>
                    
                    <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2">{{ __('Ajouter') }}</button>
                    <button type="button" onclick="document.getElementById('addUserModal').classList.add('hidden')" class="bg-gray-500 text-white rounded-lg px-4 py-2">{{ __('Annuler') }}</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg p-6">
                <form method="POST" action="{{ route('admin.gestion_utilisateur.edit') }}">
                    @csrf
                    <input type="hidden" name="id" id="editUserId">
                    <h2 class="text-xl font-bold mb-4">{{ __('Editer Utilisateur') }}</h2>
                    <label class="block text-gray-700">{{ __('Nom') }}</label>
                    <input type="text" name="name" id="editUserName" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4" required>
                    
                    <label class="block text-gray-700">{{ __('Email') }}</label>
                    <input type="email" name="email" id="editUserEmail" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4" required>
                    
                    <label class="block text-gray-700">{{ __('Mot de passe') }}</label>
                    <input type="password" name="password" id="editUserPassword" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4">
                    
                    <label class="block text-gray-700">{{ __('Confirmer Mot de passe') }}</label>
                    <input type="password" name="password_confirmation" id="editUserPasswordConfirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4">
                    
                    <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2">{{ __('Editer') }}</button>
                    <button type="button" onclick="document.getElementById('editUserModal').classList.add('hidden')" class="bg-gray-500 text-white rounded-lg px-4 py-2">{{ __('Annuler') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editUser(user) {
        document.getElementById('editUserId').value = user.id;
        document.getElementById('editUserName').value = user.name;
        document.getElementById('editUserEmail').value = user.email;
        document.getElementById('editUserModal').classList.remove('hidden');
    }
</script>
@endsection
