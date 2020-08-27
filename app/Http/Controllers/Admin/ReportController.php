<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Order;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function todayOrder()
    {
        $bladeTitle = "Today's Order";
        $today = date('d-m-y');
        $order = Order::where('status',0)->where('date',$today)->get();

        return view('admin.report.report',compact('order','bladeTitle'));

    }

    public function todayDelivery()
    {
        $bladeTitle = "Today's Delivery";
        $today = date('d-m-y');
        $order = Order::where('status',3)->where('date',$today)->get();

        return view('admin.report.report',compact('order','bladeTitle'));

    }

    public function thisMonth()
    {
        $bladeTitle = "This Month's Report (".date('F')."-".date('Y').")";
        $month = date('F');
        $year = date('Y');
        $order = Order::where('status',3)->where('month',$month)->where('year',$year)->get();

        return view('admin.report.report',compact('order','bladeTitle'));
    }

    public function search()
    {
        return view('admin.report.search');
    }

    public function date(Request $request)
    {
        $date = $request->date;
        $newDate = date('d-m-y',strtotime($date));
        
        $total = Order::where('status',3)->where('date',$newDate)->sum('total');
        $order = Order::where('status',3)->where('date',$newDate)->get();

        $bladeTitle = "Report Of The Date:".$newDate."(Total:".$total.")";
        return view('admin.report.search_result',compact('order','bladeTitle'));
    }

    public function monthYear(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        if($year == ""){
            $year = date('Y');
        }
        $total = Order::where('status',3)->where('month',$month)->where('year',$year)->sum('total');
        $order = Order::where('status',3)->where('month',$month)->where('year',$year)->get();

        if($month == ""){
            $total = Order::where('status',3)->where('year',$year)->sum('total');
            $order = Order::where('status',3)->where('year',$year)->get();
        }
        $bladeTitle = "Report for:".$month."-".$year."(Total:".$total.")";
        return view('admin.report.search_result',compact('order','bladeTitle'));
    }
}
