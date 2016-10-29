<template>
	<div @click="open()" class="tile" :class="color">
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
		</div>
	</div>
</template>

<style lang="sass">
	.tile:hover i:before {
		content: "\f115"
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