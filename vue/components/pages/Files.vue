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
                                <div class="input-group ">
                                    <input v-model="searchData.searchText" v-show="searchData.searchType != 'DATE'" type="text" placeholder="Search files..." class="form-control" style="width:70%" name="searchText">
                                    <input v-model="searchData.searchDate" v-show="searchData.searchType == 'DATE'" type="date" class="form-control" style="width:70%" name="searchDate">
                                    <select id="lunch" class="selectpicker form-control"
                                        v-model="searchData.searchType"
                                        style="width:30%"
                                        data-live-search="true" title="Please select a lunch ...">
                                        <option value="FILENAME">File name</option>
                                        <option value="FOLDER">Folder name</option>
                                        <option value="DATE">Date</option>
                                    </select> 
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            Search &nbsp; <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"
                                            title="Clear Search" v-on:click="clearSearch()">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </span>
                                </div>
                                    
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane active" id="files">
                        <div class="margin-top-10">
                            <ul class="mix-filter">
                                <li @click="uploadResources()">
                                    <i class="fa fa-file"></i>
                                    Add resources
                                </li>
                                <li class="filter" data-filter="all">
                                     All
                                </li>
                            </ul>
                            <div class="row mix-grid">
                                <div class="col-md-12">
                                    <div class="tiles">
                                        <folder v-for="folder in categories" :folder="folder"></folder>
                                    </div>
                                </div>
                            </div>
                            <div class="row mix-grid">
                                <div v-for="file in search_files" class="col-md-3 col-sm-4 mix" style="opacity: 1;display: block;">
                                    <file :file="file"></file>
                                </div>
                            </div>
                            <div v-if="noFiles" class="note note-info note-bordered">
                                <p>No files uploaded yet. Click <strong>add</strong> above.</p>
                            </div>

                            <infinite-scroll :paginator="paginator" @fetched="pulledCategories"></infinite-scroll>
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
    import Folder from './../partials/Folder.vue'
    import File from './../partials/File.vue'
    import InfiniteScroll from './../partials/InfiniteScroll.vue'
    import Category from './../../api/category'
    import FileService from './../../api/file'
    import toastr from 'toastr'
    import _ from 'lodash'
    import User from './../../api/user'
    import Cookie from 'js-cookie'
    import moment from 'moment'

    export default {

        name: 'files',

        components: {
            'folder': Folder,
            'file': File,
            'infinite-scroll': InfiniteScroll
        },

        data() {
            return {
                paginator: {},
                categories: [],
                search_files: [],
                searchData: {
                    searchText:'',
                    searchDate: null,
                    searchType:'FILENAME',
                }
            }
        },

        computed: {

            noFiles() {
                return this.categories.length < 1 && this.search_files.length < 1;
            }

        },

        beforeRouteEnter(to, from, next) {
            Category.GetAll().then(response => {
                next(vm => {
                    vm.paginator = response.data
                    vm.categories = vm.paginator.data
                })
            }).catch(err => {
                toastr.error('Cannot fetch files.')
            })
        },

        methods: {
            search() {
                FileService.PowerSearch(this.searchData).then(response => {
                    this.categories = response.data.folders;
                    this.search_files = response.data.files;
                })
            },
            clearSearch() {
                this.categories = [];
                this.search_files = [];
                this.searchData.searchText = '';
                this.searchData.searchDate =  null;
                this.searchData.searchType = 'FILENAME';

                Category.GetAll().then(response => {
                    this.paginator = response.data
                    this.categories = this.paginator.data
                }).catch(err => {
                    toastr.error('Cannot fetch files.')
                })
            },

            uploadResources() {
                router.push({ name: 'Upload resources' })
            },

            pulledCategories(paginator) {
                this.paginator = paginator
                paginator.data.forEach(category => {
                    this.categories.push(category)
                })
            }
        },

    }
</script>
