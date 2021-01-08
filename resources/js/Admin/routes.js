import Dashboard from "./Views/Dashboard";
import ArticleList from "./Views/Blog/ArticleList";

export default [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
    },
    {
        path: '/articles',
        name: 'articleList',
        component: ArticleList,
    },
];
