<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);

const router = useRouter();

const onPerfil = () => {
    router.push('/perfil/'+usuarioId);
}

let tipos = ref([])

onMounted(async () => {
    getTipos()
})

const getTipos = async () => {

    let response = await axios.get('api/get_tipos')
    tipos.value = response.data.tipos
    console.log('tipos', tipos.value)
}

const editarTipo = (id) => {
    router.push('/editarTipo/' + id)
}

const cambiarEstadoActivo = (id) => {
    axios.get(`/api/estado_activo/${id}`)
    .then(() => {
        getTipos()
    })
    .catch(() => {
        console.log()
    })
}

const cambiarEstadoInactivo = (id) => {
    axios.get(`/api/estado_inactivo/${id}`)
    .then(() => {
        getTipos()
    })
    .catch(() => {
        console.log()
    })
}

const eliminarTipo = (id) => {
    axios.get(`/api/eliminar_tipo/${id}`)
        .then(() => {
            getTipos()
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
                            <a @click="onPerfil" class="nav-link" style="cursor: pointer;">
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
                                    <h3 class="card-title">Tipos de Vehiculos</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nombre del Tipo</th>
                                                <th>Estado</th>
                                                <th style="width: 310px;">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="tipo in tipos" :key="tipo.id">
                                            <tr>
                                                <td>{{ tipo.nombre }}</td>
                                                <td>{{ tipo.estado }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default" @click="eliminarTipo(tipo.id)">Eliminar</button>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-default dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false">Cambiar
                                                                Estado</button>
                                                            <ul class="dropdown-menu" style="">
                                                                <li><button class="dropdown-item" @click="cambiarEstadoActivo(tipo.id)">Activo</button></li>
                                                                <li><button class="dropdown-item" @click="cambiarEstadoInactivo(tipo.id)">Inactivo</button></li>
                                                            </ul>
                                                        </div>
                                                        <button type="button" class="btn btn-default" @click="editarTipo(tipo.id)">Editar</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <router-link to="/registrarTipo" type="submit" class="btn btn-primary" style="margin-top: 10px;">Agregar
                                        nuevo tipo de vehiculo</router-link>
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
