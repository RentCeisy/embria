<template>
    <div class="app-section">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12 text-right">
                    <router-link :to="{name: 'news.edit', params: {id}}" v-if="isAuthor" class="btn btn-outline-dark">Edit</router-link>
                    <router-link tag="button" :to="{name: 'home'}" class="btn btn-dark">Back</router-link>
                </div>
            </div>
            <h2 class="mb-3" v-if="news">{{news.title}}</h2>
            <p v-if="news">{{news.description}}</p>
            <p class="meta d-flex"><span class="pr-3">Likes: {{likeCount}}</span><span
                class="ml-auto pl-3"><button class="btn-dark" @click="setLike()">{{isLike}}</button></span>
            </p>
            <div class="row">
                <photo-card v-if="news && photos.length > 0" v-for="photo in photos" :photo="photo" :key="photo.id" :news_id="id" />
            </div>
        </div>
    </div>
</template>

<script>
    import PhotoCard from "./PhotoCard";
    export default {
        data() {
            return {
                id: 0,
                news: null,
                like: false,
                photos: [],
                likeCount: 0,
                isAuthor: false
            }
        },
        methods: {
            getNews() {
                axios.get('/news/data/' + this.id)
                .then(result => {
                    this.news = result.data.news;
                    this.likeCount = result.data.news.like_count;
                    this.photos = result.data.news.photos;
                    this.like = result.data.news.like !== null;
                    this.isAuthor = result.data.isAuthor
                }).catch(error => {
                    console.log(error)
                })
            },
            setLike() {
                this.like ? this.likeCount-- : this.likeCount++;
                this.like = !this.like;
                axios.post('/news/' + this.id + '/like', {
                    type: 'news',
                    is_delete: !this.like
                }).then(result => {
                    console.log('like update');
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
            this.id = this.$route.params.id;
            this.getNews();
        },
        components: {
            PhotoCard
        }
    }
</script>

<style lang="scss">

</style>
