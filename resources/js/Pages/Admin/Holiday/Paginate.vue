<template>

    <!-- Previous Button -->
    <template v-if="links.prev_page_url != null">
        <Link preserve-scroll :href="links.prev_page_url"
            class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        {{ __('Previous') }}
        </Link>
    </template>
    <template v-else>
        <div
            class="opacity-40 cursor-not-allowed inline-flex items-center py-2 px-4 ml-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            {{ __('Previous') }}
        </div>
    </template>
    <!-- Next Button -->
    <template v-if="links.next_page_url != null">
        <Link preserve-scroll :href="links.next_page_url"
            class="inline-flex items-center py-2 px-4 ml-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        {{ __('Next') }}
        </Link>
    </template>
    <template v-else>
        <div
            class="opacity-40 cursor-not-allowed inline-flex items-center py-2 px-4 ml-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            {{ __('Next') }}
        </div>
    </template>
</template>

<script>
export default {
    props: {
        links: Object
    }
}
</script>
