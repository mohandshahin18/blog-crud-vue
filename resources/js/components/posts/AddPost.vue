<template>
    <div class="row d-flex justify-content-center text-start">
        <div class="col-md-6">
            <form action="" @submit.prevent="sendPost()">
                <div class="col-md-12">
                    <div class="my-4">
                        <textarea
                            name=""
                            class="form-control my-4"
                            id=""
                            cols="10"
                            rows="4"
                            v-model="body"
                            required
                        ></textarea>
                    </div>
                </div>
                <button class="btn btn-primary px-4">Post</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: ["posts", "user_id"],
    data() {
        return {
            body: "",
            newPost: new Audio("/assets/new-post.wav"),
        };
    },
    methods: {
        sendPost() {
            axios({
                method: "post",
                url: "/api/posts",
                data: {
                    body: this.body,
                    user_id: this.user_id,
                },
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            })
                .then((res) => res.data)
                .then((json) => {
                    this.posts.unshift(json.data);
                    this.newPost.play();
                    this.body = "";
                });
        },
    },
};
</script>
