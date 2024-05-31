<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";


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
</script>

<template>

    <GuestLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col justify-center  bg-white  shadow-sm sm:rounded-lg">

                    <div class="inline-flex justify-center hover:underline text-gray-500">
                        <h1 class="text-3xl font-bold">{{ name }}</h1>
                    </div>

                    <div class="mb-4 inline-flex max-h-full w-full max-w-full justify-center">
                        <div v-html="svg"></div>

                    </div>


                    <a :href="url" class="inline-flex justify-center hover:underline text-gray-500">
                        {{ url }}
                    </a>


                </div>
            </div>
        </div>
    </GuestLayout>
</template>
