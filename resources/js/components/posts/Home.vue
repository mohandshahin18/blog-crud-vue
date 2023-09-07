<template>
    <div class="container px-5">

        <AddPost :posts="posts" :user_id="user_id"/>
        <div
            class="post"
            v-for="post in posts"
            :key="post.id"
            :id="`row_${post.id}`"
        >
            <div class="header">
                <div class="avatar-name">
                    <img
                        :src="post.user.avatar_url"
                        class="avatar"
                        alt=""
                    />
                    <div>
                        <p class="name">{{ post.user.name }}</p>
                    <span class="time">{{ this.moment(post.created_at).fromNow()
                     }}</span>
                    </div>
                </div>

                <div class="dropdown">
                    <button type="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a
                                class="dropdown-item"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                                href="#"
                                @click.prevent="setPost(post)"
                                >Edit</a
                            >
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                @click.prevent="deletePost(post.id)"
                                href="#"
                                >Delete</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
            <p>
                {{ post.body }}
            </p>
            <div class="divider my-2"></div>

            <div class="content">
                <span :class="{ liked: liked }" @click="toggleLike">
                    {{ likes == 0 ? "" : likes }}
                    <i class="fa-solid fa-thumbs-up"></i>Like</span
                >
                <span @click="toggleComment(post.id)"
                    ><i class="fa-solid fa-comment"></i>Comment</span
                >
            </div>

            <div class="divider my-2"></div>
            <div class="commentForm my-2"  v-if="showComment && post.id === post_id">
                <AddComment :post_id="post.id" :user_id=" user_id" :posts="posts"/>

            </div>

            <div class="comments my-3" v-for=" comment in post.comments" :key="comment.id">
                <div class="header" style="padding-top: 10px">
                    <img
                        :src="comment.user.avatar_url"
                        class="avatar avatarComment"
                    />
                </div>

                <div class="info">
                    <p class="name">{{ comment.user.name }}</p>
                    <p>
                       {{ comment.body }}
                    </p>
                </div>
            </div>
        </div>
        <EditPost :singlePost="singlePost"/>

    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import EditPost from "./EditPost.vue";
import AddPost from "./AddPost.vue";
import AddComment from "../comments/AddComment.vue";

export default {
    components :{
        EditPost,
        AddPost,
        AddComment,
    },
    data() {
        return {
            showComment: false,
            liked: false,
            likes: 0,
            posts: [],
            singlePost : [],
            user_id : null ,
            post_id : null ,
        };
    },
    methods: {
        toggleComment(id) {
            this.showComment = true;
            this.post_id = id;
        },
        toggleLike() {
            this.liked = !this.liked;
            if (this.liked) {
                this.likes++;
            } else {
                this.likes--;
            }
        },
        moment(time) {
            return moment(time);
        },

        getPosts() {
            axios
                .get("/api/posts")
                .then((res) => res.data)
                .then((json) => {
                    this.posts = json.data.reverse();
                    // console.log(this.posts);
                });
        },


        deletePost(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#000",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`api/posts/${id}`).then((res) => {
                        document.getElementById(`row_${id}`).remove();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener(
                                    "mouseenter",
                                    Swal.stopTimer
                                );
                                toast.addEventListener(
                                    "mouseleave",
                                    Swal.resumeTimer
                                );
                            },
                        });

                        Toast.fire({
                            icon: "success",
                            title: "Deleted Completed",
                        });
                    });
                }
            });
        },
        setPost(post){
            this.singlePost = post;
        },

    },

    mounted() {
        this.getPosts();
        this.user_id = user_id
    },
};
</script>

<style lang="scss" scoped>
.avatar {
    width: 45px;
    height: 45px;
    object-fit: contain;
    border: 1px solid #aaa;
    border-radius: 50%;
}
.avatarComment {
    width: 30px !important;
    height: 30px !important;
}
.container {
    background-color: #f0f2f5 !important;
    .post {
        width: 50%;
        margin: 40px auto;
        background: #fff;
        padding: 15px;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #b7b7b7b0;

        .header {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;

            .avatar-name {
                display: flex;
                gap: 10px;
                justify-content: center;
                .name{
                    font-weight: 500;
                    margin-bottom: unset !important;
                }
                .time{
                    font-size: 14px;
                    color: #65676b;
                }
            }
            .dropdown {
                button {
                    background: unset;
                    border: unset;
                    i {
                        color: #65676b;
                    }
                }
            }
        }
        .content {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 10px;
            span {
                color: #65676b;
                cursor: pointer;
                i {
                    margin-right: 5px;
                }
            }
            .liked {
                color: #007bff; /* Change the background color when liked */
            }
        }

        .divider {
            border: 1px solid #e0e0e0b0;
            width: 100%;
        }
        .commentForm {
            width: 100%;
        }

        .comments {
            display: flex;
            gap: 10px;
            p.name {
                font-weight: 500;
                margin-bottom: 7px;
            }

            .info {
                background-color: #f0f2f5;
                padding: 8px;
                border-radius: 8px;
                p {
                    font-size: 14px;
                }
            }
        }
    }
}
</style>
