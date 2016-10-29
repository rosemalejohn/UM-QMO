<template>
	<div></div>
</template>

<script>

	export default {

		props: {

			paginator: {
				type: Object,
				required: true,
				twoWay: true
			}

		},

		mounted() {

			window.onscroll = (ev) => {
				var self = this
				let { next_page_url } = self.paginator

				if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 1000) {
					self.$http.get(next_page_url).then(response => {
						self.$emit('fetched', response.data)
					})
				}
			}

		}

	}
</script>