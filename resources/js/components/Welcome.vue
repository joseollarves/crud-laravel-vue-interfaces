<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router'

const router = useRouter();

let usuarios = ref([])

onMounted(async () => {
    getUsuarios()
})

const getUsuarios = async () => {

    let response = await axios.get('api/get_usuarios')
    usuarios.value = response.data.usuarios
    console.log('usuarios', usuarios.value)
}

const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);

const onPerfil = () => {
    router.push('/perfil/' + usuarioId);
}
</script>

<template>
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link to="/home" class="brand-link">
                <img src="../../../public/favicon.ico" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
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
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="m-0">Bienvenido</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Es bueno verlo de nuevo</h6>
                                    <!--<p class="card-text">Aqui se supone que va algo.</p>-->
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
