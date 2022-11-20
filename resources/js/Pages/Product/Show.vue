<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue'
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    product: Object,
    added: Boolean
});

const form = reactive({
    id: props.product.id,
    quantity: 1
})

function submit() {
    Inertia.post('/cart/add', form);
}
</script>

<template>
    <AppLayout :title="product && product.name">

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product Details
            </h2>
        </template>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-6 border-t" v-if="product">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4">
                        <img :src="'/storage/images/products/' + product.picture"
                             :alt="product.name"
                             class="object-cover rounded-md">
                    </div>
                </div>
                <div class="md:flex-1 px-4" v-if="$page.props.product">
                    <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">
                        {{ product.name }}
                    </h2>
                    <p class="text-gray-500 text-sm">By
                        <span class="text-indigo-600">{{ product.company }}</span>
                    </p>

                    <div class="flex items-center space-x-4 my-4">
                        <div>
                            <div class="rounded-lg bg-gray-200 flex py-2 px-3">
                                <span class="text-indigo-400 mr-1 mt-1">$</span>
                                <span class="font-bold text-indigo-600 text-3xl">{{ product.price }}</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-gray-500">
                        {{ product.description }}
                    </p>

                    <form class="flex py-4 space-x-4" @submit.prevent="submit" v-if="!added">
                        <select class="block w-50 rounded-md border-gray-300 shadow-sm
                        focus:border-indigo-300 focus:ring focus:ring-indigo-200
                        focus:ring-opacity-50" v-model="form.quantity" >
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>

                        <button type="submit"
                                class="h-14 px-6 py-2 font-semibold rounded-md
                                bg-indigo-600 hover:bg-indigo-500 text-white">
                            Order Now
                        </button>
                    </form>
                    <div class="flex flex-row p-4 bg-gray-200 border border-gray-300 mt-2 rounded" v-else>
                        <span class="mr-auto">Added to Cart!</span>
                        <Link class="text-indigo-400 hover:text-indigo-800 font-semibold" :href="route('cart')">Go To Cart</Link>
                    </div>
                </div>
            </div>

            <Link :href="route('welcome')" class="flex font-semibold text-indigo-600 text-sm mt-10">
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path
                        d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
                </svg>
                Continue Shopping
            </Link>
        </div>
    </AppLayout>
</template>
