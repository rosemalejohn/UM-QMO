<template>
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable tabbable-custom tabbable-noborder ">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#files" data-toggle="tab">
                        Files </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form @submit.prevent="search()" class="alert alert-danger alert-borderless">
                                <div class="input-group">
                                    <div class="input-cont">
                                        <input type="text" placeholder="Search files..." class="form-control"/>
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
                                <li class="filter" data-filter="category_1">
                                     UI Design
                                </li>
                                <li class="filter" data-filter="">
                                     Web Development
                                </li>
                            </ul>
                            <div class="row mix-grid">
                                <div class="col-md-3 col-sm-4 mix category_1">
                                    <file :file="{name: ''}"></file>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript" src="/js/portfolio.js"></script>
<script>
    import File from './../partials/File.vue'

    export default {

        components: {
            File
        },

        mounted() {
            $('.mix-grid').mixitup();
        },

        methods: {
            search(event) {
                let text = event.target.value;
            },

            uploadFiles() {
                filepicker.setKey('ABS0djxh1RMqDHluoiy0Kz');
                filepicker.pickMultiple(files => {
                    console.log(files);
                });
            }
        }

    }
</script>
