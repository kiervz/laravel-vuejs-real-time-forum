<template>
    <div>
        <div class="card border-0" v-for="reply in replies" :key="reply.id">
            <hr>
            <div class="card-body p-0">
                <p>{{ reply.body + ' – ' }} <router-link :to="reply.user">{{ reply.user }}</router-link></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['replies']
    }
</script>
