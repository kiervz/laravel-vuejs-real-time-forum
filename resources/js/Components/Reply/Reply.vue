<template>
    <v-list-item-content class="pa-5">
        <div>{{ data.body + ' – ' }} 
            <router-link 
                :to="data.user" 
                class="text-decoration-none">{{ data.user }}
            </router-link>
            <span class="grey--text caption">{{ data.created_at }}</span>
        </div>
        <div v-if="own">
            <v-btn icon small>
                <v-icon color="orange">edit</v-icon>
            </v-btn>
            <v-btn icon small>
                <v-icon color="red">delete</v-icon>
            </v-btn>
        </div>
    </v-list-item-content>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
               
            }
        },
        computed: {
            own() {
                return User.own(this.data.user_id)
            }
        }
    }
</script>
