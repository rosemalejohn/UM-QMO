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

		data() {
			return {
				isLoading: false
			}
		},

		mounted() {

			window.onscroll = (ev) => {
				if (this.isLoading) {
					return;
				}
				var self = this
				let { next_page_url } = self.paginator

				if (!next_page_url) {
					return;
				}

				if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 1000)) {
					this.isLoading = true
					self.$http.get(next_page_url).then(response => {
						this.isLoading = false
						self.$emit('fetched', response.data)
					})
				}
			}

		}

	}
</script>