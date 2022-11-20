<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    orders: Object
});

</script>

<template>
    <AppLayout title="My Orders">
        <div class="flex flex-col justify-center h-full py-2">
            <!-- Table -->
            <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">My Orders</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto border w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Order ID</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Status</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Amount</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Products</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-right">Options</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="(order, index) of orders">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">#{{order.id}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-center">{{order.status}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-center">${{order.total_amount}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-lg text-center">{{order.products_count}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap text-right">
                                    <Link class="font-semibold text-blue-600" :href="route('order.view', order.id)">View</Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
