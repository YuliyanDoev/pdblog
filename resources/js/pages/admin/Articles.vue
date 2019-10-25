<template>
  <div class="container mt-4">
    <div class="card card-default">
      <div class="card-header">Вход</div>
      <div class="card-body">
        <div class="alert alert-danger" v-if="error ">
         <p>{{ error }}</p>
        </div>
       <!-- Form -->
            <form class="text-center" @submit.prevent="login" style="color: #757575;">


                <div class="form-group">
                    <label >Заглавие</label>
                    <input type="text" v-model="loginForm.title" class="form-control" >
                </div>
                <div class="form-group">
                     <label >Съдържание</label>
                    <textarea type="description" v-model="loginForm.description" class="form-control" rows="10"></textarea>
                </div>

                <!-- Password -->
                <div class="form-group">
                     <label >Снимка</label>
                     <input type="file" class="form-control">
                </div>

                 <div class="form-group">
                    <label >Категория</label>
                    <select v-model="loginForm.category_id" class="form-control">

                             <option :selected="v" :value="cat.id" v-for="cat in categories" v-bind:key="cat.id">{{ cat.name }}</option>
                    </select>
                </div>
                 <div class="form-group">
                    <label >Тагове</label>
                    <select v-model="loginForm.tags" class="form-control">
                        <option :value="tag.id" v-for="tag in tags" v-bind:key="tag.id">{{ tag.name }}</option>
                    </select>
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
                title: '',
                description: '',
                image: '',
                category_id: '',
                tags: [],
            },
            categories:[],
            tags:[],
            error: false
        }
    },
  mounted() {
    this.category()
    this.tag()
    this.article()
  },
   methods: {
        category() {
            var app = this
            axios.get('categories')
                .then((response) => {
                    app.categories = response.data.data
                })
                .catch((error) => {
                     console.log(error)
                })
        },
        tag() {
            var app = this
            axios.get('tags')
                .then((response) => {
                    app.tags = response.data.data
                })
                .catch((error) => {
                     console.log(error)
                })
        },
        article() {
            var app = this
            if(!this.$route.params.id){
                return;
            }
            axios.get('articles/'+this.$route.params.id)
                .then((response) => {
                    app.loginForm= {
                           title: response.data.data.title,
                            description: response.data.data.description,
                            image: response.data.data.image,
                            category_id: response.data.data.category,
                            tags: response.data.data.tags,
                    }
                })
                .catch((error) => {
                     console.log(error)
                })
        }
    }
};
</script>
