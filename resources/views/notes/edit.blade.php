<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Note</h2>
    </x-slot>

    <form method="POST" action="{{ route('notes.update', $note) }}" class="p-6 bg-white rounded shadow">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ old('title', $note->title) }}"
               class="w-full border p-2 rounded mb-4" placeholder="Title">

        <textarea name="content" rows="6"
                  class="w-full border p-2 rounded mb-4"
                  placeholder="Note content...">{{ old('content', $note->content) }}</textarea>

        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded">
            Update Note
        </button>
    </form>
</x-app-layout>
