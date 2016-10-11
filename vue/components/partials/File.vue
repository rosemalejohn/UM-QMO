<template>
	<div class="mix-inner">
        <img class="img-responsive" :src="file.url || '/img/default-photo.jpg'" :alt="file.filename">
        <div class="mix-details">
            <h4>{{ file.filename }}</h4>
            <a class="mix-link" :href="file.url" download>
            	<i class="fa fa-download"></i>
            </a>
            <a @click="removeFile(file)" class="mix-preview fancybox-button" title="Project Name" data-rel="fancybox-button">
            	<i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</template>

<script>
    import File from './../../api/file'
    import toastr from 'toastr'
    import swal from 'sweetalert'

	export default {

		props: {
			file: {
				type: Object,
				required: true
			}
		},

        mounted() {
            
        },

        methods: {
            removeFile(file) {
                swal({
                    title: "Are you sure?",   
                    text: "This file will be deleted!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true 
                }, () => {
                    File.Delete(file).then(response => {
                        swal("Deleted!", `${file.filename} deleted!.`, "success");
                        this.$dispatch('fileDeleted', file);
                    })
                });
            }
        }

	}
</script>