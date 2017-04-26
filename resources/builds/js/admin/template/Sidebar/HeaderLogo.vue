<template>
    <header class="header-logo">
        <router-link :to="{name: 'dashboard'}" class="navbar-logo">
            <span>App.dev</span>
        </router-link>

        <router-link to="/" class="view-storefront" target="_blank">
            <i class="fa fa-lg fa-external-link"></i>
        </router-link>
    </header>
</template>

<script>
    export default {
        //
    }
</script>
