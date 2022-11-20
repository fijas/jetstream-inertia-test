<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Inertia} from "@inertiajs/inertia";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    order: Object,
    user: Object,
    transactions: Object
});

function getTransactions() {
    Inertia.reload({ only: ['transactions'] })
}

function deleteOrder() {
    if (confirm("Are you sure you want to delete this order?")) {
        Inertia.delete('/order/' + props.order.id)
    }
}

function getFormattedDatetime(datetime) {
    const date = new Date(datetime);
    return date.toLocaleDateString('en-us', { weekday:"long", year:"numeric", month:"short", day:"numeric"}) + '; ' + date.toLocaleTimeString();
}
</script>

<template>
    <AppLayout :title="'Order #' + order.id">

        <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
            <div class="flex justify-start item-start space-y-2">
                <div class="flex flex-col mr-auto">
                    <h1 class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Order #{{order.id}}
                        <small>
                            <Link :href="route('order')" class="text-indigo-600 text-sm ml-2">
                                Go Back
                            </Link>
                        </small>
                    </h1>
                    <p class="text-base font-medium leading-6 text-gray-600">{{getFormattedDatetime(order.created_at)}}</p>
                </div>
                <div class="flex flex-row">
                    <form @submit="deleteOrder">
                        <SecondaryButton type="submit" class="my-auto ">Delete Order</SecondaryButton>
                    </form>
                </div>
            </div>
            <div class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
                <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                    <div class="flex flex-col justify-start items-start bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
                        <p class="text-lg md:text-xl font-semibold leading-6 xl:leading-5 text-gray-800">Products</p>
                        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full"
                            v-for="(product, index) of order.products">
                            <div class="pb-4 md:pb-8 w-full md:w-40">
                                <img class="w-fulln" :src="'/storage/images/products/' + product.picture" alt="dress" />
                            </div>
                            <div class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                                <div class="w-full flex flex-col justify-start items-start space-y-8">
                                    <h3 class="text-xl xl:text-2xl font-semibold leading-6 text-gray-800">{{product.name}}</h3>
                                    <div class="flex justify-start items-start flex-col space-y-2">
                                        <p class="text-sm leading-none text-gray-800"><span class="dark:text-gray-400 text-gray-300">Company: </span> {{product.company}}</p>
                                        <p class="text-sm leading-none text-gray-800"><span class="dark:text-gray-400 text-gray-300">Quantity: </span> {{product.pivot.count}}</p>
                                    </div>
                                </div>
                                <div class="flex justify-between space-x-8 items-start w-full">
                                    <p class="text-base xl:text-lg leading-6">${{product.price}}</p>
                                    <p class="text-base xl:text-lg leading-6 text-gray-800">{{product.pivot.count}}</p>
                                    <p class="text-base xl:text-lg font-semibold leading-6 text-gray-800">${{product.price * product.pivot.count}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center flex-col w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                        <div v-if="transactions">
                            <div class="flex flex-col justify-center h-full">
                                <!-- Table -->
                                <div class="w-full bg-white shadow-lg rounded-sm border border-gray-200">
                                    <header class="px-5 py-4 border-b border-gray-100">
                                        <h2 class="font-semibold text-gray-800">Transactions</h2>
                                    </header>
                                    <div class="p-3">
                                        <div class="overflow-x-auto">
                                            <table class="table-auto w-full">
                                                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                                <tr>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left">Time</div>
                                                    </th>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-center">Type</div>
                                                    </th>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-center">Status</div>
                                                    </th>
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-right">Amount</div>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-sm divide-y divide-gray-100">
                                                <tr v-for="(transaction, index) of transactions">
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-left">{{getFormattedDatetime(transaction.created_at)}}</div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-center">{{transaction.type === '0' ? 'Credit Card' : 'Bank'}}</div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-center">{{transaction.status === '0' ? 'Initiated' : 'Completed'}}</div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-lg text-right">${{transaction.amount}}</div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <PrimaryButton v-else @click="getTransactions">Show All Transactions</PrimaryButton>
                    </div>
                    <div class="flex justify-center flex-col md:flex-row items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                        <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 dark:bg-gray-600 space-y-6">
                            <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Summary</h3>
                            <div class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                                <div class="flex justify-between w-full">
                                    <p class="text-base dark:text-white leading-4 text-gray-800">Subtotal</p>
                                    <p class="text-base dark:text-gray-300 leading-4 text-gray-600">${{order.sub_amount}}</p>
                                </div>
                                <div class="flex justify-between items-center w-full">
                                    <p class="text-base dark:text-white leading-4 text-gray-800">Tax <span class="bg-gray-200 p-1 text-xs font-medium dark:text-gray-800 leading-3 text-gray-800">(10%)</span></p>
                                    <p class="text-base dark:text-gray-300 leading-4 text-gray-600">${{order.tax_amount}}</p>
                                </div>
                                <div class="flex justify-between items-center w-full">
                                    <p class="text-base dark:text-white leading-4 text-gray-800">Shipping</p>
                                    <p class="text-base dark:text-gray-300 leading-4 text-gray-600">FREE</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center w-full">
                                <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Total</p>
                                <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">${{order.total_amount}}</p>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 dark:bg-gray-600 space-y-6">
                            <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Shipping</h3>
                            <div class="flex justify-between items-start w-full">
                                <div class="flex justify-center items-center space-x-4">
                                    <div class="w-8 h-8">
                                        <img class="w-full h-full" alt="logo" src="https://i.ibb.co/L8KSdNQ/image-3.png" />
                                    </div>
                                    <div class="flex flex-col justify-start items-center">
                                    </div>
                                </div>
                                <p class="text-lg font-semibold leading-6 dark:text-white text-gray-800">FREE</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-600 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                    <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Customer</h3>
                    <div class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                        <div class="flex flex-col justify-start items-start flex-shrink-0">
                            <div class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200">
                                <div class="flex justify-start items-start flex-col space-y-2">
                                    <p class="text-base dark:text-white font-semibold leading-4 text-left text-gray-800">{{user.name}}</p>
                                </div>
                            </div>

                            <div class="flex justify-center text-gray-800 dark:text-white md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                                <img class="dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/order-summary-3-svg1.svg" alt="email">
                                <img class="hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/order-summary-3-svg1dark.svg" alt="email">
                                <p class="cursor-pointer text-sm leading-5 ">{{user.email}}</p>
                            </div>
                        </div>
                        <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                            <div class="flex justify-center md:justify-start xl:flex-col flex-col md:space-x-6 lg:space-x-8 xl:space-x-0 space-y-4 xl:space-y-12 md:space-y-0 md:flex-row items-center md:items-start">
                                <div class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4 xl:mt-8">
                                    <p class="text-base dark:text-white font-semibold leading-4 text-center md:text-left text-gray-800">Shipping Address</p>
                                    <p class="w-48 lg:w-full dark:text-gray-300 xl:w-48 text-center md:text-left text-sm leading-5 text-gray-600">180 North King Street, Northhampton MA 1060</p>
                                </div>
                                <div class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4">
                                    <p class="text-base dark:text-white font-semibold leading-4 text-center md:text-left text-gray-800">Billing Address</p>
                                    <p class="w-48 lg:w-full dark:text-gray-300 xl:w-48 text-center md:text-left text-sm leading-5 text-gray-600">180 North King Street, Northhampton MA 1060</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
