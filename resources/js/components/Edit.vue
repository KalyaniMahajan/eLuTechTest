<template>
  <div>
    <h1>Edit Post</h1>
    <ul v-if="success" class="list-unstyle">
        <li class="alert alert-success">{{ success }}</li>
    </ul>
    
    <form @submit.prevent="updatePost">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Post Title:</label>
            <input type="text" class="form-control" v-model="post.title">
            <span class="text-danger text-sm" v-if="error.title">{{ error.title }}</span>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Post Body:</label>
              <textarea class="form-control" v-model="post.desc" rows="5"></textarea>
              <span class="text-danger text-sm" v-if="error.desc">{{ error.desc }}</span>
            </div>
          </div>
        </div><br />
        <div class="form-group">
          <button class="btn btn-primary">Update</button>
        </div>
    </form>
  </div>
</template>

<script>
    export default {

      data() {
        return {
          post: {},
          success: '',
          error: [],
        }
      },
      created() {
        let uri = `http://127.0.0.1:8000/api/post/${this.$route.params.id}/edit`;
        this.axios.get(uri, {
            headers: { 'Authorization': `Bearer ${JSON.parse(localStorage.getItem('auth'))}`}
          }).then((response) => {
            this.post = response.data.data;
        });
      },
      methods: {
        updatePost() {
          let uri = `http://127.0.0.1:8000/api/post/${this.$route.params.id}`;
          this.axios.put(uri, this.post, {
            headers: { 'Authorization': `Bearer ${JSON.parse(localStorage.getItem('auth'))}`}
          }).then((response) => { this.success = response.data.message;
          }).catch(error => this.error = error.response.data.message);
          //this.$router.push({name: 'posts'});
        }
      }
    }
</script>