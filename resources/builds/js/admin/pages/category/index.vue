<template>
    <Panel>
        <PanelContent>
            <div v-if="state.categories.length === 0" class="alert alert-warning">
                No data.
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox">
                    </th>
                    <th></th>
                    <th>Sản phẩm</th>
                    <th>Kho hàng</th>
                    <th>Loại</th>
                    <th>Nhà cung cấp</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category in state.categories">
                    <td>
                        <input type="checkbox">
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </PanelContent>
    </Panel>
</template>

<script>
    import Panel from '../../template/Components/Panel/Panel.vue'
    import PanelContent from '../../template/Components/Panel/PanelContent.vue'

    export default {
        components: {
            Panel,
            PanelContent
        },

        data() {
            let state = {
                categories: []
            }

            return {state}
        }
    }
</script>
