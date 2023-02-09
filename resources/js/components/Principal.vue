<script setup>
import { onMounted, ref } from 'vue';

let vehiculos = ref([])

onMounted(async () => {
    getVehiculos()
})

const getVehiculos = async () => {
    await axios.get('api/get_vehiculos')
        .then(function (response) {
            vehiculos.value = response.data.vehiculos
            console.log(vehiculos.value)
        })
}

// Modal Image Gallery
function onClick(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
    var captionText = document.getElementById("caption");
    captionText.innerHTML = element.alt;
}


// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
    } else {
        mySidebar.style.display = 'block';
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

<template>

    <!-- Sidebar on small screens when clicking the menu icon -->
    <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large"
        style="display:none" id="mySidebar">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close
            ×</a>
        <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
        <a href="#team" onclick="w3_close()" class="w3-bar-item w3-button">TEAM</a>
        <a href="#work" onclick="w3_close()" class="w3-bar-item w3-button">WORK</a>
        <a href="#pricing" onclick="w3_close()" class="w3-bar-item w3-button">PRICING</a>
        <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
    </nav>

    <!-- Header with full-height image -->
    <header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">


    </header>

    <!-- About Section -->
    <div class="w3-container" style="padding:128px 16px" id="about">
        <h3 class="w3-center">Sobre la empresa</h3>
        <div class="w3-row-padding w3-center" style="margin-top:64px">
            <div class="w3-quarter">
                <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
                <p class="w3-large">Intuitivo</p>
                <p>Realice sus alquileres de forma intuitiva</p>
            </div>
            <div class="w3-quarter">
                <i class="fa fa-heart w3-margin-bottom w3-jumbo"></i>
                <p class="w3-large">Atencion personalizada</p>
                <p>Atencion especializada en todos los aspectos</p>
            </div>
            <div class="w3-quarter">
                <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
                <p class="w3-large">Lo ultimo</p>
                <p>Consigue lo que deseas en vehiculos</p>
            </div>
            <div class="w3-quarter">
                <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
                <p class="w3-large">Soporte</p>
                <p>Todo para solucionar errores</p>
            </div>
        </div>
    </div>



    <!-- Team Section -->
    <div class="w3-container" style="padding:128px 16px" id="team">
        <h3 class="w3-center">Nuestros Productos</h3>
        <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
            <div class="w3-col l3 m6 w3-margin-bottom">
                <table>
                    <tbody style="display: flex;">
                        <tr v-for="vehiculo in vehiculos" :key="vehiculo.id">
                            <td>
                                <img src="./../../../public/img/camion.jpg" alt="John" style="width:200%; padding-right: 370px;">
                                <div class="w3-container">
                                    <h3>{{ vehiculo.marca }} {{ vehiculo.modelo }}</h3>
                                    <p class="w3-opacity">{{ vehiculo.precio }}</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Contact Section -->
    <div class="w3-container w3-light-grey" style="padding:128px 16px" id="contact">
        <h3 class="w3-center">Encuentranos</h3>

        <div style="margin-top:48px">

            <!-- Image of location/map -->

            <div class="gmap_canvas">
                <iframe width="100%" height="500" id="gmap_canvas"
                    src="https://maps.google.com/maps?q=charallave%20miranda&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                </iframe>
                <!--<style>
          .gmap_canvas {
            overflow: hidden;
            background: none;
            height: 500px;
            width: 100%;
          }
        </style>-->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w3-center w3-black w3-padding-64">
        <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Ir a Inicio</a>
        <div class="w3-xlarge w3-section">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-snapchat w3-hover-opacity"></i>
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
        </div>
        <p>Jack Rental Derechos reservados - HEE HOO </p>
    </footer>


</template>


