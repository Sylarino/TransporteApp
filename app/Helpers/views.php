<?php

if (!function_exists('makeDefaultView')) {
    function makeDefaultView($cols,$entity)
    {
        return view('default.crud.index',compact(['cols','entity']));
    }
}

if (!function_exists('idField')) {
   function idField($id)
   {
       return '<input type="hidden" name="id" id="id" value="'.$id.'">';
   }
}
