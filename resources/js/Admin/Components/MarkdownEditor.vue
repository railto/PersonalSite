<template>
    <div>
        <tabs>
            <tab name="Editor">
               <textarea
                   class="no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none"
                   :value="value"
                   @input="$emit('input', $event.target.value); resize($event)"
                   :id="label"
               ></textarea>
            </tab>
            <tab name="Preview">
                <div v-html="compiledMarkdown"></div>
            </tab>
        </tabs>
    </div>
</template>

<script>
import marked from 'marked';
import {Tabs, Tab} from 'vue-tabs-component';

export default {
    name: 'MarkdownEditor',
    props: {
        value: {
            required: true,
        },
        label: {
            required: false,
        },
    },
    components: {
        Tab,
        Tabs,
    },
    methods: {
        resize(e) {
            e.target.style.height = 'auto';
            e.target.style.height = `${e.target.scrollHeight}px`;
        },
    },
    computed: {
        compiledMarkdown: function () {
            return marked(this.value, {sanitise: true});
        },
    },
};
</script>
