<template>
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
			<slot name="content"></slot>
		</div>
	</div>
</template>