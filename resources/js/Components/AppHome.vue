<template>
    <div>
        <navigation-bar class="fixed-bar"></navigation-bar>
        <router-view></router-view>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import NavigationBar from './NavigationBar'
    import AppFooter from './AppFooter'

    export default {
        components: {NavigationBar, AppFooter}
    }   
</script>

<style>
    .fixed-bar {
        position: sticky;
        position: -webkit-sticky; /* for Safari */
        top: 0em;
        z-index: 2;
    }
</style>