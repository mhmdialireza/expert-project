<x-layout :$from>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Create Password</h2>
    <form action="{{ route('password.store') }}" method="POST"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <input id="dark-input" name='dark' type="hidden" x-model='dark'>

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Name</span>
            <input autocomplete="off"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Google" name="name" value="{{ old('name') }}" />
            @if ($errors->has('name'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('name') }}</span>
            @endif
        </label>

        <label class="block mt-6 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Url</span>
            <input autocomplete="off"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="http://google.com" name="url" value="{{ old('url') }}" type="url" />
            @if ($errors->has('url'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('url') }}</span>
            @endif
        </label>

        <label class="block mt-6 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Password</span>
            <input autocomplete="off" id="raw-password"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="******" name="raw-password" value="{{ old('password') }}" />
            @if ($errors->has('password'))
                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('password') }}</span>
            @endif
        </label>

        <input autocomplete="off" id="encripted-password" name='password' type="hidden">

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

        <div class="mt-6 pb-2">
            <button type="submit"
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Create</span>
            </button>
        </div>
    </form>

    @section('scripts')
        <script src="{{ asset('assets/js/crypto-js.js') }}"></script>
        <script>
            const key = localStorage.getItem('key')

            const rawPasswordInput = document.querySelector('#raw-password');
            const encriptedPasswordInput = document.querySelector('#encripted-password');

            rawPasswordInput.addEventListener('input', (event) => {
                encriptedPasswordInput.value = CryptoJS.AES.encrypt(event.target.value, key).toString()
            });
        </script>
    @endsection
</x-layout>
