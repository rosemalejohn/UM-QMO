<template>
	<div class="row">
		<div class="col-md-6">
			<form @submit.prevent="changePassword()">
				<div class="form-group">
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

				<button type="submit" class="btn btn-success">Change password</button>
			</form>
		</div>
	</div>
</template>

<script>
	import User from './../../api/user'
	import toastr from 'toastr'

	export default {

		name: 'change-password-form',
		
		data() {
			return {
				user: {},
				errors: []
			}
		},

		methods: {
			changePassword() {
				User.UpdatePassword(this.user).then(response => {
					toastr.success('Password updated!');
				}).catch(err => {
					toastr.error('Password not updated!');
				})
			}
		}
	}
</script>