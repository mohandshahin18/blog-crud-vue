<template>
    <div class="p-5">
        <h1>Blog Create</h1>
        <form action="" @submit.prevent="storeData()">
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="">Title</label>
                        <input type="text" class="form-control " :class="{' is-invalid': errors?errors.title :  ''}" v-model="title" name="" id="">
                        <small v-if="errors.title" class="invalid-feedback"> {{ errors.title[0] }}</small>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="">Image</label>
                        <input type="file" class="form-control"  :class="{' is-invalid': errors? errors.image :  ''}" @change="handleFileChange"  name="" id="">
                        <small v-if="errors.image" class="invalid-feedback"> {{ errors.image[0] }}</small>

                    </div>
                    <div class="mb-3 col-12">
                        <label for="">Image</label>
                        <textarea name="" class="form-control"  :class="{' is-invalid': errors? errors.body : ''}" v-model="body" id="" cols="30" rows="4"></textarea>
                        <small v-if="errors.body" class="invalid-feedback"> {{ errors.body[0] }}</small>

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
            errors : ''
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
            .then((res) =>  {
                this.$router.push({ path: '/' })
            })
          .catch((error) => {
            this.errors = error.response.data.errors;
          })
        },

        handleFileChange(event){
            this.image = event.target.files[0];
        }

    }
}
</script>
