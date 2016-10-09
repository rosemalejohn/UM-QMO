<template>
	<div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#/">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a :href="'#' + $route.path">{{ $route.name }}</a>
            </li>
        </ul>
    </div>
</template>