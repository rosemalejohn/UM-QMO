<template>
	<div class="mix-inner">
        <img class="img-responsive" :src="file.url || '/img/default-photo.jpg'" :alt="file.filename">
        <div class="mix-details">
            <h4>{{ file.filename }}</h4>
            <a v-on:click="view(file)" class="mix-link">
            	<i class="fa fa-search"></i>
            </a>
            <a v-if="authorized" v-on:click="remove" class="mix-preview fancybox-button" title="Project Name" data-rel="fancybox-button">
            	<i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</template>

<style lang="sass">
    .mix-details {
        h4 {
            text-overflow: ellipsis;
            overflow: hidden;
            height: 19px;
        }
    }
</style>

<script>
    import File from './../../api/file'
    import toastr from 'toastr'
    import swal from 'sweetalert'

	export default {

        name: 'file',

		props: {
			file: {
				type: Object,
				required: true
			}
		},
        
        methods: {
            remove() {
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
                    File.Delete(this.file).then(response => {
                        swal("Deleted!", `${this.file.filename} deleted!.`, "success");
                        this.$emit('remove', this.file);
                    })
                }); 
            },

            view(file) {
                router.push({name: 'File viewer', params: { file }})
            }
        },

        computed: {
            authorized() {
                let user = JSON.parse(cookie.get('auth'))
                if (user && (this.file.user_id == user.id || user.is_admin)) {
                    return true;
                }
                return false;
            }
        },

        watch: {
            file() {
                this.$nextTick(() => {
                    $('a.attachment').fancybox();
                })
            }
        }

	}
</script>