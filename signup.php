<?php
if(isset($_POST['sign-up']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $name=$_POST['name'];
}
?>
<html>
    <head>
    </head>
    <body>
        <script type="module">
              // Import the functions you need from the SDKs you need
              import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.1/firebase-app.js";
              import { getAuth, sendEmailVerification } from "https://www.gstatic.com/firebasejs/9.9.1/firebase-auth.js";
              import { getDatabase, ref, set, child, update, remove } from "https://www.gstatic.com/firebasejs/9.9.1/firebase-database.js";
              import { getFirestore, doc, getDoc, getDocs, setDoc, collection, addDoc, updateDoc, deleteDoc, deleteField } from "https://www.gstatic.com/firebasejs/9.9.1/firebase-firestore.js";
              // TODO: Add SDKs for Firebase products that you want to use
              // https://firebase.google.com/docs/web/setup#available-libraries

              // Your web app's Firebase configuration
              // For Firebase JS SDK v7.20.0 and later, measurementId is optional
              const firebaseConfig = {
                apiKey: "AIzaSyBumB-iWd2_IPyIcSlsmOSO6j0-O6wnHbQ",
                authDomain: "ulakam-53ef0.firebaseapp.com",
                databaseURL: "https://ulakam-53ef0-default-rtdb.firebaseio.com",
                projectId: "ulakam-53ef0",
                storageBucket: "ulakam-53ef0.appspot.com",
                messagingSenderId: "771615583204",
                appId: "1:771615583204:web:4c3bf0a1273f011d0575f1",
                measurementId: "G-17ERVWY6EM"
              };

              // Initialize Firebase
                const app = initializeApp(firebaseConfig);
                const db = getDatabase();
                const fdb = getFirestore();

                function signup()
                {
                    const result= await firebase.auth().createUserWithEmailAndPassword(<?php echo ?>)
                }

</script>
    </body>
</html>
