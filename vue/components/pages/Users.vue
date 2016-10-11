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
				<table v-if="users.length" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="table-checkbox">
								<input type="checkbox" class="group-checkable"/>
							</th>
							<th></th>
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
						<tr class="odd gradeX" v-for="user in users">
							<td>
								<input v-model="checked" type="checkbox" class="checkboxes" :value="user.id"/>
							</td>
							<td><img class="user-pic" :src="user.photo_url || '/img/default-photo.jpg'" /></td>
							<td>
								<router-link :to="{ name: 'Show account', params: { userId: user.id }}">{{ user.name }}</router-link>
							</td>
							<td>
								{{ user.id_number }}
							</td>
							<td>
								<a :href="'mailto:' + user.email">{{ user.email }}</a>
							</td>
							<td class="center">
								{{ user.gender }}
							</td>
							<td>
								{{ user.position }}
							</td>
							<td>
								{{ user.department ? user.department.name : ''  }}
							</td>
							<td>{{ user.type }}</td>
						</tr>
					</tbody>
				</table>
				<div v-else class="note note-info note-bordered">
	                <p>No users on this site. Click <strong>upload</strong> above.</p>
	            </div>
			</portlet>
		</div>
	</div>
</template>

<style lang="sass">
	.user-pic {
		height: 30px;
	}
</style>

<script>
	import Portlet from './../partials/Portlet.vue'
	import swal from 'sweetalert'
	import User from './../../api/user'
	import toastr from 'toastr'
	import swal from 'sweetalert'

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
                    	swal("Deleted!", "Users deleted!.", "success");
                    	this.users = _.reject(this.users, user => {
                    		return this.checked.indexOf(user.id) > -1;
                    	})
                    	this.checked = [];
                    	toastr.success('Users deleted!')
                    });
                });
			}
		}

	}
</script>