<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disbursement Voucher</title>
    <style>
        body { font-family: 'Times New Roman', sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .no-border { border: none; }
        /* .header { background-color: #f0f0f0; padding: 10px; }
        .footer { background-color: #f0f0f0; padding: 10px; } */
    </style>
</head>
<body>
   
    <div class="header">
        <p style="font-family: 'Times New Roman', Times, serif; font-size: 14px; text-align: right;">APPENDIX 32</p>
    </div>
    
    <table style="width:100%;">
        <tr>
            <td rowspan="3" colspan="3" style="width: 75%; text-align: center; vertical-align: middle;">
                <p style="font-family: 'Times New Roman', Times, serif; font-size: 11px;font-weight: bold;">Entity Name</p>
                <p style="font-family: 'Times New Roman', Times, serif; font-size: 14px;font-weight: bold;">DISBURSEMENT VOUCHER</p>
            </td>
            <td rowspan="3" colspan="1" style="width: 25%;">
                <div>
                    <strong>FUND CLUSTER:</strong> {{ $dv->fund_cluster }}<br>
                </div>
                <div>
                    <strong>DATE:</strong> {{ $dv->date }}<br>
                    <strong>ENTITY NAME:</strong> {{ $dv->entity_name }}<br>
                </div>
                <div>
                    <strong>DV NO.:</strong> {{ $dv->dv_no }}
                </div>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="4">MODE OF PAYMENT:</td>
        </tr>
        <tr>
            <td><input type="checkbox" {{ $dv->mode_of_payment == 'MDS Check' ? 'checked' : '' }}> MDS Check</td>
            <td><input type="checkbox" {{ $dv->mode_of_payment == 'Commercial Check' ? 'checked' : '' }}> Commercial Check</td>
            <td><input type="checkbox" {{ $dv->mode_of_payment == 'ADA' ? 'checked' : '' }}> ADA</td>
            <td><input type="checkbox" {{ $dv->mode_of_payment == 'Others' ? 'checked' : '' }}> Others (Please specify): {{ $dv->other_payment_mode }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td>PAYEE:</td>
            <td>{{ $dv->payee }}</td>
        </tr>
        <tr>
            <td>TIN/EMPLOYEE NO.:</td>
            <td>{{ $dv->tin_employee_no }}</td>
        </tr>
        <tr>
            <td>ORS/BURS NO.:</td>
            <td>{{ $dv->ors_burs_no }}</td>
        </tr>
        <tr>
            <td>ADDRESS:</td>
            <td>{{ $dv->address }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>PARTICULARS</th>
            <th>RESPONSIBILITY CENTER</th>
            <th>MFO/PAP</th>
            <th>AMOUNT</th>
        </tr>
        <tr>
            <td>{{ $dv->particulars }}</td>
            <td>{{ $dv->responsibility_center }}</td>
            <td>{{ $dv->mfo_pap }}</td>
            <td class="text-right">{{ number_format($dv->amount, 2) }}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">AMOUNT DUE</td>
            <td class="text-right">{{ number_format($dv->amount, 2) }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="2">
                <strong>A. CERTIFIED:</strong> Expenses/Cash Advance necessary, lawful and incurred under my direct supervision.
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-center">
                <br><br>
                ________________________________________<br>
                Printed Name, Designation and Signature of Supervisor
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="4"><strong>B. ACCOUNTING ENTRY:</strong></td>
        </tr>
        <tr>
            <th>ACCOUNT TITLE</th>
            <th>UACS CODE</th>
            <th>DEBIT</th>
            <th>CREDIT</th>
        </tr>
        @foreach($dv->accountingEntries as $entry)
        <tr>
            <td>{{ $entry->account_title }}</td>
            <td>{{ $entry->uacs_code }}</td>
            <td class="text-right">{{ number_format($entry->debit, 2) }}</td>
            <td class="text-right">{{ number_format($entry->credit, 2) }}</td>
        </tr>
        @endforeach
    </table>

    <table>
        <tr>
            <td>
                <strong>C. CERTIFIED:</strong>
                <br>
                <input type="checkbox" {{ $dv->cash_available ? 'checked' : '' }}> Cash available
                <br>
                <input type="checkbox" {{ $dv->subject_to_ada ? 'checked' : '' }}> Subject to Authority to Debit Account (when applicable)
                <br>
                <input type="checkbox" {{ $dv->supporting_docs_complete ? 'checked' : '' }}> Supporting documents complete and amount claimed proper
                <br><br>
                Signature: ___________________<br>
                Printed Name: {{ $dv->accounting_head_name }}<br>
                Position: Head, Accounting Unit/Authorized Representative<br>
                Date: {{ $dv->accounting_head_date }}
            </td>
            <td>
                <strong>D. APPROVED FOR PAYMENT:</strong>
                <br><br><br>
                Signature: ___________________<br>
                Printed Name: {{ $dv->agency_head_name }}<br>
                Position: Agency Head/Authorized Representative<br>
                Date: {{ $dv->agency_head_date }}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="3"><strong>E. RECEIPT OF PAYMENT</strong></td>
            <td>JEV NO.: __________</td>
        </tr>
        <tr>
            <td colspan="2">CHECK/ADA NO.: {{ $dv->check_ada_no }}</td>
            <td colspan="2">DATE: {{ $dv->check_ada_date }}</td>
        </tr>
        <tr>
            <td colspan="4">BANK NAME & ACCOUNT NUMBER: {{ $dv->bank_name_account }}</td>
        </tr>
        <tr>
            <td colspan="2">SIGNATURE: ______________________</td>
            <td colspan="2">DATE: {{ $dv->signature_date }}</td>
        </tr>
        <tr>
            <td colspan="4">PRINTED NAME: {{ $dv->printed_name }}</td>
        </tr>
        <tr>
            <td colspan="4">OFFICIAL RECEIPT NO. & DATE/OTHER DOCUMENTS: {{ $dv->or_others }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>&copy; 2023 Disbursement Voucher</p>
    </div>
</body>
</html>