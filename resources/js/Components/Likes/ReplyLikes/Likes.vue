<template>
    <div>
        <v-btn icon small @click="likeIt">
            <v-icon :color="likeColor">favorite</v-icon> {{ count }}
        </v-btn>
    </div>
</template>
<script>
    export default {
        props: ['data'],
        data() {
            return {
               isLiked: this.data.liked,
               count: this.data.like_count,
            }
        }, 
        computed: {
            likeColor() {
                return this.isLiked ? 'red' : 'dark'
            }
        },
        methods: {
            likeIt() {
                if (User.loggedIn()) {
                    this.isLiked ? this.decrement() : this.increment()
                    this.isLiked = !this.isLiked
                }
            },
            increment() {
                axios.post(`/api/like/${this.data.id}`)
                    .then(res => {
                        this.count++
                        this.color = 'red'
                    })
                    .catch(error => error.response.data)
            },
            decrement() {
                axios.delete(`/api/like/${this.data.id}`)
                    .then(res => {
                        this.count--
                        this.color = 'dark'
                    })
                    .catch(error => error.response.data)
            },
        }
    }
</script>
