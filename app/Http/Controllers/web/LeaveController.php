<?php


namespace App\Http\Controllers\web;


use App\Http\Controllers\Controller;
use App\Models\LeaveType;

class LeaveController extends Controller
{
    public function doApply()
    {
        $leaves = LeaveType::get();
        return view('hrms.leave.apply_leave', compact('leaves'));
    }
}
