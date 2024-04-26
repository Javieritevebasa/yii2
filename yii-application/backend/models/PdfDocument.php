<?php
namespace backend\models;

use Yii;

require_once(Yii::getAlias('@app').'/../vendor/tecnickcom/tcpdf/tcpdf.php');
require_once(Yii::getAlias('@app').'/../vendor/setasign2/fpdi/fpdi.php');

class PDFDocument extends \TCPDFFPDI {
 /**
 * "Remembers" the template id of the imported page
 */
 var $_tplId;
 
 /**
 * include a background template for every page
 */
 function Header() {
	 if (is_null($this->_tplId)) {
	 	 $path = Yii::getAlias('@app').'/plantillas/IFO010203ed4_blanco.pdf';
			//die($path);
		if(!file_exists($path)) { echo 'ups'; return;}
			//echo $path;
			
		
		$numPages = $this->setSourceFile($path);
			
		 $this->_tplId = $this->importPage(1);
	 }
	 
	 $size = $this->useImportedPage($this->tplId, 130, 5, 60);
	 
	 $this->SetFont('freesans', 'B', 9);
	 $this->SetTextColor(255);
	 $this->SetXY(60.5, 24.8);
	 $this->Cell(0, 8.6, "TCPDF and FPDI");
 }
 
 function Footer() {}
}