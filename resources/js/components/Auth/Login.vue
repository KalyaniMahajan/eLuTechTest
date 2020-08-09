<template>
  <div style="margin:auto 0;">
    <h1>User Login</h1>
    <form @submit.prevent="addPost">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" v-model="post.email">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" v-model="post.password">
          </div>
        </div>
      </div>
    <br />
    <div class="form-group">
        <button class="btn btn-success">Login</button>
    </div>
    </form>
  </div>
</template>

<script>
    export default {
        data(){
        return {
          post: {}
        }
    },
    methods: {
      addPost() {
        let uri = 'http://127.0.0.1:8000/api/login';
        this.axios.post(uri, this.post).then((response) => {
           //console.log(response)
            localStorage.setItem("auth", JSON.stringify(response.data.token))
            this.$router.push({path: '/posts'});
        });
      }
    }
  }
</script>