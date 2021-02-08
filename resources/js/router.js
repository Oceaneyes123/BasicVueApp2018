import Vue from 'vue'
import VueRouter from 'vue-router'
import Index from './components/Index'
import Main from './components/Main'
import Register from './components/Register'
import Home from './components/Home'
import Add from './components/Add'
import Edit from './components/Edit'
//import store from './store'




Vue.use(VueRouter)

const router = new VueRouter({
  routes: [
    {name: 'Main', path: '/Main', component: Main},
    {name: 'Register', path: '/Register', component: Register},
    {name: 'Home', path: '/Home', component: Home},
    {name: 'Add', path: '/Add', component: Add},
    {name: 'Edit', path: '/Edit', component: Edit},
  ]
})

//  router.beforeEach((to, from, next) => {
//     if (to.matched.some(m => m.meta.requiresAuth) && store.state.token === null) {
//         return next('/Register');
//     } else {
//         return next();
//     }
// });

export default router
