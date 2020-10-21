<template>
    <div class="card rounded-0">
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
    </div>
</template>

<script>
    export default {
        props: ['question']
    }
</script>