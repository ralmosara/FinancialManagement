<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisbursementVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_name',
        'date' ,
        'dv_no' ,
        'mode_of_payment',
        'payee',
        'address',
        'particulars',
        'responsibility_center',
        'mfo_pap' ,
        'amount',
        'accounting_head_name',
        'agency_head_name',
    ];

    public function payee()
    {
        return $this->belongsTo(Payee::class);
    }
    public function accountingEntries()
    {
        return $this->hasMany(AccountingEntry::class);
    }
}
