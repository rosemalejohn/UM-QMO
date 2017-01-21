<template>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption">
						<span class="caption-subject font-green-sharp bold uppercase">Requests</span>
					</div>
					<ul class="nav nav-tabs">
						<li :class="{'active': !statusFilter}">
							<a href="javascript:;" v-on:click="statusFilter = 0"> New </a>
						</li>
						<li :class="{'active': statusFilter}">
							<a href="javascript:;" v-on:click="statusFilter = 1"> Done </a>
						</li>
					</ul>
					<div class="pull-right" style="margin:8px 30px 0 0;" v-if="checked.length">
						<a @click="approve()" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-check"></i>Mark done
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table v-if="requests.length" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="table-checkbox" v-if="statusFilter == 0" width="1%">
									<!-- <input type="checkbox" class="group-checkable"/> -->
								</th>
								<th>Name</th>
								<th>College</th>
								<th>School year</th>
								<th>Email</th>
								<th>Contact number</th>
								<th width="30%">Request for</th>
								<th width="5%">Status</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="request in filteredRequests(requests)" class="odd gradeX">
								<td v-if="statusFilter == 0">
									<input v-model="checked" type="checkbox" class="checkboxes" :value="request.id"/>
								</td>
								<td>{{ request.name }}</td>
								<td>{{ request.college }}</td>
								<td>{{ request.school_year }}</td>
								<td>{{ request.email }}</td>
								<td>{{ request.contact_number }}</td>
								<td>{{ request.request_for }}</td>
								<td>
									<span class="label label-info">{{ request.is_done ? 'Done' : 'New' }}</span>
								</td>
							</tr>
						</tbody>
					</table>
					<div v-else class="note note-info note-bordered" style="margin:10px 20px">
	                    <p>No request. You are done for today.</p>
	                </div>

	                <infinite-scroll :paginator.sync="paginator" @fetched="requestsPulled"></infinite-scroll>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Authorize from './../../services/authorize'
	import Portlet from './../partials/Portlet.vue'
	import Request from './../../api/request'
	import toastr from 'toastr'
	import swal from 'sweetalert'
	import InfiniteScroll from './../partials/InfiniteScroll.vue'

	export default {

		name: 'departments',
		
		components: {
			'portlet': Portlet,
			'infinite-scroll': InfiniteScroll
		},

		beforeRouteEnter(to, from, next) {
			if (!Authorize.isAdmin()) {
				next('/403')
			}
            Request.GetAll().then(response => {
            	next(vm => {
            		vm.paginator = response.data;
            		vm.requests = response.data.data;
            	});
            }).catch(err => {
            	toastr.error('Cannot load requests!');
            	next(false);
            });
        },

		methods: {

			approve() {
				Request.ApproveMultiple(this.checked).then(response => {
					Request.GetAll().then(response => {
            			this.paginator = response.data;
            			this.requests = response.data.data;
		            }).catch(err => {
		            	toastr.error('Cannot load requests!');
		            });
				})
				.then(()=>{
					toastr.success('Request approved!');
					this.checked = [];
				})
				.catch(err => {
					toastr.error('Cannot approve! Something went wrong.');
				})
			},
			filteredRequests( requests ){
				return requests.filter(request => {
					return request.is_done == this.statusFilter;
				});
			},

			requestsPulled(paginator) {
				this.paginator = paginator
				paginator.data.forEach(request => {
					this.requests.push(request)
				})
			}
			
		},

		data() {
			return {
				paginator: {},
				checked: [],
				requests: [],
				statusFilter : 0
			}
		}
	}
</script>