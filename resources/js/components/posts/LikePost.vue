<template>
    <span :class="{ liked: liked }" @click="toggleLike">
        {{ likes == 0 ? "" : likes }}
        <i class="fa-solid fa-thumbs-up"></i>Like</span
    >
</template>

<script>
export default {
    data() {
        return {
            liked: false,
            likes: 0,
        };
    },

    methods: {
        toggleLike() {
            this.liked = !this.liked;
            if (this.liked) {
                this.likes++;
            } else {
                this.likes--;
            }
        },
    },
};
</script>
