<template>
	<div class="row">
		<div class="col-md-12">
			<portlet>
				<span slot="title">Departments</span>
				<div slot="tools" class="tools">
					<div class="actions">
						<a href="#/departments/new" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-plus"></i>Add
						</a>
						<button v-if="checked.length == 1" class="btn btn-circle btn-sm">
							<i class="fa fa-edit"></i>Edit
						</button>
						<button @click="removeDepartments()" class="btn btn-circle btn-sm red-sunglo">
							<i class="fa fa-remove"></i>Delete
						</button>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="table-checkbox">
								<input type="checkbox" class="group-checkable"/>
							</th>
							<th>
								Name
							</th>
							<th>
								Files
							</th>
							<th>
								Users
							</th>
							<th>
								Date added
							</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="department in departments" class="odd gradeX">
							<td width="5%">
								<input type="checkbox" class="checkboxes" :value="department.id"/>
							</td>
							<td>
								{{ department.name }}
							</td>
							<td>
								{{ department.file_count }}
							</td>
							<td>
								{{ department.user_count }}
							</td>
							<td class="center">
								{{ department.created_at }}
							</td>
						</tr>
					</tbody>
				</table>
			</portlet>
		</div>
	</div>
</template>

<script>
	import Portlet from './../partials/Portlet.vue'
	import Department from './../../api/department'
	import toastr from 'toastr'

	export default {
		components: {
			Portlet
		},

		created() {

			this.fetchDepartments();

		},

		methods: {

			fetchDepartments() {
				Department.GetAll().then(response => {
					this.departments = response.data;
				}).catch(err => {
					toastr.error('Cannot fetch departments.');
				})
			},

			removeDepartments() {
				swal({   
                    title: "Are you sure?",   
                    text: "This departments will be deleted!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true 
                }, () => {
                    Department.DeleteMultiple(this.checked).then(response => {
                    	this.departments = _.reject(this.departments, department => {
                    		return _.contains(this.checked, department.id.toString());
                    	})
                    	this.checked = [];
                    	toastr.success('Departments deleted!')
                    });
                });
			},
			
		},

		data() {
			return {
				checked: [],
				departments: []
			}
		}
	}
</script>