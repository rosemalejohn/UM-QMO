<template>
	<div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="page-title">{{ $route.name }}</h3>

            <breadcrumbs></breadcrumbs>

            <transition name="rotateIn">
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