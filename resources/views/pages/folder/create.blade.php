<x-layout :$from>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">New Folder</h2>
    <form action="{{ route('folder.store') }}" method="POST"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Name</span>
            <input autocomplete="off"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Work" name="name" value="{{ old('name') }}" />
            @if ($errors->has('name'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('name') }}</span>
            @endif
        </label>
        <input id="dark-input" name='dark' type="hidden" x-model='dark'>
        <input name="type" type="hidden"
            value="{{ match ($from) {
                'todos' => 1,
                'bookmarks' => 2,
                'passwords' => 3,
                '' => '#',
            } }}">
        @if ($errors->has('type'))
            <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('type') }}</span>
        @endif
        <div class="mt-6 pb-2">
            <button type="submit"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Create</span>
            </button>
        </div>
    </form>
</x-layout>
