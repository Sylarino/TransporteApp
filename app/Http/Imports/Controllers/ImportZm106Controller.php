<?php

namespace App\Http\Imports\Controllers;


use App\Domain\Supplier\PurchasingOrder\Item\Breakdown\Breakdown;
use App\Http\Imports\ImportAbstract;
use App\Http\Supplier\Orders\Items\Events\DeleteCompletedBreakdown;

class ImportZm106Controller extends ImportAbstract
{
    public function beforeLoad($id)
    {
        return Breakdown::where('is_pending',1)->update('is_pending',0);
    }

    public function processRecord($record)
    {
        $line_key = implode('-',[$record['order_number'],$record['position']]);
        $items = Breakdown::byShortKey($line_key);
        $delivered_at = (trim(str_replace('.','',$record['delivered_at'])) != '')?getFormattedDate($record['delivered_at']):null;
        if (count($items) > 0) {
            foreach ($items as $item)
            {
                Breakdown::find($item->id)->update([
                    'delivery_date' => getFormattedDate($record['delivery_date']),
                    'is_confirmed' => ($record['confirmed'] != '')?1:0,
                    'has_asn' => ($record['asn'] != '') ? 1:0,
                    'delivered_at' => $delivered_at,
                    'is_pending' => 1
                ]);
            }
        }
        $this->markAsDoned($record['id']);
    }

    public function afterLoad($id)
    {
        $breakdowns = Breakdown::where('is_pending',0)->get();
        foreach($breakdowns as $breakdown) {
            event(new DeleteCompletedBreakdown($breakdown));
        }
    }
}
