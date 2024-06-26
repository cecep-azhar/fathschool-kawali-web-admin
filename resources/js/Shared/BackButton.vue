<template>
    <button type="button"
        class="px-4 py-2.5 bg-gray-800 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 active:bg-gray-800 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 disabled:cursor-not-allowed transition text-center flex justify-center items-center">
        <ArrowLeftIcon class="text-white w-4 h-4 mr-2" />
        {{ __('Back') }}
    </button>
</template>

<script>
import { ArrowLeftIcon } from '@heroicons/vue/24/outline';

export default {
    props: {
        type: String,
        loading: Boolean,
    },
    components: { ArrowLeftIcon }
}
</script>

<style>

</style>

