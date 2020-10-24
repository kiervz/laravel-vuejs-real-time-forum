<template>
    <v-card class="mx-auto mt-3">
        <v-list-item-content class="pl-4 pt-10 pr-4 pb-5">
            <div class=" mb-4">
                <router-link :to="question.path" class="text-decoration-none text-h6">
                    {{ question.title }}
                </router-link>
            </div>
            <v-list-item-subtitle>
                <p class="black--text" v-if="question.body < 200">{{ question.body }}</p>
                <p class="black--text" v-else>{{ question.body.substring(0, 200) + '...' }}</p>
            </v-list-item-subtitle>
            
            <div class="row">
                <div class="col-md-8">
                    <v-chip
                        :ripple="false"
                        color="grey"
                        label
                        text-color="white"
                        >
                        {{ question.category }}
                    </v-chip>
                </div>
                <div class="col-md-4">
                    <div class="grey--text mb-0 caption">{{ 'Asked ' + question.created_at }}</div>
                    <div class="mt-0 mb-0">
                        <router-link :to="question.user" class="text-decoration-none">
                            {{ question.user }}
                        </router-link>
                    </div>
                </div>
            </div>
        </v-list-item-content>
    </v-card>
</template>

<script>
    export default {
        props: ['question']
    }
</script>