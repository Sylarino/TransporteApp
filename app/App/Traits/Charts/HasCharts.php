<?php

namespace App\App\Traits\Charts;

use Carbon\Carbon;

trait HasCharts
{
    public function transformData($data)
    {
        $array = array();
        foreach ($data as $key => $column) {
            array_push($array,[
                strtotime($column->y)*1000,
                $column->param
            ]);
        }

        return $array;
    }

    public function getJsonEncoded($series)
    {
        return json_encode($series,JSON_NUMERIC_CHECK);
    }

    public function makeGoalLine($data,$goal)
    {
        $array = array();
        foreach ($data as $key => $column) {
            array_push($array, [
                 (strtotime($column->y))*1000,
                  $goal
            ]);
        }
        return $array;
    }

    public function resolveParams(Request $params)
    {
        if(count($params->all()) > 0) {
            $params = explode('?',$params->fullUrl())[1];
        } else {
            $params = '';
        }

        return $params;
    }
}
