<template>
    <label for="class" class="block items-center text-sm font-medium text-gray-900 dark:text-gray-400 mb-1" :class="class">
        <span v-if="value">{{ __(value) }}</span>
        <span v-else>
            <slot />
        </span>
        <span v-if="required" class="text-red-500 ml-1 text-sm">∗</span>
        <slot />
    </label>
</template>

<script>
export default {
    props: {
        value: String,
        required: Boolean,
        class: String
    }
}
</script>

<style>

</style>
