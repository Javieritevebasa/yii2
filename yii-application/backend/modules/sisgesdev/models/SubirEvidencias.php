<?php

namespace backend\modules\sisgesdev\models;

use Yii;
use yii\base\Model;


class SubirEvidencias extends Model
{
   
    /**
     * @var UploadedFile
     */
    public $rutaTmp = '/var/www/tickadas/backend/web/uploads/';
    public $imageFile;
	public $accionId;
	public $descripcion;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, pdf, mp4'],
            [['descripcion'], 'string', ],
            [['accionId'], 'integer', ],
        ];
    }
    
	 public function attributeLabels()
    {
        return [
            'imageFile' => 'Fichero a subir',
            'descripcion' => 'Breve descripción',
            'accionId' => 'Acción Id',
           
        ];
    }
	
	public function upload()
    {
    	
        if ($this->validate()) {
           $this->imageFile->saveAs($this->rutaTmp  . $this->imageFile->baseName . '.' . $this->imageFile->extension);
		   return true;
        } else {
        	 
           return false;
        }
    }
	
	
    public function uploadMultiple()
    {
    	
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $file->saveAs($this->rutaTmp . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
        	
            return false;
        }
    }

    
}
