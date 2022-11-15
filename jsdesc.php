<script type="module">
      // Import the functions you need from the SDKs you need
      import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.1/firebase-app.js";
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

      // Database

        const db = getDatabase();
        const fdb = getFirestore();
//-------------------------Insert----------------------------------//
        function getLocation()
        {
            if(navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
            }
            else
            {
                    alert("Geolocation is not supported by this browser.");
            }
        }
        function geoSuccess(position)
        {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            set(ref(db,"UserLocation/<?php echo $user->uid; ?>"),{
                id: '<?php echo $user->uid; ?>',
                latitude: lat,
                longitude: lng
            })
        }
        function geoError()
        {
            alert("Geocoder failed.");
        }
        window.addEventListener('load',getLocation);
//---------------------------firestore-----------------------------------//
        async function AddDocument_AutoID()
        {
            var ref = collection(fdb, "TheStudentsList");
            const docRef = await addDoc(
                ref, {
                    Name: 'hello'
                }
            )
        }
        async function GetDocument()
        {
            const querySnapshot = await getDocs(collection(fdb, "Users"));
            querySnapshot.forEach((doc) => {
                // doc.data() is never undefined for query doc snapshots
                const el = document.createElement('div');
                el.classList.add('item', 'border', 'border-1', 'border-secondary', 'p-1');
                el.innerHTML='<img class="rounded" src="'+doc.data().imgURI+'" height="250px">';
                const box = document.getElementById('user-list');
                box.appendChild(el);
            });
        }
        window.addEventListener('load',GetDocument);
</script>
