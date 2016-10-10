<template>
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
								</ul>
							</div>
							<div class="portlet-body">
								<div class="tab-content">
									<div class="tab-pane active" id="personal-info">
										<div class="form-group">
											<label class="control-label">Name</label>
											<input v-model="user.name" type="text" placeholder="John" class="form-control" required />
										</div>
										<div class="form-group">
											<label class="control-label">ID No.</label>
											<input v-model="user.id_number" type="text" class="form-control" required />
										</div>
										<div class="form-group">
											<label class="control-label">Gender</label>
											<div class="radio-list">
												<label class="radio-inline">
												<input v-model="user.gender" type="radio" name="optionsRadios" value="male" required> Male</label>
												<label class="radio-inline">
												<input v-model="user.gender" type="radio" name="optionsRadios" value="female" required> Female </label>
											</div>

										</div>
										<div class="form-group">
											<label class="control-label">Position</label>
											<input v-model="user.position" type="text" placeholder="Web Developer" class="form-control" required/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="sass">
	.profile-sidebar-portlet {
		padding-bottom: 30px !important;
	}
</style>

<script>
	import User from './../../api/user'
	import toastr from 'toastr'

	export default {

		created() {
			this.getUser();
		},

		data() {
			return {
				user: {}
			}
		},

		methods: {
			getUser() {
				let { userId } = this.$route.params;
				User.Get(userId).then(response => {
					this.user = response.data;
				}).catch(err => {
					toastr.error('User not fetched!');
				})
			}
		}

	}
</script>