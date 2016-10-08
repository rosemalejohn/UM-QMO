<template>
	<div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="page-title">Dashboard</h3>

            <breadcrumbs></breadcrumbs>

            <transition>
            	<router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
	import Breadcrumbs from './Breadcrumbs.vue'

	export default {
		components: {
			Breadcrumbs
		}
	}
</script> 