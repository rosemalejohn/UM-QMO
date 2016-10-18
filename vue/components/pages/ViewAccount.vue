<template>
	<div class="profile">
	    <div class="tabbable-line tabbable-full-width">
	        <ul class="nav nav-tabs">
	            <li class="active">
	                <a href="#tab_1_1" data-toggle="tab"> Overview </a>
	            </li>
	        </ul>
	        <div class="tab-content">
	            <div class="tab-pane active" id="tab_1_1">
	                <div class="row">
	                    <div class="col-md-3">
	                        <ul class="list-unstyled profile-nav">
	                            <li>
	                                <img :src="user.photo_url || '/img/default-photo.jpg'" class="img-responsive pic-bordered" alt="" />
	                            </li>
	                        </ul>
	                    </div>
	                    <div class="col-md-9">
	                        <div class="row">
	                            <div class="col-md-12 profile-info">
	                                <h1 class="font-green sbold uppercase">{{ user.name }}</h1>
	                                <ul class="list-inline">
	                                    <li>
	                                        <i class="fa fa-user"></i> {{ user.id_number }} </li>
	                                    <li>
	                                        <i class="fa fa-at"></i> {{ user.email }} </li>
	                                    <li>
	                                        <i class="fa fa-male"></i> {{ user.gender }} </li>
	                                    <li>
	                                        <i class="fa fa-star"></i> {{ user.position }} </li>
	                                    <li>
	                                        <i class="fa fa-sitemap"></i> {{ user.department ? user.department.name : 'No department' }} </li>
	                                </ul>
	                            </div>
	                        </div>

	                        <div class="tabbable-line tabbable-custom-profile">
	                            <ul class="nav nav-tabs">
	                                <li class="active">
	                                    <a href="#files-uploaded" data-toggle="tab"> Files uploaded </a>
	                                </li>
	                            </ul>
	                            <div class="tab-content">
	                                <div class="tab-pane active" id="files-uploaded">
	                                    <div class="portlet-body">
	                                        <table class="table table-striped table-bordered table-advance table-hover">
	                                            <thead>
	                                                <tr>
	                                                    <th>
	                                                        <i class="fa fa-file"></i> Filename </th>
	                                                    <th class="hidden-xs">
	                                                        <i class="fa fa-question"></i> Size (kb)</th>
	                                                    <th>
	                                                        <i class="fa fa-calendar"></i> Date uploaded </th>
	                                                    <th> </th>
	                                                </tr>
	                                            </thead>
	                                            <tbody>
	                                                <tr v-for="file in files">
	                                                    <td>{{ file.filename }}</td>
	                                                    <td>{{ file.size }}</td>
	                                                    <td>{{ file.created_at }}</td>
	                                                    <td>
	                                                    	<a :href="file.url" download>Download</a>
	                                                    </td>
	                                                </tr>
	                                            </tbody>
	                                        </table>
	                                        <div v-if="!files.length" class="alert alert-info">
	                                        	No files uploaded!
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</template>

<style lang="sass">
	.profile-sidebar-portlet {
		padding-bottom: 30px !important;
	}
</style>

<script>
	import User from './../../api/user'
	import toastr from 'toastr'

	export default {

		name: 'view-account',

		data() {
			return {
				user: {},
				files: []
			}
		},

		beforeRouteEnter(to, from, next) {
			User.Get(to.params.userId).then(response => {
				next(vm => {
					vm.user = response.data;

					User.GetFiles(vm.user.id).then(response => {
						vm.files = response.data;
					})
				})
			}).catch(err => {
				toastr.error('User cant be displayed!');
				next(false);
			})
		}

	}
</script>