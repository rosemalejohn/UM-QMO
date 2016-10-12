<template>
	<form @submit.prevent="search()" class="alert alert-danger alert-borderless">
        <div class="input-group">
            <div class="input-cont">
                <input v-on:keyup="search()" v-model="searchText" type="text" placeholder="Search files..." class="form-control"/>
            </div>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                	Search &nbsp; <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
</template>

<script>
	export default {
		
	}
</script>