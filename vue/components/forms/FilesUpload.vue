<template>
	<form @submit.prevent="submit" class="form-horizontal form-bordered">
		<div class="form-group" v-bind:class="{ 'has-error': form_errors.name }">
			<label class="col-sm-3 control-label">Title</label>
			<div class="col-sm-7">
				<input type="text" v-model="category.name" class="form-control"/>
				<div class="help-block" v-if="form_errors.name">{{form_errors.name[0]}}</div>
			</div>
		</div>
		<div class="form-group" v-bind:class="{ 'has-error': form_errors.body }">
			<label class="col-sm-3 control-label">Body</label>
			<div class="col-sm-7">
				<textarea v-model="category.description" class="form-control" rows="3"></textarea>
                <div class="help-block" v-if="form_errors.description">{{form_errors.description[0]}}</div>
			</div>
		</div>

		<div class="form-group" v-bind:class="{ 'has-error': form_errors.body }">
			<label class="col-sm-3 control-label">Department</label>
			<div class="col-sm-7">
				<select class="form-control" required="required" v-model="category.department_id" >
					<option v-for="department in departments" v-bind:value="department.id">
						{{department.name}}
					</option>
				</select>
                <div class="help-block" v-if="form_errors.department_id">{{form_errors.department_id[0]}}</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div class="col-sm-7">
				<upload-files title="Add files" @uploaded="uploaded"></upload-files>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div class="col-sm-7">
				<table class="files">
					<tbody>
						<tr v-for="file in category.fileArray">
							<td>
								<img class="img-responsive" :src="file.url" />
							</td>
							<td>{{ file.filename }}</td>
							<td>{{ file.size }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn red"><i class="fa fa-check"></i> Submit</button>
					<button @click="cancel" type="button" class="btn default">Cancel</button>
				</div>
			</div>
		</div>
	</form>
</template>

<style lang="sass">
	.files {
		img {
			width: 100px !important;
		}
	}
</style>

<script>
	import UploadFiles from './../partials/UploadFiles.vue'
	import Category from './../../api/category'
	import toastr from 'toastr'
	import Deparment from './../../api/department'

	export default {

		components: {
			'upload-files': UploadFiles
		},

		created(){

			Deparment.GetAll().then(response =>{
				this.departments = response.data;
			});

		},

		data() {
			return {
				category: {
					fileArray: []
				},
				departments: [],
				form_errors: []
			}
		},

		methods: {
			cancel() {
				window.history.back();
			},

			submit() {
				Category.Add(this.category).then(response => {
					toastr.success('Resources saved!')
					this.category = {}
				}).catch(err => {
					this.form_errors = err.data
				})
			},

			uploaded(files) {
				this.category.fileArray = files;
			}
		}

	}
</script>