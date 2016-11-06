<template>
	<div>
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<button type="button" class="btn btn-primary" 
						:disabled="!canGoPrev" v-on:click="prev()">
						<i class="icon-control-start"></i> 
					</button>
					<button type="button" class="btn btn-primary" 
						:disabled="!canGoNext" v-on:click="next()">
						<i class="icon-control-end"></i> 
					</button>
				</div>
			</div>
		</div>
		<hr>
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
	</div>
</template>

<script>
	import File from './../../api/file'
	import Category from './../../api/category'
	import toastr from 'toastr'

	export default {

		data() {
			return {
				file: {},
				categoryFiles: [],
				currentIndex: null,
				showForm: false
			}
		},

		beforeRouteEnter(to, from, next) {
			if (to.params.file) {
				next(vm => {
					vm.file = to.params.file
					Category.GetFiles(vm.file.pivot.category_id)
						.then(response => {
							vm.categoryFiles = response.data
						})
						.then( () => {
							vm.currentIndex = vm.categoryFiles.files.findIndex((file =>{
								return file.id === vm.file.id;
							}));
						})
						.catch(err => {
							toastr.error('Cannot fetch category files.')
						})
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
			},

			next(){
				if(this.canGoNext){
					this.currentIndex += 1
					this.file = this.categoryFiles.files[this.currentIndex]
				}
			},

			prev(){
				if(this.canGoPrev){
					this.currentIndex -= 1
					this.file = this.categoryFiles.files[this.currentIndex]
				}
			}

		},

		computed : {

			canGoPrev(){
				if(this.categoryFiles.files)
					return this.currentIndex > 0
				return false
			},

			canGoNext(){
				if(this.categoryFiles.files)
					return this.currentIndex < this.categoryFiles.files.length-1
				return false
			},

		}
		
	}
</script>