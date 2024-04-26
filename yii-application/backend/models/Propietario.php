<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


class Propietario extends \yii\db\ActiveRecord
{
	public $propietarioNombre;
	
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['propietarioNombre', ], 'safe'],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'propietarioNombre' => 'Nombre',
        ];
    }
	
	

	
		
}
