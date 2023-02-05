<x-layout :$from>
    @if (!(count($todos) || count($folders)))
        <div class="mt-16 text-center">
            <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Doesn't Exist Any Todo!!!</h1>
            <a href="{{ route('todo.create') }}" class="text-gray-700 dark:text-gray-300">create a new todo</a>
        </div>
    @endif

    @if (count($todos) || count($folders))
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Todo Section</h2>
    @endif

    @if (count($folders))
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Folders</h4>
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($folders as $folder)
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 rounded-full text-white bg-purple-600 active:bg-purple-600 hover:bg-purple-700">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <a href="{{ route('folder.show', $folder->id) }}">
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $folder->name }}</p>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">include:
                            {{ $folder->include }}</p>
                    </a>

                    <div class="ml-auto">
                        <a href="{{ route('folder.edit', $folder->id) }}"
                            class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Info
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if (count($folders) && count($todos))
        <hr class="mb-4">
    @endif

    @if (count($todos))
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Single Todos</h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs mb-4">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-10 py-3">Title</th>
                            {{-- <th class="px-4 py-3">Description</th> --}}
                            <th class="pl-4 pr-10 py-3">status</th>
                            {{-- <th class="pl-4 pr-10 py-3">Info</th> --}}
                            {{-- <th class="pl-4 pr-10 py-3">Delete</th> --}}
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
</x-layout>
