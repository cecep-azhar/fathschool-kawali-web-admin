<template>
    <div class="col-span-2 bg-white dark:bg-gray-800 dark:text-gray-600 rounded-lg">
        <global-table>
            <template #head>
                <th class="py-5 px-5">{{ __('Title') }}</th>
                <th class="py-5 px-5">{{ __('Message') }}</th>
                <th width="10%" class="py-5">{{ __('Action') }}</th>
            </template>
            <template #body>
                <template v-if="templates.length > 0">
                    <template v-for="template in templates" :key="template.id">
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-5 px-5">
                                {{ template.title }}
                            </td>
                            <td class="py-5 px-5">
                                {{ template.message }}
                            </td>
                            <td class="py-5 px-5 flex gap-2">
                                <button type="button" @click="edit(template)" class="group relative" >
                                    <PencilSquareIcon class="w-6 h-6 text-blue-400 hover:text-blue-300" />
                                    <tool-tip text="Edit" />
                                </button>
                                <button type="button" @click="destroy(template.id)" class="group relative" >
                                    <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                    <tool-tip :text="__('Delete')" />
                                </button>
                            </td>
                        </tr>
                    </template>
                </template>
                <template v-else>
                    <NothingFound asShow="tr" />
                </template>
            </template>
        </global-table>
    </div>
</template>

<script>
import ToolTip from "@/Shared/ToolTip.vue";
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';
import NothingFound from "@/Shared/NothingFound.vue";
export default {
    props: {
        templates: Array,
    },
    components: {
        ToolTip,
        TrashIcon,
        PencilSquareIcon,
        NothingFound
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("sms.template.destroy", id));
            } else {
                return false;
            }
        },
        edit(template) {
            this.$emit("edit", template);
        },
    },
};
</script>

<style></style>
