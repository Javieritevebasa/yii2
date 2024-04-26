<?php




use Yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->title = 'Intranet Itevebasa';
?>
<div class="site-index">

   <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
            	
            	
            	<?php if ( in_array('0', ArrayHelper::getColumn( Yii::$app->user->identity->idGrupos, 'idGrupo') ) ) : ?>
					<?php //= Yii::$app->runAction('gran-ojo/dashboard', []); ?>
					<?php //= $this->render('//gran-ojo/vencimientos', [], $this->context) ?>
				<?php else : ?>
	                <h2>Bienvenido</h2>
	
	               
                <?php endif; ?>
            </div>
            
        </div>

    </div>
</div>
