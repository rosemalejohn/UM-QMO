<template>
	<div class="row">
		<div class="col-md-12">
			<portlet>
				<span slot="title">Accounts</span>
				<div slot="tools" class="tools">
					<div class="actions">
						<a href="#/accounts/new" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-plus"></i>Add
						</a>
						<router-link 
							class="btn btn-circle btn-default btn-sm" 
							v-if="checked.length == 1" 
							:to="{name: 'Edit account', params: {userId: user}}">
							<i class="fa fa-edit"></i>Edit
						</router-link>

						<button v-if="checked.length > 0" @click="removeAccounts()" class="btn btn-circle btn-sm red-sunglo">
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
								ID No.
							</th>
							<th>
								Email
							</th>
							<th>
								Gender
							</th>
							<th>
								Position
							</th>
							<th>
								Department
							</th>
							<th>Account type</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<td>
								<input v-model="checked" type="checkbox" class="checkboxes" value="123"/>
							</td>
							<td>
								<router-link :to="{ name: 'Show account', params: { userId: 123 }}">Rosemale-John</router-link>
							</td>
							<td>
								234672
							</td>
							<td>
								<a href="mailto:shuxer@gmail.com">
								rosemalejohn@gmail.com </a>
							</td>
							<td class="center">
								Male
							</td>
							<td>
								Senior Web Developer
							</td>
							<td>
								Web Team
							</td>
							<td>Admin</td>
						</tr>
					</tbody>
				</table>
			</portlet>
		</div>
	</div>
</template>

<script>
	import Portlet from './../partials/Portlet.vue'
	import swal from 'sweetalert'
	import User from './../../api/user'
	import toastr from 'toastr'

	export default {

		components: {
			Portlet
		},

		created() {

			this.fetchUsers();

		},

		data() {
			return {
				checked: [],
				users: [],
				loading: false
			}
		},

		computed: {

			user() {
				return this.checked.length == 1 ? this.checked[0] : null
			}

		},

		methods: {

			fetchUsers() {
				User.GetAll().then(response => {
					this.users = response.data;
				}).catch(err => {
					toastr.error('Cannot fetch users.');
				})
			},

			removeAccounts() {
				swal({   
                    title: "Are you sure?",   
                    text: "This user will be deleted!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true 
                }, () => {
                    User.DeleteMultiple(this.checked).then(response => {
                    	this.users = _.reject(this.users, user => {
                    		return _.contains(this.checked, user.id.toString());
                    	})
                    	this.checked = [];
                    	toastr.success('Users deleted!')
                    });
                });
			}
		},

	}
</script>