<template>
    <nav class="navbar navbar-expand-lg bg-dark py-3 px-5" data-bs-theme="dark">
        <router-link class="navbar-brand" to="/">LOGO</router-link>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <router-link class="nav-link" to="/" active-class="active"
                    >Home</router-link
                >
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/blogs" active-class="active"
                    >All Blog</router-link
                >
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    to="/blog/create"
                    active-class="active"
                    >Add Blog</router-link
                >
            </li>
            <li class="nav-item">
                <a href="" class="nav-link" @click.prevent="logout()"
                    >Log out</a
                >
            </li>
        </ul>
    </nav>
</template>

<script>
import axios from "axios";

export default {
    methods: {
        logout() {
            axios({
                method: "post",
                url: "/api/logout",
                headers: {
                    'Authorization': "Bearer " + localStorage.getItem("token"),
                },
            })
                .then((res) => {
                    localStorage.removeItem("token");
                })
                .then((json) => {
                    window.location.href = "/login";
                });
        },
    },
};
</script>
