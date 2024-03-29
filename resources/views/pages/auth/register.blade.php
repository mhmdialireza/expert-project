<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up - Personal Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                    <form class="w-full" method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Sign up</h1>

                        <input id="fcm-token" type="hidden" name="fcm_token" value="">

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Name</span>
                            <input autocomplete="off"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="John" name="name" value="{{ old('name') }}" />
                            @if ($errors->has('name'))
                                <span class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('name') }}</span>
                            @endif
                        </label>

                        <label class="block mt-6 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>
                            <input autocomplete="off"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="example@gamil.com" name="email" value="{{ old('email') }}" />
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

                        <label class="block mt-6 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="******" type="password" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" />
                            @if ($errors->has('password_confirmation'))
                                <span
                                    class="text-xs text-red-600 dark:text-red-400">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </label>

                        <!-- You should use a button here, as the anchor is only used for the example  -->
                        <div class="mt-6 pb-2">
                            <button type="submit"
                                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple w-full">
                                <p class="w-full text-center">Sign up</p>
                            </button>
                        </div>

                        <p class="mt-4">
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                                href="{{ route('login-page') }}">Already have an account?</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="../assets/js/init-alpine.js"></script>
    <script src="{{ asset('assets/js/generate-key.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.all.js') }}"></script>
    @include('sweetalert::alert')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyCoCaXEAsJxVEDpNe4ja1ADRn79SedKQqg",
            authDomain: "expert-project-b7c2e.firebaseapp.com",
            projectId: "expert-project-b7c2e",
            storageBucket: "expert-project-b7c2e.appspot.com",
            messagingSenderId: "1098422788338",
            appId: "1:1098422788338:web:0850a8bca4a28c2a4d306b",
            measurementId: "G-9F7TSW04GE"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        let isFirebaseNeedSetup = localStorage.getItem('isFirebaseNeedSetup');
        // if (isFirebaseNeedSetup) {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
                $('#fcm-token').val(token)
            }).catch(function(err) {
                console.log(err);
            });
        // }

        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });
    </script>
</body>

</html>
