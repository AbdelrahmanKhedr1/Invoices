<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use App\Models\Status;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:invoices report', ['only' => ['index','search']]);
        $this->middleware('permission:customer report', ['only' => ['customer', 'search_customer']]);
    }



    public function index() {
        $status = Status::all();
        return view('reports.index',compact('status'));
    }

    public function search(Request $request){
        $radio = $request->radio;
        if($radio == '1'){
            if($request->type && $request->start_at == '' && $request->end_at == ''){
                $invoices = Invoice::select('*')->where('status_id',$request->type)->get();
                $status = Status::all();
                $type = Status::where('id',$request->type)->get();
                return view('reports.index',compact('type','invoices','status'));
            }else{
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $invoices = Invoice::select('*')->whereBetween('created_at',[$start_at,$end_at])->where('status_id',$request->type)->get();
                $status = Status::all();
                $type = Status::where('id',$request->type)->get();
                return view('reports.index',compact('type','invoices','status','end_at','start_at'));

            }
        }else{
            $invoices = Invoice::select('*')->where('invoice_number',$request->invoice_number)->get();
            $status = Status::all();
            return view('reports.index',compact('status','invoices'));
        }
    }

    public function customer(){
        $sections = Section::all();
        return view('reports.customer',compact('sections'));
    }

    function search_customer(Request $request){
        if ($request->section && $request->product && $request->start_at == '' && $request->end_at == '') {
            $invoices = Invoice::select('*')->where('section_id',$request->section)->where('product',$request->product)->get();
            $sections = Section::all();
            return view('reports.customer', compact('invoices','sections'));
        }else{
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $invoices = Invoice::select('*')->whereBetween('created_at',[$start_at,$end_at])->where('section_id',$request->section)->where('product',$request->product)->get();
            $sections = Section::all();
            return view('reports.customer', compact('invoices','sections','end_at','start_at'));
        }
    }
}
