<template>
	<form @submit.prevent="submit()">
		<div class="row">
			<div class="col-md-12">
				<div class="profile-sidebar" style="width:250px;">
					<div class="portlet light profile-sidebar-portlet">

						<div class="profile-userpic">
							<img :src="user.photo_url || '/img/default-photo.jpg'" class="img-responsive" alt="Profile photo">
						</div>
						<div class="profile-usertitle">
							<div class="profile-usertitle-name">
								 {{ user.name }}
							</div>
							<div class="profile-usertitle-job">
								 {{ user.position }}
							</div>
						</div>
						<div class="profile-userbuttons">
							<button @click="uploadPhoto()" type="button" class="btn btn-circle green-haze btn-sm">Upload photo</button>
						</div>
					</div>
				</div>

				<div class="profile-content">
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light">
								<div class="portlet-title tabbable-line">
									<div class="caption caption-md">
										<i class="icon-globe theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
									</div>
									<ul class="nav nav-tabs">
										<li class="active">
											<a href="#personal-info" data-toggle="tab">Personal Info</a>
										</li>
										<li>
											<a href="#account-info" data-toggle="tab">Account Info</a>
										</li>
									</ul>
								</div>
								<div class="portlet-body">
									<div class="tab-content">
										<div class="tab-pane active" id="personal-info">
											<div class="form-group">
												<label class="control-label">Name</label>
												<input v-model="user.name" type="text" placeholder="John" class="form-control" />
												<span v-for="error in errors['name']" class="error">
													{{ error }}
												</span>
											</div>
											<div class="form-group">
												<label class="control-label">ID No.</label>
												<input v-model="user.id_number" type="text" class="form-control" required />
												<span v-for="error in errors['id_number']" class="error">
													{{ error }}
												</span>
											</div>
											<div class="form-group">
												<label class="control-label">Gender</label>
												<div class="radio-list">
													<label class="radio-inline">
													<input v-model="user.gender" type="radio" name="optionsRadios" value="male" required> Male</label>
													<label class="radio-inline">
													<input v-model="user.gender" type="radio" name="optionsRadios" value="female" required> Female </label>
												</div>
												<span v-for="error in errors['gender']" class="error">
													{{ error }}
												</span>
											</div>
											<div class="form-group">
												<label class="control-label">Position</label>
												<input v-model="user.position" type="text" placeholder="Web Developer" class="form-control" required/>
												<span v-for="error in errors['position']" class="error">
													{{ error }}
												</span>
											</div>
											<div class="form-group">
												<label class="control-label">Department</label>
												<select v-model="user.department_id" class="form-control" required>
													<option value="">Select department</option>
													<option :value="department.id" v-for="department in departments">{{ department.name }}</option>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Account type</label>
												<select v-model="user.type" class="form-control" required>
													<option>Select account type</option>
													<option value="faculty">Faculty</option>
													<option value="staff">Staff</option>
													<option value="standard">Standard</option>
												</select>
												<span v-for="error in errors['type']" class="error">
													{{ error }}
												</span>
											</div>
										</div>

										<div class="tab-pane" id="account-info">
											<div class="form-group">
												<label class="control-label">Email</label>
												<input v-model="user.email" type="email" class="form-control" required/>
												<span v-for="error in errors['email']" class="error">
													{{ error }}
												</span>
											</div>
											<div v-if="isUpdate" class="form-group">
												<label class="control-label">Current Password</label>
												<input v-model="user.current_password" type="password" class="form-control"/>
											</div>
											<div class="form-group">
												<label class="control-label">New Password</label>
												<input v-model="user.password" type="password" class="form-control"/>
												<span v-for="error in errors['password']" class="error">
													{{ error }}
												</span>
											</div>
											<div class="form-group">
												<label class="control-label">Re-type New Password</label>
												<input v-model="user.password_confirmation" type="password" class="form-control"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-success">{{ isUpdate ? 'Update account' : 'Save account' }}</button>
							<button type="button" class="btn btn-default">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</template>

<style lang="sass">
	.error {
		color: red;
	}
</style>

<script>
	import User from './../../api/user'
	import toastr from 'toastr'
	import Department from './../../api/department'

	export default {

		data() {
			return {
				user: {},
				departments: [],
				errors: [],
				isUpdate: false
			}
		},

		created() {
			this.fetchDepartments();
		},

		beforeRouteEnter(to, from, next) {
			let { params: { userId } } = to;
            if (userId) {
            	next(vm => {
            		vm.isUpdate = true;
            		User.Get(userId).then(response => {
            			vm.user = response.data;
            		})
            	})
            }
            next(vm => {
            	vm.user = {};
            });
        },

		methods: {

			submit() {
				if (!this.isUpdate) {
					User.AddUser(this.user).then(response => {
						this.user = {};
						toastr.success('User added!');
					}).catch(err => {
						this.errors = err.data;
						toastr.error('User not added!');
					})
				} else {
					User.UpdateUser(this.user).then(response => {
						toastr.success('User updated!');
					})
				}
			},

			uploadPhoto() {
				filepicker.pick(blob => {
					this.user.photo_url = blob.url;
				});
			},

			fetchDepartments() {
				Department.GetAll().then(response => {
					this.departments = response.data;
				})
			}

		}

	}
</script>