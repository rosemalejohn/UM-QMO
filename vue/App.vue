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

<style lang="sass">
	.fade-enter-active, .fade-leave-active {
	  transition: opacity .5s ease;
	}
	.fade-enter, .fade-leave-active {
	  opacity: 0
	}
	.child-view {
	  transition: all .5s cubic-bezier(.55,0,.1,1);
	}
	.slide-left-enter, .slide-right-leave-active {
	  opacity: 0;
	  -webkit-transform: translate(30px, 0);
	  transform: translate(30px, 0);
	}
	.slide-left-leave-active, .slide-right-enter {
	  opacity: 0;
	  -webkit-transform: translate(-30px, 0);
	  transform: translate(-30px, 0);
	}
</style>

<script>
	import AppHeader from './components/Header.vue'
	import AppSidebar from './components/Sidebar.vue'
	import AppFooter from './components/Footer.vue'
	import AppContent from './components/Content.vue'
	import User from './api/user'

	export default {
		components: {
			AppHeader, AppSidebar, AppContent, AppFooter
		},

		data() {

			return {
				auth_user: {}
			}
		},

		// beforeRouteEnter(to, from, next) {
  //           if (Boolean(localStorage.getItem('is_admin') == 'true')) {
  //           	next(true)
  //           }
  //           next(false);
  //       },

		mounted() {
			var self = this;
			User.GetAuthenticatedUser().then(response => {
				localStorage.setItem('is_admin', response.data.is_admin);
				this.$root.auth_user = response.data;
			})
		}
	}
</script>