<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\web\View;


/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Evidencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evidencia-form-subir-evidencias">
	<table class="table">
		<thead>
			<tr>
				<th>
					Evidencia Código
				</th>
				<th>
					Descripción
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($evidencias as $evidencia) : ?>
				<tr>
					<td><?= $evidencia->codigoEvidencia?></td>
					<td><?= $evidencia->descripcion?></td>
					<td>
						<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['evidencia/delete', 'id' => $evidencia->id], [
							           'class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar',
							            'data' => [
						                'confirm' => '¿Estás seguro que quieres eliminarlo',
						                'method' => 'post',
						            ],
								]) ?>
					</td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td>
					
				</td>
			</tr>
		</tbody>
	</table>
	
	
	<div class="container-fluid">
	    <?php $form = ActiveForm::begin([
			                'options' => [
			                    'id' => 	'form-subir-evidencias',
			                    'method'  =>'POST',
			                    'enctype' =>'multipart/form-data',
			                    'class' => 'form-inline'
			                ]
	                	]); ?>
		<div class="form-group">
			<?= $form->field($model, 'descripcion')->textInput(['class' =>'form-control']) ?>
		</div>
		<div class="form-group">
			<?= $form->field($model, 'imageFile')->fileInput([ 'class' =>'form-control']) ?>
		</div>	
		<div class="table-responsive">
			<table id="uploadFiles" class="table table-condensed">
				<tbody>
					
				</tbody>
			</table>
		</div>
		<button class="btn btn-primary pull-right" type="button">Subir</button>
		
			
	    <?php ActiveForm::end(); ?>
	</div>
</div>

<?php
$accionId = $model->accionId;
$script=<<<EOT
	function TransferCompleteCallback(f){
			
		var content = f.target.result;
		$('table#uploadFiles tbody').append(`<tr>
									<td><img src="`+content+`" width="100px"/></td>
									
									<td width="100%">
									<div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									    <span class="sr-only">0% Complete</span>
									  </div>
									</div
									</td>
								</tr>`);
    }
	
	
	$(document).ready(function(){
		
		
		var formdata = false;
        if (window.FormData) {
        	formdata = new FormData();
        }
        
        $('form#form-subir-evidencias').on('submit', function(e){
        	e.preventDefault();
        	return;
        });
        
        $('input[name="SubirEvidencias[imageFile]"]').on('change', function(){
			console.log('changeEvent');
			var i = 0, len = this.files.length, img, reader, file;
			for ( ; i < len; i++ ) {
	        	file = this.files[i];
	        	console.log(file.name);
	        	if ( window.FileReader ) {
	            	reader = new FileReader();
	                reader.onloadend = function (e) { TransferCompleteCallback(e); };
	                if (file.type!="video/mp4")
	                	reader.readAsDataURL(file);
	            }
	            if (formdata) {
	            	formdata.append("files[]", file);
	            }
	        }
		});
		
		$('button').on('click', function() {
			var formData = new FormData($('form#form-subir-evidencias')[0]);
			formData.append('SubirEvidencias[descripcion]',$('input[name="SubirEvidencias[descripcion]"]').val());
		    $.ajax({
		        // Your server script to process the upload
		        url: 'http://192.168.23.40:8082/backend/index.php?r=sisgesdev/evidencia/subir-evidencias&accionId=$accionId',
		        type: 'POST',
		
		        // Form data
		        data: formData ,
				
		        // Tell jQuery not to process data or worry about content-type
		        // You *must* include these options!
		        cache: false,
		        contentType: false,
		        processData: false,
		        success: function(data){
		        	formData= false;
					$('form#form-subir-evidencias').trigger('reset');
					 $('#modal').modal('show')
                    .find('#modalContent')
                    .load('http://192.168.23.40:8082/backend/index.php?r=sisgesdev/evidencia/subir-evidencias&accionId=$accionId');
					//$('.showModalButton').trigger('click');	
		        },
				error: function(data){
					console.log(data);
					
					e = jQuery.parseJSON(data.responseText);

   					jQuery.each(e, function(key, value) { jQuery('#subirevidencias-'+key).next('.help-block').show().html(value.toString()); });
					
				},
		        // Custom XMLHttpRequest
		        xhr: function() {
		            var myXhr = $.ajaxSettings.xhr();
		            if (myXhr.upload) {
		                // For handling the progress of the upload
		                myXhr.upload.addEventListener('progress', function(e) {
		                    if (e.lengthComputable) {
		                    	var currentProgress = Math.round( ((e.loaded * 100) / e.total) * 10 ) / 10; 
								
		                        $('.progress-bar').css("width", currentProgress + "%")
						        	.attr("aria-valuenow", currentProgress)
							      	.text(currentProgress + "% Complete");
		                    }
		                } , false);
		            }
		            return myXhr;
		        }
	    });
});
			
	});
	
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>