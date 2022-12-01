<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router'

let form = ref({
    id: '',
    name: '',
    apellido: '',
    cedula: '',
    fecha_nacimiento: '',
    numero_licencia: '',
    fecha_vencimiento: '',
    foto_perfil: '',
    foto_licencia: ''

})

onMounted(async () => {
    getPerfil()
})

const usuarioId = JSON.parse(document.head.querySelector('meta[name="user"]').content);

const router = useRouter();

const onPerfil = () => {
    router.push('/perfil/' + usuarioId);
}

const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})

const getPerfil = async () => {
    let response = await axios.get(`/api/get_perfil/${props.id}`)
    form.value = response.data.usuario
}

const getFotoPerfil = () => {
    let foto_perfil = "/upload/image.png"
    if (form.value.foto_perfil != null) {
        if (form.value.foto_perfil.indexOf('base64') != -1) {
            foto_perfil = form.value.foto_perfil;
        } else {
            foto_perfil = '/upload/'+form.value.foto_perfil;
        }
        return foto_perfil
    }

}

const getFotoLicencia = () => {
    let foto_licencia = '/upload/image.png';
    if (form.value.foto_licencia) {
        if (form.value.foto_licencia.indexOf('base64') != -1) {
            foto_licencia = form.value.foto_licencia;
        } else {
            foto_licencia = '/upload/' + form.value.foto_licencia;
        }
    }
    return foto_licencia
}

const actualizarFotoPerfil = (e) => {

    let file = e.target.files[0];
    let reader = new FileReader();
    let limit = 1024 * 1024 * 2;

    if (file['size'] > limit) {
        return false
    }

    reader.onloadend = (file) => {
        form.value.foto_perfil = reader.result;
    }

    reader.readAsDataURL(file);
}

const actualizarFotoLicencia = (e) => {
    let file = e.target.files[0];
    let reader = new FileReader();
    let limit = 1024 * 1024 * 2;
    if (file['size'] > limit) {
        return false
    }
    reader.onloadend = (file) => {
        form.value.foto_licencia = reader.result;
    }

    reader.readAsDataURL(file);
}

const actualizarPerfil = () => {
    console.log(form.value.foto_perfil)
    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('apellido', form.value.apellido);
    formData.append('cedula', form.value.cedula);
    formData.append('fecha_nacimiento', form.value.fecha_nacimiento);
    formData.append('numero_licencia', form.value.numero_licencia);
    formData.append('fecha_vencimiento', form.value.fecha_vencimiento);
    formData.append('foto_perfil', form.value.foto_perfil);
    formData.append('foto_licencia', form.value.foto_licencia);
    axios.post(`/api/actualizar_perfil/${form.value.id}`, formData)
        .then((response) => {
            form.value.name = '',
                form.value.apellido = '',
                form.value.cedula = '',
                form.value.fecha_nacimiento = '',
                form.value.numero_licencia = '',
                form.value.fecha_vencimiento = '',
                form.value.foto_perfil = '',
                form.value.foto_licencia = '',

                router.push('/home')
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
                                    <h3 class="card-title">Datos</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Apellido</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.apellido">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Cedula</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.cedula">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.fecha_nacimiento">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Numero de licencia de conducir</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.numero_licencia">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha de vencimiento</label>
                                            <input type="date" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.fecha_vencimiento">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary"
                                            @click="actualizarPerfil()">Actualizar Datos</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Fotos</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Foto de perfil</label>
                                            <div
                                                style="display: flex; text-align: center; justify-content: center; align-items: center; margin-bottom: 10px;">
                                                <img :src="getFotoPerfil()"
                                                    style="height: 183px; width: 183px; box-shadow: 0px 0px 10px 2px;" />
                                            </div>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        @change="actualizarFotoPerfil">
                                                    <label class="custom-file-label" for="exampleInputFile">Elige un
                                                        archivo</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Foto de licencia</label>
                                            <div
                                                style="display: flex; text-align: center; justify-content: center; align-items: center; margin-bottom: 10px;">
                                                <img :src="getFotoLicencia()" alt=""
                                                    style="height: 200px; width: 400px; box-shadow: 0px 0px 10px 2px;" />
                                            </div>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        @change="actualizarFotoLicencia">
                                                    <label class="custom-file-label" for="exampleInputFile">Elige un
                                                        archivo</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Cambiar Contraseña</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Contraseña Actual</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nueva Contraseña</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
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
    <!--
    <div id="actualizar-datos" class="container">
        <div id="grid" class="row">
            <div id="espacio-foto" class="col card">
                <div class="mb ">
                    <img :src="getFotoPerfil()" class="row img-thumbnail foto-perfil" style="width: 150px;">
                    <label for="foto_perfil" class="form-label label-foto-perfil">Subir Foto de Perfil</label>
                    <input class="form-control" type="file" id="foto_perfil" name="foto_perfil"
                        v-on:change="actualizarFotoPerfil">
                </div>

                <div class="mb espacio-licencia">
                    <img :src="getFotoLicencia()" class="row img-thumbnail foto-licencia" style="width: 321px;">
                    <label for="foto_licencia" class="form-label label-foto-perfil">Subir Foto de Licencia</label>
                    <input class="form-control" type="file" id="foto_licencia" name="foto_licencia"
                        v-on:change="actualizarFotoLicencia">
                </div>
            </div>

            <div id="espacio-texto" class="col card">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" v-model="form.name">
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" v-model="form.apellido">
                </div>

                <div class="mb-3">
                    <label for="cedula" class="form-label">Cedula</label>
                    <input type="number" class="form-control" id="cedula" name="cedula" v-model="form.cedula">
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                        v-model="form.fecha_nacimiento">
                </div>

                <div class="mb-3">
                    <label for="numero_licencia" class="form-label">Numero de Licencia de Conducir</label>
                    <input type="number" class="form-control" id="numero_licencia" name="numero_licencia"
                        v-model="form.numero_licencia">
                </div>

                <div class="mb-3">
                    <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento"
                        v-model="form.fecha_vencimiento">
                </div>
            </div>

            <div id="boton-datos">
                <button class="btn btn-success bg-primary" @click="actualizarPerfil()">Actualizar Datos</button>
            </div>
        </div>
    </div>


    <div class="container" id="actualizar-contrasena">
        <h1>Cambiar Contraseña</h1>
        <form action="{{ route('update-password') }}" method="POST">
            @csrf

            <div id="grid" class="row-2 d-flex justify-content-center">
                <div id="espacio-contrasena">
                    <div class="d-flex flex-row">
                        <div>
                            <label for="oldPasswordInput" class="pe-2">Contraseña Actual</label>
                            <input name="old_password" type="password"
                                class="@error('old_password') is-invalid @enderror me-2" id="oldPasswordInput">
                            @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="newPasswordInput" class="pe-2">Nueva Contraseña</label>
                            <input name="new_password" type="password"
                                class="@error('new_password') is-invalid @enderror me-2" id="newPasswordInput">
                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="confirmNewPasswordInput" class="pe-2">Confirmar Contraseña</label>
                            <input name="new_password_confirmation" type="password" class="me-2"
                                id="confirmNewPasswordInput">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer" id="boton-datos">
        <button class="btn btn-success bg-primary">Actualizar Contraseña</button>
    </div>-->
</template>
