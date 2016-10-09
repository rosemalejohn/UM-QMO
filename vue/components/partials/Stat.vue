<template>
	<div class="dashboard-stat" :class="color">
		<div class="visual">
			<i class="fa fa-dashboard" :class="icon"></i>
		</div>
		<div class="details">
			<div class="number">
				{{ stat }}
			</div>
			<div class="desc">
				{{ description }}
			</div>
		</div>
		<a class="more" :href="url">
			View more 
			<i class="m-icon-swapright m-icon-white"></i>
		</a>
	</div>
</template>

<script>
	export default {
		props: {
			url: {
				type: String,
				required: true
			},
			description: {
				type: String,
				required: true
			},
			stat: {
				type: String,
				required: true
			},
			icon: {
				type: String,
				required: true
			},
			color: {
				type: String,
				required: true
			}
		}
	}
</script>