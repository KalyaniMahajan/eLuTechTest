<template>
  <div>
      <h1>Posts Listing - {{user.name}}</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create' }" class="btn btn-sm btn-success">Add New Post</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Post Name</th>
                <th>Post Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody v-if="posts != ''">
                <tr v-for="(post, index) in posts" :key="index"  >
                    <td>{{ index+1 }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.desc }}</td>
                    <td>
                        <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-sm btn-primary">Edit</router-link>
                        <button class="btn btn-sm btn-danger" @click.prevent="deletePost(post.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
            <p v-else>Posts Not Found, Please Create Post first...!</p>
        </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          posts: [],
          user: null
        }
      },
      created() {
      this.user = JSON.parse(localStorage.getItem('user'));
      let uri = 'http://127.0.0.1:8000/api/post';
      this.axios.get(uri, {
        headers: { 'Authorization': `Bearer ${JSON.parse(localStorage.getItem('auth'))}`}
      }).then(response => {
        this.posts = response.data.data;
      });

    },
    methods: {
      deletePost(id)
      {
        const reply = confirm("Are You Sure...?");
        if(reply) {
          let uri = `http://127.0.0.1:8000/api/post/${id}`;
          this.axios.delete(uri, {
              headers: { 'Authorization': `Bearer ${JSON.parse(localStorage.getItem('auth'))}`}
            }).then(response => {
            this.posts.splice(this.posts.findIndex(player => player.id === id), 1);
          });
        }
      }
    }
  }
</script>

