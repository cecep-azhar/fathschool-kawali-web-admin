<template>
    <div class="overflow-auto">
        <table :class="classes" class="overflow-auto w-full text-sm text-left rtl:text-right rounded-lg text-gray-500 bg-white dark:bg-gray-800 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                <tr>
                    <slot name="head" />
                </tr>
            </thead>
            <tbody class="border-t-2 dark:border-gray-600">
                <slot name="body" />
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    components: {
    },
    props: {
        classes: ''
    },
    methods: {
    },
};
</script>
