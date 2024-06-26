<template>
    <div
        class="absolute whitespace-nowrap hidden group-hover:flex z-20 left-2/4 -translate-x-2/4 -top-2 -translate-y-full px-4 py-1 bg-gray-700 rounded text-center text-white text-sm after:content-[''] after:absolute after:left-1/2 after:top-[100%] after:-translate-x-1/2 after:border-8 after:border-x-transparent after:border-b-transparent after:border-t-gray-700">
        <div v-html="text"></div>
    </div>
</template>

<script>
export default { props: ["text"] };
</script>

<style lang="scss" scoped>

</style>
