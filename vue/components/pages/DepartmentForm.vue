<template>
	<form @submit.prevent="submit()" class="form-horizontal form-bordered">
		<div class="form-group">
			<label class="col-sm-3 control-label">Department name</label>
			<div class="col-sm-7">
				<input type="text" v-model="department.name" class="form-control"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Department code</label>
			<div class="col-sm-7">
				<input type="text" v-model="department.code" class="form-control"/>
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

<script>
	import Department from './../../api/department'
	import toastr from 'toastr'

	export default {

		props: {
			show: {
				type: Boolean,
				default: false,
				twoWay: true
			},
			department: {
				type: Object,
				default() {
					return {
						name: '',
						code: ''
					}
				},
				required: false
			},
			isUpdate: {
				type: Boolean,
				default: false
			}
		},

		methods: {

			cancel() {
				this.$emit('cancel');
			},

			submit() {
				if (this.isUpdate) {
					Department.Update(this.department).then(response => {
						toastr.success('Department updated!');
					})
				} else {
					Department.Add(this.department).then(response => {
						this.$dispatch('departmentCreated', response.data);
						toastr.success('Department added!');
					}).catch(err => {
						toastr.error('You`ve got an error!');
					})	
				}
				
			}
		},
	}
</script>