<template>
    <nav v-if="tab_data.length > 0" class="flex items-center mt-1 md:mt-0 space-x-2 w-full" :class="css">
        <div
            class="flex flex-wrap bg-gray-300 w-full rounded-lg transition py-1 px-2 dark:bg-gray-700 dark:hover:bg-gray-700/70">
            <template v-for="(item, index) in tab_data" :key="index">
                <label :for="item.id" @click="setTab(item.value)"
                    :class="tab.value == item.value ? 'bg-white dark:bg-gray-500 ' : ''"
                    class="cursor-pointer text-gray-700 whitespace-nowrap  text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold">

                    {{ __(item.title) }}

                    <input :value="item.value" type="checkbox" :id="item.id" class="sr-only hidden" />
                </label>
            </template>
        </div>
        <slot />
    </nav>
</template>

<script>
export default {
    props: {
        css:{
            type: String,
            default: '',
        },
        tab_data: {
            type: Array,
            default: []
        },
        filter_column: {
            type: String,
            default: ''
        },
        filterData: {
            type: String,
            default: 'all'
        }
    },
    data() {
        return {
            tab: {
                value: this.filterData ?? 'all',
                filter_column_data: this.filter_column ?? '',
            }
        }
    },
    methods: {
        setTab(arg) {
            this.tab.value = arg;
            this.$emit('setTabData', this.tab);
        }
    }
}
</script>

<style>
</style>
