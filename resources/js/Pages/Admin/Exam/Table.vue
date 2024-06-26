<template>
    <table
        class="w-full overflow-auto text-sm bg-white dark:bg-gray-800 rounded-lg text-left rtl:text-right text-gray-500 dark:text-gray-400" id="testExamDataTable">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="py-4 px-5 whitespace-nowrap">{{ __('Name') }}</th>
                <th scope="col" class="py-4 px-5 whitespace-nowrap">{{ __('GPA') }}</th>
                <th scope="col" class="py-4 px-5 whitespace-nowrap">{{ __('Course') }}</th>
                <th scope="col" width="350" class="py-4 px-5 whitespace-nowrap">{{ __('Description') }}</th>
                <th scope="col" width="10" class="py-4 px-5 whitespace-nowrap">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody class="border-t-2 dark:border-gray-600">
            <template v-if="exams.data.length > 0">
                <template v-for="exam in exams.data" :key="exam.id">
                    <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-5 whitespace-nowrap">
                            <div class="mb-2">{{ exam.name }}</div>
                            <div :class="exam.status == 'Expired'
                                ? 'bg-red-500'
                                : 'bg-blue-500 '
                                " class="inline-block cursor-default dark:opacity-70 text-sm rounded text-white px-2 py-0.5">
                                {{ exam.status }}
                            </div>
                        </td>
                        <td class="py-4 px-5 whitespace-nowrap">
                            {{ exam.gpa }} - {{ exam.grade }}
                        </td>
                        <td class="py-4 px-5 whitespace-nowrap">
                            <div class="text-gray-700 uppercase mb-2">
                                {{ exam.course.name }}
                            </div>
                            <div>{{ formatTime(exam.start_date) }} - {{ formatTime(exam.end_date) }}</div>
                        </td>
                        <td @click="full_description == exam.id ? full_description = '' : full_description = exam.id"
                            class="py-4 px-5 cursor-pointer">
                            <template v-if="full_description == exam.id">
                                {{ exam.description }}
                            </template>
                            <template v-else>
                               {{ __('Click to see')}}
                            </template>
                        </td>
                        <td class="py-4 px-5 whitespace-nowrap flex gap-2">
                            <Link :href="route('exam.edit', exam.id)" class="group relative" :id="'testExamEdit' + exam.id">
                            <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                            <tool-tip :text="__('Edit')" />
                            </Link>
                            <button type="button" @click="destroy(exam.id)" class="group relative" :id="'testExamDelete' + exam.id">
                                <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                <tool-tip :text="__('Delete')" />
                            </button>
                        </td>
                    </tr>
                </template>
            </template>
            <template v-else>
                <NothingFound cssClass="text-center" />
            </template>
        </tbody>
    </table>
</template>

<script>
import ToolTip from "@/Shared/ToolTip.vue";
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';
import NothingFound from "@/Shared/NothingFound.vue";
export default {
    props: {
        exams: Object,
    },
    data() {
        return {
            full_description: ''
        }
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
                this.$inertia.delete(this.route("exam.destroy", id));
            } else {
                return false;
            }
        },
        str_limit(value, size) {
            if (!value) return '';
            value = value.toString();

            if (value.length <= size) {
                return value;
            }
            return value.substr(0, size) + '...';
        },
        edit(exam) {
            this.$emit("edit", exam);
        },
    },
};
</script>

<style>
</style>
