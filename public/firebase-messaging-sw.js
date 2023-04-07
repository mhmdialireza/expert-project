importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyCoCaXEAsJxVEDpNe4ja1ADRn79SedKQqg",
    authDomain: "expert-project-b7c2e.firebaseapp.com",
    projectId: "expert-project-b7c2e",
    storageBucket: "expert-project-b7c2e.appspot.com",
    messagingSenderId: "1098422788338",
    appId: "1:1098422788338:web:0850a8bca4a28c2a4d306b",
    measurementId: "G-9F7TSW04GE"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
