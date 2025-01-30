<?php

namespace app\services;

use app\models\Profit;

class Parser
{
    public static function parseHtml(string $content): array
    {
        $ret = [];
        $dom = \phpQuery::newDocument($content);
        $profitObj = new Profit();
        foreach ($dom->find("tr") as $tr) {
            $tdItems = pq($tr)->find("td")->elements;
            $ticketItem = $tdItems[0];
            $profitItem = $tdItems[count($tdItems) - 1];
            if (!$profitObj->setData($ticketItem->textContent, $profitItem->textContent)) {
                continue;
            }
            $ret[$profitObj->ticketId] = $profitObj->profit;
        }
        return $ret;
    }
}
