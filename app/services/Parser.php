<?php

namespace app\services;

use app\models\Profit;

class Parser
{
    public static function parseProfitHtml(string $content): array
    {
        $ret = [];
        $dom = \phpQuery::newDocument($content);
        $profitObj = new Profit();
        $profit = 0;
        foreach ($dom->find("tr") as $tr) {
            $tdItems = pq($tr)->find("td")->elements;
            $ticketItem = $tdItems[0];
            $profitItem = $tdItems[count($tdItems) - 1];
            if (!$profitObj->setData($ticketItem->textContent, $profitItem->textContent)) {
                continue;
            }
            $profit += $profitObj->profit;
            $ret[$profitObj->ticketId] = $profit;
        }
        return $ret;
    }
}
