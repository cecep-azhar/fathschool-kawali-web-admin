<template>
    <div class="col-span-2 bg-white dark:bg-gray-800 dark:text-gray-600 rounded-lg">
        <global-table>
            <template #head>
                <th class="py-5 px-5">{{ __('Name') }}</th>
                <th class="py-5 px-5">{{ __('GPA') }}</th>
                <th class="py-5 px-5">{{ __('Mark') }}</th>
                <th class="py-5 px-5">{{ __('Grade Remark') }}</th>
                <th width="10%" class="py-5">{{ __('Action') }}</th>
            </template>
            <template #body>
                <template v-if="rules.length > 0">
                    <template v-for="rule in rules" :key="rule.id">
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-5 px-5">
                                {{ rule.name }}
                            </td>
                            <td class="py-5 px-5">
                                {{ rule.gpa }}
                            </td>
                            <td class="py-5 px-5">
                                {{ rule.min_mark }} - {{ rule.max_mark }}
                            </td>
                            <td class="py-5 px-5">
                                {{ rule.grade_remark }}
                            </td>
                            <td class="py-5 px-5 flex gap-2">
                                <button type="button" @click="edit(rule)" class="group relative" :id="'testEditRule' + rule.id">
                                    <PencilSquareIcon class="w-6 h-6 text-blue-400 hover:text-blue-300" />
                                    <tool-tip text="Edit" />
                                </button>
                                <button type="button" @click="destroy(rule.id)" class="group relative" :id="'testDeleteRule' + rule.id">
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
            rules: Array,
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
                    this.$inertia.delete(this.route("result.rule.destroy", id));
                } else {
                    return false;
                }
            },
            edit(rule) {
                this.$emit("edit", rule);
            },
        },
    };
</script>

<style>

</style>
