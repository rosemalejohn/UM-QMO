<template>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-bar-chart font-green-haze"></i>
						<span class="caption-subject bold uppercase font-green-haze">File uploads</span>
					</div>
					<div class="tools">
						<a href="/api/files/excel-report/download">
							<i class="fa fa-download"></i> Export graph
						</a>
						<a href="javascript:;" class="fullscreen"></a>
					</div>
				</div>
				<div class="portlet-body">
					<div id="fileUploadGraph" class="chart" style="height: 500px;"></div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import jQuery from 'jquery'
	import Stat from './../../api/stat'
	import toastr from 'toastr'

	export default {

		data() {
			return {
				dataProvider: []
			}
		},

		beforeRouteEnter(to, from, next) {
			next(vm => {
				vm.drawGraph();
				Stat.GetTotalFilesUploadedByMonth('2016').then(response => {
					vm.dataProvider = response.data;
				}).catch(err => {
					toastr.error('Cannot fetch analytics.')
				})
			})
			
		},

		methods: {
			drawGraph() {
				var chart = AmCharts.makeChart("fileUploadGraph", {
		            "type": "serial",
		            "theme": "light",
		            "autoMargins": false,
		            "marginLeft": 30,
		            "marginRight": 8,
		            "marginTop": 10,
		            "marginBottom": 26,

		            "fontFamily": 'Open Sans',            
		            "color":    '#888',
		            
		            "dataProvider": this.dataProvider,
		            "valueAxes": [{
		                "axisAlpha": 0,
		                "position": "left"
		            }],
		            "startDuration": 1,
		            "graphs": [{
		                "alphaField": "alpha",
		                "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>",
		                "dashLengthField": "dashLengthColumn",
		                "fillAlphas": 1,
		                "title": "Files uploaded",
		                "type": "column",
		                "valueField": "files"
		            }, {
		                "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>",
		                "bullet": "round",
		                "dashLengthField": "dashLengthLine",
		                "lineThickness": 3,
		                "bulletSize": 7,
		                "bulletBorderAlpha": 1,
		                "bulletColor": "#FFFFFF",
		                "useLineColorForBulletBorder": true,
		                "bulletBorderThickness": 3,
		                "fillAlphas": 0,
		                "lineAlpha": 1,
		                "title": "Files Deleted",
		                "valueField": "deleted"
		            }],
		            "categoryField": "month",
		            "categoryAxis": {
		                "gridPosition": "start",
		                "axisAlpha": 0,
		                "tickLength": 0
		            }
		        });

		        jQuery('#fileUploadGraph').closest('.portlet').find('.fullscreen').click(function() {
		            chart.invalidateSize();
		        });
			}
		},

		watch: {
			dataProvider() {
				this.drawGraph();
			}
		}

	}
</script>