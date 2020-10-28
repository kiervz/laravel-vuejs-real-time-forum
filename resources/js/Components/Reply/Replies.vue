<template>
    <v-container>
        <v-flex md9>
            <reply 
                v-for="reply in replies" 
                :key="reply.id"
                :data="reply"
                >
            </reply>
        </v-flex>
    </v-container>
</template>

<script>
    import Reply from './Reply'
    
    export default {
        props: ['replies'],
        components: { Reply }
    }
</script>