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
						<a href="javascript:;" class="fullscreen">
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<div id="fileUploadGraph" class="chart" style="height: 500px;">
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import jQuery from 'jquery'

	export default {

		beforeRouteEnter(to, from, next) {
			next(vm => {
				vm.drawGraph();
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
		            
		            "dataProvider": [{
		                "year": 2009,
		                "income": 23.5,
		                "expenses": 18.1
		            }, {
		                "year": 2010,
		                "income": 26.2,
		                "expenses": 22.8
		            }, {
		                "year": 2011,
		                "income": 30.1,
		                "expenses": 23.9
		            }, {
		                "year": 2012,
		                "income": 29.5,
		                "expenses": 25.1
		            }, {
		                "year": 2013,
		                "income": 30.6,
		                "expenses": 27.2,
		                "dashLengthLine": 5
		            }, {
		                "year": 2014,
		                "income": 34.1,
		                "expenses": 29.9,
		                "dashLengthColumn": 5,
		                "alpha": 0.2,
		                "additional": "(projection)"
		            }],
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
		                "title": "Income",
		                "type": "column",
		                "valueField": "income"
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
		                "title": "Expenses",
		                "valueField": "expenses"
		            }],
		            "categoryField": "year",
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
		}

	}
</script>