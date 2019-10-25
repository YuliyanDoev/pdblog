<template>
   <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">Новини</h1>

        <!-- Blog Post -->
       <template >
           <div class="card mb-4"  v-for="article in articles" v-bind:key="article.id">
                <img class="card-img-top" :src="article.image" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">{{ article.title }} </h2>
                    <small>{{ article.category }}</small>
                    <p class="card-text">{{ article.description }}</p>
                      <router-link class="btn btn-primary" :to="{ name : 'articles',params:{'id':article.id} }"> Виж повече &rarr; </router-link>
                </div>
                <div class="card-footer text-muted">
                    <a class="btn btn-default" href="javascript:void(0)" v-for="(tag,id) in article.tags"  v-on:click="article('tag',id)" v-bind:key="id"> {{ tag }}</a>
                </div>
                <div class="card-footer text-muted">
                    {{ article.created }}
                    <a href="javascript:void(0)"> {{ article.publisher }}</a>
                </div>
            </div>
       </template>

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Търсене</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" v-model="search" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" v-on:click="article('search')" type="button">Търси</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Категории</h5>
          <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled mb-0 row">
                        <li lass="nav-item active col-3" v-for="(category, key) in categories" v-bind:key="category.id">
                            <button class="btn btn-link" v-on:click="article('cat',category.id)" :key="key">
                                {{ category.name}}
                            </button>
                        </li>
                    </ul>
                </div>

            </div>
          </div>
        </div>
        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Тагове</h5>
          <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled mb-0 row">
                    <li lass="nav-item active col-3" v-for="(tag, key) in tags" v-bind:key="tag.id">
                        <button class="btn btn-link" v-on:click="article('tag',tag.id)" :key="key">
                            {{ tag.name}}
                        </button>
                    </li>
                    </ul>
                </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
</template>



<script>
export default {
    data() {
        return {
            categories:[],
            tags:[],
            articles:[],
            error: false,
            search: null,
            cat: null,
            ta: null,
        }
    },
    mounted: function () {
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
        article(type,value) {
            var app = this
            switch (type) {
                case 'tag':
                    app.cat = null;
                    app.ta = value;
                    app.search = null;
                    break;
                case 'cat':
                    app.cat = value;
                    app.ta = null;
                    app.search = null;
                    break;
                case 'search':
                    break
                default:
                    app.cat = null;
                    app.search = null;
                    app.ta = null;
                    break;
            }


            axios.get('articles',{params: {category: app.cat,tag: app.ta,search:app.search}})
                .then((response) => {
                    app.articles = response.data.data
                })
                .catch((error) => {
                    app.articles = {}
                     console.log(error)
                })
        }
    }
}
</script>
