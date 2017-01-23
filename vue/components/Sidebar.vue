<template>
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
		    <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
		        <li class="">
		            <router-link :to="{ path: '/' }">
						<i class="icon-home"></i>
		                <span class="title">Dashboard</span>
		                <span class="selected"></span>
		            </router-link>
		        </li> 
		        <li>
		            <router-link :to="{ path: '/reports' }">
		                <i class="icon-chart"></i>
		                <span class="title">Reports</span>
		                <span class="selected"></span>
		            </router-link>
		        </li>
		        <li>
		            <router-link :to="{ path: '/memos' }">
		                <i class="icon-note"></i>
		                <span class="title">Memo</span>
		                <span class="arrow "></span>
		            </router-link>
		        </li>
		        <li>
		            <router-link :to="{ path: '/files' }">
		                <i class="icon-folder-alt"></i>
		                <span class="title">Files</span>
		                <span class="arrow "></span>
		            </router-link>
		        </li>
		        <li v-if="is_admin">
		            <router-link :to="{ path: '/accounts' }">
		                <i class="icon-people"></i>
		                <span class="title">Accounts</span>
		                <span class="arrow "></span>
		            </router-link>
		        </li>
		        <li v-if="is_admin">
		            <router-link :to="{ path: '/departments' }">
		                <i class="icon-organization"></i>
		                <span class="title">Departments</span>
		                <span class="arrow"></span>
		            </router-link>
		        </li>
			    <li v-if="is_admin" style="position:relative">
		            <router-link :to="{ path: '/request' }">
		                <i class="icon-folder"></i>
		                <span class="title">Request </span>
		                <span class="arrow "></span>
		                <span class="badge badge-danger sidebar-link-badge" 
		                	v-if="newRequestCount > 0"
		                >{{newRequestCount}}</span>
		            </router-link>
		        </li>
		    </ul>
		</div>
	</div>
</template>

<style type="text/css">
	.sidebar-link-badge{
		position: absolute;
		top: 8px;
    	right: 70px;
	}
</style>

<script>
	import Department from './../api/department'
	import Request from './../api/request'

	export default {

		name: 'app-sidebar',

		mounted() {
            Request.getNewRequestCount()
                .then(count => {
                    this.newRequestCount = count.data;
            })
        },
        data(){
        	return {
        		newRequestCount : 0
        	}
        },

		computed: {
			is_admin() {
				var auth = JSON.parse(cookie.get('auth'))
				return auth.is_admin;
			}
		}

	}
</script>