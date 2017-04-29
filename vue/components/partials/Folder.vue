<template>
	<!-- <div @click="open()" class="tile" :class="color">
		<div class="tile-body">
			<i class="fa fa-folder-o"></i>
		</div>
		<div class="tile-object">
			<div class="name">
				{{ folder.name }}
			</div>
			<div class="number">
				{{ folder.files_count }}
			</div>

			<small v-if="folder.department">
				<i class="text-muted">{{folder.department.name}}</i>
			</small>
		</div>
	</div> -->
	<div class="dashboard-stat blue-madison clickable" @click="open()">
		<div class="visual">
			<i class="fa fa-folder-o"></i>
		</div>
		<div class="details">
			<div class="number">
				{{ folder.files_count }}
			</div>
			<div class="desc">
				{{ folder.name }}
			</div>
		</div>
		<small class="more" >
			<span v-if="folder.department">{{folder.department.name}}</span>
			<span v-else> <i>-- NO DEPARTMENT --</i> </span>
		</small>
	</div>
</template>

<style lang="sass">
	.tile:hover i:before {
		content: "\f115"
	}
	.clickable{
		cursor:pointer;
	}
</style>

<script>
	export default {
		props: {
			folder: {
				type: Object,
				required: true
			},
			color: {
				type: String,
				required: false,
				default: 'bg-blue-steel'
			}
		},

		methods: {
			open() {
				router.push({ name: 'Show category', params: { categoryId: this.folder.id } })
			}
		}
	}
</script>