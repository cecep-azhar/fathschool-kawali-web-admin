<template>

    <global-table>
        <template #head>
            <th width="90%" class="py-4 px-5">{{ __('Name') }}</th>
            <th width="10%" class="py-4 px-5" v-if="can('event.destroy') || can('event.edit')">{{ __('Action') }}</th>
        </template>
        <template #body>
            <template v-if="all_events.data.length > 0">
                <template v-for="event in all_events.data" :key="event.id">
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row"
                            class="flex items-center py-4 px-5 text-gray-900 dark:text-gray-400 whitespace-nowrap">
                            <div class="inline-flex relative">
                                {{ event.title }}
                                <div :class="
                                  event.status == 'Upcoming' || event.status == 'Running'
                                    ? 'bg-green-500 dark:opacity-60'
                                    : 'bg-red-500 dark:opacity-60'
                                "
                                    class="ml-2 inline-flex rounded px-1 justify-center items-center text-xs font-bold text-white">
                                    {{ event.status }}
                                </div>
                            </div>
                        </td>
                        <td  v-if="can('event.destroy') || can('event.edit')">
                            <div class="py-4 px-5 inline-flex gap-1 items-center">
                                <div @click="edit(event.id)" class="cursor-pointer group relative" :id="'testEdit' + event.id">
                                    <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                    <tool-tip :text="__('Edit')" />
                                </div>

                                <button @click="destroy(event.id)" class="group relative" :id="'testDelete' + event.id">
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
                    <td colspan="4" class="text-center p-4">
                        {{ __('Nothing Found') }}
                    </td>
                </tr>
            </template>
        </template>
    </global-table>
    <div class="flex justify-center text-xs p-4">
        <pagination class="mt-2" v-if="all_events.last_page > 1" :links="all_events" />
    </div>
</template>

<script>
import Pagination from './Paginate.vue'
import ToolTip from '@/Shared/ToolTip.vue'
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";

export default {
    components: { PencilSquareIcon, ToolTip, TrashIcon, Pagination },
    props: {
        all_events: Object
    },
    methods: {
        edit(id) {
            this.$emit('edit', id);
        },
        destroy(id) {
            if (confirm('Are you sure ?')) {
                this.$inertia.delete(this.route('event.destroy', id));
            } else {
                return false;
            }
        }
    }
}
</script>

<style>

</style>
