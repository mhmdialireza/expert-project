<x-layout :$from>
    @switch($folder->type)
        @case(1)
            @php
                $todos = $items;
            @endphp
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $folder->name }}'s Todos</h2>
            @if (count($todos))
                <div class="w-full overflow-hidden rounded-lg shadow-xs mb-4">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-10 py-3">Title</th>
                                    <th class="pl-4 pr-10 py-3">status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($todos as $todo)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-10 py-3">
                                            <div class="flex items-center text-sm">
                                                <div class="overflow-hidden">
                                                    <a class="font-semibold"
                                                        href="{{ route('todo.show', $todo->id) }}">{{ $todo->title }}</a>
                                                    {{-- <span class="text-xs text-white bg-orange-400 px-2 rounded-lg">
                                                    {{ match ($todo->priority) {
                                                        1 => 'very low',
                                                        2 => 'low',
                                                        3 => 'normal',
                                                        4 => 'high',
                                                        5 => 'very high',
                                                    } }}
                                                </span> --}}
                                                    <p class="text-xs ">{{ $todo->description }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td class="px-4 py-3">{{ $todo->description }}</td> --}}
                                        <td class="pl-4 pr-10 py-3 w-1 text-center">
                                            <form action="{{ route('todo.change-status', $todo->id) }}" method="GET">
                                                <button type="submit" id="todo-check-{{ $todo->id }}" class="text-center">
                                                    <svg class="w-5 h-5 m-a" aria-hidden="true" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path
                                                            @if ($todo->is_done) d="M4.5 12.75l6 6 9-13.5"
                                                            @else 
                                                            d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z"> @endif
                                                            </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                        {{-- <td class="pl-4 pr-10 py-3 w-1 text-center">
                                        <a href="{{ route('todo.show', $todo->id) }}" id="todo-info-{{ $todo->id }}"
                                            class="text-center">
                                            <svg class="w-5 h-5 m-a" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </a>
                                    </td> --}}
                                        {{-- <td class="pl-4 pr-10 py-3 w-1 text-center">
                                        <a id="todo-delete-{{ $todo->id }}" class="text-center">
                                            <svg class="w-5 h-5 m-a" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                </path>
                                            </svg>
                                        </a>
                                    </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    </div>
                </div>
            @endif
        @break

        @case(2)
            @php
                $bookmarks = $items;
            @endphp
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $folder->name }}'s Bookmarks</h2>
            @if (count($bookmarks))
                <div class="w-full overflow-hidden rounded-lg shadow-xs mb-4">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-10 py-3">Name</th>
                                    <th class="pl-4 pr-10 py-3">Open</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($bookmarks as $bookmark)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-10 py-3">
                                            <div class="flex items-center text-sm">
                                                <div class="overflow-hidden">
                                                    <a class="font-semibold"
                                                        href="{{ route('bookmark.show', $bookmark->id) }}">{{ $bookmark->name }}</a>
                                                    <p class="text-xs ">{{ $bookmark->description }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-4 pr-10 py-3 w-1 text-center">
                                            <a href="{{ $bookmark->url }}" id="bookmark-check-{{ $bookmark->id }}"
                                                target="_blank" class="text-center">
                                                <svg class="w-5 h-5 m-a" aria-hidden="true" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path
                                                        d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    </div>
                </div>
            @endif
        @break

        @case(3)
            @php
                $passwords = $items;
            @endphp
            <input id="dark-input" name='dark' type="hidden" x-model='dark'>

            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $folder->name }}'s Passwords</h2>
            @if (count($passwords))
                <div class="w-full overflow-hidden rounded-lg shadow-xs mb-4">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-10 py-3">Name</th>
                                    <th class="pl-4 pr-10 py-3">Copy</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($passwords as $password)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-10 py-3">
                                            <div class="flex items-center text-sm">
                                                <div class="overflow-hidden">
                                                    <a class="font-semibold"
                                                        href="{{ route('password.show', $password->id) }}">{{ $password->name }}</a>
                                                    <p class="text-xs ">{{ $password->url }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-4 pr-10 py-3 w-1 text-center">
                                            <div>
                                                <button data-h="1" type="submit" id="{{ $password->id }}"
                                                    class="text-center for-find">
                                                    <svg class="w-5 h-5 m-a" aria-hidden="true" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path
                                                            d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    </div>
                </div>
            @endif

            @section('scripts')
                <script src="{{ asset('assets/js/crypto-js.js') }}"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    $(document).ready(function() {
                        const key = localStorage.getItem('key')

                        let id = null
                        const copyBtns = document.querySelectorAll('.for-find')
                        copyBtns.forEach(copyBtn => {
                            copyBtn.addEventListener('click', event => {
                                const dark = document.querySelector('#dark-input').value
                                id = event.target.parentElement.getAttribute('id')
                                Swal.fire({
                                    title: 'password confirmation',
                                    input: 'password',
                                    inputLabel: 'Enter your password',
                                    inputPlaceholder: '******',
                                    background: dark != 'true' ? '#fff' : '#1A1C23',
                                    showCloseButton: true,
                                    inputAttributes: {
                                        maxlength: 10,
                                        autocapitalize: 'off',
                                        autocorrect: 'off',
                                    }
                                }).then((result) => {
                                    $.ajax({
                                        url: "{{ route('confirm-password') }}",
                                        method: 'post',
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            email: "{{ auth()->user()->email }}",
                                            password: result.value,
                                            dark: $('#dark-input').val()
                                        },
                                        dataType: 'JSON',
                                        success: function(response) {
                                            if (response.status == 'ok') {
                                                $.ajax({
                                                    url: "{{ route('password.get-password') }}",
                                                    method: 'post',
                                                    data: {
                                                        "_token": "{{ csrf_token() }}",
                                                        id
                                                    },
                                                    dataType: 'JSON',
                                                    success: function(response) {
                                                        let decriptedPassword =
                                                            CryptoJS.AES
                                                            .decrypt(
                                                                response
                                                                .password, key)
                                                            .toString(CryptoJS
                                                                .enc.Utf8);

                                                        navigator.clipboard
                                                            .writeText(
                                                                decriptedPassword
                                                            );
                                                        Swal.fire({
                                                            icon: 'success',
                                                            title: 'Password Copied',
                                                            background: dark !=
                                                                'true' ?
                                                                '#fff' :
                                                                '#1A1C23',
                                                            timer: 3000
                                                        })
                                                    },
                                                    error: function(response) {
                                                        console.log('error ' +
                                                            JSON.stringify(
                                                                response));
                                                    }
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Invalid Password',
                                                    background: dark != 'true' ?
                                                        '#fff' : '#1A1C23',
                                                    timer: 3000
                                                })
                                            }
                                        },
                                        error: function(response) {
                                            console.log('error ' + JSON.stringify(
                                                response));
                                        }
                                    });
                                });
                            })
                        });


                    });
                </script>
            @endsection
        @break

        @default
    @endswitch
</x-layout>
