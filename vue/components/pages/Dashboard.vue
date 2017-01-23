<template>
<div>
	<div class="row" v-if="is_admin">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 margin-bottom-10">
			<stat color="blue-madison" icon="fa fa-briefcase" description="Files uploaded" :stat="files" url="files"></stat>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<stat color="red-intense" icon="fa fa-users" description="User registered" :stat="users" url="accounts"></stat>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<stat color="green-haze" icon="fa fa-dashboard" description="Departments" :stat="departments" url="departments"></stat>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<stat color="purple-soft" icon="fa fa-sticky-note-o" description="Memos" :stat="memos" url="memos"></stat>
		</div>
	</div>
	<dashboard-calendar></dashboard-calendar>
</div>
</template>
<style type="text/css">
	img.media-object{
		width: 30px;
		border-radius: 50%;
	}

</style>

<script>
	import Authorize from './../../services/authorize'
	import Stat from './../partials/Stat.vue'
	import DashboardCalendar from './../partials/DashboardCalendar.vue'
	import StatService from './../../api/stat'

	export default {

		name: 'dashboard',

		components: {
			'stat': Stat,
			'dashboard-calendar': DashboardCalendar
		},

		beforeRouteEnter(to, from, next) {
			if (!Authorize.isAdmin()) {
				next('/memos')
			}
			next(vm => {
				StatService.GetTotalFilesUploaded().then(response => {
					vm.files = response.data;
				})

				StatService.GetTotalUsers().then(response => {
					vm.users = response.data;
				})

				StatService.GetTotalDepartments().then(response => {
					vm.departments = response.data;
				})

				StatService.GetTotalMemos().then(response => {
					vm.memos = response.data;
				})
			})
		},

		data() {
			return {
				files: 0,
				users: 0,
				departments: 0,
				memos: 0
			}
		},

		computed: {
			is_admin() {
				var auth = JSON.parse(cookie.get('auth'))
				return auth.is_admin;
			}
		}
	}
</script>