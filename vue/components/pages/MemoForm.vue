<template>
	<form @submit.prevent="submit()" class="form-horizontal form-bordered">
		<div class="form-group" v-bind:class="{ 'has-error': form_errors.title }">
			<label class="col-sm-3 control-label">Title</label>
			<div class="col-sm-7">
				<input type="text" v-model="memo.title" class="form-control"/>
                <div class="help-block" v-if="form_errors.title">{{form_errors.title[0]}}</div>
			</div>
		</div>
		<div class="form-group" v-bind:class="{ 'has-error': form_errors.body }">
			<label class="col-sm-3 control-label">Body</label>
			<div class="col-sm-7">
				<textarea v-model="memo.body" class="form-control" rows="10"></textarea>
                <div class="help-block" v-if="form_errors.body">{{form_errors.body[0]}}</div>
			</div>
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn red"><i class="fa fa-check"></i> Submit</button>
					<button @click="cancel" type="button" class="btn default">Cancel</button>
				</div>
			</div>
		</div>
	</form>
</template>

<script>
	import Memo from './../../api/memo'
	import toastr from 'toastr'

	export default {

		name: 'memo-form',

		props: {
			show: {
				type: Boolean,
				default: false,
				twoWay: true
			},
			memo: {
				type: Object,
				default() {
					return {
						title: '',
						body: '',
                        user_id:null
					}
				},
				required: false
			},
			isUpdate: {
				type: Boolean,
				default: false
			}
		},

        data(){
            return {
                form_errors:{}
            }
        },

		methods: {

			cancel() {
				this.$emit('cancel');
			},

			submit() {
				if (this.isUpdate) {
					Memo.UpdateMemo(this.memo).then(response => {
                        this.$emit('update',response.data);
						toastr.success('Memo updated!');
					})
				} else {
                    this.memo.user_id = cookie.get('auth_user_id');
					Memo.AddMemo(this.memo).then(response => {
						this.$emit('submit', response.data);
						toastr.success('Memo added!');
					}).catch(err => {
                        if(err.status == 422)
                            this.form_errors = err.data;
						toastr.error('You`ve got an error!');
					})	
				}
				
			}
		},
	}
</script>