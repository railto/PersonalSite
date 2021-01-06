<template>
    <div class="leading-normal tracking-normal" id="main-body">
        <div class="flex flex-wrap">
            <Sidebar/>

            <div class="w-full bg-gray-100 pl-0 lg:pl-64 min-h-screen" :class="sideBarOpen ? 'overlay' : ''"
                 id="main-content">

                <Navbar/>

                <div class="p-6 bg-gray-100 mb-20">
                    <router-view/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';

import Sidebar from './Components/Sidebar';
import Navbar from "./Components/Navbar";

export default {
    name: 'admin',
    components: {
        Sidebar,
        Navbar,
    },
    computed: {
        ...mapGetters({
            sideBarOpen: 'appStore/sideBarOpen',
        }),
    },
};
</script>
