<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    {{ __("You're logged in!") }}
                </h3>

                <p class="text-gray-600 mb-2">
                    👋 {{ __('Welcome') }}, <strong>{{ Auth::user()->name }}</strong>!
                </p>

                <p class="text-gray-600 mb-4">
                    🔐 {{ __('Your role') }}: <span class="font-medium">{{ Auth::user()->role->name }}</span>
                </p>

                <a href="{{ route('tasks.index') }}"
                   class="inline-block mt-4 px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    {{ __('Go to Task Manager') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
