<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

use common\models\Estacion;
/**
 * ContactForm is the model behind the contact form.
 */
class Colas extends Model
{
    public $codigoEstacion;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }


	public function getEstacion()
    {
    
        return Estacion::find()->where(['codigo' => $this->codigoEstacion])->one();
    }

    
}
