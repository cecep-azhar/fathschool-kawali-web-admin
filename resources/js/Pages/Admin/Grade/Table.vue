<template>
    <global-table>
        <template #head>
            <th scope="col" class="py-4 px-5 whitespace-nowrap">{{ __('Score') }} ({{ __('marks') }})</th>
            <th scope="col" class="py-4 px-5 whitespace-nowrap">{{ __('Grade') }}</th>
            <th scope="col" class="py-4 px-5 whitespace-nowrap">{{ __('Grade Point Average') }} ({{ __('GPA') }})</th>
            <th scope="col" width="10" class="py-4 px-5 whitespace-nowrap">{{ __('Action') }}</th>
        </template>
        <template #body>
            <template v-if="grades.data.length > 0">
                <template v-for="grade in grades.data" :key="grade.id">
                    <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-5 whitespace-nowrap">
                            {{ grade.marks }}
                        </td>
                        <td class="py-4 px-5 whitespace-nowrap">
                            {{ grade.grade }}
                        </td>
                        <td class="py-4 px-5 whitespace-nowrap">
                            {{ grade.gpa }}
                            <span v-if="grade.gpa == 0">(fail)</span>
                        </td>

                        <td class="py-4 px-5 whitespace-nowrap flex gap-2">
                            <button type="button" @click="edit(grade)" class="group relative">
                                <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                <tool-tip :text="__('Edit')" />
                            </button>
                            <button type="button" @click="destroy(grade.id)" class="group relative">
                                <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                <tool-tip :text="__('Delete')" />
                            </button>
                        </td>
                    </tr>
                </template>
            </template>
            <template v-else>
                <NothingFound asShow="div" />
            </template>
        </template>
    </global-table>
</template>

<script>
    import ToolTip from "@/Shared/ToolTip.vue";
    import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        props: {
            grades: Object,
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
                    this.$inertia.delete(this.route("grades.destroy", id));
                } else {
                    return false;
                }
            },
            edit(grade) {
                this.$emit("edit", grade);
            },
        },
    };
</script>

<style>

</style>
