<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-6">
        <div class="flex justify-between items-center text-center">
            <div class="text-lg font-bold dark:text-gray-400">
                {{ __('Syllabus') }}
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg">
        <global-table classes="">
            <template #head>
                <th class="py-4 px-5">{{ __('Subject') }}</th>
                <th class="py-4 px-5">{{ __('Course') }}</th>
                <th class="py-4 px-5">{{ __('Syllabus') }}</th>
                <th v-if="can('syllabus.edit') || can('syllabus.destroy')" width="10%" class="py-4 px-5">{{ __('Action')
                    }}</th>
            </template>
            <template #body>
                <template v-if="syllabuses.data.length > 0">
                    <template v-for="syllabus in syllabuses.data" :key="syllabus.id">
                        <tr
                            class="text-left rtl:text-right border-t dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600">
                            <td class="py-4 px-5">
                                {{ syllabus.subject.name }}
                            </td>
                            <td class="py-4 px-5">
                                {{ syllabus.class.name }}
                            </td>
                            <td class="py-4 px-5">
                                <button @click="
                                    download(syllabus.syllabus)
                                " class="text-blue-500 cursor-pointer whitespace-nowrap">
                                    {{ __('Download Syllabus') }}
                                </button>
                            </td>
                            <td v-if="can('syllabus.edit') || can('syllabus.destroy')" class="py-4 px-5">
                                <div class="flex items-start gap-2 text-gray-900 whitespace-nowrap dark:text-white">
                                    <Link :href="route('syllabus.index')"
                                        :data="{ title: syllabus.subject ? syllabus.subject.name : '' }"
                                        class="group relative">
                                    <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                    <tool-tip text="Edit" />
                                    </Link>

                                    <Link :href="route('syllabus.index')"
                                        :data="{ title: syllabus.subject ? syllabus.subject.name : '' }"
                                        class="group relative">
                                    <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                    <tool-tip :text="__('Delete')" />
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </template>
                </template>
                <template v-else>
                    <NothingFound asShow="tr" />
                </template>
            </template>
        </global-table>
        <div class="flex justify-center">
            <pagination class="mt-6" :links="syllabuses.links" />
        </div>
    </div>
    <br>
    <br>
</template>

<script>
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import {
        PencilSquareIcon,
        TrashIcon
    } from "@heroicons/vue/24/outline";
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        props: {
            syllabuses: Object,
        },
        components: {
            Pagination,
            PencilSquareIcon,
            TrashIcon,
            NothingFound
        },
        data() {
            return {
            }
        },
        methods: {
        }
    };
</script>
<style scoped>
</style>
