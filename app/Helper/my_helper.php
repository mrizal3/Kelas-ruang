<?php

use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

function createTable($data) {
    return DataTables::of($data)
        ->addIndexColumn()
        ->make(true);
}

function getUser() {
    return auth()->user();
}

function setResponse($data) {
    return response()->json([
        'status' => true,
        'data' => $data
    ]);
}

function getUri($uri)
{
    return request()->segment($uri);
}

function dayFormatIndo($number)
{
    $array = ['Senin', 'Selesa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    foreach ($array as $key => $value) {
        if ($number == $key+1) {
            return $value;
        }
    }
}

function active_class($uri, $name) {
    return $uri == $name ? 'active' : '';
}

function formatDate($date) 
{
    return Carbon::parse($date)->isoFormat('dddd, D MMMM Y');
}

function formatDate2($date)
{
    return Carbon::parse($date)->format('d/m/Y H:i');
}

function formatDate3($date)
{
    return Carbon::parse($date)->format('d');
}

function formatDate4($date)
{
    return Carbon::parse($date)->isoFormat('D MMMM Y');
}

function timeFormat($date)
{
    return Carbon::parse($date)->format('H:i');
}

function checkHari($date) {
    return $weekday = date('N', strtotime($date));
}
