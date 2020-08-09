<template>
  <div style="margin:auto 0;">
    <h1>Register User</h1>
    <form @submit.prevent="addPost">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" v-model="post.name">
          </div>
        </div>
      </div>
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
        <button class="btn btn-success">Register</button>
    </div>
    </form>
  </div>
</template>

<script>
    export default {
        data(){
        return {
          post:{}
        }
    },
    methods: {
      addPost() {
          let uri = 'http://127.0.0.1:8000/api/register';
          this.axios.post(uri, this.post).then((response) => {
            this.$router.push({name: 'login'});
          });
      }
    }
  }
</script>