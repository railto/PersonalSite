<template>
    <section class="max-w-5xl px-12 mx-auto text-center">
        <div class="bg-white shadow-md px-8 pt-6 pb-8 mb-4 flex flex-col">
            <div v-if="!subscribed">
                <form @submit.prevent="submit">
                    <h3 class="font-semibold text-xl text-gray-800 pb-4">Subscribe to my newsletter</h3>
                    <div class="-mx-3 md:flex mb-2">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide text-gray-800 text-sm font-semibold mb-2"
                                   for="first_name">
                                First Name
                            </label>
                            <div>
                                <input
                                    class="w-full border border-indigo-600 text-black text-xs py-3 px-4 pr-8 mb-3"
                                    id="first_name" type="text" v-model="form.first_name"/>
                            </div>
                        </div>
                        <div class="md:w-1/2 px-3">
                            <label class="uppercase tracking-wide text-gray-800 text-sm font-semibold mb-2"
                                   for="email">
                                Email Address
                            </label>
                            <div>
                                <input
                                    class="w-full border border-indigo-600 text-black text-xs py-3 px-4 pr-8 mb-3"
                                    id="email" type="email" v-model="form.email"/>
                            </div>
                        </div>
                        <div class="md:w-1/4 px-3">
                            <div>
                                &nbsp;
                            </div>
                            <div>
                                <button class="bg-indigo-600 p-2 text-white" type="submit">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div v-else>
                <h3 class="font-semibold text-xl text-gray-800 pb-4">Successfully Subscribed</h3>
                <p>Thank you for subscribing to my newsletter. I promise I will not spam you, I hate that stuff as
                    well.</p>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    name: 'NewsletterSubscribe',
    data() {
        return {
            subscribed: false,
            form: {
                first_name: '',
                email: '',
            },
        };
    },
    methods: {
        async submit() {
            await axios.post('/api/newsletter/subscribe', this.form);

            this.form.first_name = '';
            this.form.email = '';
            this.subscribed = true;
        }
    }
};
</script>
