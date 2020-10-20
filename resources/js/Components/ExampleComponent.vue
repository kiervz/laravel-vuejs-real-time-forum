<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        I'm an Example component. {{message}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExampleComponents",
        data() {
            return {
                message: "Hello"
            }
        },
        mounted() {
            console.log('Example Component mounted.')
        }
    }
</script>