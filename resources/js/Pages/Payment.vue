<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import axios from "axios";


defineProps<{
    name: string,
    svg: string,
    url: string,
}>();

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

const sendAptos = () => {
    window.location.href = route('success');
};

</script>

<template>

    <GuestLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col justify-center  bg-white  shadow-sm sm:rounded-lg">

                    <div class="inline-flex justify-center hover:underline text-gray-500">
                        <h1 class="text-3xl font-bold">To {{ name }}</h1>
                    </div>


                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input  type="text" id="text"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                               placeholder="$0.00" required>
                    </div>

                    <button @click="sendAptos" type="button" class="text-gray-100 bg-blue-700 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2  focus:outline-none border border-4">Send</button>



                </div>
            </div>
        </div>
    </GuestLayout>
</template>
