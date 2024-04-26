	
	
	
	
	function cargarChartDatosEconomicos(selector)
	{
		var sql = `select 
					count(InformeMecanica) inspecciones
					,sum(
					  convert (concat(ConceptoSigno1, ConceptoImporte1), decimal) 
				    + convert (concat(ConceptoSigno2, ConceptoImporte2), decimal)
				    + convert (concat(ConceptoSigno3, ConceptoImporte3), decimal)
				    + convert (concat(ConceptoSigno4, ConceptoImporte4), decimal)
				    + convert (concat(ConceptoSigno5, ConceptoImporte5), decimal)
				    + convert (concat(ConceptoSigno6, ConceptoImporte6), decimal)) importe
				, month(STR_TO_DATE(inspecciones.FechaInspeccion, "%d%m%Y")) mes
				, anyo 
				from inspecciones 
				where 
					Anyo >= :anyo 
					
				group by month(STR_TO_DATE(inspecciones.FechaInspeccion, "%d%m%Y")), anyo
				order by month(STR_TO_DATE(inspecciones.FechaInspeccion, "%d%m%Y")), anyo`;
									
					
		var parametros = {
				':anyo' : '2017',
		};
		$.ajax({
				url: 'index.php?r=gran-ojo/json-sql',
				type: 'get',
				
				data: {
					 'sql' : sql
					 ,'parametros' : JSON.stringify( parametros )
					// ,'debug' : true  
					},
					
				success: function (data) {
					
					datos = $.parseJSON(data) ;
					dataAdapter = prepararDatosAreaSeries_datosEconomicos(datos);
					
					cargarAreaSeries_datosEconomicos (selector, dataAdapter)
				},
				error:function (data) {
					console.log('Incio errores');
					console.log(data);
					console.log('Fin errores');
					return false;
				}	
			});		
		
	}
	
	///
	//
	//return dataAdapter
	//
	function prepararDatosAreaSeries_datosEconomicos(datos)
	{
			var series =  new Array(12);
			for(i=0; i<12;i++) series[i] = {};
			
			$.each(datos, function(index, item){
				series[parseInt(item['mes'])-1]['mes'] = item['mes'];
				series[parseInt(item['mes'])-1][item['anyo']] = item['importe']; 
			});
		
			console.log(series);
	
			var source =
			{
			   localdata: series,
			   datatype: "array",
			   datafields:
			   [
			      { name: 'mes', type: 'number' },			
			      { name: '2017', type: 'number' },			
			      { name: '2018', type: 'number' },
			      { name: '2019', type: 'number' },				
			   ]
			};
			
			var dataAdapter = new $.jqx.dataAdapter(source);
			dataAdapter.dataBind();
				
			return dataAdapter;
	}
	
	function cargarAreaSeries_datosEconomicos(selector, data)
	{
		var meses = ['','Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
		// prepare jqxChart settings
            var settings = {
                title: 'Ingresos por inspecciones',
                description: '',
                enableAnimations: true,
                showLegend: true,
                enableCrosshairs: true,
                padding: { left: 10, top: 5, right: 10, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                xAxis:
                    {
                        dataField: 'mes',
                        type: 'default',
                        valuesOnTicks: true,
                        labels: {
                            angle: -45,
                            rotationPoint: 'topright',
                            offset: {x: 0, y: -15},
                             formatFunction: function (value) {
                                return meses[value];
                            },
							
                        },
                        toolTipFormatFunction: function (value) {
                            return meses[value];
                            
                        }
                    },
                valueAxis:
                {
                    title: { text: 'Ingresos mensuales ITEVEBASA<br>' }
                },
                colorScheme: 'scheme05',
                seriesGroups:
                    [
                        {
                            type: 'line', //'area',
                            alignEndPointsWithIntervals: true,
                            series: [
                                    { dataField: '2017', displayText: '€ 2017',},
                                    { dataField: '2018', displayText: '€ 2018',},
									{ dataField: '2019', displayText: '€ 2019',}
                                ]
                        }
                    ]
            };
            // setup the chart
            $(selector).jqxChart(settings);
		
	}