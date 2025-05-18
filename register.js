
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyC7zX1iu3zJ4R4k5cBQktc1Nwz_pAvZtuE",
    authDomain: "autofocus-4ad4e.firebaseapp.com",
    projectId: "autofocus-4ad4e",
    storageBucket: "autofocus-4ad4e.firebasestorage.app",
    messagingSenderId: "937729495586",
    appId: "1:937729495586:web:3e81458afdba7cf516f07b",
    measurementId: "G-W68R9J8076"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

