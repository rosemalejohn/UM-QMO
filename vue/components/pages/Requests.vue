<template>
	<div class="row">
		<div class="col-md-12">
			<portlet>
				<span slot="title">Requests</span>
				<div slot="tools" class="tools">
					<div class="actions" v-if="checked.length">
						<a @click="approve()" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-check"></i>Mark done
						</a>
						<!-- <button @click="reject()" class="btn btn-circle btn-sm red-sunglo">
							<i class="fa fa-remove"></i>Reject
						</button> -->
					</div>
				</div>
				<table v-if="requests.length" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="table-checkbox">
								<input type="checkbox" class="group-checkable"/>
							</th>
							<th>Name</th>
							<th>College</th>
							<th>School year</th>
							<th>Email</th>
							<th>Contact number</th>
							<th>Request for</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="request in requests" class="odd gradeX">
							<td width="5%">
								<input v-model="checked" type="checkbox" class="checkboxes" :value="request.id"/>
							</td>
							<td>{{ request.name }}</td>
							<td>{{ request.college }}</td>
							<td>{{ request.school_year }}</td>
							<td>{{ request.email }}</td>
							<td>{{ request.contact_number }}</td>
							<td>{{ request.request_for }}</td>
							<td>{{ request.is_done }}</td>
						</tr>
					</tbody>
				</table>
				<div v-else class="note note-info note-bordered">
                    <p>No request. You are done for today.</p>
                </div>
			</portlet>
		</div>
	</div>
</template>

<script>
	import Portlet from './../partials/Portlet.vue'
	import Request from './../../api/request'
	import toastr from 'toastr'
	import swal from 'sweetalert'

	export default {

		name: 'departments',
		
		components: {
			'portlet': Portlet,
		},

		beforeRouteEnter(to, from, next) {
            Request.GetAll().then(response => {
            	next(vm => {
            		vm.requests = response.data;
            	});
            }).catch(err => {
            	toastr.error('Cannot load requests!');
            	next(false);
            });
        },

		methods: {

			approve() {
				Request.ApproveMultiple(this.checked).then(response => {
					toastr.success('Request approved!');
					this.requests = _.each(this.requests, request => {
						return request.is_done = true;
					})

                	this.checked = [];
				}).catch(err => {
					toastr.error('Cannot approve! Something went wrong.');
				})
			},
			
		},

		data() {
			return {
				checked: [],
				requests: []
			}
		}
	}
</script>