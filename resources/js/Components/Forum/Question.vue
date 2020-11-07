<template>
    <v-card class="mx-auto mt-3">
        <v-list-item-content class="pl-4 pt-10 pr-4 pb-5">
            <div class="mb-4">
                <router-link :to="{ path : '/' + question.path }" class="text-decoration-none text-h6">
                    {{ question.title }}
                </router-link>
            </div>
            <div class="paragraph-limit">
                <p class="black--text" v-if="question.body < 200" v-html="question.body"></p>
                <p class="black--text" v-else  v-html="question.body.substring(0, 200) + '...'"></p>
            </div>
            
            <div class="row">
                <div class="col-md-9">
                    <v-chip
                        :ripple="false"
                        color="grey"
                        label
                        text-color="white"
                        >
                        {{ question.category }}
                    </v-chip>
                </div>
                <div class="col-md-3">
                    <div class="grey--text mb-0 caption">{{ 'Asked ' + question.created_at }}</div>
                    <div>
                        <router-link :to="question.user_path" class="text-decoration-none">
                            {{ question.user_name }}
                        </router-link>
                    </div>
                </div>
            </div>
        </v-list-item-content>
    </v-card>
</template>

<script>
    export default {
        props: ['question'],
        data() {
            return {
                inProfile: false,
            }
        },
        created() {
            this.inProfile= false,

            EventBus.$on('inProfile', () => {
                this.inProfile = true
            })
        }
    }
</script>
<style>
    .paragraph-limit {
        display: block;/* or inline-block */
        text-overflow: ellipsis;
        word-wrap: break-word;
        overflow: hidden;
   -webkit-line-clamp: 2; /* number of lines to show */
   -webkit-box-orient: vertical;
    }
</style>