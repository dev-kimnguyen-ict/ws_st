<template>
    <div class="page-wrapper">
        <AppSidebar></AppSidebar>

        <div class="page-content">
            <AppHeader></AppHeader>

            <div class="page-body">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import AppHeader from './Header.vue'
    import AppSidebar from './Sidebar.vue'

    export default {
        components: {
            AppHeader,
            AppSidebar,
        }
    }
</script>
