<template>
    <div>
        <form action="" @submit.prevent="addComment">
            <input
                class="form-control"
                placeholder="Add new comment"
                type="text"
                autofocus
                v-model="body"
            />
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["user_id", "post_id", "posts"],
    data() {
        return {
            body: "",
        };
    },

    methods: {
        addComment() {
            axios({
                method: "post",
                url: `/api/comments/${this.post_id}`,
                data: {
                    body: this.body,
                    user_id: this.user_id,
                    post_id: this.post_id,
                },
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            })
                .then((res) => res.data)
                .then((json) => {
                    const postIndex = this.posts.findIndex(
                        (post) => post.id == json.data.post.id
                    );
                    this.posts[postIndex].comments.unshift(json.data.comment);

                    // json.data.post.comments.unshift(json.data.comment);
                    this.body = "";
                });
        },
    },
};
</script>
