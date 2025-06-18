@extends('welcome')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ __('messages.tasks') }}</h1>

    {{-- Tikai lietotājiem, kam atļauts veidot uzdevumu --}}
    @can('create', App\Models\Task::class)
        <a href="{{ route('tasks.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            {{ __('messages.create_task') }}
        </a>
    @endcan

    @forelse ($tasks as $task)
        <li class="p-4 bg-white rounded shadow mb-4 list-none">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold">{{ $task->title }}</h2>
                    <p class="text-gray-600 text-sm mt-1">
                        {{-- Ja lietotājs ir admins, rādīt īpašnieku --}}
                        @if (auth()->user()->role->name === 'admin')
                            <span class="text-gray-500">{{ __('messages.owner') }}:</span> {{ $task->user->name }}<br>
                        @endif
                        <span class="inline-block px-2 py-1 text-xs font-medium rounded 
                            {{ $task->is_completed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $task->is_completed ? __('messages.completed') : __('messages.not_completed') }}
                        </span>
                    </p>
                </div>
                <a href="{{ route('tasks.show', $task->id) }}"
                   class="ml-4 inline-block px-3 py-1 bg-indigo-500 text-white text-sm rounded hover:bg-indigo-600">
                    {{ __('messages.view') }}
                </a>
            </div>
        </li>
    @empty
        <p class="text-gray-500">{{ __('messages.no_tasks') }}</p>
    @endforelse
</div>
@endsection
