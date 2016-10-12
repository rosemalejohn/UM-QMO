<template>
	<div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="page-title">{{ $route.name }}</h3>

            <breadcrumbs></breadcrumbs>

            <transition>
                <keep-alive>
            	   <router-view></router-view>
                </keep-alive>
            </transition>
        </div>
    </div>
</template>

<script>
	import Breadcrumbs from './Breadcrumbs.vue'

	export default {
		components: {
			Breadcrumbs
		},
	}
</script> 