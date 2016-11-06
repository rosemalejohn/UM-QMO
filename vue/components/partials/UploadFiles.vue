<template>
	<button type="button" @click="upload" class="btn btn-info">{{ title }}</button>
</template>

<script>
	import FileService from './../../api/file'
	import moment from 'moment'
	import Cookie from 'js-cookie'
	
	export default {

		name: 'upload-files',

		props: {
			title: {
				type: String,
				default: 'Upload',
				required: false
			}
		},

		data() {
			return {
				files: []
			}
		},

		methods: {
			upload() {
				filepicker.pickMultiple({
                    imageQuality: 80
                }, fileArray => { 
                    fileArray = _.map(fileArray, (file) => {
                        var currentDateTime = moment().format('YYYY-MM-DD HH:mm:ss');
                        file['user_id'] = JSON.parse(cookie.get('auth')).id;
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

                    this.$emit('uploaded', fileArray)
                })
			}
		}

	}
</script>