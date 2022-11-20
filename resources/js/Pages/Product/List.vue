<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue'
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    products: Object
});

const deleteProduct = (id) => {
    if (confirm("Are you sure you want to delete this product?")) {
        Inertia.delete(route('product.delete', id));
    }
};
</script>

<template>
    <AppLayout title="My Orders">

        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mr-auto">
                    My Orders
                </h2>
                <Link :href="route('product.new')" class="font-bold text-indigo-600">Add Product</Link>
            </div>
        </template>

        <div class="flex flex-col justify-center h-full py-2">
            <!-- Table -->
            <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">ID</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Picture</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Company</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Quantity</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Price</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-right">Options</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="(product, index) of products" :key="product.id">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">#{{ product.id }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-center"><img :src="'/storage/images/products/' + product.picture"
                                                                  style="max-height: 120px"/></div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ product.name }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-center">{{ product.company }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-center">{{ product.quantity }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-center">${{ product.price }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap text-right flex flex-row justify-end">
                                    <Link class="font-semibold text-blue-600 my-auto mr-2 p-2" :href="route('product.edit', product.id)">
                                        Edit
                                    </Link>
                                    <form @submit="deleteProduct(product.id)">
                                        <button type="submit" class="inline-block my-auto text-red-600 background-transparent p-2 outline-none focus:outline-none ease-linear transition-all duration-150"
                                        >
                                            Delete
                                        </button>
                                    </form>
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
