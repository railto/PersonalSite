<template>
    <div class="max-w-5xl mx-auto">
        <h1 class="mb-4">Edit Article</h1>
        <form action="#" @submit.prevent="updateArticle">
            <div v-if="errors" class="bg-red-600 text-white py-2 px-4 pr-0 font-bold mb-4 shadow-lg">
                <div v-for="(v, k) in errors" :key="k">
                    <p v-for="error in v" :key="error" class="text-sm">
                        {{ error }}
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                        Title
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="title" type="text" v-model="article.title">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="published_at">
                        Publish At
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="published_at" type="text" v-model="article.published_at">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="content">
                        Content
                    </label>
                    <MarkdownEditor v-model="article.content" label="content"/>
                </div>
            </div>
            <button type="submit" class="bg-indigo-500 text-white px-4 py-3 leading-none font-medium">Update Article
            </button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import {mapActions} from 'vuex';

import MarkdownEditor from "../../Components/MarkdownEditor";

export default {
    name: 'EditArticle',
    components: {
        MarkdownEditor,
    },
    data() {
        return {
            article: {
                title: '',
                slug: '',
                published_at: '',
                content: '',
            },
            errors: null,
        };
    },
    methods: {

        async getArticle(slug) {
            const response = await axios.get(`/api/articles/${slug}`);

            this.article = response.data.data;
        },
        async updateArticle() {
            try {
                await axios.put(`/api/articles/${this.article.slug}`, this.article);

                this.flashMessage({text: 'Article Successfully Updated', type: 'success'});
                await this.$router.replace({name: 'articleList'});
            } catch (err) {
                this.errors = err.response.data.errors;
            }
        },
    },
    async mounted() {
        await this.getArticle(this.$route.params.slug);
    }
}
</script>
