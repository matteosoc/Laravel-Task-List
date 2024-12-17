@extends('layout.app')

@section('title', $task->title)

<div class="mb-4">
    <a href="{{ route('tasks.index') }}" class="link">
        ← Go back
    </a>
</div>

@section('content')
    <p class="mb-2 text-slate-700">{{ $task->description }}</p>

    @if ($task->long_description)
        <p class="mb-2 text-slate-700">{{ $task->long_description }}</p>
    @endif

    <p class="mb-2 text-sm text-slate-500">{{ $task->created_at->diffForHumans() }} -
        {{ $task->updated_at->diffForHumans() }}</p>

    <p class="mb-2">
        @if ($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not completed</span>
        @endif
    </p>

    <div class="flex gap-2">
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn">Edit</a>

        <form class="mb-0" method="POST" action=" {{ route('tasks.toggle-complete', ['task' => $task]) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="btn">
                Mark as {{ $task->completed ? 'not completed' : 'completed' }}
            </button>
        </form>

        <form class="mb-0" method="POST" action="{{ route('tasks.destroy', ['task' => $task]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Delete</button>
        </form>
    </div>
@endsection
