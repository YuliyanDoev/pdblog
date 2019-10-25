<template >

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <router-link class="navbar-brand" :to="{ name : 'home' }">PD Blog</router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

          <li class="nav-item" v-for="(route, key) in routes" v-bind:key="route.path">
                <router-link class="nav-link" :to="{ name : route.path }" :key="key">
                    {{route.name}}
                </router-link>
          </li>
          <template  v-if="userRole == 'Admin'">
               <li class="nav-item" v-for="(route, key) in AdminRoutes" v-bind:key="route.path">
                    <router-link  class="nav-link" :to="{ name : route.path }" :key="key">
                        {{route.name}}
                    </router-link>
                 </li>
          </template>
    </ul>
     <ul class="navbar-nav float-right">
        <li class="nav-item float-right" v-if="!userToken">
            <router-link class="nav-link" :to="{ name : 'login' }"> Вход </router-link>
        </li>
        <li class="nav-item float-right" v-if="!userToken">
            <router-link class="nav-link" :to="{ name : 'register' }"> Регистрация </router-link>
        </li>
        <li class="nav-item float-right" v-if="userToken">
            <a class="nav-link" v-on:click="logout()"  href="javascript:void(0)">Изход</a>
        </li>
    </ul>
  </div>
</nav>

</template>

<script>

export default {
     data() {
        return {
            userToken: localStorage.getItem('accessToken'),
            userRole: localStorage.getItem('userRole'),
            routes: [
                {
                    "name":"Начало",
                    "path":"home"
                }
            ],
            AdminRoutes: [
                {
                    "name":"Статии",
                    "path":"admin.articles",
                },
            ]
        }
    },
    mounted() {

    },
    methods: {
        logout(){
             localStorage.removeItem('accessToken')
             localStorage.removeItem('userRole')
             this.$router.push({ name: 'home' });
             location.reload()
        }
    }
};
</script>
