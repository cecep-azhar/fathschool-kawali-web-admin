<template>
    <div class="rounded-lg sm:mb-4 mb-1.5 sm:py-4 py-1.5 sm:px-6 px-2 sm:text-lg text-sm font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800 flex gap-4 justify-between items-center" :class="classes">
        <h2 class="dark:text-gray-400 text-black/[0.85] font-semibold mb-0">
            <slot />
        </h2>
        <slot name="content"/>
    </div>
</template>

<script>
export default {
    props:{
        classes: {tyep: String, default: ''}
    }

}
</script>

<style>

</style>
