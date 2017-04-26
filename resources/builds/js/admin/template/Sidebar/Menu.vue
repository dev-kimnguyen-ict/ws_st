<template>
    <nav>
        <ul class="navigation">
            <AdminMenuItem :link="{name: 'dashboard'}" icon="fa-home">Trang chủ</AdminMenuItem>
            <AdminMenuItem :link="{name: 'order.list'}" icon="fa-credit-card">Đơn hàng</AdminMenuItem>
            <AdminMenuItem :link="{name: 'product.list'}" icon="fa-tag">Sản phẩm</AdminMenuItem>
            <AdminMenuItem :link="{name: 'category.list'}" icon="fa-tags">Danh mục sản phẩm</AdminMenuItem>
            <AdminMenuItem :link="{name: 'customer.list'}" icon="fa-users">Khách hàng</AdminMenuItem>
            <AdminMenuItem :link="{name: 'discount.list'}" icon="fa-volume-up">Khuyến mãi</AdminMenuItem>
            <li class="separate"></li>
            <AdminMenuItem :link="{name: 'website.list'}" icon="fa-globe">Website</AdminMenuItem>
            <li class="separate"></li>
            <AdminMenuItem :link="{name: 'application.list'}" icon="fa-cubes">Ứng dụng</AdminMenuItem>
        </ul>
    </nav>
</template>

<script>
    import AdminMenuItem from './MenuItem.vue'

    export default {
        components: {AdminMenuItem}
    }
</script>
