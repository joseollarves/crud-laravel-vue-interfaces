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
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->

        <div style="min-height: 465px;">
            <!-- Content Header (Page header) -->
            <div id="contenido">
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">

                            <div class="col-sm-1">
                                <img src="../../../../public/favicon.ico" alt="AdminLTE Logo"
                                    class="brand-image img-circle elevation-3"
                                    style="opacity: .8; height: 80px; width: 80px;">
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                Jack Rental - Alquiler de Vehiculos<br>
                                New Shioya Heights 1F, Wakayama<br>
                                Contacto: +81 73-496-2043
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <!-- /.col-md-6 -->
                            <div class="col-lg-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <div class="input-group-append">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered" style="margin-bottom: 10px;">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Vehiculo</th>
                                                    <th>Desde</th>
                                                    <th>Hasta</th>
                                                    <th>Precio /
                                                        Dia
                                                    </th>
                                                    <th style="width: 150px;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ alquiler.id }}</td>
                                                    <td>{{ alquiler.vehiculo }}</td>
                                                    <td>{{ alquiler.fecha_desde }}</td>
                                                    <td>{{ alquiler.fecha_hasta }}</td>
                                                    <td>{{ alquiler.precio }}</td>
                                                    <td>{{ alquiler.precio }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="bg-gray py-2 px-3 mt-4">
                                        <h4 class="mt-0">
                                            <small>Subtotal: $- {{ alquiler.precio }}</small>
                                        </h4>
                                        <h4 class="mt-0">
                                            <small>IVA: $- {{ alquiler.precio }}</small>
                                        </h4>
                                        <h4 class="mt-0">
                                            <small>Total: $- {{ alquiler.precio }}</small>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-6 -->
                        </div>

                        <div class="btn-group">
                            <button @click="PDF" type="button" class="btn btn-default"
                                style="margin-top: 50px; border-color: black;">Imprimir</button>
                        </div>

                        <!-- Main Footer -->
                    </div>
                </div>

                <!-- ./wrapper -->
                <footer class="main-footer">
                    <!-- To the right -->
                    <div class="float-right d-none d-sm-inline">
                        HEE-HO!
                    </div>
                    <!-- Default to the left -->
                    <strong>Copyright &copy; 2022 <a href="https://youtu.be/UTH1VNHLjng">Jack's Rentals</a>.</strong>
                    Todos
                    los derechos
                    reservados.
                </footer>
            </div>
        </div>
    </div>
</template>
