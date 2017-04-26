/**
 * Created by kimnh on 02/05/2017.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Layout from './template/Layout.vue'
import Dashboard from './pages/dashboard.vue'
import Categorylist from './pages/category/index.vue'
import Login from './pages/index/login.vue'

const routes = [
    {
        path: '/',
        name: 'admin',
        component: Layout,
        redirect: '/dashboard',
        children: [
            {path: 'dashboard', name: 'dashboard', component: Dashboard},
            {path: 'order', name: 'order.list', component: Categorylist},
            {path: 'product', name: 'product.list', component: Dashboard},
            {path: 'category', name: 'category.list', component: Categorylist},
            {path: 'customer', name: 'customer.list', component: Dashboard},
            {path: 'discount', name: 'discount.list', component: Categorylist},
            {path: 'website', name: 'website.list', component: Dashboard},
            {path: 'application', name: 'application.list', component: Categorylist},
        ]
    },
    {
        path: '/login',
        name: 'auth.getLogin',
        component: Login,
    }
]

export default new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes
})
