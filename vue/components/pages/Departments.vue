<template>
	<div class="row">
		<div class="col-md-12">
			<portlet>
				<span slot="title">Departments</span>
				<div slot="tools" class="tools">
					<div class="actions">
						<a href="#/departments/new" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-plus"></i>Add
						</a>
						<button class="btn btn-circle btn-sm">
							<i class="fa fa-edit"></i>Edit
						</button>
						<button @click="removeDepartments()" class="btn btn-circle btn-sm red-sunglo">
							<i class="fa fa-remove"></i>Delete
						</button>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="table-checkbox">
								<input type="checkbox" class="group-checkable"/>
							</th>
							<th>
								Name
							</th>
							<th>
								Files
							</th>
							<th>
								Users
							</th>
							<th>
								Date added
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<td width="5%">
								<input type="checkbox" class="checkboxes" value="1"/>
							</td>
							<td>
								College of Computing
							</td>
							<td>
								234672
							</td>
							<td>
								12
							</td>
							<td class="center">
								October 12
							</td>
						</tr>
					</tbody>
				</table>
			</portlet>
		</div>
	</div>
</template>

<script>
	import Portlet from './../partials/Portlet.vue'

	export default {
		components: {
			Portlet
		},

		methods: {

			removeDepartments() {

			}
			
		}
	}
</script>