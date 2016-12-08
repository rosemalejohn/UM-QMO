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
	import Breadcrumbs from './Breadcrumbs.vue'
  import moment from 'moment'
  import Vue from 'vue'
  import User from './../api/user'

	export default {

    name: 'app-content',

		components: {
			'breadcrumbs': Breadcrumbs
		},

    created() {
      User.GetAuthenticatedUser().then(response => {
          cookie.set('auth', response.data);
      })
    }
	}

  Vue.filter('date', (value, format) => {
    return moment(value).format(format)
  })
</script> 