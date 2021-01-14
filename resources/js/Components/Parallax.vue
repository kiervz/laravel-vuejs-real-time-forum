<template>
    <div class="bg-img">
        <v-parallax
            dark
            :src="'images/bg-image.jpg'" height="700">
            <v-row align="center" justify="center">
                <v-col class="text-center" cols="12">
                    <h1 class="display-1 font-weight-thin mb-4">
                    Stack Underflow
                    </h1>
                    <h4 class="subheading">
                    Stack Overflow is the largest, most trusted online community for developers to learn, share​ ​their programming ​knowledge, and build their careers.
                    </h4>
                </v-col>
            </v-row>
        </v-parallax>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style>
    .bg-img {
        height: 100%
    }
</style>    