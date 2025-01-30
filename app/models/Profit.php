<?php

namespace app\models;

use yii\base\Model;

class Profit extends Model
{
    public $ticketId;
    public $profit;

    public function rules()
    {
        return [
            [['ticketId', 'profit'], 'required'],
            [['ticketId'], 'integer'],
            [['profit'], 'double'],
        ];
    }

    public function setData(string $ticketId, string $profit): bool
    {
        $this->ticketId = $ticketId;
        $this->profit = $profit;
        if (!$this->validate()) {
            return false;
        }
        $this->ticketId = (int)$ticketId;
        $this->profit = (float)$profit;
        return true;
    }
}