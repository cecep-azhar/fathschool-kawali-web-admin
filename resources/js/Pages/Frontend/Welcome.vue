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
        <div class="flex flex-col lg:flex-row items-start mt-8">
        
        <div class=" lg:w-1/2 w-full lg:mr-8 mb-8 lg:mb-0" v-if="landing" >
            <iframe :src="formattedYouTubeUrl" class="w-full h-60 lg:h-80 rounded-lg shadow-lg" frameborder="0" allowfullscreen></iframe>
        </div>

        <!-- Text Section -->
        <div class="lg:w-1/2 w-full" v-if="landing">
            <h2 class="text-2xl font-semibold mb-4">{{ landing.title }}</h2>
            <p class="text-gray-700">{{ landing.description }}</p>
        </div>
    </div>
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
import { computed } from 'vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    sliders: Array,
    landing: Object
});

// Computed property to format the YouTube URL for embedding
const formattedYouTubeUrl = computed(() => {
    if (props.landing && props.landing.youtube_link) {
        const videoId = props.landing.youtube_link.split('v=')[1]?.split('&')[0];
        return videoId ? `https://www.youtube.com/embed/${videoId}` : '';
    }
    return '';
});
</script>

<style>
.video-container {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    max-width: 100%;
    background: #000;
    margin-bottom: 8px;
}

.video-container .video-frame {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>
