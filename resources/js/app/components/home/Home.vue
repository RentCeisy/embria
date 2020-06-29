<template>
    <div class="app-section">
        <div class="row">
            <news-card v-for="item in news"
                  :key="item.id"
                  :news="item"
            />
        </div>
        <ul class="pagination">
            <li v-if="newsPaginate.current_page > 1" class="page-item">
                <a href="javascript:void(0)" aria-label="Previous" class="page-link"
                   @click.prevent="changePage(newsPaginate.current_page - 1)">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <li v-for="page in pagesNumber" :class="{'active': page == newsPaginate.current_page}" class="page-item">
                <a href="javascript:void(0)" @click.prevent="changePage(page)" class="page-link">{{ page }}</a>
            </li>
            <li v-if="newsPaginate.current_page < newsPaginate.last_page" class="page-item">
                <a href="javascript:void(0)" aria-label="Next" class="page-link"
                   @click.prevent="changePage(newsPaginate.current_page + 1)">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    import NewsCard from './NewsCard'

    export default {
        data() {
            return {
                news: [],
                newsPaginate: {
                    total: 0,
                    per_page: 12,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page: 1
                },
                offset: 4
            }
        },
        methods: {
            getNews() {
                axios.get('/home/news?page=' + this.newsPaginate.current_page, {}).then(result => {
                    if (result.data.data.length > 0) {
                        this.news = result.data.data;
                        this.newsPaginate.last_page = result.data.last_page;
                        this.newsPaginate.to = result.data.to;
                    }
                }).catch(error => {
                    console.log(error)
                })
            },
            changePage(page) {
                this.newsPaginate.current_page = page;
                this.getNews()
            }
        },
        computed: {
            pagesNumber() {
                if (!this.newsPaginate.to) {
                    return [];
                }

                let from = this.newsPaginate.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                let to = from + (this.offset * 2);
                if (to >= this.newsPaginate.last_page) {
                    to = this.newsPaginate.last_page;
                }
                let pagesArray = [];
                for (let page = from; page <= to; page++) {
                    pagesArray.push(page);
                }

                return pagesArray;
            },
        },
        created() {
            this.getNews();
        },
        components: {
            NewsCard
        }
    }
</script>
<style>

</style>
