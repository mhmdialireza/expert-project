<x-layout :$from>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Create Todo</h2>
    <form action="{{ route('todo.store') }}" method="POST"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <input id="dark-input" name='dark' type="hidden" x-model='dark'>
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Title</span>
            <input autocomplete="off"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Study for exam" name="title" value="{{ old('title') }}" />
            @if ($errors->has('title'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('title') }}</span>
            @endif
        </label>

        <label class="block mt-6 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Description</span>
            <textarea
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3" placeholder="Enter all about this todo" name="description">{{ old('decription') }}</textarea>
            @if ($errors->has('description'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('description') }}</span>
            @endif
        </label>

        {{-- <label class="block mt-6 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Priority</span>
            <select name="priority"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="5">very high</option>
                <option value="4">high</option>
                <option value="3" selected>normal</option>
                <option value="2">low</option>
                <option value="1">very low</option>
            </select>
            @if ($errors->has('priority'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('priority') }}</span>
            @endif
        </label> --}}

        <label class="block mt-6 text-sm">
            <span class="text-gray-700 dark:text-gray-400">folder</span>
            <select name="folder_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="0">-</option>
                @foreach ($folders as $folder)
                    <option value="{{ $folder->id }}" @if (old('folder_id') == $folder->id) selected @endif>
                        {{ $folder->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('folder_id'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('folder_id') }}</span>
            @endif
        </label>

        <div class="mt-6 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Status</span>
            <div class="mt-2">
                <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                    <input type="radio"
                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        name="is_done" value="0" checked />
                    <span class="ml-2">Ongoing</span>
                </label>
                <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                    <input type="radio"
                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        name="is_done" value="1" />
                    <span class="ml-2">Done</span>

                </label>
                @if ($errors->has('is_done'))
                    <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('is_done') }}</span>
                @endif
            </div>
        </div>

        <div class="mt-6 pb-2">
            <button type="submit"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Create</span>
            </button>
        </div>
    </form>
</x-layout>
