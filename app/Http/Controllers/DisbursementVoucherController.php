<?php

namespace App\Http\Controllers;

use App\Models\DisbursementVoucher;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Payee;
use App\Models\FundCluster;
use App\Models\ResponsibilityCenter;
use Barryvdh\DomPDF\Facade\Pdf;
class DisbursementVoucherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $vouchers = DisbursementVoucher::query()
            ->when($search, function ($query, $search) {
                $query->where('dv_no', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhere('payee', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%");
            })
            ->paginate(10);

        if ($search) {
            $vouchers->appends(['search' => $search]);
        }

        return Inertia::render('DisbursementVouchers/Index', [
            'vouchers' => $vouchers,
            'filters' => $request->only('search'),
        ]);
    }
    public function create()
    {
        $payees = Payee::all(['id', 'name']); // Fetch all payees
        $fundClusters = FundCluster::all(['id', 'name']);
        $responsibilityCenters = ResponsibilityCenter::select('id', 'name')->limit(2)->get();
        return Inertia::render('DisbursementVouchers/Create', [
            'payees' => $payees,
            'fundClusters'=>$fundClusters,
            'responsibilityCenters' =>$responsibilityCenters
        ]);
       // return Inertia::render('DisbursementVouchers/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'entity_name' => 'required',
            'date' => 'required|date',
            'dv_no' => 'required',
            'mode_of_payment' => 'required',
            'payee_id' => 'exists:payees,id',
            'address' => 'required',
            'particulars' => 'required',
            'responsibility_center' => 'required',
            'mfo_pap' => 'required',
            'amount' => 'required|numeric',
           // 'supervisor_name' => 'required',
           // 'supervisor_designation' => 'required',
            //'accounting_entries' => 'required|json',
            'accounting_head_name' => 'required',
            'agency_head_name' => 'required',


            'accounting_entries' => 'required|array|min:1',
            'accounting_entries.*.account_title' => 'required|string',
            'accounting_entries.*.uacs_code' => 'required|string',
            'accounting_entries.*.debit' => 'required|numeric|min:0',
            'accounting_entries.*.credit' => 'required|numeric|min:0',
        ]);

        $voucher =  DisbursementVoucher::create($validated);

        foreach ($validated['accounting_entries'] as $entry) {
            $voucher->accountingEntries()->create($entry);
        }

        return redirect()->route('disbursement-vouchers.index');
    }

    public function show(DisbursementVoucher $disbursementVoucher)
    {
        return Inertia::render('DisbursementVouchers/Show', ['voucher' => $disbursementVoucher]);
    }
    public function generatePdf($id)
    {

        $dv = DisbursementVoucher::with('accountingEntries')->findOrFail($id);
        
        $pdf = PDF::loadView('disbursement_voucher_pdf', ['dv' => $dv]);
        
        return $pdf->stream('disbursement_voucher.pdf');
    }
}