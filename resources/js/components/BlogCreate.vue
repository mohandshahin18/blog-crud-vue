<template>
    <div class="p-5">
        <h1>Blog Create</h1>
        <form action="" @submit.prevent="storeData()">
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="">Title</label>
                        <input type="text" class="form-control" v-model="title" name="" id="">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="">Image</label>
                        <input type="file" class="form-control" @change="handleFileChange"  name="" id="">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="">Image</label>
                        <textarea name="" class="form-control" v-model="body" id="" cols="30" rows="4"></textarea>
                    </div>

                </div>
                <button class="btn btn-primary px-4">Save</button>
        </form>
    </div>
</template>


<script>
import axios from 'axios';

export default{
    data(){
        return{
            title : "",
            body : "",
            image : "",
        }
    },

    methods :{
        storeData(){
            axios({
                method: "post",
                url: "/api/blogs",
                headers : {
                    'Content-Type' : 'multipart/form-data'
                },
                data: {
                    title: this.title,
                    image: this.image,
                    body: this.body,
                },
            })
            .then((res) =>  this.$router.push({ path: '/' }))


        },

        handleFileChange(event){
            this.image = event.target.files[0];
        }
    }
}
</script>
