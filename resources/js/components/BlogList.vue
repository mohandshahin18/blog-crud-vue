<template>
    <div class="p-5">
        <h1>All Blogs</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="blog in blogs" :key="blog.id" :id="`row_${blog.id}`">
                    <td>{{ blog.id }}</td>
                    <td>{{ blog.title }}</td>
                    <td>
                        <img :src="`images/${blog.image}`" width="80" alt="" />
                    </td>
                    <td>
                        <router-link
                            :to="`/blog/${blog.id}/edit`"
                            class="btn btn-primary btn-sm"
                            @click.prevent="setBlog(blog)"
                        >
                            <i class="fa-solid fa-pen"></i>
                        </router-link>
                        <button
                            @click="deleteBlog(blog.id)"
                            class="btn btn-danger btn-sm mx-1"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
    data() {
        return {
            blogs: [],
            blog : null,
            loading: true
        };
    },

    methods: {
        async getBlogs() {
                await axios
                .get("/api/blogs")
                .then((res) => res.data)
                .then((json) => {
                    this.blogs = json.data;
                });
        },

         deleteBlog(id) {
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
                    axios.delete(`api/blogs/${id}`)
                   .then((res) => {
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

        setBlog(blog){
            this.$root.blog = blog;
        }
    },

    async mounted() {
       await this.getBlogs();
    },


};
</script>


