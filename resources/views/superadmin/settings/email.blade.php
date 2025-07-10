<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight bg-blue-600 p-4 rounded">
            Pengaturan Email
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                     class="mb-4 p-4 rounded bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('settings.email.update') }}">
                @csrf

                @foreach ($settings as $key => $value)
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700" for="{{ $key }}">
                            {{ $key }}
                        </label>
                        <input type="text" name="{{ $key }}" id="{{ $key }}"
                               value="{{ old($key, $value) }}"
                               class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                        @error($key)
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
