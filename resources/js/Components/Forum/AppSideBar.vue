<template>
    <v-card class="mx-auto ml-2">
        <v-toolbar dark dense>
            <v-toolbar-title>Tags</v-toolbar-title>
        </v-toolbar>
        <v-list>
            <v-list-item v-for="tag in tags" :key="tag.id">
                <v-list-item-content>
                    <v-list-item-title>
                        {{ tag.name }}
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-card>
</template>

<script>
    export default {
        data() {
           return {
               tags: {}
           }
        },
        created() {
            axios.get('api/tag')
                .then(res => { this.tags = res.data.data })
                .catch(error => { error.response.data })
        }
    }
</script>