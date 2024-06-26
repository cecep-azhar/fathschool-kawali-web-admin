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
