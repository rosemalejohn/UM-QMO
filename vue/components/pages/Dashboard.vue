<template>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
			<stat color="blue-madison" icon="fa fa-briefcase" description="Files uploaded" stat="541" url="#/files"></stat>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<stat color="red-intense" icon="fa fa-users" description="User registered" stat="100" url="#/files"></stat>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<stat color="green-haze" icon="fa fa-dashboard" description="Todays activity" stat="12" url="#/files"></stat>
		</div>
	</div>
</template>

<script>
	import Stat from './../partials/Stat.vue'

	export default {
		components: {
			Stat
		}
	}
</script>