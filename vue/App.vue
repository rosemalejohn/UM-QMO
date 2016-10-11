<template>
	<div>
		<app-header></app-header>

        <div class="clearfix"></div>

        <div class="container">
        
            <div class="page-container">

                <app-sidebar></app-sidebar>

                <app-content></app-content>

            </div>

            <app-footer></app-footer>
        </div>
	</div>
</template>

<script>
	import AppHeader from './components/Header.vue'
	import AppSidebar from './components/Sidebar.vue'
	import AppFooter from './components/Footer.vue'
	import AppContent from './components/Content.vue'

	export default {
		components: {
			AppHeader, AppSidebar, AppContent, AppFooter
		}
	}
</script>