<template>
    <div>
        <form action="" @submit.prevent="search">
            <label for="query" class="sr-only">Search Query</label>
            <input class="form-input rounded-none" type="text" id="query" v-model="query"
                   placeholder="Search Blog Articles" v-debounce:300ms="search"
                   autofocus>
        </form>

        <Transition name="fade">
            <div v-if="query && results" @keyup.esc="closeModal" tabindex="0" class=" overflow-y-visible">
                <div class="fixed pin inset-0 bg-indigo-600 overflow-auto text-white mt-12">
                    <div class="flex justify-between items-center py-4 px-8">
                        <p class="text-2xl font-bold">{{ results.length }} Result(s)</p>
                        <div class="modal-close cursor-pointer z-50" @click="closeModal">
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="18"
                                 height="18" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <ul class="pt-3 -pb-3">
                        <li v-for="article in results" :key="article.id" class="pb-4">
                            <a class="text-xl font-semibold" :href="'/blog/' + article.slug">{{ article.title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </Transition>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ArticleSearch',
    data() {
        return {
            query: null,
            results: null,
        }
    },
    methods: {
        async search() {
            const response = await axios.post('/api/articles/search', {query: this.query});

            this.results = response.data.data;
        },
        closeModal() {
            this.query = null;
            this.results = null;
        }
    }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.4s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
