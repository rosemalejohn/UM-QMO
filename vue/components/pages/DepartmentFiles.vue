<template>
    <div class="row">
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
                                        <input v-on:keyup="search()" v-model="searchText" type="text" placeholder="Search files..." class="form-control"/>
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
                                <li @click="uploadFiles()">
                                    <i class="fa fa-plus"></i>
                                    Upload files
                                </li>
                                <li class="filter" data-filter="all">
                                     All
                                </li>
                                <li 
                                    v-for="category in categories" 
                                    class="filter" 
                                    :data-filter="category.id">
                                    {{ category.name }}
                                </li>
                            </ul>
                            <div class="row mix-grid">
                                <div v-for="file in files" class="col-md-3 col-sm-4 mix category_1">
                                    <file v-on:remove="files.splice(index, 1)" :file="file"></file>
                                </div>
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
</template>

<style lang="sass">
    .mix-grid {
        .mix {
            .mix-inner {
                height: 150px;
            }
        }
    }
</style>

<script>
    import File from './../partials/File.vue'
    import Category from './../../api/category'
    import FileService from './../../api/file'
    import toastr from 'toastr'
    import _ from 'lodash'
    import User from './../../api/user'
    import Department from './../../api/department'
    import moment from 'moment'

    export default {

        name: 'department-files',

        components: {
            'file': File
        },

        mounted() {
            
            this.getCategories();
            
        },

        data() {
            return {
                departmentId: null,
                files: [],
                categories: [],
                searchText: ''
            }
        },

        computed: {

            noFiles() {
                return this.files.length < 1;
            }

        },

        beforeRouteEnter(to, from, next) {
            Department.GetFiles(to.params.departmentId).then(response => {
                next(vm => {
                    vm.departmentId = to.params.departmentId;
                    vm.files = response.data.files;
                })
            }).catch(err => {
                toastr.error('Cannot fetch files.')
                next(false);
            })
        },

        methods: {
            search: _.debounce(() => {
                FileService.Search(this.searchText).then(response => {
                    this.files = response.data;
                })
            }, 1000),

            getCategories() {
                Category.GetAll().then(response => {
                    this.categories = response.data;
                }).catch(err => {
                    toastr.error('Cannot fetch categories.')
                })
            },

            uploadFiles() {
                filepicker.pickMultiple({
                    imageQuality: 80
                }, fileArray => {
                    fileArray = _.map(fileArray, (file) => {
                        var currentDateTime = moment().format('YYYY-MM-DD HH:mm:ss');
                        file['user_id'] = JSON.parse(cookie.get('auth')).id;
                        file['description'] = 'Test description';
                        file['department_id'] = this.departmentId;
                        file['created_at'] = currentDateTime;
                        file['updated_at'] = currentDateTime;
                        delete file['client'];
                        delete file['isWriteable'];
                        delete file['id'];
                        delete file['container'];
                        delete file['key'];
                        return file;
                    });
                    FileService.AddFiles(fileArray).then(response => {
                        this.files = _.concat(this.files, fileArray);
                    }).catch(err => {
                        toastr.error('Files not uploaded!');
                    }).bind(this);
                })
            }
        },

        watch: {
            files() {
                this.$nextTick(() => {
                    $('.mix-grid').mixitup();
                });
            }
        }

    }
</script>
