<template>
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption font-purple-plum">
				<slot name="title"></slot>
			</div>
			<slot name="tools"></slot>
		</div>
		<div class="portlet-body">
			<main><slot></slot></main>
		</div>
	</div>
</template>

<script>
	export default {

		props: {
			color: {
				type: String,
				required: false,
				default: 'grey-cascade'
			}
		}

	}
</script>