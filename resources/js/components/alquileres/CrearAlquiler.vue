<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);

const router = useRouter();

//const onPerfil = () => {
//    router.push('/perfil/' + usuarioId);
//}

let clientes = ref([])
let vehiculos = ref([])

let form = ref({
    cliente: '',
    vehiculo: '',
    fecha_desde: '',
    fecha_hasta: '',
    precio: '',
    estado: ''
})

onMounted(async () => {
    getDatos()
})

const getDatos = async () => {

    await axios.get('api/get_usuarios')
        .then(function (response) {
            clientes.value = response.data.usuarios
        })

    await axios.get('api/get_vehiculos')
        .then(function (response) {
            vehiculos.value = response.data.vehiculos
        })
    console.log('usuarios', clientes.value)
    console.log('vehiculos', vehiculos.value)
}

const registrarAlquiler = () => {
    const formData = new FormData();
    formData.append('cliente', form.value.cliente);
    formData.append('vehiculo', form.value.vehiculo);
    formData.append('fecha_desde', form.value.fecha_desde);
    formData.append('fecha_hasta', form.value.fecha_hasta);
    formData.append('precio', form.value.precio);
    formData.append('estado', form.value.estado);

    axios.post('api/add_alquiler', formData)
        .then((response) => {
            form.value.cliente = '',
                form.value.vehiculo = '',
                form.value.fecha_desde = '',
                form.value.fecha_hasta = '',
                form.value.precio = '',
                form.value.estado = '',
                router.push('/ListaAlquilados')
        })
        .catch((error) => {
            console.log(error.response)
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
                        <div class="col-lg-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Nuevo Alquiler</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Cliente</label>
                                            <div class="input-group">
                                                <select class="custom-select" v-model="form.cliente">
                                                    <option v-for="cliente in clientes" :key="cliente.id">{{ cliente.name }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Vehiculo</label>
                                            <div class="input-group">
                                                <select class="custom-select" v-model="form.vehiculo">
                                                    <option v-for="vehiculo in vehiculos" :key="vehiculo.id">{{ vehiculo.marca }} {{ vehiculo.modelo }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha Desde</label>
                                            <input type="date" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.fecha_desde">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha Hasta</label>
                                            <input type="date" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.fecha_hasta">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Precio</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.precio">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Estado</label>
                                            <select class="custom-select" v-model="form.estado">
                                                <option>Activo</option>
                                                <option>Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary"
                                            @click="registrarAlquiler()">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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


