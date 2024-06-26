<template id="x-item">
    <label>
        <input type="checkbox" :checked="item.checked" @change="$emit('change', item, $event.target.checked)"
            @click="getValue(item, $event.target.checked)" :id="convertToSlug(item.name)"
            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
        <label :for="convertToSlug(item.name)"
            class="py-4 ml-2 capitalize w-full text-sm font-medium text-gray-900 dark:text-gray-400">
            {{ removeDot(item.name) }}
        </label>
    </label>
</template>

<script>
export default {
    template: "#x-item",
    props: ["item"],
    data() {
        return {
            data: [],
        };
    },
    methods: {
        getValue(item, checked) {
            this.$emit("childData", item, checked);
        },
        convertToSlug(text) {
            return text
                .toLowerCase()
                .replace(/ /g, "-")
                .replace(/[^\w-]+/g, "");
        },
        // remove dot from permission name
        removeDot(text) {
            return text.replace(/\./g, " ");
        },
    },
};
</script>

<style>

</style>
