<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);

const router = useRouter();

//const onPerfil = () => {
//    router.push('/perfil/' + usuarioId);
//}

let alquileres = ref([])

onMounted(async () => {
    getAlquileres()
})

const editarAlquiler = (id) => {
    router.push('/EditarAlquiler/' + id)
}

const verFactura = (id) => {
    router.push('/verFactura/' + id)
}

const getAlquileres = async () => {

    let response = await axios.get('api/get_alquileres')
    alquileres.value = response.data.alquileres
    console.log('alquileres', alquileres.value)
}

const cambiarEstadoActivo = (id) => {
    axios.get(`/api/estado_activo_alquiler/${id}`)
        .then(() => {
            getAlquileres()
        })
        .catch((error) => {
            console.log(error.response)
        })
}

const cambiarEstadoInactivo = (id) => {
    axios.get(`/api/estado_inactivo_alquiler/${id}`)
        .then(() => {
            getAlquileres()
        })
        .catch((error) => {
            console.log(error.response)
        })
}

$(document).ready(function () {
    $("#busqueda").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#alquileres tr").filter(function () {
            $(this).toggle($(this).text()
                .toLowerCase().indexOf(value) > -1)
        });
    });
});

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
                        <li class="nav-item">
                            <router-link to="/ListaAlquilados" class="nav-link" style="cursor: pointer;">
                                <i class="fas fa-car"></i>
                                <p>
                                    Vehiculos alquilados
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
                                    <h3 class="card-title">Lista de Alquileres</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input id="busqueda" type="text" name="table_search" class="form-control float-right"
                                                placeholder="Buscar">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Vehiculo</th>
                                                <th>Fecha Desde</th>
                                                <th>Fecha Hasta</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                                <th style="width: 430px;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="alquileres">
                                            <tr v-for="alquiler in alquileres" :key="alquiler.id">
                                                <td>{{ alquiler.cliente }}</td>
                                                <td>{{ alquiler.vehiculo }}</td>
                                                <td>{{ alquiler.fecha_desde }}</td>
                                                <td>{{ alquiler.fecha_hasta }}</td>
                                                <td>{{ alquiler.precio }}</td>
                                                <td>{{ alquiler.estado }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default"
                                                            @click="verFactura(alquiler.id)">Ver
                                                            Factura</button>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default"
                                                                @click="editarAlquiler(alquiler.id)">Editar</button>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-default dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false">Cambiar
                                                                Estado</button>
                                                            <ul class="dropdown-menu" style="">
                                                                <li><button class="dropdown-item"
                                                                        @click="cambiarEstadoActivo(alquiler.id)">Activo</button>
                                                                </li>
                                                                <li><button class="dropdown-item"
                                                                        @click="cambiarEstadoInactivo(alquiler.id)">Inactivo</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="btn-group">
                                    <router-link to="/CrearAlquiler" class="btn btn-primary">Nuevo alquiler</router-link>
                                </div>

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


</template>


