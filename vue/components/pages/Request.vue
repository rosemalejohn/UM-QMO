<template>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-body" style="padding:50px;">
	                <div class="row">
	                    <div class="col-xs-4">
	                        <img src="/img/um.jpg" class="img-responsive" alt="Image">
	                    </div>
	                    <div class="col-xs-8 text-center">
	                        <h3 style="margin-top: 5px;"><b>Quality Management Office</b></h3>
	                        <h4><b>Request For Document</b></h4>
	                    </div>      
	                </div>   
	                <hr>  
	                <form @submit.prevent="update()">
	                    <div class="row">
	                        <div class="col-sm-6">
	                            <label>QMO Branch</label>
	                            <div class="radio3">
	                                <input type="radio" id="radio1" name="branch" v-model="request.branch" value="Main">
	                                <label for="radio1">
	                                    Main
	                                </label>
	                            </div>
	                            <div class="radio3">
	                                <input type="radio" id="radio2" name="branch"  v-model="request.branch" value="Specific_branch">
	                                <label for="radio2">
	                                    Branch
	                                </label>
	                            </div>
	                            <input type="text" class="form-control" id="" placeholder="Specify Branch" name="specific_branch" 
	                            v-model="specific_branch"
	                                style="width: 200px;">
	                        </div>
	                        <div class="col-sm-6">
	                            <label>Nature Of request</label>
	                            <div class="radio3">
	                                <input type="radio" id="radio3" name="request_nature" value="New" 
	                                	v-model="request.request_nature">
	                                <label for="radio3">
	                                    New
	                                </label>
	                            </div>
	                            <div class="radio3">
	                                <input type="radio" id="radio4" name="request_nature" value="Revision"
	                                v-model="request.request_nature">
	                                <label for="radio4">
	                                    Revision
	                                </label>
	                            </div>
	                            <div class="radio3">
	                                <input type="radio" id="radio5" name="request_nature" value="Deletion" 
	                                v-model="request.request_nature">
	                                <label for="radio5">
	                                    Deletion
	                                </label>
	                            </div>
	                        </div>
	                    </div>
	                    <hr>
	                    <div class="row">
	                        <div class="col-sm-6">
	                            <div class="form-group">
	                                <label for="">Request Date</label>
	                                <input type="text" class="form-control " disabled v-model="request.created_at">
	                            </div>
	                        </div>
	                        <div class="col-sm-6">
	                            <div class="form-group">
	                                <label for="">Request #</label>
	                                <input type="text" class="form-control " v-model="request.request_number">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                    	<div class="form-group col-sm-6">
	                    		<label for="">Document Title</label>
	                    		<input type="text" class="form-control" disabled v-model="request.document_title">
	                    	</div>
	                    	<div class="form-group col-sm-6">
	                    		<label for="">Document ID</label>
	                    		<input type="text" class="form-control" v-model="request.document_id">
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="form-group col-sm-6">
	                    		<label for="">Date Issued</label>
	                    		<input type="date" class="form-control" v-model="request.date_issued">
	                    	</div>
	                    	<div class="form-group col-sm-6">
	                    		<label for="">Rev #</label>
	                    		<input type="text" class="form-control" v-model="request.rev_number">
	                    	</div>
	                    </div>
	                    
	                    <div class="form-group">
	                        <label for="">Description of the Request</label>
	                        <textarea type="text" class="form-control input-lg"
	                        rows="5" v-model="request.description" disabled></textarea>
	                    </div>

	                    <div class="form-group">
	                        <label for="">Reason of the Request</label>
	                        <textarea type="text" class="form-control "
	                        rows="5" v-model="request.reason" disabled></textarea>
	                    </div>
	                    <div class="form-group">
	                        <label for="">Request By</label>
	                        <input type="text" class="form-control " id="" placeholder="Your name here..." name="request_by" v-model="request.request_by" disabled>
	                    </div>
	                            
	                    <div class="form-group">
	                        <label for="">Email</label>
	                        <input type="email" class="form-control" name="email" v-model="request.email" disabled>
	                    </div>
	                    <hr>
			                    
	                    <div class="row">
	                    	<div class="col-sm-6">
	                    		<div class="form-group">
			                        <label for="">Comments / Remarks</label>
			                        <textarea type="text" class="form-control "
			                        rows="3" v-model="request.remarks"></textarea>
			                    </div>
	                    	</div>
	                    	<div class="col-sm-6">
	                    		<label for="">Approval</label>
	                    		<div class="radio3">
			                    	<input type="radio" id="radio11" name="branch" v-model="request.is_approved" value="1">
			                    	<label for="radio11">
			                    		Approved
			                    	</label>
			                    </div>
			                    <div class="radio3">
			                    	<input type="radio" id="radio12" name="branch"  v-model="request.is_approved" value="2">
			                    	<label for="radio12">
			                    		Disapproved
			                    	</label>
			                    </div>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-sm-4">
	                    		 <div class="form-group">
			                        <label for="">To be effective from</label>
			                        <input type="date" class="form-control" name="effective_date" v-model="request.effective_date">
			                    </div>
	                    	</div>
	                    	<div class="col-sm-4">
	                    		 <div class="form-group">
			                        <label for="">Rev #</label>
			                        <input type="text" class="form-control" name="rev_number" v-model="request.rev_number">
			                    </div>
	                    	</div>
	                    	<div class="col-sm-4">
	                    		 <div class="form-group">
			                        <label for="">Document ID</label>
			                        <input type="text" class="form-control" name="document_id" v-model="request.document_id">
			                    </div>
	                    	</div>

	                    	<div class="col-sm-12">
	                    		 <div class="form-group">
			                        <label for="">Unit Head</label>
			                        <input type="text" class="form-control" name="unit_head" v-model="request.unit_head">
			                    </div>
	                    	</div>

	                    </div>
	                    <hr>
	                    <div class="form-group hidden-print">
	                        <div class="col-sm-3">
	                            <router-link class="btn btn-warning btn-lg btn-block" :to="{ path: '/requests'}">{{cancelText}}</router-link>
	                        </div>
	                        <div class="col-sm-3">
	                            <button type="button" class="btn btn-success btn-lg btn-block" v-on:click="print()">Print</button>
	                        </div>
	                        <div class="col-sm-3 col-sm-offset-3">
	                            <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
	                        </div>
	                    </div>
	                </form>
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

	export default {

		name: 'request',
		
		components: {
			'portlet': Portlet
		},

		beforeRouteEnter(to, from, next) {
			if (!Authorize.isAdmin()) {
				next('/403')
			}
            Request.Get(to.params.requestId).then(response => {
            	next(vm => {
            		vm.request = response.data;
            		vm.cancelText = "Cancel";
            	});
            }).catch(err => {
            	toastr.error('Cannot load request!');
            	next(false);
            });
		},

		methods: {

			update(){
				Request.Update(this.request)
					.then( res => {
						toastr.success('Request updated!');
						this.cancelText = 'Close';
					} )
					.catch(err => {
						toastr.error('You`ve got an error!');
					})	
			},
			print(){
				window.print();
			}
			
		},

		data() {
			return {
				request: {},
				cancelText: "Cancel"
			}
		}
	}
</script>