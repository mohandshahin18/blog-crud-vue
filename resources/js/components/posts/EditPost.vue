<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="my-4">
                                        <textarea
                                            name=""
                                            class="form-control my-4"
                                            id=""
                                            cols="10"
                                            rows="4"
                                            v-model.lazy="singlePost.body"
                                            required
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click.prevent="editPost(singlePost.id)"
                        >
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
    props: ["singlePost"],

    methods: {
        editPost(id) {
            axios({
                method: "post",
                url: `/api/posts/${id}`,

                data: {
                    body: this.singlePost.body,
                    _method: "put",
                },
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                    },
                });

                Toast.fire({
                    icon: "success",
                    title: "Updated Successfully ",
                });
            });
        },
    },
};
</script>
