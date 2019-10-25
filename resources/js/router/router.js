import VueRouter from 'vue-router'
// Pages
import Article from '../pages/Article'
import Home from '../pages/Home'
import Register from '../pages/Register'
import Login from '../pages/Login'
import AdminArticles from '../pages/admin/Articles'

// Routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: false
        }
    },
    {
        path: '/articles/:id',
        name: 'articles',
        component: Article,
        meta: {
            auth: false
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    // ADMIN ROUTES
    {
        path: '/admin/articles',
        name: 'admin.articles',
        component: AdminArticles,
        meta: {
            auth: true,
            roles: ['Admin']
        }
    },
    {
        path: '/admin/articles/:id',
        name: 'admin.article',
        component: AdminArticles,
        meta: {
            auth: true,
            roles: ['Admin']
        }
    },
]
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

// check user is login

router.beforeEach((to, from, next) => {
    if(to.meta.auth){
        if (localStorage.getItem('accessToken')) {
            next();
        }else{
            next({ name: 'login'});
        }
    }
    if(to.meta.roles){
        if (to.meta.roles.indexOf(localStorage.getItem('userRole'))>-1) {
            next();
        }else{
            next({ name: '/'});
        }
    }
    next();
});


export default router
