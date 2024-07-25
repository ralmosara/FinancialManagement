<template>
<div class="max-w-full sm:max-w-4xl md:max-w-5xl lg:max-w-6xl xl:max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">DISBURSEMENT VOUCHER</h1>
    <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="fund_cluster">
                    Fund Cluster
                </label>
                <vue-multiselect v-model="form.fund_cluster" :options="fundClusterOptions" :searchable="true" :loading="isFundClusterLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="10" :limit="10" :limit-text="count => `and ${count} more`" placeholder="Type to search" label="name" track-by="id" @search-change="query => fundClusterSearchQuery = query">
                    <template #option="{ option }">
                        {{ option.name }}
                    </template>
                </vue-multiselect>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="entity_name">
                    Entity Name
                </label>
                <input v-model="form.entity_name" id="entity_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Date
                </label>
                <input v-model="form.date" id="date" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="dv_no">
                    DV No.
                </label>
                <input v-model="form.dv_no" id="dv_no" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Mode of Payment
            </label>
            <div class="flex space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" v-model="form.mode_of_payment" value="MDS Check" class="form-radio" name="mode_of_payment">
                    <span class="ml-2">MDS Check</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" v-model="form.mode_of_payment" value="Commercial Check" class="form-radio" name="mode_of_payment">
                    <span class="ml-2">Commercial Check</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" v-model="form.mode_of_payment" value="ADA" class="form-radio" name="mode_of_payment">
                    <span class="ml-2">ADA</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" v-model="form.mode_of_payment" value="Others" class="form-radio" name="mode_of_payment">
                    <span class="ml-2">Others (Please specify)</span>
                </label>
            </div>
            <input v-if="form.mode_of_payment === 'Others'" v-model="form.other_payment_mode" type="text" class="mt-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Specify other payment mode">
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="payee">
                Payee
            </label>
            <vue-multiselect v-model="form.payee_id" :options="payeeOptions" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="10" :limit="10" :limit-text="count => `and ${count} more`" placeholder="Type to search" label="name" track-by="id" @search-change="query => searchQuery = query">
                <template #option="{ option }">
                    {{ option.name }}
                </template>
            </vue-multiselect>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tin_employee_no">
                    TIN/Employee No.
                </label>
                <input v-model="form.tin_employee_no" id="tin_employee_no" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="ors_burs_no">
                    ORS/BURS No.
                </label>
                <input v-model="form.ors_burs_no" id="ors_burs_no" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                Address
            </label>
            <textarea v-model="form.address" id="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
        </div>

        <div class="mt-4 grid grid-cols-4 gap-4">
            <div class="col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="particulars">
                    Particulars
                </label>
                <textarea v-model="form.particulars" id="particulars" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>
            <div class="col-span-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="particulars">
                    Respibility Center
                </label>
                <vue-multiselect v-model="form.responsibility_center" :options="responsibilityCenterOptions" :searchable="true" :loading="isRCLoading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="10" :limit="10" :limit-text="count => `and ${count} more`" placeholder="Type to search" label="name" track-by="id" @search-change="query => responsibilityCenterSearchQuery = query">
                    <template #option="{ option }">
                        {{ option.name }}
                    </template>
                </vue-multiselect>
            </div>  
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="mfo_pap">
                    MFO/PAP
                </label>
                <input v-model="form.mfo_pap" id="mfo_pap" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">
                Amount
            </label>
            <input v-model="form.amount" id="amount" type="number" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mt-4">
            <h2 class="text-lg font-bold mb-2">A. Certified</h2>
            <p class="mb-2">Expenses/Cash Advance necessary, lawful and incurred under my direct supervision.</p>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="supervisor_signature">
                    Printed Name, Designation and Signature of Supervisor
                </label>
                <input v-model="form.supervisor_signature" id="supervisor_signature" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="text-lg font-bold mb-2">B. Accounting Entry</h2>
            <div class="grid grid-cols-4 gap-4 mb-2">
                <div class="font-bold">Account Title</div>
                <div class="font-bold">UACS Code</div>
                <div class="font-bold">Debit</div>
                <div class="font-bold">Credit</div>
            </div>
            <div v-for="(entry, index) in form.accounting_entries" :key="index" class="grid grid-cols-4 gap-4 mb-2">
                <input v-model="entry.account_title" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Account Title" required>
                <input v-model="entry.uacs_code" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="UACS Code" required>
                <input v-model="entry.debit" type="number" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Debit" required>
                <input v-model="entry.credit" type="number" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Credit" required>
            </div>
            <div class="mt-2">
                <button @click="addAccountingEntry" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Add Entry
                </button>
                <button @click="removeAccountingEntry" type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" :disabled="form.accounting_entries.length <= 1">
                    Remove Entry
                </button>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <h2 class="text-lg font-bold mb-2">C. Certified</h2>
                <div class="mb-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" v-model="form.cash_available" class="form-checkbox">
                        <span class="ml-2">Cash available</span>
                    </label>
                </div>
                <div class="mb-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" v-model="form.subject_to_ada" class="form-checkbox">
                        <span class="ml-2">Subject to Authority to Debit Account (when applicable)</span>
                    </label>
                </div>
                <div class="mb-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" v-model="form.supporting_docs_complete" class="form-checkbox">
                        <span class="ml-2">Supporting documents complete and amount claimed proper</span>
                    </label>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="accounting_head_name">
                        Head, Accounting Unit/Authorized Representative
                    </label>
                    <input v-model="form.accounting_head_name" id="accounting_head_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mt-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="accounting_head_date">
                        Date
                    </label>
                    <input v-model="form.accounting_head_date" id="accounting_head_date" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
            </div>
            <div>
                <h2 class="text-lg font-bold mb-2">D. Approved for Payment</h2>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="agency_head_name">
                        Agency Head/Authorized Representative
                    </label>
                    <input v-model="form.agency_head_name" id="agency_head_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mt-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="agency_head_date">
                        Date
                    </label>
                    <input v-model="form.agency_head_date" id="agency_head_date" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="text-lg font-bold mb-2">E. Receipt of Payment</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="check_ada_no">
                        Check/ADA No.
                    </label>
                    <input v-model="form.check_ada_no" id="check_ada_no" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="check_ada_date">
                        Date
                    </label>
                    <input v-model="form.check_ada_date" id="check_ada_date" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="mt-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="bank_name_account">
                    Bank Name & Account Number
                </label>
                <input v-model="form.bank_name_account" id="bank_name_account" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="signature">
                        Signature
                    </label>
                    <input v-model="form.signature" id="signature" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="signature_date">
                        Date
                    </label>
                    <input v-model="form.signature_date" id="signature_date" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="mt-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="printed_name">
                    Printed Name
                </label>
                <input v-model="form.printed_name" id="printed_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mt-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="or_others">
                    Official Receipt No. & Date/Other Documents
                </label>
                <input v-model="form.or_others" id="or_others" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>
        <button @click="generatePdf" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
            Generate PDF
        </button>

        <div class="flex items-center justify-between mt-6">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Create Voucher
            </button>
        </div>
    </form>
</div>
</template>

<script>
import {
    reactive
} from 'vue'
import {
    useForm
} from "@inertiajs/vue3";
import VueMultiselect from 'vue-multiselect'
import {
    computed,
    onMounted,
    watch,
    ref
} from 'vue'
export default {
    components: {
        VueMultiselect,
    },
    props: {
        payees: Array,
        fundClusters: Array,
        responsibilityCenters: Array,
    },
    setup(props) {
        const form = useForm({
            fund_cluster: '',
            entity_name: '',
            date: '',
            dv_no: '',
            mode_of_payment: '',
            other_payment_mode: '',
            payee: '',
            tin_employee_no: '',
            ors_burs_no: '',
            address: '',
            particulars: '',
            responsibility_center: '',
            mfo_pap: '',
            amount: '',
            supervisor_signature: '',
            accounting_entries: '',
            cash_available: false,
            subject_to_ada: false,
            supporting_docs_complete: false,
            accounting_head_name: '',
            accounting_head_date: '',
            agency_head_name: '',
            agency_head_date: '',
            check_ada_no: '',
            check_ada_date: '',
            bank_name_account: '',
            signature: '',
            signature_date: '',
            printed_name: '',
            or_others: '',
            accounting_entries: [{
                account_title: '',
                uacs_code: '',
                debit: '',
                credit: ''
            }]
        })

        function generatePdf() {
            const pdfUrl = route('disbursement-vouchers.pdf', {
                id: 1
            });
            window.open(pdfUrl, '_blank');
        }

        function submit() {
            form.post('/disbursement-vouchers', form)
            console.log('Form submitted:', form)

        }

        function addAccountingEntry() {
            form.accounting_entries.push({
                account_title: '',
                uacs_code: '',
                debit: '',
                credit: ''
            })
        }

        function removeAccountingEntry() {
            if (form.accounting_entries.length > 1) {
                form.accounting_entries.pop()
            }
        }
        const payeeOptions = ref(props.payees || [])
        const isLoading = ref(false)
        const searchQuery = ref('')

        const fundClusterOptions = ref(props.fundClusters || [])
        const fundClusterSearchQuery = ref('')
        const isFundClusterLoading = ref(false)
        const responsibilityCenterOptions = ref(props.responsibilityCenters || [])
        const responsibilityCenterSearchQuery = ref('')
        const isRCLoading = ref(false)


        watch(responsibilityCenterSearchQuery, (newQuery) => {
            if (newQuery.length < 2) {
                responsibilityCenterOptions.value = props.responsibilityCenters || []
                return
            }
            searchResponsibilityCenters(newQuery)
        })

        watch(searchQuery, (newQuery) => {
            if (newQuery.length < 2) {
                payeeOptions.value = props.payees || []
                return
            }
            searchPayees(newQuery)
         
        })

        watch(fundClusterSearchQuery, (newQuery) => {
            if (newQuery.length < 2) {
                fundClusterOptions.value = props.fundClusters || []
                return
            }
            searchFundClusters(newQuery)
        })


        function searchPayees(query) {
            isLoading.value = true
            axios.get('/search-payees', {
                    params: {
                        query
                    }
                })
                .then(response => {
                    payeeOptions.value = response.data
                })
                .catch(error => {
                    console.error('Error searching payees:', error)
                    payeeOptions.value = []
                })
                .finally(() => {
                    isLoading.value = false
                })
        }

        function searchFundClusters(query) {
            isFundClusterLoading.value = true
            axios.get('/search-fund-clusters', {
                    params: {
                        query
                    }
                })
                .then(response => {
                    fundClusterOptions.value = response.data
                })
                .catch(error => {
                    console.error('Error searching fund clusters:', error)
                    fundClusterOptions.value = []
                })
                .finally(() => {
                    isFundClusterLoading.value = false
                })
        }

        function searchResponsibilityCenters(query) {
            isRCLoading.value = true
            axios.get('/search-responsibility-centers', {
                params: { query }
            })
            .then(response => {
                responsibilityCenterOptions.value = response.data
            })
            .catch(error => {
                console.error('Error searching responsibility centers:', error)
                responsibilityCenterOptions.value = []
            })
            .finally(() => {
                isRCLoading.value = false
            })
        }


        return {
            form,
            generatePdf,
            isLoading,
            payeeOptions,
            searchQuery,
            fundClusterOptions,
            fundClusterSearchQuery,
            isFundClusterLoading,
            responsibilityCenterOptions,
            responsibilityCenterSearchQuery,
            isRCLoading,
            addAccountingEntry,
            removeAccountingEntry,
            submit
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
