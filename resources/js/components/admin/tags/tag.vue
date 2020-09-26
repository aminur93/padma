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
                        <router-link to="/add_tag" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Tag
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tag Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="(tag,index) in tags" :key="index">
                            <td>{{ index + 1}}</td>
                            <td>{{ tag.tag_name }}</td>
                            <td>
                                <router-link :to="`/edit_tag/${tag.id}`" class="btn btn-info"><i class="fa fa-edit"></i></router-link>
                                <button v-on:click="deleteTags(tag)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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

    export default{
        name: 'tag',
        data(){
            return{
                tags: [],
            }
        },

        mounted(){
          this.loadtags();
        },

        methods: {
            loadtags: async function(){
                try {
                    const response = await TagServices.getTagsData();
                    this.tags = response.data.tag;
                }catch (error){
                    console.log(error);
                }
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