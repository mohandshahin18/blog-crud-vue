<template>
    <div class="p-5">
        <div class="text-center">
            <h1 class="mb-3">{{ blog.title }}</h1>
            <img :src="`/images/${blog.image}`" class="mb-4" alt="" />

            <p>{{ blog.body }}</p>
        </div>

        <router-link to="/" class="btn btn-dark px-4">Retunrn Back</router-link>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            blog: "",
        };
    },
    methods: {
        async getBlog() {
            await axios
                .get(`/api/blogs/${this.$route.params.id}`)
                .then((res) => res.data)
                .then((json) => {
                    this.blog = json.data;
                });
        },
    },

    async mounted() {
        await this.getBlog();
    },
};
</script>

<style scoped>
img {
    width: 300px;
    height: auto;
    border-radius: 8px;
    border: 1px solid #000;
}
</style>
