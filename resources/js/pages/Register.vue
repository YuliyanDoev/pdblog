<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-header">Регистрация</div>
       <div class="card-body">
        <div class="alert alert-danger" v-if="error ">
         <p>{{ error }}</p>
        </div>
       <!-- Form -->
            <form class="text-center" @submit.prevent="register" style="color: #757575;">

                <!-- Email -->
                <div class="form-group">
                    <input type="email" v-model="registerForm.email" class="form-control" placeholder="E-mail">
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input type="password" v-model="registerForm.password" class="form-control" placeholder="Password">
                </div>

                 <div class="form-group">
                    <input type="password" id="password_confirmation" class="form-control" v-model="registerForm.password_confirmation" />
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
       registerForm: {
          email: app.email,
          password: app.password,
          password_confirmation: app.password_confirmation
        },
        error: false
    };
  },
  methods: {
    register() {
           var app = this
        axios.post('auth/register', this.loginForm)
            .then((response) => {
                localStorage.setItem('accessToken', response.data.access_token);
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ response.data.access_token
                this.user()
                this.$router.push({ name: 'home' });
                location.reload()
            })
            .catch((error) => {
               app.error = error.response.data.errors[Object.keys(error.response.data.errors)[0]][0]
            })
    },
      user() {
            axios.post('auth/user', this.loginForm)
                .then((response) => {
                    localStorage.setItem('userRole', response.data.userRole);
                })
                .catch((error) => {
                      app.error = error.response.data.errors[Object.keys(error.response.data.errors)[0]]
                })
        }
  }
};
</script>
