<template>
    <div class="col-md-4">
        <div class="news-entry">
            <router-link :to="{name: 'news.show', params: { id: news.id }}" class="image"><img v-if="news.photo" :src="'img/' + news.photo.url" class="img-big img-fluid"></router-link>
            <div class="text pt-3">
                <p class="meta d-flex"><span class="pr-3">{{news.created_at}}</span><span
                    class="ml-auto pl-3">Likes: {{news.like_count}}</span>
                </p>
                <h3><router-link :to="{name: 'news.show', params: { id: news.id }}">{{news.title}}</router-link></h3>
                <p class="mb-0"><router-link  :to="{name: 'news.show', params: { id: news.id }}" class="btn btn-dark py-2">Read More</router-link></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'news'
        ],
    }
</script>
<style lang="scss" scoped>
    .news-entry {
        margin-bottom: 3em;
        width: 100%;

        .text {
            h3 {
                font-size: 20px;
                margin-bottom: 20px;

                a {
                    color: #000000;
                }
            }

        }
        .image {
            display: block;
            width: 100%;
            overflow: hidden;
            border-radius: 4px;

            .img-big {
                max-height: 300px;
            }
        }

    }
</style>
