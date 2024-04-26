<?php
namespace backend\models;


use Yii;


//use setasing\fdpi;
//use setasing\fdpi\StreamReader;



class IFO010203  {
	
	public $pdf;
	
	function __construct()
	{


	   $path = Yii::getAlias('@app').'/plantillas/IFO010203ed5_blanco.pdf';
		//die($path);
		if(!file_exists($path)) { echo 'ups'; return;}
		//echo $path;
		
		//Añadiendo una línea en todas las páginas del documento:
		$this->pdf = new \FPDI();
		
		$numPages = $this->pdf->setSourceFile($path);
        for ($i = 1; $i <= $numPages; $i++) {
            $tplIdx = $this->pdf->importPage($i);
           // $this->pdf->SetPrintHeader(false);
           // $this->pdf->SetPrintFooter(false);
            $this->pdf->AddPage();
            $this->pdf->useTemplate(
                $tplIdx, $x = null, $y = null, 
                $w = 0, $h = 0, $adjustPageSize = true
            );
        }
		$this->pdf->SetMargins(0,0,0,0);
		
		
		
	}
	
	function getPdf($inspector, $pathToSave ='')
	{
		$this->pdf->SetAuthor(utf8_decode(Yii::$app->user->identity->nombre.' '.Yii::$app->user->identity->apellidos));
		$this->pdf->SetTitle('Impreso IFO-01-02-03');
		$this->pdf->SetSubject(utf8_decode('Certificado de competetencia de inspector en materia de inspección técnica de vehículos del inspector '.$inspector->nombre.' '.$inspector->apellidos));
		//$this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		$this->pdf->SetFont('helvetica', '', 13, '', false);
		$this->pdf->SetTextColor(0,105,170);
		
		
		
		
		$txt = 'D./Dña '. $inspector->estacion->responsable0->nombre.' '.$inspector->estacion->responsable0->apellidos.', con D.N.I. '. $inspector->estacion->responsable0->dni.', en calidad de Director Técnico de Estación de la entidad Estación ITV Vega Baja, S.A. con C.I.F. A03105632.';
		//$this->pdf->Text(15,50, utf8_decode($txt));
		$this->pdf->SetXY(15, 42 );
		$this->pdf->MultiCell(270, 6, utf8_decode($txt),0,'J');
		
		$this->pdf->SetFont('helvetica', 'B', 18, '', false);
		$this->pdf->SetXY(15, 54);
		$this->pdf->MultiCell(270, 6, utf8_decode('CERTIFICA'),0,'C');
		
		$txt = 'Que el inspector D./Dña. '.$inspector->nombre.' '.$inspector->apellidos.', con D.N.I. '.$inspector->dni.', está autorizado para realizar la inspección técnica de las siguientes categorías de vehículos:';
		$this->pdf->SetFont('helvetica', '', 13, '', false);
		$this->pdf->SetXY(15, 62);
		$this->pdf->MultiCell(270, 6, utf8_decode($txt),0,'J');
		
			
		//Cualificaciones
		$posI = 74;
		$this->pdf->SetFont('helvetica', 'B', 12, '', false);
		$txt ='';
		//foreach ($inspector->estarCualificado as $key => $cualificacion) {
		foreach ($inspector->cualificacionesEnVigor as $key => $cualificacion) {
			if ($cualificacion->apto)
				$txt .= ($txt != '' ? ', ' : '') . '('. $cualificacion->grupoCategorias->nombre . ')';
			
		//	$this->pdf->SetXY(15, $posI );
		//	$this->pdf->MultiCell(270, 6, utf8_decode($cualificacion->nombre),0,'C');
		//	$posI += 5;
		}
		
		//print_r($inspector->getCualificacionesEnVigor()->createCommand()->getRawSql());
		//die();
		$this->pdf->SetXY(15, $posI );
		$this->pdf->MultiCell(270, 6, utf8_decode($txt),0,'C');
		
		$txt = 'Así mismo, de conformidad con lo dispuesto en el Real Decreto 920/2017, de 23 de octubre, por el que se regula la Inspección Técnica de Vehículos, está autorizado para realizar los siguientes tipos de inspecciones técnicas:';
		$this->pdf->SetFont('helvetica', '', 13, '', false);
		$this->pdf->SetXY(15, 82);
		$this->pdf->MultiCell(270, 6, utf8_decode($txt),0,'J');
		
		//Especialidades:
		$this->pdf->SetFont('helvetica', 'B', 11, '', false);
		
		
		$this->pdf->SetXY(85, 95 );
		
		
		if ($inspector->cualificaciones){
			$this->pdf->MultiCell(200, 5, utf8_decode('Periódicas (*)'),0,'L');
			
		}
		
	//	print_r($inspector->especialidadesEnVigor); die();
		if ($inspector->especialidadesEnVigor)
		{
			$this->pdf->SetXY(85, 100 );
			//$this->pdf->MultiCell(200, 5, utf8_decode('No Periódicas:'),0,'L');
			$posI = 100;
			//foreach ($inspector->especialidades as $key => $especialidad) {
			foreach ($inspector->especialidadesEnVigor as $key => $especialidad) {
				
				if ($especialidad->especialidad->cualificacion->activo && $especialidad->especialidad->cualificacion->imprimirEnIFO010203)
				{
					$this->pdf->SetXY(85, $posI ); 
					$this->pdf->MultiCell(170, 5, utf8_decode($especialidad->especialidad->cualificacion->nombre.'(**)'),0,'L');
							
					$posI += 5;
				}
			}
		}
		if ($inspector->cualificaciones){
			$this->pdf->SetFont('helvetica', '', 9, '', false);
			$this->pdf->SetTextColor(0,105,170);
			$this->pdf->SetXY(15, 110 );
			$this->pdf->MultiCell(270, 5, utf8_decode('(*) Aún teniendo carácter de inspecciones no periódicas, el mecánico inspector cualificado para inspecciones periódicas de una especialidad, se entiende cualificado para prestar servicios de inspecciones no periódicas voluntarias, a requerimiento de la autoridad y como resultado de inspecciones técnicas en carretera. Igualmente, el inspector cualificado en inspecciones técnicas peródicas de M2/M3 se entiende cualificado para prestar servicios de Idoneidad de transporte escolar y de menores.'),0,'L');
		}
		if ($inspector->especialidadesEnVigor)
		{
			$this->pdf->SetFont('helvetica', '', 9, '', false);
			$this->pdf->SetTextColor(0,105,170);
			$this->pdf->SetXY(15, 125 );
			$this->pdf->MultiCell(270, 5, utf8_decode('(**) El inspector cualificado para inspecciones técnicas No Periódicas, se entiende cualificado para prestar servicios de reformas, duplicados, cambios de destino, diligencias y previas a la matriculación (incluidas las contempladas en el proceso de catalogación de los vehículos como históricos).'),0,'L');
		}
		
		$txt = 'Este certificado mantendrá su vigencia siempre y cuando el inspector se someta a los procesos de adiestramiento periódico previstos y supere las supervisiones a la que debe somerterse su actuación.';
		$this->pdf->SetFont('helvetica', '', 13, '', false);
		$this->pdf->SetXY(15, 140);
		$this->pdf->MultiCell(270, 6, utf8_decode($txt),0,'J');
		
		
		$txt = 'Y para que así conste, y surta los efectos oportunos, se expide el presente certificado:';
		$this->pdf->SetFont('helvetica', '', 13, '', false);
		$this->pdf->SetXY(15, 158);
		$this->pdf->MultiCell(270, 6, utf8_decode($txt),0,'J');
		
		
		$formatter = \Yii::$app->formatter;

		setlocale(LC_TIME, 'es_ES.UTF-8');
		date_default_timezone_set ('Europe/Madrid');
		$hoy = new \DateTime();
		$txt = 'En '. Yii::$app->user->identity->estacionPredeterminada->poblacion.' a '.strftime("%A, %d de %B de %Y", $hoy->getTimestamp());
		$this->pdf->SetFont('helvetica', '', 13, '', false);
		$this->pdf->SetXY(15, 165);
		$this->pdf->MultiCell(270, 6, utf8_decode($txt),0,'C',0);
		
		$txt = 'fdo.: '. $inspector->estacion->responsable0->nombre.' '.$inspector->estacion->responsable0->apellidos;
		$this->pdf->SetFont('helvetica', '', 13, '', false);
		$this->pdf->SetXY(15, 183.5);
		$this->pdf->MultiCell(270, 6, utf8_decode($txt),0,'C',0);
		
		
		
		if ($pathToSave!='')
			return $this->pdf->Output('F',  $pathToSave );
		else {
				return $this->pdf->Output('S');
		}
	}

	function firmarDocumento($userFirma, $pdf)
	{
		$var = new \TPDF();
		
		// set certificate file
		$certificate = $userFirma->certificado;

		// set additional information
		$info = array(
		    'Name' => 'TCPDF',
		    'Location' => 'Office',
		    'Reason' => 'Testing TCPDF',
		    'ContactInfo' => 'http://www.tcpdf.org',
		    );

		// set document signature
		$pdf->setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);
	}

	
}

?>