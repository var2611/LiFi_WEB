@if ($refresh ?? false)
    <?php
    $url1 = $_SERVER['REQUEST_URI'];
//    header("Refresh: 5; URL=$url1");
    ?>
@endif

@extends('layouts.main_hr')
@extends('includes.header')
@extends('includes.sidemenu')
