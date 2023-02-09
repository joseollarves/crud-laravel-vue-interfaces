<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router'

let form = ref({
    id: '',
    marca: '',
    modelo: '',
    placa: '',
    color: '',
    tipo: '',
    estado: '',
    foto_primera: '',
    foto_segunda: '',
    foto_tercera: ''
})
let tipos = ref([])
let vehiculo = ref([])

onMounted(async () => {
    getDatos()
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

const get_vehiculo = async () => {
    let response = await axios.get(`/api/get_vehiculo/${props.id}`)
    form.value = response.data.vehiculo
}

const getDatos = async () => {

    await axios.get(`/api/get_vehiculo/${props.id}`)
        .then(function (response) {
            form.value = response.data.vehiculo
        })

    await axios.get('/api/get_tipos')
        .then(function (response) {
            tipos.value = response.data.tipos
        })
    }

const getFotoPrimera = () => {
    let foto_primera = '/upload/image.png';
    if (form.value.foto_primera != null) {
        if (form.value.foto_primera.indexOf('base64') != -1) {
            foto_primera = form.value.foto_primera;
        } else {
            foto_primera = '/upload/' + form.value.foto_primera;
        }
    }
    return foto_primera
}

const getFotoSegunda = () => {
    let foto_segunda = '/upload/image.png';
    if (form.value.foto_segunda != null) {
        if (form.value.foto_segunda.indexOf('base64') != -1) {
            foto_segunda = form.value.foto_segunda;
        } else {
            foto_segunda = '/upload/' + form.value.foto_segunda;
        }
    }
    return foto_segunda
}

const getFotoTercera = () => {
    let foto_tercera = '/upload/image.png';
    if (form.value.foto_tercera != null) {
        if (form.value.foto_tercera.indexOf('base64') != -1) {
            foto_tercera = form.value.foto_tercera;
        } else {
            foto_tercera = '/upload/' + form.value.foto_tercera;
        }
    }
    return foto_tercera
}

const actualizarFotoPrimera = (e) => {
    let file = e.target.files[0];
    let reader = new FileReader();
    let limit = 1024 * 1024 * 2;
    if (file['size'] > limit) {
        return false
    }
    reader.onloadend = (file) => {
        form.value.foto_primera = reader.result;
    }

    reader.readAsDataURL(file);
}

const actualizarFotoSegunda = (e) => {
    let file = e.target.files[0];
    let reader = new FileReader();
    let limit = 1024 * 1024 * 2;
    if (file['size'] > limit) {
        return false
    }
    reader.onloadend = (file) => {
        form.value.foto_segunda = reader.result;
    }
    reader.readAsDataURL(file);
}

const actualizarFotoTercera = (e) => {
    let file = e.target.files[0];
    let reader = new FileReader();
    let limit = 1024 * 1024 * 2;
    if (file['size'] > limit) {
        return false
    }
    reader.onloadend = (file) => {
        form.value.foto_tercera = reader.result;
    }

    reader.readAsDataURL(file);
}


const editarVehiculo = () => {
    const formData = new FormData();
    formData.append('marca', form.value.marca);
    formData.append('modelo', form.value.modelo);
    formData.append('placa', form.value.placa);
    formData.append('color', form.value.color);
    formData.append('tipo', form.value.tipo);
    formData.append('estado', form.value.estado);
    formData.append('foto_primera', form.value.foto_primera);
    formData.append('foto_segunda', form.value.foto_segunda);
    formData.append('foto_tercera', form.value.foto_tercera);

    axios.post(`/api/editar_vehiculo/${form.value.id}`, formData)
        .then((response) => {

            form.value.marca = '',
                form.value.modelo = '',
                form.value.placa = '',
                form.value.color = '',
                form.value.tipo = '',
                form.value.estado = '',
                form.value.foto_primera = '',
                form.value.foto_segunda = '',
                form.value.foto_tercera = '',
                router.push('/listaVehiculos')
            }).catch((error) => {
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
                                    <h3 class="card-title">Datos</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Marca</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.marca">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Modelo</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.modelo">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Placa</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.placa">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Color</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="" v-model="form.color">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tipo</label>
                                            <div class="input-group">
                                                <select class="custom-select" v-model="form.tipo">
                                                    <option>Familiar</option>
                                                    <option>Sport</option>
                                                    <option>Carga</option>
                                                    <option>4x4</option>
                                                    <option v-for="tipo in tipos" :key="tipo.id">{{ tipo.nombre }}
                                                    </option>
                                                </select>
                                                <div class="input-group-append">
                                                    <router-link to="/tipos" class="btn btn-primary">Registrar
                                                        Tipo</router-link>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Estado</label>
                                            <select class="custom-select" v-model="form.estado">
                                                <option>Activo</option>
                                                <option>Inactivo</option>
                                                <option>Alquilado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary"
                                            @click="editarVehiculo()">Editar</button>
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
                                            <div class="container">
                                                <div class="mySlides">
                                                    <div class="numbertext">1 / 3</div>
                                                    <img :src="getFotoPrimera()" style="width:100%;">
                                                </div>

                                                <div class="mySlides">
                                                    <div class="numbertext">2 / 3</div>
                                                    <img :src="getFotoSegunda()" style="width:100%;">
                                                </div>

                                                <div class="mySlides">
                                                    <div class="numbertext">3 / 3</div>
                                                    <img :src="getFotoTercera()" style="width:100%;">
                                                </div>


                                                <a class="prev" onclick="plusSlides(-1)">❮</a>
                                                <a class="next" onclick="plusSlides(1)">❯</a>


                                                <div class="row">
                                                    <div class="column">
                                                        <img :src="getFotoPrimera()" class="demo cursor"
                                                            style="width:100%" onclick="currentSlide(1)"
                                                            alt="The Woods">
                                                    </div>
                                                    <div class="column">
                                                        <img :src="getFotoSegunda()" class="demo cursor"
                                                            style="width:100%" onclick="currentSlide(2)"
                                                            alt="Cinque Terre">
                                                    </div>
                                                    <div class="column">
                                                        <img :src="getFotoTercera()" class="demo cursor"
                                                            style="width:100%" onclick="currentSlide(3)"
                                                            alt="Mountains and fjords">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input @change="actualizarFotoPrimera" type="file"
                                                        class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Elige un
                                                        archivo</label>
                                                </div>
                                                <div class="custom-file">
                                                    <input @change="actualizarFotoSegunda" type="file"
                                                        class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Elige un
                                                        archivo</label>
                                                </div>
                                                <div class="custom-file">
                                                    <input @change="actualizarFotoTercera" type="file"
                                                        class="custom-file-input" id="exampleInputFile">
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

<style>
img {
    vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
    position: relative;
    margin-bottom: 10px;
}

/* Hide the images by default */
.mySlides {
    display: none;
    height: 450px;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
    cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
    cursor: pointer;
    position: absolute;
    top: 40%;
    width: auto;
    padding: 16px;
    margin-top: -50px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
}

/* Container for image text */
.caption-container {
    text-align: center;
    background-color: #222;
    padding: 2px 16px;
    color: white;
}

.row {
    display: flex;
    justify-content: center;
}

.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Six columns side by side */
.column {
    float: left;
    width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
    opacity: 0.6;
}

.active,
.demo:hover {
    opacity: 1;
}

</style>
