<template>
    <div class="col-span-2 bg-white dark:bg-gray-800 dark:text-gray-600 rounded-lg">
        <global-table>
            <template #head>
                <th class="py-5 px-5">{{ __('Name') }}</th>
                <th width="10%" class="py-5 px-3">{{ __('Action') }}</th>
            </template>
            <template #body>
                <template v-if="studyPrograms.data.length > 0">
                    <template v-for="studyProgram in studyPrograms.data" :key="studyProgram.id">
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-5 px-5">
                                {{ studyProgram.name }}
                            </td>
                            <td class="py-5 px-3 flex gap-3">
                                <button type="button" @click="edit(studyProgram)" class="group relative" :id="'testEditDepartment' + studyProgram.id">
                                    <PencilSquareIcon class="w-6 h-6 text-blue-400 hover:text-blue-300" />
                                    <tool-tip text="Edit" />
                                </button>
                                <button type="button" @click="destroy(studyProgram.id)" class="group relative" :id="'testDeleteDepartment' + studyProgram.id">
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
            studyPrograms: Object,
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
                    this.$inertia.delete(this.route("study_programs.destroy", id));
                } else {
                    return false;
                }
            },
            edit(studyProgram) {
                this.$emit("edit", studyProgram);
            },
        },
    };
</script>

<style>

</style>
