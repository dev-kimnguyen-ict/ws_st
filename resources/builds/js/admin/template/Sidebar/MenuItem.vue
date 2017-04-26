<template>
    <router-link :to="link" tag="li">
        <a href="javascript:void(0);">
            <i :class="`fa fa-lg fa-fw ${icon}`"></i>
            <span class="menu-name">
                <slot></slot>
            </span>
        </a>
    </router-link>
</template>

<script>
    export default {
        props: {
            icon: {
                type: String,
                require: true
            },
            link: {
                type: [String, Object],
                require: true
            }
        }
    }
</script>
