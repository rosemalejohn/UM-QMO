<template>
	<div class="mix-inner">
        <img class="img-responsive" :src="file.url || '/img/default-photo.jpg'" :alt="file.filename">
        <div class="mix-details">
            <h4>{{ file.filename }}</h4>
            <a class="mix-link" :href="file.url" download>
            	<i class="fa fa-download"></i>
            </a>
            <a class="mix-preview fancybox-button" :href="file.url" title="Project Name" data-rel="fancybox-button">
            	<i class="fa fa-search"></i>
            </a>
        </div>
    </div>
</template>

<script>
	export default {

		props: {
			file: {
				type: Object,
				required: true
			}
		}

	}
</script>