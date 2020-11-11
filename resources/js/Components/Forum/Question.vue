<template>
    <v-card class="mx-auto mt-3">
        <v-list-item-content class="pl-4 pt-10 pr-4 pb-5">
            <div class="mb-4">
                <router-link :to="question.path" class="text-decoration-none text-h6">
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
                        color="teal darken-1"
                        text-color="white">
                        {{ question.reply_count > 1 ? question.reply_count + ' answers': question.reply_count + ' answer' }}
                    </v-chip>
                    <v-chip
                        :ripple="false"
                        color="blue lighten-1"
                        text-color="white"
                        v-for="tag in question.tags" :key="tag.id"
                        class="ml-1">
                        {{ tag.tag_name }} 
                    </v-chip>
                </div>
                <div class="col-md-3" v-if="!inprofile">
                    <div class="grey--text mb-0 caption">{{ 'Asked ' + question.created_at }}</div>
                    <div>
                        <router-link :to="question.user_path" class="text-decoration-none" color="blue darken-1">
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
        props: ['question', 'inprofile'],
        data() {
            return {
            }
        },
        computed: {
            body() {
                return md.parse(this.question.body);
            }
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