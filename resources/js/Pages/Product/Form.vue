<script setup>

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import {useForm} from "@inertiajs/inertia-vue3";


const props = defineProps({
    type: String,
    product: Object
});

const form = useForm({
    name: props.product ? props.product.name : '',
    company: props.product ? props.product.company : '',
    description: props.product ? props.product.description : '',
    quantity: props.product ? props.product.quantity : 0,
    price: props.product ? props.product.price : 0,
});

const submit = () => {
    if (props.type === 'update') {
        form.patch(route('product.update', props.product.id));
    } else {
        form.post(route('product.store'))
    }
};
</script>
<template>
    <AppLayout :title="(type === 'update' ? 'Update' : 'New') + ' Product'">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Product Name"/>
                        <TextInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.name"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="company" value="Company"/>
                        <TextInput
                            id="company"
                            v-model="form.company"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.company"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="description" value="Description"/>
                        <textarea
                            id="description"
                            v-model="form.description"
                            type="text"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.description"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="quantity" value="Quantity"/>
                        <TextInput
                            id="quantity"
                            v-model="form.quantity"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.quantity"/>
                    </div>

                    <div class="mt-4 mb-4">
                        <InputLabel for="price" value="Price"/>
                        <TextInput
                            id="price"
                            v-model="form.price"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.price"/>
                    </div>

                    <hr/>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing">
                            Save
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
