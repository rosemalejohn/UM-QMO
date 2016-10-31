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
            'infinite-scroll': InfiniteScroll
        },

        data() {
            return {
                paginator: {},
                categories: [],
                searchText: ''
            }
        },

        computed: {

            noFiles() {
                return this.categories.length < 1;
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
                FileService.Search(this.searchText).then(response => {
                    this.files = response.data;
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
