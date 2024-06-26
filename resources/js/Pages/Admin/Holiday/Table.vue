<template>

    <global-table>
        <template #head>
            <th width="90%" class="py-5 px-6">{{ __('Name') }}</th>
            <th width="10%" v-if="can('holiday.edit') || can('holiday.destroy')" class="py-5 px-6">{{ __('Action') }}
            </th>
        </template>
        <template #body>
            <template v-if="holidays.length > 0">
                <template v-for="event in holidays" :key="event.id">
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class=" items-center py-4 px-6 text-gray-900 dark:text-gray-400 whitespace-nowrap">
                            <div class="inline-flex relative">
                                <div
                                    class="bg-blue-100 text-blue-800 dark:text-gray-400 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700">
                                    {{ event.title }}
                                </div>
                                <br>
                            </div>
                            <div class="mt-2">{{ event.format_start_date }} - {{ event.format_end_date }}</div>
                        </td>
                        <td>
                            <div class="py-4 px-6 inline-flex">
                                <div v-if="can('holiday.edit')" @click="edit(event.id)"
                                    class="cursor-pointer group relative">
                                    <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                    <tool-tip :text="__('Edit')" />
                                </div>

                                <button v-if="can('holiday.destroy')" @click="destroy(event.id)" class="group relative">
                                    <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                    <tool-tip :text="__('Delete')" />
                                </button>
                            </div>

                        </td>
                    </tr>
                </template>
            </template>
            <template v-else>
                <tr>
                    <td colspan="4" class="text-center pt-8">
                        <NothingFound asShow="div" />
                    </td>
                </tr>
            </template>
        </template>
    </global-table>
    <div class="flex justify-center text-xs p-4">
        <pagination class="mt-2" v-if="holidays.last_page > 1" :links="holidays" />
    </div>
</template>

<script>
    import Pagination from './Paginate.vue'
    import ToolTip from '@/Shared/ToolTip.vue'
    import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        components: { PencilSquareIcon, ToolTip, TrashIcon, Pagination, NothingFound },
        props: {
            holidays: Object
        },
        methods: {
            edit(id) {
                this.$emit('edit', id);
            },
            destroy(id) {
                if (confirm('Are you sure ?')) {
                    this.$inertia.delete(this.route('holiday.destroy', id));
                } else {
                    return false;
                }
            }
        }
    }
</script>

<style>

</style>
