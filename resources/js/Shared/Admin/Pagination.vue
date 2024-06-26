<template>
    <div v-if="links && links.length > 3" class="bg-white sm:px-4 px-2 py-2 rounded-md dark:bg-gray-800">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 sm:px-4 sm:py-3 py-1.5 px-1.5 sm:text-sm text-xs leading-4 text-gray-400 border dark:border-gray-600 rounded"
                    v-html="link.label" />
                <Link preserve-scroll v-else
                    class="mr-1 mb-1 sm:px-4 sm:py-3 py-1.5 px-1.5 sm:text-sm text-xs leading-4 border dark:border-gray-600 rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label">
                </Link>
            </template>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        links: Array,
    },
};
</script>
