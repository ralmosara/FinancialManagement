<template>
    <div class="max-w-4xl mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">DISBURSEMENT VOUCHER</h1>
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Fund Cluster</label>
            <p class="text-gray-700">{{ voucher.fund_cluster }}</p>
          </div>
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Entity Name</label>
            <p class="text-gray-700">{{ voucher.entity_name }}</p>
          </div>
        </div>
  
        <div class="grid grid-cols-2 gap-4 mt-4">
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Date</label>
            <p class="text-gray-700">{{ voucher.date }}</p>
          </div>
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">DV No.</label>
            <p class="text-gray-700">{{ voucher.dv_no }}</p>
          </div>
        </div>
  
        <div class="mt-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Mode of Payment</label>
          <p class="text-gray-700">{{ voucher.mode_of_payment }}</p>
        </div>
  
        <div class="mt-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Payee</label>
          <p class="text-gray-700">{{ voucher.payee }}</p>
        </div>
  
        <div class="grid grid-cols-2 gap-4 mt-4">
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">TIN/Employee No.</label>
            <p class="text-gray-700">{{ voucher.tin_employee_no }}</p>
          </div>
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">ORS/BURS No.</label>
            <p class="text-gray-700">{{ voucher.ors_burs_no }}</p>
          </div>
        </div>
  
        <div class="mt-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Address</label>
          <p class="text-gray-700">{{ voucher.address }}</p>
        </div>
  
        <div class="mt-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Particulars</label>
          <p class="text-gray-700">{{ voucher.particulars }}</p>
        </div>
  
        <div class="grid grid-cols-3 gap-4 mt-4">
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Responsibility Center</label>
            <p class="text-gray-700">{{ voucher.responsibility_center }}</p>
          </div>
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">MFO/PAP</label>
            <p class="text-gray-700">{{ voucher.mfo_pap }}</p>
          </div>
          <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
            <p class="text-gray-700">{{ voucher.amount }}</p>
          </div>
        </div>
  
        <div class="mt-4">
          <h2 class="text-lg font-bold mb-2">A. Certification</h2>
          <p class="mb-2">Expenses/Cash Advance necessary, lawful and incurred under my direct supervision.</p>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-700 text-sm font-bold mb-2">Printed Name</label>
              <p class="text-gray-700">{{ voucher.supervisor_name }}</p>
            </div>
            <div>
              <label class="block text-gray-700 text-sm font-bold mb-2">Designation</label>
              <p class="text-gray-700">{{ voucher.supervisor_designation }}</p>
            </div>
          </div>
        </div>
  
        <div class="mt-4">
          <h2 class="text-lg font-bold mb-2">B. Accounting Entry</h2>
          <pre class="bg-gray-100 p-2 rounded">{{ JSON.stringify(JSON.parse(voucher.accounting_entries), null, 2) }}</pre>
        </div>
  
        <div class="grid grid-cols-2 gap-4 mt-4">
          <div>
            <h2 class="text-lg font-bold mb-2">C. Certification</h2>
            <label class="block text-gray-700 text-sm font-bold mb-2">Head, Accounting Unit/Authorized Representative</label>
            <p class="text-gray-700">{{ voucher.accounting_head_name }}</p>
          </div>
          <div>
            <h2 class="text-lg font-bold mb-2">D. Approval for Payment</h2>
            <label class="block text-gray-700 text-sm font-bold mb-2">Agency Head/Authorized Representative</label>
            <p class="text-gray-700">{{ voucher.agency_head_name }}</p>
          </div>
        </div>
      </div>
      <div class="mt-4">
        <inertia-link :href="route('disbursement-vouchers.index')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Back to List
        </inertia-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      voucher: Object
    }
  }
  </script>