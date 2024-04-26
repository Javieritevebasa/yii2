	
	
	
	
	function cargarChartInspectoresActivos(selector, estacion)
	{
		var sql = `select entrada, salida, concat(user.nombre, ' ', apellidos) inspector, codigoEstacion from (

					SELECT idUser, fechaHora entrada FROM  tickadas.fichajes where  idAccion = 1 and date( fechaHora ) = date (now() )) entradas
					left join (
					
					select idUser, fechaHora salida from tickadas.fichajes where idAccion = 2 and date( fechaHora ) = date (now())) salidas on entradas.idUser=salidas.idUser
					
					left join  tickadas.user on user.id = entradas.idUser
					left join tickadas.estaciones_predeterminada_por_usuario estacion on user.id = estacion.idUser
					left join tickadas.pertenecer on user.id=pertenecer.idUser 
					left join tickadas.grupo on pertenecer.idGrupo = grupo.idGrupo
					where grupo.idGrupo in (2,3) and estacion.codigoEstacion=:codigoEstacion
					group by entrada, salida, concat(user.nombre, ' ', apellidos), codigoEstacion
					order by inspector`;
									
					
		var parametros = {
				'codigoEstacion' : estacion
		};
		$.ajax({
				url: 'index.php?r=gran-ojo/json-sql',
				type: 'get',
				
				data: {
					 'sql' : sql
					 ,'parametros' : JSON.stringify( parametros )
					// ,'debug' : true 
					 ,'db' : 'dbTickadas' 
					},
					
				success: function (data) {
					
					datos = $.parseJSON(data) ;
					dataAdapter = prepararDatos_inspectoresActivos(datos);
					
					cargarChart_inspectoresActivos (selector, dataAdapter)
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
	function prepararDatos_inspectoresActivos(datos)
	{
			
			var source =
			{
			   localdata: datos,
			   datatype: "array",
			   datafields:
			   [
			      { name: 'entrada', type: 'date' },			
			      { name: 'salida', type: 'date' },			
			      { name: 'inspector', type: 'string' },
			      { name: 'codigoEstacion', type: 'string' },
			   ]
			};
			
			var dataAdapter = new $.jqx.dataAdapter(source);
			dataAdapter.dataBind();
				
			return dataAdapter;
	}
	
	function cargarChart_inspectoresActivos(selector, dataAdapter)
	{
		var settings = {
            width: $(selector).parent().width(),
                source: dataAdapter,                
                pageable: true,
                autoheight: true,
                sortable: true,
                altrows: true,
                enabletooltips: true,
                editable: true,
                selectionmode: 'multiplecellsadvanced',
                columns: [
                  { text: 'Inspector', datafield: 'inspector', width: 250 },
                  { text: 'Entrada', datafield: 'entrada', width: 250 },
                  { text: 'Salida', datafield: 'salida', width: 250 },
                ],
            };
            // setup the chart
       $(selector).jqxGrid(settings);
		
	}