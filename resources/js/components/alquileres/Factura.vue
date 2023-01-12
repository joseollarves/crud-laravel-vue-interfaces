<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import { jsPDF } from "jspdf";

let alquiler = ref([])

let form = ref({
    id: '',
    cliente: '',
    vehiculo: '',
    fecha_desde: '',
    fecha_hasta: '',
    precio: '',
    estado: ''
})

onMounted(async () => {
    getFactura()
})

const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})

const getFactura = async () => {

    await axios.get(`/api/get_alquiler/${props.id}`)
        .then(function (response) {
            alquiler.value = response.data.alquiler
            form.value = response.data.alquiler
            console.log('alquiler', alquiler.value)
        })
        .catch((error) => {
            console.log(error.response)
        })
}

const PDF = () => {
    let doc = new jsPDF('1', 'mm', [1550, 650]);

    doc.html(document.getElementById('contenido'), {
        callback: function (doc) {

            //doc.text("Lista Vehiculos", 50, 10);
            doc.save('Factura-Alquiler');
        },
    });
}

</script>

<template>
    <div class="invoice p-3 mb-3">

        <div class="row mb-2" style="margin-left:-300px; padding-bottom: 10px;">

            <div class="col-sm-1">
                <img src="../../../../public/favicon.ico" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8; height: 80px; width: 80px;">
            </div><!-- /.col -->
            <div class="col-sm-6">
                Jack Rental - Alquiler de Vehiculos<br>
                New Shioya Heights 1F, Wakayama<br>
                Contacto: +81 73-496-2043
            </div><!-- /.col -->

        </div>


        <div class="card-body">
            <table class="table table-bordered" style="margin-bottom: 10px;">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Vehiculo</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ alquiler.id }}</td>
                        <td>{{ alquiler.vehiculo }}</td>
                        <td>{{ alquiler.fecha_desde }}</td>
                        <td>{{ alquiler.fecha_desde }}</td>
                        <td>{{ alquiler.precio }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row" style="margin-top:30px;">
            <div class="col-6">
                <div class="table">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>{{ alquiler.precio }} $</td>
                            </tr>
                            <tr>
                                <th>IVA (16%)</th>
                                <td>{{ alquiler.precio * 0.16 }} $</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>{{ alquiler.precio * 0.16 }} $</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row no-print">
            <div class="col-12">
                <a onclick="window.print()" rel="noopener" target="_blank" class="btn btn-default"><i
                        class="fas fa-print"></i> Imprimir</a>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            HEE-HO!
        </div>
        <!-- Default to the left -->
        <strong>Copyright © 2022-2023 <a href="https://youtu.be/wZmsy1k1_t0">Jack's Rentals</a>.</strong> Todos los derechos reservados.
    </footer>

</template>
