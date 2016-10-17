<template>
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
		    <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
		        <li class="">
		            <a href="#/">
		                <i class="icon-home"></i>
		                <span class="title">Dashboard</span>
		                <span class="selected"></span>
		            </a>
		        </li> 
		        <li>
		            <a href="#/reports">
		                <i class="icon-chart"></i>
		                <span class="title">Reports</span>
		                <span class="selected"></span>
		            </a>
		        </li>
		        <li>
		            <a href="#/files">
		                <i class="icon-folder-alt"></i>
		                <span class="title">Files</span>
		                <span class="arrow "></span>
		            </a>
		            <ul class="sub-menu">
		                <li>
		                    <a href="ecommerce_index.html">
		                        <i class="icon-home"></i> Dashboard
		                    </a>
		                </li>
		            </ul>
		        </li>
		        <li>
		            <a href="#/accounts">
		                <i class="icon-people"></i>
		                <span class="title">Accounts</span>
		                <span class="arrow "></span>
		            </a>
		            <ul class="sub-menu">
		                <li>
		                    <a href="#/account/new">Add new</a>
		                </li>
		            </ul>
		        </li>
		        <li>
		            <a href="#/departments">
		                <i class="icon-organization"></i>
		                <span class="title">Departments</span>
		                <span class="arrow"></span>
		            </a>
		        </li>
			    <li>
		            <a href="#/request">
		                <i class="icon-folder"></i>
		                <span class="title">Request</span>
		                <span class="arrow "></span>
		            </a>
		        </li>
		    </ul>
		</div>
	</div>
</template>

<script>
	import Department from './../api/department'

	export default {

		name: 'app-sidebar',

		mounted() {
			Department.GetAll().then(response => {
				this.departments = response.data;
			})
		},

		data() {
			return {
				departments: [],
			}
		},

		computed: {
			is_admin() {
				return Boolean(localStorage.getItem('is_admin') == 'true')
			}
		}

	}
</script>