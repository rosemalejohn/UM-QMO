<template>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box grey-cascade">
				<div class="portlet-title">
					<div class="caption">
						Accounts
					</div>
					<div class="tools">
						<a href="#/accounts/new" class="fa fa-plus"></a>
					</div>
				</div>
				<div class="portlet-body">
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
									ID No.
								</th>
								<th>
									Email
								</th>
								<th>
									Gender
								</th>
								<th>
									Position
								</th>
								<th>
									Department
								</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd gradeX">
								<td>
									<input type="checkbox" class="checkboxes" value="1"/>
								</td>
								<td>
									Rosemale-John II
								</td>
								<td>
									234672
								</td>
								<td>
									<a href="mailto:shuxer@gmail.com">
									rosemalejohn@gmail.com </a>
								</td>
								<td class="center">
									Male
								</td>
								<td>
									Senior Web Developer
								</td>
								<td>
									Web Team
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
</template>

<script>
	export default {

	}
</script>