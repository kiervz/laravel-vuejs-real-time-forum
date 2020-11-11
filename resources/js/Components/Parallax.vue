<template>
    <div class="bg-img">
        <v-parallax
            dark
            :src="'images/bg-image.jpg'" height="700">
            <v-row align="center" justify="center">
                <v-col class="text-center" cols="12">
                    <h1 class="display-1 font-weight-thin mb-4">
                    Vuetify
                    </h1>
                    <h4 class="subheading">
                    Build your application today!
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