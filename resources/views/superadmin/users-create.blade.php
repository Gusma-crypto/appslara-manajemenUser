<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight bg-blue-500 bg-opacity-60 p-4 rounded">
            Tambah User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('superadmin.users.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700">Nama</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Role</label>
                    <select name="role" class="w-full border rounded px-3 py-2">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                    <a href="{{ route('superadmin.users.index') }}" class="ml-2 text-gray-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
