<?php

namespace app\models;

use yii\base\Model;

class UploadForm extends Model
{
    public $htmlFile;

    public function rules()
    {
        return [
            [['htmlFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'html'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->htmlFile->saveAs(__DIR__ . '/../uploads/' . $this->htmlFile->baseName . '.' . $this->htmlFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
