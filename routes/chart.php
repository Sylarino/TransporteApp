<?php
Route::group(['middleware' => 'auth'], function() {

    Route::get('chartView/{view}', function ($view,\Illuminate\Http\Request $params){
        if(count($params->all()) > 0) {
            $params = explode('?',$params->fullUrl())[1];
        } else {
            $params = '';
        }
        return view('charts.'.camel_case($view), compact(['view','params']));
    });

    Route::get('chart/{view}',function($view,\Illuminate\Http\Request $params){
        $controller = app()->make('App\Http\Chart\Controllers\\'.studly_case($view).'ChartController');
        return $controller->callAction('getData', ['params'=>$params]);
    });
});
