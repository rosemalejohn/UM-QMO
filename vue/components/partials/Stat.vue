<template>
	<div class="dashboard-stat" :class="color">
		<div class="visual">
			<i :class="icon"></i>
		</div>
		<div class="details">
			<div class="number">
				{{ stat }}
			</div>
			<div class="desc">
				{{ description }}
			</div>
		</div>
		<router-link class="more" :to="{ path: url }">
			View more 
			<i class="m-icon-swapright m-icon-white"></i>
		</router-link>
	</div>
</template>

<script>
	export default {

		name: 'stat',

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
				type: Number,
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