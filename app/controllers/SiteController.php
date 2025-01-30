<?php

namespace app\controllers;

use app\models\UploadForm;
use app\services\Parser;
use yii\web\Controller;

class SiteController extends Controller
{
    private UploadForm $model;
    private string $error = '';

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->model = new UploadForm();
        $data = [];
        if (\Yii::$app->request->isPost) {
            $data = $this->process();
        }
        return $this->render('index', [
            'model' => $this->model,
            'error' => $this->error,
            'data' => $data,
        ]);
    }

    private function process(): array
    {
        if (!$this->model->upload()) {
            $this->error = 'Файлик не загружен. График не может быть построен';
            return [];
        }
        $data = Parser::parseProfitHtml($this->model->getContent());
        if (count($data) === 0) {
            $this->error = 'Данные в контенте не обнаружены. График не может быть построен';
            return [];
        }
        return $data;
    }
}
