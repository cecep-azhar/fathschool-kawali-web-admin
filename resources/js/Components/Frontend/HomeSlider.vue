<template>
    <carousel  autoplay="2000" pauseAutoplayOnHover="true" :wrap-around="true">
        <slide v-for="(slide, index) in sliders" :key="index">
            <img class="w-full h-[35rem] object-cover rounded-lg" :src="slide.image" alt="">
        </slide>

        <template #addons>
            <navigation />
            <pagination />
        </template>
    </carousel>
</template>
<script>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

export default {
    name: 'App',
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    props:{
        sliders: {
            type: Array,
            default: [],
        }
    }
}
</script>
