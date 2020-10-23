<template>
    <div>
        <navigation-bar></navigation-bar>
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