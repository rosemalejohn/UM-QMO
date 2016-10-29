<template>
	<div @click="open()" class="tile bg-blue-steel">
		<div class="tile-body">
			<i class="fa fa-folder-open-o"></i>
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

<script>
	export default {
		props: {
			folder: {
				type: Object,
				required: true
			}
		},

		methods: {
			open() {
				router.push({ name: 'Show category', params: { categoryId: this.folder.id } })
			}
		}
	}
</script>