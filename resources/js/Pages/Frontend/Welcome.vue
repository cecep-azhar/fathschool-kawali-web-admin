<template>
    <Head title="Welcome" />
    <FrontendLayout>
        <template #header>
            <h1 class="text-4xl font-bold tracking-tight text-white md:text-5xl lg:text-6xl">
                {{ $page.props.setting.text_logo_name }}
            </h1>
            <p class="mt-6 max-w-3xl text-xl text-blue-gray-300" v-html="$page.props.setting?.app_description">
            </p>
        </template>
        <div v-if="sliders.length > 0" class="mx-auto max-w-lg lg:max-w-7xl px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <section class="w-full">
                <home-slider :sliders="sliders" />
            </section>
        </div>
        <div class="flex flex-col lg:flex-row items-start mt-8">
        <!-- Video Section -->
        <div class="lg:w-1/2 w-full lg:mr-8 mb-8 lg:mb-0">
            <iframe :src="videoUrl" class="w-full h-64 lg:h-full rounded-lg shadow-lg" frameborder="0" allowfullscreen></iframe>
        </div>

        <!-- Text Section -->
        <div class="lg:w-1/2 w-full">
            <h2 class="text-2xl font-semibold mb-4"></h2>
            <p class="text-gray-700"></p>
        </div>
    </div>
    </FrontendLayout>
</template>

<script setup>
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import HomeSlider from '@/Components/Frontend/HomeSlider.vue';
import NothingFound from "@/Shared/NothingFound.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    sliders: Array
});


</script>
