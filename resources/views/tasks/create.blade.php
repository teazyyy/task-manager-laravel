@extends('welcome')

@section('content')
@can('create', App\Models\Task::class)
    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">{{ __('messages.create_task') }}</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf

            <div>
                <label for="title" class="block font-medium">{{ __('messages.title') }}</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block font-medium">{{ __('messages.description') }}</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 rounded px-4 py-2 mt-1">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                {{ __('messages.save') }}
            </button>
        </form>
    </div>
@else
    <div class="text-center mt-8 text-red-500 font-semibold">
        {{ __('messages.unauthorized') }}
    </div>
@endcan
@endsection