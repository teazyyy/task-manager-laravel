@extends('welcome')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8 bg-white shadow rounded">
    <h1 class="text-3xl font-bold mb-4">{{ $task->title }}</h1>
    <p class="text-gray-700 mb-6">{{ $task->description }}</p>

    <div class="flex space-x-4 items-center">
        @can('update', $task)
            <a href="{{ route('tasks.edit', $task->id) }}"
                class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">
                {{ __('messages.edit_task') }}
            </a>
        @endcan

        @can('delete', $task)
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                    {{ __('messages.delete_task') }}
                </button>
            </form>
        @endcan
    </div>

    <div class="mt-6">
        <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:underline">
            ← {{ __('messages.back_to_list') }}
        </a>
    </div>
</div>
@endsection
