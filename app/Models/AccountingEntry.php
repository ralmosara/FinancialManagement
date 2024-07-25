<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_title',
        'uacs_code',
        'debit',
        'credit',
        'disbursement_voucher_id'
    ];

    public function disbursementVoucher()
    {
        return $this->belongsTo(DisbursementVoucher::class);
    }
}
