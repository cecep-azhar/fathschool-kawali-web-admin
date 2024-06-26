<template>
    <Link v-if="route" :href="route" class="bg-white hover:shadow rounded-lg dark:hover:bg-gray-700 dark:bg-gray-800 dark:border-gray-700">
        <div class="border-b dark:border-gray-600">
            <div class="p-4 text-gray-700 dark:text-gray-400 text-lg font-bold">
                {{ title }}
            </div>
        </div>
        <div class="p-4 text-gray-700 dark:text-gray-400" v-if="!injected">
            <div class="text-lg mb-2 font-bold">
                {{ value }}
            </div>
            <div class="text-md text-gray-500" v-if="label">
                {{ label }}
            </div>
        </div>
        <template v-else>
            <slot />
        </template>
    </Link>
    <div v-else class="bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <div class="border-b dark:border-gray-600">
            <div class="p-4 text-gray-700 dark:text-gray-400 text-lg font-bold">
                {{ title }}
            </div>
        </div>
        <div class="p-4 text-gray-700 dark:text-gray-400" v-if="!injected">
            <div class="text-lg mb-2 font-bold">
                {{ value }}
            </div>
            <div class="text-md text-gray-500" v-if="label">
                {{ label }}
            </div>
        </div>
        <template v-else>
            <slot />
        </template>
    </div>
</template>

<script setup>
const props = defineProps({
    route: {
        type: String,
        default: null,
    },
    title: {
        type: String,
        required: true,
    },
    value: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        default: '',
    },
    injected: {
        type: Boolean,
        default: false,
    }
})

</script>

<style>

</style>
