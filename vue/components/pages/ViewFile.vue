<template>
	<div v-if="file" class="row">
		<div class="col-md-6">
			<img class="img-responsive" :src="file.url" />
		</div>
		<div class="col-md-6">
			<form v-if="showForm" @submit.prevent="update" class="form-inline">
				<input class="form-control" type="text" v-model="file.filename" />
				<button type="submit" class="btn btn-info">Save</button>
			</form>
			<p><strong>File name: </strong> <span>{{ file.filename }}</span></p>
			<p><strong>Size: </strong> <span>{{ file.size }} kb</span></p>
			<p><strong>Date uploaded: </strong> <span>{{ file.created_at }}</span></p>
			<button @click="showForm = true" class="btn btn-info">Edit</button>
			<a class="btn btn-info" :href="file.url" download>Download</a>
		</div>
	</div>
</template>

<script>
	import File from './../../api/file'
	import toastr from 'toastr'

	export default {

		data() {
			return {
				file: {},
				showForm: false
			}
		},

		beforeRouteEnter(to, from, next) {
			if (to.params.file) {
				next(vm => {
					vm.file = to.params.file
				})
			}
			next(false)
		},

		methods: {

			update() {
				File.Update(this.file).then(response => {
					toastr.success('File updated!')
					this.showForm = !this.showForm
				})
			}

		}
		
	}
</script>