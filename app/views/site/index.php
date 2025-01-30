<?php

/** @var yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use miloschuman\highcharts\Highcharts;

?>
<div>
    <p>
        Загрузите файлик, содержащий изменения прибыли в зависимости от совершённых сделок
    </p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($model, 'htmlFile')->fileInput() ?>

            <button>Загрузить</button>

            <?php ActiveForm::end() ?>

        </div>
    </div>

    <hr>

    <?php
    if (!empty($error)) {
        echo "<p>{$error}</p>";
    } elseif (count($data) > 0) {
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Баланс по операциям'],
                'xAxis' => [
                    'categories' => array_keys($data),
                ],
                'yAxis' => [
                    'title' => ['text' => 'Сумма, руб']
                ],
                'series' => [['name' => 'Баланс', 'data' => array_values($data)]],
            ],
        ]);
    }
    ?>

</div>
