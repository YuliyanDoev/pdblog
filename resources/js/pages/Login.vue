<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-header">Вход</div>
      <div class="card-body">
        <div class="alert alert-danger" v-if="error ">
         <p>{{ error }}</p>
        </div>
       <!-- Form -->
            <form class="text-center" @submit.prevent="login" style="color: #757575;">

                <!-- Email -->
                <div class="form-group">
                    <input type="email" v-model="loginForm.email" class="form-control" placeholder="E-mail">
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input type="password" v-model="loginForm.password" class="form-control" placeholder="Password">
                </div>
                <!-- Sign in button -->
                <button class="btn btn-success" type="submit">Sign in</button>
            </form>
            <!-- Form -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            loginForm: {
                email: 'admin@pdblog.com',
                password: 'password',
            },
            error: false
        }
    },
    created: function () {

    },
    methods: {
        login() {
             var app = this
            axios.post('auth/login', this.loginForm)
                .then((response) => {
                    localStorage.setItem('accessToken', response.data.access_token);
                    axios.defaults.headers.common['Authorization'] = 'Bearer '+ response.data.access_token
                    this.user()
                    this.$router.push({ name: 'home' });
                    location.reload()
                })
                .catch((error) => {
                      app.error = error.response.data.errors[Object.keys(error.response.data.errors)[0]]
                })
        },
        user() {
            axios.get('auth/user')
                .then((response) => {
                    localStorage.setItem('userRole', response.data.data.userRole);
                })
                .catch((error) => {
                      app.error = error.response.data.errors[Object.keys(error.response.data.errors)[0]]
                })
        }
    }
}
</script>
