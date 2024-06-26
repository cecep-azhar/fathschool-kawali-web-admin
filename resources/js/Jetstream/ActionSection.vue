<script setup>
import JetSectionTitle from './SectionTitle.vue';
</script>

<template>
    <div >
        <JetSectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </JetSectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 sm:p-6 dark:border-gray-600 dark:text-gray-400 sm:rounded-lg">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
