<template>
	<div class="row">
		<div class="col-md-12" v-if="showMemoForm">
			<portlet>
				<span slot="title" v-if="!isUpdate">Add memo</span>
				<span slot="title" v-else>Update memo</span>
				<memo-form @submit="newMemo" @update="updatedMemo" @cancel="showMemoForm = false" :is-update="isUpdate" :show.sync="showMemoForm" :memo.sync="memo"></memo-form>
			</portlet>
		</div>
		<div class="col-md-12">
			<portlet>
				<span slot="title">Memos</span>
				<div slot="tools" class="tools">
					<div class="actions">
						<button v-if="is_admin" @click="add()" class="btn btn-circle btn-sm btn-default">
							<i class="fa fa-plus"></i>Add Memo
						</button>
					</div>
				</div>
				<div class="row todo-content" v-if="memos.length">
                    <div class="col-md-12">
						<div class="todo-tasklist">
							<div class="todo-tasklist-item todo-tasklist-item-border-green" v-for="(memo,index) in memos">
								<div class="todo-tasklist-item-controls" v-if="owns(memo.user_id)">
									<button class="btn btn-xs btn-circle" @click="updateMemo(memo)">
										<i class="fa fa-pencil"></i>
									</button>
									<button class="btn btn-xs btn-circle" @click="removeMemo(memo,index)">
										<i class="fa fa-trash"></i>
									</button>
								</div>
								<img class="todo-userpic pull-left" :src="memo.user.photo_url ? memo.user.photo_url : '/img/default-photo.jpg'" width="27px" height="27px">
								<div class="todo-tasklist-item-title">
									{{memo.user.name}}
								</div>
								<div class="todo-tasklist-item-text">
									<h4>{{memo.title}}</h4>
									{{memo.body}}
								</div>
								<div class="todo-tasklist-controls pull-left">
									<span class="todo-tasklist-date"><i class="fa fa-calendar"></i> {{memo.updated_at}} </span>
								</div>
							</div>
						</div>
                    </div>
                </div>
				<div v-else class="note note-info note-bordered">
	                <p>No memos added yet.</p>
	            </div>
			</portlet>
		</div>
	</div>
</template>

<style lang="sass">
	.user-pic {
		height: 30px;
	}
</style>

<script>
	import Portlet from './../partials/Portlet.vue'
	import MemoForm from './MemoForm.vue'
	import swal from 'sweetalert'
	import User from './../../api/user'
	import Memo from './../../api/memo'
	import toastr from 'toastr'
	import swal from 'sweetalert'

	export default {

		name: 'memos',

		components: {
			'portlet': Portlet,
			'memo-form': MemoForm
		},

		beforeRouteEnter(to, from, next) {

			Memo.GetAll().then(response => {
				next(vm => {
					vm.memos = response.data;
				})
			}).catch(err => {
				toastr.error('Cannot fetch memos.');
			})
			
        },

		data() {
			return {
				memos: [],
				memo:{},
				authenticated_user_id:  cookie.get('auth_user_id'),
				showMemoForm:false,
				isUpdate:false,
				loading: false
			}
		},

		computed: {
			is_admin() {
				return Boolean(localStorage.getItem('is_admin') == 'true')
			}
		},

		methods: {
			
			owns(user_id) {
				return user_id == this.authenticated_user_id
			},

			add(){
				this.memo = {};
				this.showMemoForm = true;
			},

			updateMemo(memo) {
				this.isUpdate = true;
				this.memo = memo;
				this.showMemoForm = true;
			},

			removeMemo(memo,index) {
				swal({   
                    title: "Are you sure?",   
                    text: '"'+memo.title +'" will be deleted!',   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true 
                }, () => {
                    Memo.DeleteMemo(memo).then(response => {
                    	swal("Deleted!", "Memo deleted!.", "success");
                    	this.memos.splice(index,1);
                    	toastr.success('Memo deleted!')
                    });
                });
			},

			newMemo(memo) {
				this.showMemoForm = false;
				this.memo = {};
				this.memos.unshift(memo);
			},

			updatedMemo(memo){
				let index = this.memos.findIndex(_memo =>{
					return _memo.id === memo.id;
				});
				this.memos.splice(index,1);
				this.memos.unshift(memo);
				this.isUpdate = false;
				this.memo = {};
				this.showMemoForm = false;

			}

			
		}

	}
</script>