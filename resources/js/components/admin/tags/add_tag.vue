<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Tag</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home/tag">Tag</router-link></li>
                            <li class="breadcrumb-item active">Add Tag</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Tag</h3>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="createTag">
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" v-model="tagData.tag_name" class="form-control" id="name" placeholder="Enter Tag Name">
                        <div class="invalid-feedback" v-if="errors.tag_name">{{ errors.tag_name[0] }}</div>
                    </div>

                    <router-link to="/home/tag" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>

    import * as TagServices from '../../../services/tag_services';

    export default{
        name: 'add_tag',
        data(){
            return{
                tagData: {
                    tag_name: '',
                },
                errors: {},
            }
        },

        methods: {
            createTag: async function(){
                try {
                    let formData = new FormData();
                    formData.append('tag_name', this.tagData.tag_name);

                    const response = await TagServices.createTag(formData);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.tagData.tag_name = '';
                }catch(error){
                    switch (error.response.status)
                    {
                        case 422:
                            this.errors = error.response.data.errors;
                            break;

                        default:
                            this.$swal.fire({
                                icon: 'error',
                                text: 'Oops',
                                title: error.response.data.message,
                            });
                            break;
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>