<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router'

let form = ref({
    nombre: '',
    estado: '',
})

const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);

const router = useRouter();

const onPerfil = () => {
    router.push('/perfil/' + usuarioId);
}

const registrarTipo = () => {
    const formData = new FormData();
    formData.append('nombre', form.value.nombre);
    formData.append('estado', form.value.estado);

    axios.post('api/add_tipo', formData)
        .then((response) => {
            form.value.nombre = '',
                form.value.estado = '',
                console.log(response)
                router.push('/tipos')
        })
        .catch((error) => {
            console.log(error.message)
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
                        <div class="col-lg">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Datos</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre del Tipo</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.nombre">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Estado del Tipo</label>
                                            <select class="custom-select" v-model="form.estado">
                                                <option>Activo</option>
                                                <option>Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="button" @click="registrarTipo()">Guardar</button>
                                    </div>
                                </form>
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
