@extends('welcome')

@section('content')
@can('update', $task)
    <div class="max-w-3xl mx-auto px-4 py-8 bg-white shadow rounded">
        <h1 class="text-2xl font-bold mb-6">{{ __('messages.edit_task') }}</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-medium mb-1">{{ __('messages.title') }}</label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('title')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="description" class="block font-medium mb-1">{{ __('messages.description') }}</label>
                <textarea name="description" id="description"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                >{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ __('messages.save_changes') }}
            </button>
        </form>
    </div>
@else
    <p class="text-red-600 text-center mt-10">{{ __('messages.no_permission') }}</p>
@endcan
@endsection
