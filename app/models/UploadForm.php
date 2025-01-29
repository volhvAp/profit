<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $htmlFile;
    private string $content = '';

    public function rules()
    {
        return [
            [['htmlFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'html'],
        ];
    }

    public function upload()
    {
        $this->htmlFile = UploadedFile::getInstance($this, 'htmlFile');
        if ($this->validate()) {
            $this->content = file_get_contents($this->htmlFile->tempName);
            return true;
        } else {
            return false;
        }
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
