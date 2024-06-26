<template>
    <div class="flex items-center mb-3 pl-1">
        <div class="mr-2 w-4 h-4 rounded-full bg-[ #3498db]"></div>
        <h2 class="text-xl font-bold m-0 dark:text-gray-400">
            <slot name="name"/>
        </h2>
    </div>
    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 col-span-3 auto-rows-min">
        <slot name="subject"/>
    </div>
</template>

<script>

export default {
    props: {

    }
};
</script>
<style scoped>
</style>
