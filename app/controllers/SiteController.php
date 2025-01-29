<?php

namespace app\controllers;

use app\models\UploadForm;
use yii\web\Controller;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new UploadForm();
        $error = '';
        if (\Yii::$app->request->isPost) {
            $model->htmlFile = UploadedFile::getInstance($model, 'htmlFile');
            if ($model->upload()) {
                // file is uploaded successfully
            }
        }
        return $this->render('index', [
            'model' => $model,
            'error' => $error,
        ]);
    }
}
