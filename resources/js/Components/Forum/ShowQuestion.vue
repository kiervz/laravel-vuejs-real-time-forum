<template>
    <div>
        <div class="row">
            <div class="col-md-9">
                <div class="card border-0">
                    <div class="card-body">
                        <h3>{{ question.title }}</h3>
                        <p><small class="text-muted">{{ 'Asked ' + question.created_at }}</small></p>
                        <hr>
                        <div class="row">
                            <div class="col-md-2 text-center">
                                <button class="btn btn-primary btn-sm">Like</button>
                                <h4 class="p-1 mt-3 mb-3 text-muted">{{ question.id }}</h4>
                                <button class="btn btn-primary btn-sm">Like</button>
                            </div>
                            <div class="col-md-10 text-justify">
                                {{ question.body }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="mt-4">
                    <h5 v-if="replies.length > 1">{{ replies.length + ' Answers'}}</h5>
                    <h5 v-else>{{ replies.length + ' Answer'}}</h5> 
                </div>
                <reply :replies=replies></reply>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</template>

<script>
    import Reply from './Reply'

    export default {
        components: {Reply},
        props: ['question', 'replies'],
    }
</script>