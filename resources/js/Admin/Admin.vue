<template>
    <div>
        <Navbar />
        <router-view />
    </div>
</template>

<script>
import Navbar from "./Components/Navbar";

export default {
    name: 'admin',
    components: {
        Navbar,
    },
    mounted() {
        console.log('mounted')
    }
};
</script>
