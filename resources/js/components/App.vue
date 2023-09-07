<template>
    <div class="container ">

        <nav-bar />
        <loader></loader>

        <router-view />


    </div>
</template>

<script>
import NavBar from "./Nav.vue";
import Loader from "./Loader.vue";

export default {
  components: {
    NavBar,
    Loader,
  },
};
</script>
