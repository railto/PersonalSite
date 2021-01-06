<template>
    <div>
        <h1>Admin Dashboard</h1>
        {{user}}
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null,
        };
    },
    async mounted() {
        const response = await axios.get('/api/user');

        this.user = response.data;
        console.log(this.user)
    }
}
</script>
