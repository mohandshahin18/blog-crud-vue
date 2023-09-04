<template>
    <div class="p-5">
        <h1>Blog Edit</h1>
        <form action="" @submit.prevent="EditData()">
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="">Title</label>
                        <input type="text" class="form-control"  name="" id="">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="">Image</label>
                        <input type="file" class="form-control" @change="handleFileChange"  name="" id="">
                        <!-- <img :src="`images/${this.$root.blog.image}`" width="100" alt=""> -->

                    </div>
                    <div class="mb-3 col-12">
                        <label for="">Image</label>
                        <textarea name="" class="form-control" id=""  cols="30" rows="4"></textarea>
                    </div>

                </div>
                <button class="btn btn-primary px-4">Save</button>
        </form>
    </div>
</template>

<script>

</script>
