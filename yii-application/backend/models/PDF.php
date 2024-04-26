<?php
namespace backend\models;


use Yii;
use setasing\fdpi;
use setasing\fdpi\StreamReader;
use backend\models\Barcode;

class PDF {
	
	public static function GenerarPDFSalida($user, $barcodePath, $outputType ='S')
	{
		
		$path = Yii::getAlias('@app').'/plantillas/pantillaIdentificacion.pdf';
		//die($path);
		if(!file_exists($path)) { echo 'ups'; return;}
		//echo $path;
		
		//Añadiendo una línea en todas las páginas del documento:
		$pdf = new \FPDI();
		//$pdf->AddPage();
		$pdf->SetFont('Helvetica');
		
		
		    
			
		// get the page count
		$pageCount = $pdf->setSourceFile($path);
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
			$templateId = $pdf->importPage($pageNo);
			// get the size of the imported page
			$size = $pdf->getTemplateSize($templateId);
		 	
			// create a page (landscape or portrait depending on the imported page size)
			if ($size['w'] > $size['h']) {
				$pdf->AddPage('L', array($size['w'], $size['h']));
			} else {
				$pdf->AddPage('P', array($size['w'], $size['h']));
			}
			$pdf->useTemplate($templateId);
			$pdf->Image($barcodePath,$size['w']-25,0,-0);
			/* Halbado con Ricardo y Paco Diaz, la tarjeta sin foto ni nombre
			if ($user->foto !=null)
			{
			    if( file_put_contents(Yii::getAlias('@app').'/plantillas/foto'.$user->id.'.png',$user->foto)!==false )
			    {
			        $pdf->Image(Yii::getAlias('@app').'/plantillas/foto'.$user->id.'.png',5,4.5,27);
			        unlink(Yii::getAlias('@app').'/plantillas/foto'.$user->id.'.png');
			    }
			}
			
			$pdf->Text(5,  $size['h']-9, utf8_decode($user->nombre));
			$pdf->Text(5,  $size['h']-4,   utf8_decode($user->apellidos));
			*/
		}
		
		
		return $pdf->Output('test.pdf',$outputType);
		
	}

	public static function GenerarTarjetasEstacion ($codigosInspector = [])
	{
		$pdf = new \FPDI();
		
		
		
		foreach ($codigosInspector as $key => $codigoInspector) {
			$generator = new barcode();
			$image = $generator->render_image('code-128', $codigoInspector, ['w' => 200]);
			$image= imagerotate($image,-90.0,0);
			imagepng($image,'barcode'.$codigoInspector.'.png');
			$aux = PDF::GenerarPDFSalida(null, 'barcode'.$codigoInspector.'.png','S');
			$myfile = fopen($codigoInspector.".pdf", "w");
			fwrite($myfile, $aux);
			fclose($myfile);
			$pageCount = $pdf->setSourceFile($codigoInspector.".pdf");
			$templateId = $pdf->ImportPage(1);
			$size = $pdf->getTemplateSize($templateId);
			if ($size['w'] > $size['h']) {
				$pdf->AddPage('L', array($size['w'], $size['h']));
			} else {
				$pdf->AddPage('P', array($size['w'], $size['h']));
			}
            $pdf->useTemplate($templateId);
			
			
			
			
			imagedestroy($image);
			unlink($codigoInspector.".pdf");
		}
		
		return $pdf->Output('test.pdf','S');
		
		
		
		
		
	}	
}

?>