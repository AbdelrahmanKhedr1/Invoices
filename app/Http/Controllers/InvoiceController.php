<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Http\Requests\invoice\InvoicesCreate;
use App\Http\Requests\invoice\InvoicesEdit;
use App\Models\Invoice;
use App\Models\Section;
use App\Models\Status;
use App\Models\User;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:invoices list', ['only' => ['index']]);
        $this->middleware('permission:add invoice', ['only' => ['create', 'store']]);
        $this->middleware('permission:invoice edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete invoice', ['only' => ['destroy']]);
        $this->middleware('permission:show invoice', ['only' => ['show']]);
        $this->middleware('permission:invoice force', ['only' => ['force']]);
        $this->middleware('permission:invoice restore', ['only' => ['restore']]);
        $this->middleware('permission:invoice trashed', ['only' => ['trashed']]);
        $this->middleware('permission:print invoice', ['only' => ['print']]);
        $this->middleware('permission:invoices status', ['only' => ['status']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = Status::all();
        $sections = Section::all();
        return view('invoices.invoices_create',compact('sections','status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoicesCreate $request)
    {
        $data = $request->validated();
        $data['user'] = Auth::user()->name;
        if($request->hasFile('file')){
            $data['file'] = request()->file('file')->store('invoicesAttachment/'. $request->invoice_number);
        }
        $invoice = Invoice::create($data);
        $owners = User::where('id','!=',Auth::user()->id)->get();
        $creater = Auth::user()->name;
        Notification::send($owners,new AddInvoice($invoice->id,$invoice->invoice_number,$creater));
        session()->flash('Add');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoices.invoices_show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = Status::all();
        $sections = Section::all();
        $invoice = Invoice::findOrFail($id);
        return view('invoices.invoices_edit',compact('invoice','sections','status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoicesEdit $request, string $id)
    {

        $test = Invoice::findOrFail($id);
        $data = $request->validated();

        if($request->hasFile('file')){
            if(!empty($test->file) && Storage::exists($test->file)){
                Storage::delete($test->file);
            }
            $data['file'] = request()->file('file')->store('invoicesAttachment/'. $request->invoice_number);
        }else{
            unset($data['file']);
        }
        
        $test->update($data);
        session()->flash('Edit');
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Invoice::where('id',$id)->delete();
        session()->flash('Delete');
        return redirect('/invoices');


    }

    public function getProducts($id){
        $product = DB::table('products')->where('section_id',$id)->pluck('product_name','id');
        return json_encode($product);
    }

    public function force(string $id)
    {
        $test = Invoice::withTrashed()->findOrFail($id);
        if(!empty($test->file) && Storage::exists($test->file)){
            Storage::delete($test->file);
            if(empty(Storage::files('invoicesAttachment/'. $test->invoice_number))){
                Storage::deleteDirectory('invoicesAttachment/' .$test->invoice_number);
            }
        }
        $test->forceDelete();
        session()->flash('force');
        return back();
    }

    public function restore(string $id)
    {
        Invoice::where('id',$id)->restore();
        session()->flash('restore');
        return back();
    }

    public function trashed(){

        $invoices = Invoice::onlyTrashed()->get();
        return view('invoices.invoices_trashed',compact('invoices'));
    }

    public function print(string $id){
        $invoice = Invoice::findOrfail($id);
        return view('invoices.invoices_print',compact('invoice'));
    }

    public function status(string $id){
        $invoices = Invoice::where('status_id',$id)->get();
        return view('invoices.invoices_status',compact('invoices'));
    }

    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function notifi($id){
        auth()->user()->unreadNotifications->where('id',$id)->delete();
        return back();
    }

    public function readall()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }

}
