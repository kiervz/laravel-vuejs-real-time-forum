<template>
    <v-container>
        <div class="mx-auto border-0" v-for="reply in replies" :key="reply.id">
            <v-list-item-content class="pa-5">
                <div>{{ reply.body + ' – ' }} <router-link :to="reply.user" class="text-decoration-none">{{ reply.user }}</router-link></div>
            </v-list-item-content>
            <v-divider></v-divider>
        </div>
    </v-container>
</template>

<script>
    export default {
        props: ['replies']
    }
</script>
