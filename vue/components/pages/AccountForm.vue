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
												<input v-model="user.name" type="text" placeholder="John" class="form-control"/>
											</div>
											<div class="form-group">
												<label class="control-label">ID No.</label>
												<input v-model="user.id_number" type="text" placeholder="+1 646 580 DEMO (6284)" class="form-control"/>
											</div>
											<div class="form-group">
												<label class="control-label">Gender</label>
												<div class="radio-list">
													<label class="radio-inline">
													<input v-model="user.gender" type="radio" name="optionsRadios" id="optionsRadios4" value="option1"> Male</label>
													<label class="radio-inline">
													<input v-model="user.gender" type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> Female </label>
												</div>

											</div>
											<div class="form-group">
												<label class="control-label">Position</label>
												<input v-model="user.position" type="text" placeholder="Web Developer" class="form-control"/>
											</div>
											<div class="form-group">
												<label class="control-label">Department</label>
												<select v-model="user.department_id" class="form-control">
													<option>Option 1</option>
													<option>Option 2</option>
												</select>
											</div>
										</div>

										<div class="tab-pane" id="account-info">
											<div class="form-group">
												<label class="control-label">Email</label>
												<input v-model="user.email" type="email" class="form-control"/>
											</div>
											<div class="form-group">
												<label class="control-label">Current Password</label>
												<input v-model="user.current_password" type="password" class="form-control"/>
											</div>
											<div class="form-group">
												<label class="control-label">New Password</label>
												<input v-model="user.password" type="password" class="form-control"/>
											</div>
											<div class="form-group">
												<label class="control-label">Re-type New Password</label>
												<input v-model="user.password_confirmation" type="password" class="form-control"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-success">Save account</button>
							<button type="submit" class="btn btn-default">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</template>

<script>
	import filepicker from 'filepicker-js'

	export default {

		data() {
			return {
				user: {
					photo_url: '',
					name: '',
					position: ''
				}
			}
		},

		methods: {

			submit() {
				alert('form Submitted!');
			},

			uploadPhoto() {
				filepicker.setKey('ABS0djxh1RMqDHluoiy0Kz');
				filepicker.pick(blob => {
					this.user.photo_url = blob.url;
				});
			}

		}

	}
</script>