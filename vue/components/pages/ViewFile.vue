<template>
	<div v-if="file" class="row">
		<div class="col-md-6">
			<img class="img-responsive" :src="file.url" />
		</div>
		<div class="col-md-6">
			<p><strong>File name: </strong> <span>{{ file.filename }}</span></p>
			<p><strong>Size: </strong> <span>{{ file.size }} kb</span></p>
			<p><strong>Date uploaded: </strong> <span>{{ file.created_at }}</span></p>
			<a class="btn btn-info" :href="file.url" download>Download</a>
		</div>
	</div>
</template>

<script>
	export default {

		data() {
			return {
				file: {}
			}
		},

		beforeRouteEnter(to, from, next) {
			if (to.params.file) {
				next(vm => {
					vm.file = to.params.file
				})
			}
			
			next(false)
		},
		
	}
</script>