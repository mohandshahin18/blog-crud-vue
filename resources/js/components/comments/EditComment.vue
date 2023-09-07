<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="editComment"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" >
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
                                            v-model.lazy="singleComment.body"
                                            required
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click.prevent="editPost(singleComment.id)">
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
    props: ["singleComment"],

    methods: {
        editPost(id) {
            axios({
                method: "post",
                url: `/api/comments/${id}`,

                data: {
                    body: this.singleComment.body,
                    _method: "put",
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
