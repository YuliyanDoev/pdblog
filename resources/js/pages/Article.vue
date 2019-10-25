<template>
   <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-12">

        <h1 class="my-4">Новини</h1>

        <!-- Blog Post -->
            <template >
                <div class="card mb-4">
                        <img class="card-img-top" :src="articles.image" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{ articles.title }} </h2>
                            <small>{{ articles.category }}</small>
                            <p class="card-text">{{ articles.description }}</p>
                            <a href="#" class="btn btn-primary">Виж повече &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            <a class="btn btn-default" href="javascript:void(0)" v-for="(tag,id) in articles.tags" v-bind:key="id"> {{ tag }}</a>
                        </div>
                        <div class="card-footer text-muted">
                            {{ articles.created }}
                            <a href="javascript:void(0)"> {{ articles.publisher }}</a>
                        </div>
                        <div class="comments card">
                            <div class="card-body">
                                <textarea v-model="text" class="col-12" rows="3"></textarea>
                            </div>
                            <div class="card-footer text-muted">
                                <button class="btn btn-success float-right" v-on:click="comment()">Запази</button>
                            </div>
                        </div>
                        <div class="comments card" v-for="(comment,id) in articles.comments" v-bind:key="id">
                                <div class="card-body">
                                    <p>{{ comment.text }}</p>
                                </div>
                                <div class="card-footer text-muted">
                                    <p>{{ comment.created }} <a href="javascript:void(0)">{{ comment.name }}</a></p>
                                </div>
                         </div>
                    </div>
            </template>

      </div>


      </div>

    </div>
    <!-- /.row -->
  <!-- /.container -->
</template>



<script>
export default {
    data() {
        return {
            articles:{
                image:null,
                category:null,
                description:null,
                title:null,
                created:null,
                publisher:null,
                tags:[],
                comments:[],
            },
            text:name

        }
    },
    mounted: function () {
        this.article()
    },
    methods: {
        article() {
            var app = this

            axios.get('articles/'+this.$route.params.id)
                .then((response) => {
                    app.articles = response.data.data
                })
                .catch((error) => {
                     console.log(error)
                })
        },
        comment() {
            var app = this

            axios.post('comments',{text:app.text,article_id:this.$route.params.id})
                .then((response) => {
                    app.articles.comments.push(response.data.data)
                    app.text = ""
                })
                .catch((error) => {
                     console.log(error)
                })
        }
    }
}
</script>
