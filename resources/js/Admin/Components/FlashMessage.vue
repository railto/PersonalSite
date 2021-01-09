<template>
    <div class="fixed bottom-0 left-0 m-6 z-50">
        <div
            v-if="message.type"
            :class="{
                'bg-red-200 text-red-900': message.type === 'error',
                'bg-green-200 text-green-900': message.type === 'success',
            }"
            class="shadow-md p-6 pr-10"
            style="min-width: 240px"
        >
            <button class="opacity-75 cursor-pointer absolute top-0 right-0 py-2 px-3 hover:opacity-100" @click="clearMessage">
                x
            </button>
            <div class="flex items-center">
                {{ message.text }}
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';

export default {
    name: "FlashMessage",
    computed: {
        ...mapGetters({
            message: 'messages/message',
        }),
    },
    methods: {
        ...mapActions({
            setMessage: 'messages/showMessage',
        }),
        clearMessage() {
            return this.setMessage({
                text: null,
                type: null,
            });
        },
    },
};
</script>
