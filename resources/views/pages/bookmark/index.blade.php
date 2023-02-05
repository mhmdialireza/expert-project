<x-layout :$from>
    @if (!(count($bookmarks) || count($folders)))
        <div class="mt-16 text-center">
            <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Doesn't Exist Any Bookmark!!!</h1>
            <a href="{{ route('bookmark.create') }}" class="text-gray-700 dark:text-gray-300">create a new bookmark</a>
        </div>
    @endif

    @if (count($bookmarks) || count($folders))
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Bookmark Section</h2>
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
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            include:{{ $folder->include }}</p>
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

    @if (count($folders) && count($bookmarks))
        <hr class="mb-4">
    @endif

    @if (count($bookmarks))
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Single Bookmarks</h4>
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
</x-layout>
