<template>
    <v-card class="mx-auto">
        <v-list-item three-line>
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
        </v-list-item>
    </v-card>
    <!-- <div class="card rounded-0">
        <div class="card-body">
            <router-link :to="question.path" class="text-decoration-none">
                <h5 class="card-title">{{ question.title }}</h5>
            </router-link>
            <p class="card-text" v-if="question.body < 200">{{ question.body }}</p>
            <p class="card-text" v-else>{{ question.body.substring(0, 200) + '...' }}</p>
            <div class="row">
                <div class="col-md-8">
                    <div class="badge badge-primary text-wrap">
                        {{ question.category }}
                    </div>
                </div>
                <div class="col-md-4">
                    <p class="mb-0"><small class="text-muted">{{ 'Asked ' + question.created_at }}</small></p>
                    <p class="mt-0 mb-0">{{ question.user }}</p>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
    export default {
        props: ['question']
    }
</script>