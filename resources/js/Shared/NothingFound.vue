<template>
    <tr v-if="asShow == 'tr'" :class="cssClass">
        <td colspan="20" class="text-center p-4 font-medium dark:text-gray-400 text-xl">
            {{ __('Nothing Found') }}
        </td>
    </tr>
    <div :class="cssClass" v-else class="text-gray-900 dark:text-gray-400 font-bold text-center p-4">
        {{ __('Nothing Found') }}
    </div>
</template>

<script>
export default {
    props: {
        asShow: {
            type: String,
            default: 'tr',
        },
        cssClass: {
            type: String,
        }
    }
}
</script>

<style>
</style>

