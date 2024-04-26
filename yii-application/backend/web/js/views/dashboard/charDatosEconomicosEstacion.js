	
	
	
	
	function cargarChartDatosEconomicosEstacion(selector, estacion)
	{
		/*var sql = `select count(InformeMecanica) inspecciones,
					sum(
					convert (concat(ConceptoSigno1, ConceptoImporte1), decimal) 
				    + convert (concat(ConceptoSigno2, ConceptoImporte2), decimal)
				    + convert (concat(ConceptoSigno3, ConceptoImporte3), decimal)
				    + convert (concat(ConceptoSigno4, ConceptoImporte4), decimal)
				    + convert (concat(ConceptoSigno5, ConceptoImporte5), decimal)
				    + convert (concat(ConceptoSigno6, ConceptoImporte6), decimal)) importe
				    
				    ,d_servicios.servicioUnificadoDescripcion servicio
					
				from inspecciones 
				inner join d_estaciones on d_estaciones.codigo=inspecciones.Estacion
				inner join d_servicios on d_servicios.codigo = inspecciones.TipoInspeccion and d_servicios.comunidad = d_estaciones.comunidad
				where 
					Anyo in ( :anyo )
				    and inspecciones.Estacion = :codigoEstacion
				    and inspecciones.FaseInspeccion = 1
				group by  d_servicios.servicioUnificadoDescripcion`; */
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
					Anyo >=  :anyo  
					and estacion = :codigoEstacion
				group by month(STR_TO_DATE(inspecciones.FechaInspeccion, "%d%m%Y")), anyo
				order by month(STR_TO_DATE(inspecciones.FechaInspeccion, "%d%m%Y")), anyo`;							
					
		var parametros = {
				':anyo' : 2017,
				':codigoEstacion' : estacion,
		};
		$.ajax({
				url: 'index.php?r=gran-ojo/json-sql',
				type: 'get',
				
				data: {
					 'sql' : sql
					 ,'parametros' : JSON.stringify( parametros )
					 //,'debug' : true  
					},
					
				success: function (data) {
					
					datos = $.parseJSON(data) ;
					dataAdapter = prepararDatos_datosEconomicosEstacion(datos);
					
					cargarChart_datosEconomicosEstacion (selector, dataAdapter);
				},
				error:function (data) {
					console.log('Incio errores');
					console.log(data);
					console.log('Fin errores');
					return false;
				}	
			});		
		
	}
	
	
	function prepararDatos_datosEconomicosEstacion(datos)
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
	
	function cargarChart_datosEconomicosEstacion(selector, data)
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
	
	///
	//
	//return dataAdapter
	//
	/*function prepararDatos_datosEconomicosEstacion(datos)
	{
			
			var source =
			{
			   localdata: datos,
			   datatype: "array",
			   datafields:
			   [
			      { name: 'servicio', type: 'string' },			
			      { name: 'inspecciones', type: 'number' },			
			      { name: 'importe', type: 'number' },
			   ]
			};
			
			var dataAdapter = new $.jqx.dataAdapter(source);
			dataAdapter.dataBind();
				
			return dataAdapter;
	}
	
	function cargarChart_datosEconomicosEstacion(selector, dataAdapter)
	{
		var settings = {
                title: "Servicios",
                description: "(source: wikipedia.org)",
                enableAnimations: true,
                showLegend: false,
                showBorderLine: true,
                legendPosition: { left: 520, top: 140, width: 100, height: 100 },
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                colorScheme: 'scheme02',
                seriesGroups:
                    [
                        {
                            type: 'pie',
                            showLabels: true,
                            series:
                                [
                                    { 
                                        dataField: 'inspecciones',
                                        displayText: 'servicio',
                                        labelRadius: 120,
                                        initialAngle: 15,
                                        radius: 100,
                                        centerOffset: 0,
                                        formatSettings: { sufix: '', decimalPlaces: 0 }
                                    }
                                ]
                        }
                    ]
            };
            // setup the chart
       $(selector).jqxChart(settings);
		
	}*/