<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue'
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    products: Object,
    cart: Object,
    total: Number,
    tax: Number
});

function submit() {
    Inertia.post('/order/create');
}
</script>

<template>
    <AppLayout title="My Cart">

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Cart
            </h2>
        </template>

        <div class="flex shadow-md border-t" v-if="products && products.length > 0">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Products</h1>
                    <h2 class="font-semibold text-2xl">{{products.length}} Items</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">
                        Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>

                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5"
                    v-for="(product, index) of products" :key="product.id">
                    <div class="flex w-2/5"> <!-- product -->
                        <div class="w-20">
                            <img class="h-24" :src="'/storage/images/products/' + product.picture"
                                 alt="">
                        </div>
                        <div class="flex flex-col justify-between ml-4 flex-grow">
                            <span class="font-bold text-sm">{{product.name}}</span>
                            <span class="text-blue-700 text-xs">{{product.company}}</span>
                            <a href="#" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                        </div>
                    </div>
                    <span class="text-center w-1/5 font-semibold text-sm">{{cart[product.id]}}</span>
                    <span class="text-center w-1/5 font-semibold text-sm">${{product.price}}</span>
                    <span class="text-center w-1/5 font-semibold text-sm">${{(product.price * cart[product.id])}}</span>
                </div>

                <Link :href="route('welcome')" class="flex font-semibold text-indigo-600 text-sm mt-10">
                    <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                        <path
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
                    </svg>
                    Continue Shopping
                </Link>
            </div>

            <div id="summary" class="w-1/4 px-8 py-10 flex flex-col">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="mt-10 mb-auto">
                    <div class="flex justify-between mb-2"
                         v-for="(product, index) of products" :key="product.id">
                        <span class="font-semibold text-sm uppercase">Item {{index}}</span>
                        <span class="font-semibold text-sm">${{(product.price * cart[product.id])}}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-sm uppercase">Tax (10%)</span>
                        <span class="font-semibold text-sm">${{tax}}</span>
                    </div>
                </div>
                <form class="border-t" @submit.prevent="submit">
                    <div class="flex font-bold justify-between py-6 text-sm uppercase">
                        <span>Total</span>
                        <span>${{total}}</span>
                    </div>
                    <button
                        class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">
                        Order Now
                    </button>
                </form>
            </div>
        </div>
        <div class="flex my-10" v-else>
            <div class="w-2/3 mx-auto bg-white px-10 py-10 shadow-md text-center">
                <h3>Cart is empty!</h3>
                <Link :href="route('welcome')" class="font-semibold text-indigo-600 text-sm mt-10">
                    Continue Shopping
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
