<?php
// prints css links
if (!function_exists('printCss')) {
   function printCss($sheets)
   {
       if (is_array($sheets)) {
            $sheetsHtml = '';
            for ($i = 0; $i < count($sheets); $i++) {
                if (file_exists(public_path($sheets[$i])) || filter_var($sheets[$i],FILTER_VALIDATE_URL)) {
                    $sheetsHtml = $sheetsHtml . '<link rel="stylesheet" type="text/css" href="'.asset($sheets[$i]).'">';
                } else {
                    throw new Exception('Asset file does not exist, file name: '. $sheets[$i]);
                }
            }
            return $sheetsHtml;
       } else {
           throw new Exception('Sheets given are not an array.');
       }
   }
}
//print script includes
if (!function_exists('printScript')) {
    function printScript($scripts)
    {
        if (is_array($scripts)) {
            $scriptsHtml = '';
            for ($i=0 ; $i < count($scripts); $i++) {
                if (file_exists(public_path($scripts[$i])) || filter_var($scripts[$i],FILTER_VALIDATE_URL)) {
                    $scriptsHtml = $scriptsHtml . '<script  src="'.asset($scripts[$i]).'"></script>';
                } else {
                    throw new Exception('Asset file does not exist, file name: '.$scripts[$i]);
                }
            }
            return $scriptsHtml;
        }  else {
            throw new Exception('Scripts given are not an array.');
        }
    }
}
//check if route name is active
if (!function_exists('isActiveRoute')) {
   function isActiveRoute($route)
   {
        if (Route::currentRouteName() == $route) {
            return true;
        } else {
            return false;
        }
   }
}
//get Model Fillable columns
if (!function_exists('getModelFillables')) {
    function getModelFillables($modelName)
    {
        return app()->make($modelName)->getFillable();
    }
}
// set numbers to alpha notation
if (!function_exists('numToAlpha')) {
    function numToAlpha ($number)
    {
        if (is_numeric($number)) {
            $number = intval($number);
            $letter = '';
            if ($number > 0) {
               while ($number != 0) {
                   $p = ($number -1 ) % 26;
                   $number = intval(($number - $p) / 26);
                   $letter = chr(65 + $p) . $letter;
               }
            }
            return $letter;
        } else {
            throw new Exception('Variable must be numeric.');
        }
    }
}
//get model from table name if exists
if (!function_exists('getModelFromTableName')) {
    function getModelFromTableName ($tableName)
    {
        foreach (get_declared_classes() as $class) {
            if (is_subclass_of($class, 'Illuminate\Database\Eloquent\Model')) {
                $model = new $class;
                if ($model->getTable() === $tableName) {
                   return $model;
                }
            }
        }
        return false;
    }
}
//get date in Y-m-d format
if (!function_exists('getFormattedDate')) {
    function getFormattedDate($date)
    {
        if (stristr($date,'/')) {
            $delimiter = '/';
        } elseif (stristr($date,'.')) {
            $delimiter = '.';
        } else {
            $delimiter = '-';
        }
        $auxArray = explode($delimiter,$date);
        if (is_array($auxArray) && count($auxArray) == 3) {
            if (strlen($auxArray[0]) == 4) {
                $auxArray[1] = substr("0{$auxArray[1]}", -2);
                $auxArray[2] = substr("0{$auxArray[2]}", -2);
                return implode('-',$auxArray);
            } else {
                $auxArray[0] = substr("0{$auxArray[0]}", -2);
                $auxArray[1] = substr("0{$auxArray[1]}", -2);
                return implode('-',array_reverse($auxArray));
            }
        } else {
            return '0000-00-00';
        }
    }
}
//unique multidimensional array
if (!function_exists('uniqueMultidimensionalArray')) {
    function uniqueMultidimensionalArray($array,$key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();
        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}
//  get numbers from string
if (!function_exists('getNumbersFromString')) {
    function getNumbersFromString($string)
    {
        return array_filter(
            preg_split('/[^0-9]+/i', $string),
            function ($item) {
                if ($item == '') {
                   return false;
                } else {
                    return true;
                }
            }
        );
    }
}
if (!function_exists('makeValidation')) {
    function makeValidation($form,$url,$aditionals = '')
    {
        return view('layouts.validations.form-validation',compact(['form','url','aditionals']));
    }
}

if (!function_exists('validateHours')) {
    function validateHours($select_hour_end, $select_minute_end,$select_hour_start, $select_minute_start, $form)
    {
        return view('layouts.validations.select-hour-validation',compact(['select_hour_end', 'select_minute_end','select_hour_start','select_minute_start', 'form']));
    }
}

if (!function_exists('hideInput')) {
    function hideInput($from_id,$to_id,$from_input_id, $to_input_id,$form)
    {
        return view('layouts.validations.manual-input-validation',compact(['from_id','to_id','from_input_id','to_input_id','form']));
    }
}

if (!function_exists('getUserName')) {
    function getUserName()
    {
        $sentinelUser = Sentinel::getUser();
        return $sentinelUser->first_name." ".$sentinelUser->last_name;
    }
}

if(!function_exists('numberWithLeadZero')) {
    function numberWithLeadZero($number)
    {
        return substr("0{$number}", -2);
    }
}
