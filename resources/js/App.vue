<template>
  <div class="container">
    <nav class="navbar justify-content-between navbar-expand-sm bg-primary navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/" class="nav-link">Laravel-VueJs</router-link>
        </li>
        <li class="nav-item" v-if="auth">
          <router-link to="/posts" class="nav-link">Posts</router-link>
        </li>
      </ul>
      <form class="form-inline">
        <ul class="navbar-nav">
          <li class="nav-item" v-if="auth==null">
            <router-link to="/register" class="nav-link">Register</router-link>
          </li>
          <li class="nav-item" v-if="auth==null">
            <router-link to="/login" class="nav-link">Login</router-link>
          </li>
          <li class="nav-item" v-if="auth">
            <button class="btn btn-sm btn-primary nav-link" @click="logout"> logout</button>
          </li>
        </ul>
      </form>
    </nav>
    <br />
    <transition name="fade">
      <router-view></router-view>
    </transition>
  </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }

    .nav-link {
        font-weight: bold !important;
        color: #FFF !important;
    }
</style>

<script>
    export default{
      data() {
        return {
          auth: null
        }
      },
      created() {
        this.auth = JSON.parse(localStorage.getItem('auth'))
        //console.log(this.auth)
      },
      methods: {
        logout() {
            let uri = 'http://127.0.0.1:8000/api/logout';
            this.axios.post(uri, this.post).then((response) => {
              this.auth = null;
              localStorage.clear();
              this.$router.push({name: 'login'});
            });
        }
      }
    }
</script>
