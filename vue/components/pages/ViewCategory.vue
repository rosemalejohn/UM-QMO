<template>
    <div class="row folder">
        <div class="col-md-12">
            <div class="tabbable tabbable-custom tabbable-noborder ">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#files" data-toggle="tab">Files</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form @submit.prevent="search()" class="alert alert-danger alert-borderless">
                                <div class="input-group">
                                    <div class="input-cont">
                                        <input v-model="searchText" type="text" placeholder="Search files..." class="form-control"/>
                                    </div>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                        Search &nbsp; <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane active" id="files">
                        <div class="margin-top-10">
                            <ul class="mix-filter">
                                <li @click="back()">
                                    <i class="fa fa-chevron-left"></i>
                                    Back 
                                </li>
                                <li @click="uploadFiles()">
                                    <i class="fa fa-plus"></i>
                                    Add files
                                </li>
                                <li @click="deleteCategory()">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </li>
                            </ul>
                            <div class="row mix-grid">
                            	<div class="col-md-3">
                            		<div class="well">
                            			<h3 class="title">{{ category.name }}</h3>
                            			<p>{{ category.description }}</p>
                            		</div>
                            	</div>
                            	<div class="col-md-9">
	                                <div v-for="(file, index) in category.files" class="col-md-4 col-sm-4 mix category_1">
	                                    <file v-on:remove="category.files.splice(index, 1)" :file="file"></file>
	                                </div>
                                    <div v-if="noFiles" class="note note-info note-bordered">
                                        <p>No files uploaded yet. Click <strong>upload</strong> above.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="sass">
    .mix-grid {
        .mix {
            .mix-inner {
                height: 150px;
            }
        }
    }

    .folder {
        .title {
            margin-top: 10px !important;
        }
    }
</style>

<script>
    import File from './../partials/File.vue'
    import Category from './../../api/category'
    import toastr from 'toastr'
    import _ from 'lodash'
    import User from './../../api/user'
    import moment from 'moment'
    import swal from 'sweetalert'

    export default {

        name: 'view-category',

        components: {
            'file': File
        },

        data() {
            return {
                category: {
                	files: []
                },
                searchText: ''
            }
        },

        computed: {

            noFiles() {
            	    return this.category.files.length < 1;
            }

        },

        beforeRouteEnter(to, from, next) {
            Category.GetFiles(to.params.categoryId).then(response => {
                console.log(response.data);
                next(vm => {
                    vm.category = response.data
                })
            }).catch(err => {
                toastr.error('Cannot fetch category files.')
            })
        },

        methods: {
            search() {
                
            },

            uploadFiles() {
                filepicker.pickMultiple({
                    imageQuality: 80
                }, fileArray => { 
                    fileArray = _.map(fileArray, (file) => {
                        var currentDateTime = moment().format('YYYY-MM-DD HH:mm:ss');
                        file['user_id'] = JSON.parse(cookie.get('auth')).id;
                        file['department_id'] = JSON.parse(cookie.get('auth')).department_id;
                        file['description'] = 'Test description';
                        file['created_at'] = currentDateTime;
                        file['updated_at'] = currentDateTime;
                        delete file['client'];
                        delete file['isWriteable'];
                        delete file['id'];
                        delete file['container'];
                        delete file['key'];
                        return file;
                    });

                    Category.AddFiles(this.category.id, fileArray).then(response => {
                        this.category.files = response.data;
                    }).catch(err => {
                        toastr.error('Files not uploaded!');
                    }).bind(this);
                })
            },

            uploadResources() {
                router.push({ name: 'Upload resources' })
            },

            deleteCategory() {
                swal({   
                    title: "Are you sure?",   
                    text: 'This folder will be deleted!',   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true 
                }, () => {
                    Category.Delete(this.category.id).then(response => {
                        swal("Deleted!", "Folder deleted!.", "success");
                        router.push({ name: 'Files' });
                    })
                });
            },

            back() {
                window.history.back()
            }
        },

        watch: {
            'category.files'() {
                this.$nextTick(() => {
                    $('.mix-grid').mixitup();
                });
            },

        },

    }
</script>
