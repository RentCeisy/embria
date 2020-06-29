<template>
    <div class="col-md-4 p-2">
        <img class="img" :src="'/img/' + photo.url"  alt="">
        <button @click="deletePhoto" class="btn btn-outline-danger btn-del">Delete</button>
    </div>
</template>

<script>
    export default {
        props: [
            'photo'
        ],
        data() {
            return {

            }
        },
        methods: {
            deletePhoto() {
                axios.delete('/news/photo/' + this.photo.id)
                    .then(result => {
                    this.$emit('deletePhoto', this.photo.id)
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .img {
        max-height: 300px;
        min-height: 300px;
        width: 100%;
    }
    .btn-del {
        margin-left: 10px;
    }
</style>
