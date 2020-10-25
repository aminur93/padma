<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sub Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Sub Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sub Category Management</h3>

                    <div class="card-tools">
                        <router-link to="/add_sub_cat" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="float-left">
                            <label>
                                Show
                                <select name="example_length" aria-controls="example" v-model="tableData.length" @change="loadSubCategories()">
                                    <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                                </select>
                                entries
                            </label>
                        </div>

                        <div class="float-right">
                            <label for="">Search:
                                <input class="input" type="text" v-model="tableData.search" placeholder="Search Table" @input="loadSubCategories()">
                            </label>
                        </div>
                    </div>

                    <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                        <tbody>
                        <tr v-show="subCategories.length" v-for="(subCat,index) in subCategories" :key="subCat.id">
                            <td>{{index + 1}}</td>
                            <td>{{subCat.category_name }}</td>
                            <td>{{subCat.sub_category_name }}</td>
                            <td>
                                <router-link :to="`/edit_sub_vat/${subCat.id}`" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></router-link>
                                <button v-on:click="deleteSubCate(subCat)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>

                        <tr v-show="!subCategories.length">
                            <td colspan="3">
                                <div class="alert alert-danger" role="alert">
                                    Sorry: (No Data Found)
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </datatable>

                    <pagination :pagination="pagination" :offset="5" @paginate="loadSubCategories()" v-if="this.pagination.last_page > 1"></pagination>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Sub Category Management
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    import * as SubCatServices from '../../../services/subCatServices';

    import DataTable from '../../datatable/DataTable.vue';
    import Pagination from '../../datatable/pagination.vue';

    export default{
        components: { datatable: DataTable, pagination: Pagination },
        name: 'sub_categories',
        data(){
            let sortOrders = {};

            let columns = [
                {label: '#Sl', name: 'id' },
                {label: 'Category Name', name: 'category_name'},
                {label: 'Sub Category Name', name: 'sub_category_name'},
                {label: 'Action', name: 'action'},
            ];

            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });

            return{
                subCategories: [],
                columns: columns,
                sortKey: 'id',
                sortOrders: sortOrders,
                perPage: ['10', '20', '30','25','50','100'],

                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'desc',
                },
                pagination: {
                    last_page: '',
                    current_page: 1,
                    total: '',
                    last_page_url: '',
                    next_page_url: '',
                    prev_page_url: '',
                    from: '',
                    to: ''
                },
            }
        },

        mounted(){
            this.loadSubCategories();
        },

        methods: {
            loadSubCategories: async function(){
                this.tableData.draw++;
                try {
                    let params = new URLSearchParams();
                    params.append('page', this.pagination.current_page);
                    params.append('draw', this.tableData.draw);
                    params.append('length', this.tableData.length);
                    params.append('search', this.tableData.search);
                    params.append('column', this.tableData.column);
                    params.append('dir', this.tableData.dir);

                    const response = await SubCatServices.getData(params);
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.subCategories = data.data.data;
                        this.configPagination(data.data);
                    }
                    //this.subCategories = response.data.sub_cat.data;
                }catch (error){
                    console.log(error);
                }
            },

            configPagination(data) {
                this.pagination.last_page = data.last_page;
                this.pagination.current_page = data.current_page;
                this.pagination.total = data.total;
                this.pagination.last_page_url = data.last_page_url;
                this.pagination.next_page_url = data.next_page_url;
                this.pagination.prev_page_url = data.prev_page_url;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            },
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.loadSubCategories();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },

            deleteSubCate: async function(subCat){
                try {
                    const response = await SubCatServices.deleteSubCat(subCat.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.loadSubCategories();
                }catch (error){
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>

</style>