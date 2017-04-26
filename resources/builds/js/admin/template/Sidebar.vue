<template>
    <aside class="sidebar">
        <HeaderLogo></HeaderLogo>

        <AdminMenu></AdminMenu>
    </aside>
</template>

<script>
    import AdminMenu from './Sidebar/Menu.vue'
    import HeaderLogo from './Sidebar/HeaderLogo.vue'

    export default {
        components: {
            HeaderLogo,
            AdminMenu
        }
    }
</script>
