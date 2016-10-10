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
		            <ul class="sub-menu">
		            	<li>
		                    <a href="">Add department</a>
		                </li>
		                <li v-for="department in departments">
		                    <router-link 
		                    	:to="{name: 'Show department', params: {departmentId: department.id}}"
		                    	>{{ department.name }}</router-link>
		                </li>
		            </ul>
		        </li>
		    </ul>
		</div>
	</div>
</template>

<script>
	import Department from './../api/departments'

	export default {


		created() {
			Department.GetAll().then(response => {
				this.departments = response.data;
			})
		},

		data() {
			return {
				departments: []
			}
		}

	}
</script>