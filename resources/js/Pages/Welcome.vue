<script setup>
import {Link, Head} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    products: Object
});
</script>

<template>
    <AppLayout title="Shop Our Products">

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Shop Our Products
            </h2>
        </template>

        <div class="p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-10">
                <Link :href="route('product.show', product.id)" v-for="(product, index) in products" :key="product.id">
                    <div class="flex flex-col bg-white drop-shadow hover:drop-shadow-lg hover:opacity-70 rounded-md">
                        <img :src="'/storage/images/products/' + product.picture"
                             :alt="product.name"
                             class="h-36 object-cover rounded-tl-md rounded-tr-md">

                        <div class="px-3 py-2">
                            <h1 class="font-semibold">{{product.name}}</h1>
                            <p class="text-sm">${{product.price}}</p>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
        {{ products }}
    </AppLayout>
</template>
