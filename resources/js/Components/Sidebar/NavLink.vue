<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'flex items-center gap-x-3 py-2 px-2.5 bg-gray-100 text-sm text-slate-700 rounded-md dark:bg-slate-700 dark:text-white'
        : 'flex items-center gap-x-3 py-2 px-2.5 text-sm hover:bg-gray-100 text-slate-700 rounded-md dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white';
});
</script>

<template>
    <Link :href="href" preserve-scroll :class="classes">
    <slot />
    </Link>
</template>
