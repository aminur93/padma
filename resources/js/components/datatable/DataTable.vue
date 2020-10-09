<template>
    <div>
        <table class="table table-hover table-bordered table-striped data-table">
            <thead>
            <tr>
                <th v-for="column in columns" :key="column.name" @click="column.name === 'action'? '' : $emit('sort', column.name)"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                    :style="'width:'+column.width+';'+'cursor:pointer;'">
                    {{column.label}}
                </th>
            </tr>
            </thead>
            <slot></slot>
        </table>
    </div>
</template>

<script>
    export default{
        props: ['columns', 'sortKey', 'sortOrders'],
        name: 'data-table',
    }
</script>

<style scoped>

</style>