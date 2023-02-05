<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Personal Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
                        src="../assets/img/login-office.jpeg" alt="Office" />
                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
                        src="../assets/img/login-office-dark.jpeg" alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <form class="w-full" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Login</h1>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>
                            <input autocomplete="off"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="example@gmail.com" name="email" value="{{ old('email') }}" />
                            @if ($errors->has('email'))
                                <span
                                    class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('email') }}</span>
                            @endif
                        </label>

                        <label class="block mt-6 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Password</span>
                            <input autocomplete="off"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="******" type="password" name="password" value="{{ old('password') }}" />
                            @if ($errors->has('password'))
                                <span
                                    class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('password') }}</span>
                            @endif
                        </label>

                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        <div class="mt-6 pb-2">
                            <button type="submit"
                                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple w-full">
                                <p class="w-full text-center">Log in</p>
                            </button>
                        </div>

                        <p class="mt-4">
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                                href="{{ route('register-page') }}">
                                Don't have account?
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/sweetalert.all.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>
