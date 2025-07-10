
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Notifikasi sukses --}}
            @if (session('success'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 3000)" 
                x-show="show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative mb-4 px-4 py-3 rounded-md text-green-900 bg-green-100 border border-green-300 shadow-md"
            >
                <span class="block text-sm font-medium">{{ session('success') }}</span>
                <button @click="show = false" class="absolute top-1 right-2 text-green-700 hover:text-green-900 text-xl font-bold leading-none">
                    &times;
                </button>
            </div>
        @endif

            {{-- Notifikasi error --}}
            @if (session('error'))
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 4000)" 
                    x-show="show"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="relative mb-4 px-4 py-2 rounded text-red-900 bg-red-100 border border-red-300 shadow"
                >
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="absolute top-1 right-2 text-red-700 hover:text-red-900 text-lg font-bold">&times;</button>
                </div>
            @endif

            {{-- Validasi error --}}
            @if ($errors->any())
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 5000)" 
                    x-show="show"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="relative mb-4 px-4 py-2 rounded text-orange-900 bg-orange-100 border border-orange-300 shadow"
                >
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button @click="show = false" class="absolute top-1 right-2 text-orange-700 hover:text-orange-900 text-lg font-bold">&times;</button>
                </div>
            @endif
            <div class="flex justify-end mb-4">
                <a href="{{ route('superadmin.users.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                    + Add User
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full text-sm text-gray-700 border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Role</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    @foreach ($user->roles as $role)
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2">
                                    @if ($user->is_active)
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Aktif</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">Tidak Aktif</span>
                                    @endif
                                </td>

                                <td class="px-8 py-2">
                                    <div class="flex items-center space-x-2">
                                        {{-- Form Update Role --}}
                                        <form action="{{ route('superadmin.users.update-role', $user->id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="border rounded px-2 py-1 text-sm">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                                                Simpan
                                            </button>
                                        </form>

                                        {{-- Form Toggle Blokir --}}
                                        <form action="{{ route('superadmin.users.toggle-block', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-sm px-2 py-1 rounded
                                                {{ $user->is_active ? 'bg-red-500 hover:bg-red-600 text-white' : 'bg-green-500 hover:bg-green-600 text-white' }}">
                                                {{ $user->is_active ? 'Blokir' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>

                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
