<?php

declare(strict_types=1);

namespace app\bootstrap;

use yii\base\BootstrapInterface;

class AppBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        \Yii::$app->name = 'PROFIT';
    }
}
