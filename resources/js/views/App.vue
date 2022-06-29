<template>
  <div>
    <div class=" title text-center bg-dark">
      <h1 class="text-danger">Boolpress Blog</h1>
      <p class="text-danger">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam necessitatibus magni
        corrupti fugit
        dignissimos. Accusantium beatae nostrum doloremque deserunt.</p>
    </div>
    <section class="posts">
      <div class="container">
        <div class="row row-cols-1 row cols-sm-2 row cols-md-3">
          <div class="col" v-for="post in postResponse" :key="post.id">
            <div class="product card">
              <img :src="post.cover" :alt="post.title">
              <div class="card-body">
                <h3>{{ post.title }}</h3>
                <p>{{ post.body }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="pagination justify-content-center">
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" aria-label="Previous" @click="getAllPosts(postResponse.currentPage - 1)">
                <span aria-hidden="true">&laquo;</span>
                <span class="visually-hidden">Previous</span>
              </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next" @click="getAllPosts(postResponse.currentPage + 1)">
                <span aria-hidden="true">&raquo;</span>
                <span class="visually-hidden">Next</span>
              </a>
            </li>
          </ul>
        </nav>

      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "App",
  components: {},
  data() {
    return {
      posts: '',
      postResponse: '',
    }
  },
  methods: {
    getAllPosts(postPage) {
      axios
        .get('/api/posts', {
          params: {
            page: postPage
          }
        })
        .then((response) => {
          console.log(response);
          //this.posts = response.data.posts
          this.postResponse = response.data.posts
        })
    }
  },
  mounted() {
    this.getAllPosts(2)
  }
}
</script>
