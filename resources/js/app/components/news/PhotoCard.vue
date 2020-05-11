<template>
    <div class="col-md-4">
        <img class="img" :src="'/img/' + photo.url" alt="">
        <p class="meta d-flex"><span class="pr-3">Likes: {{likeCount}}</span><span
            class="ml-auto pl-3"><button class="btn-dark" @click="setLikePhoto()">{{isLike}}</button></span>
        </p>
    </div>
</template>

<script>
    export default {
        props: [
            'photo',
            'news_id'
        ],
        data() {
            return {
                likeCount: 0,
                like: false
            }
        },
        methods: {
            setLikePhoto() {
                this.like ? this.likeCount-- : this.likeCount++;
                this.like = !this.like;
                axios.post('/news/' + this.news_id + '/like', {
                    type: 'photo',
                    is_delete: !this.like,
                    photo_id: this.photo.id
                }).then(result => {
                    let res = result.data ? 'Like Update' : "it's so bad"
                    console.log(res);
                }).catch(error => {
                    console.log(error);
                })
            }
        },
        computed: {
            isLike() {
                return this.like ? 'Cancel Like' : 'Like'
            }
        },
        created() {
            this.likeCount = this.photo.like_count;
            this.like = this.photo.like !== null;
        }
    }
</script>
