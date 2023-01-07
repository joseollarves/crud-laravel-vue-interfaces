import { createRouter, createWebHistory } from "vue-router";

import Welcome from '../components/Welcome.vue'
import Usuarios from '../components/usuarios/Usuarios.vue'
import Perfil from '../components/usuarios/Perfil.vue'

import Listado from '../components/vehiculos/Listado.vue'
import RegistrarVehiculo from '../components/vehiculos/RegistrarVehiculo.vue'
import EditarVehiculo from '../components/vehiculos/EditarVehiculo.vue'

import Tipos from '../components/tipos/Tipos.vue'
import RegistrarTipo from '../components/tipos/RegistrarTipo.vue'
import EditarTipo from '../components/tipos/EditarTipo.vue'

import ListaAlquilados from '../components/alquileres/ListaAlquilados.vue'
import CrearAlquiler from '../components/alquileres/CrearAlquiler.vue'
import EditarAlquiler from '../components/alquileres/EditarAlquiler.vue'
import Factura from '../components/alquileres/Factura.vue'

const routes = [
    {
        path: '/home',
        component: Welcome
    },

    {
        path: '/usuarios',
        component: Usuarios
    },

    {
        path: '/perfil/:id',
        component: Perfil,
        props: true
    },

    {
        path: '/listaVehiculos',
        component: Listado,
    },

    {
        path: '/registrarVehiculo',
        component: RegistrarVehiculo,
    },

    {
        path: '/editarVehiculo/:id',
        component: EditarVehiculo,
        props: true,
    },

    {
        path: '/tipos',
        component: Tipos,
    },

    {
        path: '/registrarTipo',
        component: RegistrarTipo,
    },

    {
        path: '/editarTipo/:id',
        component: EditarTipo,
        props: true
    },

    {
        path: '/ListaAlquilados',
        component: ListaAlquilados
    },

    {
        path: '/CrearAlquiler',
        component: CrearAlquiler
    },

    {
        path: '/EditarAlquiler/:id',
        component: EditarAlquiler,
        props: true
    },

    {
        path: '/verFactura/:id',
        component: Factura,
        props: true
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})

export default router
