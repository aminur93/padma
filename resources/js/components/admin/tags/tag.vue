<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tag</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Tag</li>
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
                    <h3 class="card-title">Tag Management</h3>

                    <div class="card-tools">
                        <router-link to="/add_tag" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New
                        </router-link>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3">

                        <div class="float-left">
                            <label>
                                Show
                                <select name="example_length" aria-controls="example" v-model="tableData.length" @change="loadtags()">
                                    <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                                </select>
                                entries
                            </label>
                        </div>

                        <div class="float-right">
                            <label for="">Search:
                                <input class="input" type="text" v-model="tableData.search" placeholder="Search Table" @input="loadtags()">
                            </label>
                        </div>

                    </div>

                    <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                        <tbody>
                        <tr v-show="tags.length" v-for="(tag,index) in tags" :key="tag.id">
                            <td>{{index + 1}}</td>
                            <td>{{tag.tag_name }}</td>
                            <td>
                                <router-link :to="`/edit_tag/${tag.id}`" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></router-link>
                                <button v-on:click="deleteTags(tag)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>

                        <tr v-show="!tags.length">
                            <td colspan="3">
                                <div class="alert alert-danger" role="alert">
                                    Sorry: (No Data Found)
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </datatable>

                    <pagination :pagination="pagination" :offset="5" @paginate="loadtags()" v-if="this.pagination.last_page > 1"></pagination>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Tag Management
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</template>

<script>

    import * as TagServices from '../../../services/tag_services';
    import DataTable from '../../datatable/DataTable.vue';
    import Pagination from '../../datatable/pagination.vue';

    export default{
        components: { datatable: DataTable, pagination: Pagination },
        name: 'tag',
        data(){
            let sortOrders = {};

            let columns = [
                {label: '#Sl', name: 'id' },
                {label: 'Tag Name', name: 'tag_name'},
                {label: 'Action', name: 'action'},
            ];

            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });

            return{
                tags: [],
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
          this.loadtags();
        },

        methods: {
            loadtags: async function(){
                this.tableData.draw++;
                try {
                    let params = new URLSearchParams();
                    params.append('page', this.pagination.current_page);
                    params.append('draw', this.tableData.draw);
                    params.append('length', this.tableData.length);
                    params.append('search', this.tableData.search);
                    params.append('column', this.tableData.column);
                    params.append('dir', this.tableData.dir);

                    const response = await TagServices.getTagsData(params);
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.tags = data.data.data;
                        this.configPagination(data.data);
                    }
                    //this.tags = response.data.tag;
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
                this.loadtags();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },

            deleteTags: async function(tag){
                try {
                    const response = await TagServices.deleteTag(tag.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.loadtags();
                }catch (error){
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>

</style>