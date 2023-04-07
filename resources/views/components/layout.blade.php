<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}" />
    <title>{{ $title ?? 'Personal Panel' }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-desktop-slidebar :$from></x-desktop-slidebar>
        <x-backdrop></x-backdrop>
        <x-mobile-slidebar :$from></x-mobile-slidebar>
        <div class="flex flex-col flex-1 w-full">
            <x-header :$from></x-header>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('assets/js/sweetalert.all.js') }}"></script>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
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

        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });
    </script>
    @yield('scripts')
</body>

</html>
