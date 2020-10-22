<template>
    <div class="container">
        <show-question :question=question :replies=replies></show-question>
    </div>
</template>

<script>
    import ShowQuestion from './ShowQuestion'

    export default {
        components: { ShowQuestion },
        data() {
            return {
                question: {},
                replies: {},
            }
        },
        created() {
            axios.get(`/api/question/${this.$route.params.slug}`)
                .then(res => this.question = res.data.data)
                .catch(error => console.log(error.response.data))

            axios.get(`/api/question/${this.$route.params.slug}/reply`)
                .then(res => this.replies = res.data.data)
                .catch(error => console.log(error.response.data))
        },
    }
</script>