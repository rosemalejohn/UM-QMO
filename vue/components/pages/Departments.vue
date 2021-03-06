<template>
	<div class="row">
		<div class="col-md-12" v-if="showDepartmentForm">
			<portlet>
				<span slot="title">Add department</span>
				<department-form @submit="newDepartment" @cancel="showDepartmentForm = false" :is-update="isUpdate" :show.sync="showDepartmentForm" :department.sync="department"></department-form>
			</portlet>
		</div>
		<div class="col-md-12">
			<portlet>
				<span slot="title">Departments</span>
				<div slot="tools" class="tools">
					<div class="actions">
						<a @click="add()" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-plus"></i>Add
						</a>
						<button @click="editDepartment()" v-if="checked.length == 1" class="btn btn-circle btn-sm">
							<i class="fa fa-edit"></i>Edit
						</button>
						<button @click="removeDepartments()" class="btn btn-circle btn-sm red-sunglo">
							<i class="fa fa-remove"></i>Delete
						</button>
					</div>
				</div>
				<table v-if="departments.length" class="table table-striped table-bordered table-hover">
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
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="department in departments" class="odd gradeX">
							<td width="5%">
								<input v-model="checked" type="checkbox" class="checkboxes" :value="department.id"/>
							</td>
							<td>
								<router-link :to="{ name: 'Show department', params: { departmentId: department.id }}">{{ department.name }}</router-link>
							</td>
							<td>
								<router-link :to="{ name: 'Department files', params: { departmentId: department.id }}">{{ department.files_count }}</router-link>
							</td>
							<td>
								{{ department.users_count }}
							</td>
							<td class="center">
								{{ department.created_at | date('MMMM Do YYYY, h:mm:ss a') }}
							</td>
							<td>
								<router-link class="btn btn-xs btn-success" :to="{ name: 'Department files', params: { departmentId: department.id }}"><i class="fa fa-file"></i></router-link>
								<router-link class="btn btn-xs btn-success" :to="{ name: 'Show department', params: { departmentId: department.id }}"><i class="fa fa-users"></i></router-link>
							</td>
						</tr>
					</tbody>
				</table>
				<div v-else class="note note-info note-bordered">
                    <p>No departments yet. Click <strong>add</strong> above.</p>
                </div>
			</portlet>
		</div>
	</div>
</template>

<script>
	import Authorize from './../../services/authorize'
	import Portlet from './../partials/Portlet.vue'
	import Department from './../../api/department'
	import toastr from 'toastr'
	import DepartmentForm from './DepartmentForm.vue'
	import swal from 'sweetalert'

	export default {

		name: 'departments',
		
		components: {
			'portlet': Portlet, 
			'department-form': DepartmentForm
		},

		data() {
			return {
				checked: [],
				departments: [],
				department: {},
				showDepartmentForm: false,
				isUpdate: false 
			}
		},

		beforeRouteEnter(to, from, next) {
			if (!Authorize.isAdmin()) {
				next('/403')
			}
			next(vm => {
				Department.GetAll().then(response => {
					vm.departments = response.data;
				}).catch(err => {
					toastr.error('Cannot fetch departments.');
				})
			})
			
		},

		methods: {

			add() {
				this.showDepartmentForm = true;
				this.department = {}
			},

			editDepartment() {
				this.isUpdate = true;
				this.department = _.find(this.departments, (department) => { 
					return department.id == this.checked[0] 
				});
				this.showDepartmentForm = true;
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
                    	swal("Deleted!", "Department deleted!.", "success");
                    	this.departments = _.reject(this.departments, department => {
                    		return this.checked.indexOf(department.id) > -1;
                    	})
                    	this.checked = [];
                    	toastr.success('Departments deleted!')
                    });
                });
			},

			newDepartment(department) {
				this.department = {};
				this.departments.push(department);
			}
			
		},

		events: {
			departmentCreated(department) {
				this.departments.push(department);
			}
		}
	}
</script>