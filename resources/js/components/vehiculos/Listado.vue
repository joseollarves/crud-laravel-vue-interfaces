<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import { jsPDF } from "jspdf";

const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);

const router = useRouter();

const onPerfil = () => {
    router.push('/perfil/'+usuarioId);
}

const editarVehiculo = (id) => {
    router.push('/editarVehiculo/' + id)
}

let vehiculos = ref([])

onMounted(async () => {
    getVehiculos()
})

const getVehiculos = async () => {

    let response = await axios.get('api/get_vehiculos')
    vehiculos.value = response.data.vehiculos
    console.log('vehiculos', vehiculos.value)
}

const PDF = () => {
    let doc = new jsPDF('1', 'mm', [1050, 500]);

    doc.html(document.getElementById('tabla-vehiculos'), {
        callback: function (doc) {

            //doc.text("Lista Vehiculos", 50, 10);
            doc.save('Tabla de Vehiculos');
        },
    });
}

const eliminarVehiculo = (id) => {
    axios.get(`/api/eliminar_vehiculo/${id}`)
        .then(() => {
            getVehiculos()
        })
        .catch(() => {
            console.log()
        })
}

</script>

<template>
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link to="/home" class="brand-link">
                <img src="../../../../public/favicon.ico" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Jack's Rentals</span>
            </router-link>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <router-link to="/usuarios" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    Usuarios
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" @click="onPerfil">
                                <i class="fas fa-id-card"></i>
                                <p>
                                    Perfil
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <router-link to="/listaVehiculos" class="nav-link" style="cursor: pointer;">
                                <i class="fas fa-car"></i>
                                <p>
                                    Listado de Vehiculos
                                </p>
                            </router-link>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- /.col-md-6 -->
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Lista de Vehiculos</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Buscar">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="tabla-vehiculos">
                                        <table class="table table-bordered" style="margin-bottom: 10px;">
                                            <thead>
                                                <tr>
                                                    <th>Marca</th>
                                                    <th>Modelo</th>
                                                    <th>Placa</th>
                                                    <th>Estado</th>
                                                    <th style="width: 150px;">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody v-for="vehiculo in vehiculos" :key="vehiculo.id">
                                                <tr>
                                                    <td>{{ vehiculo.marca }}</td>
                                                    <td>{{ vehiculo.modelo }}</td>
                                                    <td>{{ vehiculo.placa }}</td>
                                                    <td>{{ vehiculo.estado }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-default" @click="eliminarVehiculo(vehiculo.id)">Eliminar</button>
                                                            <button @click="editarVehiculo(vehiculo.id)" type="button"
                                                                class="btn btn-default">Editar</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                                    </ul>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" @click="PDF">Descargar PDF</button>
                                    </div>
                                    <router-link to="/registrarVehiculo" class="btn btn-primary">Registrar Vehiculo</router-link>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                HEE-HO!
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 <a href="https://youtu.be/UTH1VNHLjng">Jack's Rentals</a>.</strong> Todos
            los derechos
            reservados.
        </footer>
    </div>
</template>
