<template>
    <div>
        <h1 class="mb-4">Article List</h1>

        <table class="w-full text-md bg-white shadow-md rounded mb-4">
            <thead>
            <tr class="border-b">
                <th class="text-left p-3 px-5">Title</th>
                <th class="text-left p-3 px-5">Slug</th>
                <th class="text-left p-3 px-5">Published At</th>
                <th class="text-left p-3 px-5">Edited At</th>
                <th class="text-left p-3 px-5">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="article in articles" class="border-b hover:bg-indigo-100 bg-gray-100">
                <td class="p-3 px-5">{{ article.title }}</td>
                <td class="p-3 px-5">{{ article.slug }}</td>
                <td class="p-3 px-5">{{ article.published_at | formatDate }}</td>
                <td class="p-3 px-5">{{ article.updated_at |formatDate }}</td>
                <td class="p-3 px-5 flex justify-end">
                    <button class="bg-indigo-600 text-white mr-3 py-1 px-2" type="button"
                            @click="editArticle(article.slug)">Edit
                    </button>
                    <button class="bg-red-600 text-white p-2 py-1 px-2" type="button"
                            @click="deleteArticle(article.slug)">Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment'
import {mapActions} from 'vuex';

export default {
    name: 'BlogArticleList',
    data() {
        return {
            articles: null,
        };
    },
    filters: {
        formatDate(value) {
            if (value) {
                return moment(String(value)).format('DD/MM/YYYY HH:mm');
            }
        },
    },
    methods: {
        ...mapActions({
            flashMessage: 'messages/showMessage',
        }),
        async getArticles() {
            const response = await axios.get('/api/articles');
            this.articles = response.data.data;
        },
        editArticle(slug) {
            this.$router.replace({name: 'editArticle', params: {slug}});
        },
        async deleteArticle(slug) {
            if (confirm('Are you sure you want to delete this article?')) {
                await axios.delete(`/api/articles/${slug}`);

                this.flashMessage({text: 'Article Successfully Updated', type: 'success'});

                await this.getArticles();
            }
        }
    },
    async mounted() {
        await this.getArticles();
    },
};
</script>
