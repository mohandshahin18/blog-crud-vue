<template>
    <div class="p-5">
        <h1>Blog Edit</h1>
        <form action="" @submit.prevent="EditData(blog.id)">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="">Title</label>
                    <input type="text" class="form-control" v-model="blog.title"  :class="{' is-invalid': errors?errors.title :  ''}" name="" id="" />
                    <small v-if="errors.title" class="invalid-feedback"> {{ errors.title[0] }}</small>

                </div>
                <div class="mb-3 col-6">
                    <label for="">Image</label>
                    <input
                        type="file"
                        class="form-control"
                        @change="handleFileChange"
                        name=""
                        id=""
                    />
                    <img :src="blog.prev_img ? blog.prev_img : `/images/${blog.image}`" width="80" alt="" />
                </div>
                <div class="mb-3 col-12">
                    <label for="">Image</label>
                    <textarea
                        name=""
                        v-model="blog.body"
                        class="form-control"
                        id=""
                        cols="30"
                        rows="4"
                        :class="{' is-invalid': errors? errors.body : ''}"
                    ></textarea>
                    <small v-if="errors.body" class="invalid-feedback"> {{ errors.body[0] }}</small>

                </div>
            </div>
            <button class="btn btn-primary px-4 mx-2">Save</button>
            <router-link to="/" class="btn btn-dark  px-4"  >Retunrn Back</router-link>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";


export default {
    data() {
        return {
            blog : "",
            image : "",
            errors : ""
        };
    },
    methods: {
       async getBlog() {
           await axios
                .get(`/api/blogs/${this.$route.params.id}`)
                .then((res) => res.data)
                .then((json) => {
                    this.blog = json.data
                    this.blog._method = 'put';
                })

        },

        handleFileChange(event){
            this.image = event.target.files[0];
            this.blog.prev_img = URL.createObjectURL(this.image);

        } ,

        EditData(id){
            axios({
                method: "post",
                url: `/api/blogs/${id}`,
                headers : {
                    'Content-Type' : 'multipart/form-data'
                },
                data: {
                    title : this.blog.title,
                    image : this.image,
                    body : this.blog.body,
                    _method : this.blog._method
                },
            })
            .then((res) =>  {
                this.$router.push({ path: '/' })

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
                            title: "Updated Successfully ",
                        });
            })
            .catch((error) => {
            this.errors = error.response.data.errors;
          })
        },
    },

   async mounted() {
        await this.getBlog();
    },
};
</script>
