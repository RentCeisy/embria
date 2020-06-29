import VueRouter from "vue-router";
import Home from "./components/home/Home";
import News from "./components/news/News"
import NewsEdit from "./components/news/NewsEdit";

export default new VueRouter({
    routes: [
        {
            name: 'home',
            path: '/home',
            component: Home,
        },
        {
            name: 'news.show',
            path: '/news/:id',
            component: News,
            props: true
        },
        {
            name: 'news.edit',
            path: '/news/edit/:id',
            component: NewsEdit,
            props: true
        },

    ],
    mode: 'history'
})
