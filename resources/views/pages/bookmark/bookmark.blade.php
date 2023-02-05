<x-layout :$from>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Bookmark Page</h2>
    <form method="POST" action="{{ route('bookmark.update', $bookmark->id) }}"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        @method('PUT')
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Name</span>
            <input autocomplete="off"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Complete task" name="name" value="{{ old('name', $bookmark->name) }}" />
            @if ($errors->has('name'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('name') }}</span>
            @endif
        </label>

        <label class="block mt-6 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Description</span>
            <textarea
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3" name="description" placeholder="Enter all about this bookmark">{{ old('description', $bookmark->description) }}</textarea>
            @if ($errors->has('description'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('description') }}</span>
            @endif
        </label>

        <label class="block mt-6 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Url</span>
            <input autocomplete="off" type="url"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="https://github.com/" name="url" value="{{ old('url',$bookmark->url) }}" />
            @if ($errors->has('url'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('url') }}</span>
            @endif
        </label>

        <input id="dark-input" name='dark' type="hidden" x-model='dark'>

        <label class="block mt-6 text-sm">
            <span class="text-gray-700 dark:text-gray-400">folder</span>
            <select name="folder_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="0">-</option>
                @foreach ($folders as $folder)
                    <option value="{{ $folder->id }}" @if ($bookmark->folder && $bookmark->folder->id == $folder->id) selected @endif>
                        {{ $folder->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('folder_id'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('folder_id') }}</span>
            @endif
        </label>

        <div class="mt-6 mr-4 pb-2 inline-block">
            <button type="submit"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Edit</span>
            </button>
        </div>
        <div class="mt-6 pb-2 inline-block">
            <button id="delete-bookmark" type="button"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                <span>Delete</span>
            </button>
        </div>
    </form>

    @section('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#delete-bookmark').on('click', function(event) {
                    const dark = document.querySelector('#dark-input').value
                    Swal.fire({
                        title: 'Are You Sure?',
                        icon: 'question',
                        iconHtml: '?',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'Cancel',
                        background: dark != 'true' ? '#fff' : '#1A1C23',
                        showCancelButton: true,
                        showCloseButton: true
                    }).then((result) => {
                        if (result.value == true) {
                            $.ajax({
                                url: "{{ route('bookmark.delete', $bookmark->id) }}",
                                method: 'DELETE',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    id: {{ $bookmark->id }},
                                    dark: $('#dark-input').val()
                                },
                                dataType: 'JSON',
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'ok') {
                                        window.location.href =
                                            "{{ route('bookmark.index') }}"
                                    }
                                },
                                error: function(response) {
                                    console.log('error ' + response);
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
</x-layout>
