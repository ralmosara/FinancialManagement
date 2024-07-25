<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Disbursement Vouchers</h1>
    <div class="flex justify-between items-center mb-4">
      <Link :href="route('disbursement-vouchers.create')" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-block">Create New Voucher</Link>
      <div class="relative">
        <input 
          v-model="search" 
          @input="performSearch"
          type="text" 
          placeholder="Search vouchers..." 
          class="border rounded py-2 px-4 w-64 focus:outline-none focus:border-blue-500"
        >
        <span class="absolute right-3 top-2 text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </span>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="py-2 px-4 border-b">DV No.</th>
            <th class="py-2 px-4 border-b">Date</th>
            <th class="py-2 px-4 border-b">Payee</th>
            <th class="py-2 px-4 border-b">Amount</th>
            <th class="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="voucher in vouchers.data" :key="voucher.id" class="hover:bg-gray-50">
            <td class="py-2 px-4 border-b">{{ voucher.dv_no }}</td>
            <td class="py-2 px-4 border-b">{{ voucher.date }}</td>
            <td class="py-2 px-4 border-b">{{ voucher.payee }}</td>
            <td class="py-2 px-4 border-b">{{ voucher.amount }}</td>
            <td class="py-2 px-4 border-b">
              <Link :href="route('disbursement-vouchers.edit', voucher.id)" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded text-sm mr-2">Edit</Link>
              <button @click="deleteVoucher(voucher.id)" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded text-sm">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="mt-6" v-if="vouchers.links.length > 3">
      <div class="flex flex-wrap -mb-1">
        <template v-for="(link, key) in vouchers.links" :key="key">
          <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
          <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-100 focus:border-blue-500 focus:text-blue-500" :class="{ 'bg-blue-500 text-white': link.active }" :href="link.url" v-html="link.label" />
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';

export default {
  components: {
    Link,
  },
  props: {
    vouchers: Object,
    filters: Object,
  },
  setup(props) {
    const search = ref(props.filters.search);

    const performSearch = debounce(() => {
      router.get(
        route('disbursement-vouchers.index'),
        { search: search.value },
        { preserveState: true, replace: true }
      );
    }, 300);

    watch(search, performSearch);

    return {
      search,
    };
  },
  methods: {
    deleteVoucher(id) {
      if (confirm('Are you sure you want to delete this voucher?')) {
        router.delete(route('disbursement-vouchers.destroy', id));
      }
    },
  },
};
</script>