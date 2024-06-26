<template>
    <div class="bg-white cursor-pointer dark:bg-gray-800 p-4 rounded-md" :id="'hoverAssignment' + assignment.id">
        <span @click="assignmentView(assignment.slug)">
            <div class="text-base dark:text-gray-400">
                {{ assignment.title }}
            </div>
            <div class="flex items-center mt-4 dark:text-gray-400">
                <div>
                    <BookOpenIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ __('Course') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ assignment.class ? assignment.class.name : '' }}
                </div>
            </div>
            <div class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <DocumentIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ __('Subject') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ assignment.subject ? assignment.subject.name : '' }}
                </div>
            </div>
            <div class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <UserIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ __('Teacher') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ assignment.teacher ? assignment.teacher.name : '' }}
                </div>
            </div>
            <div class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <CalendarDaysIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ __('Due Date') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ assignment.deadline }}
                </div>
            </div>
            <div v-if="assignment.submitted_done && assignment.status == 'Expired'"
                class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <HashtagIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ __('Gained Mark') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ assignment.total_mark ? assignment.total_mark.gained_mark : '0' }}
                </div>
            </div>
            <div class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <CheckCircleIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-900 dark:text-gray-400 ml-2">
                    {{ __('Status') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400 bg-gray-300 dark:bg-gray-500 px-3 rounded-full ml-2">
                    {{ assignment.status }}
                </div>
            </div>
            <div class="flex items-center whitespace-nowrap truncate mt-2 dark:text-gray-400">
                <div class="flex gap-2">
                    <div class="flex">
                        <FolderMinusIcon class="w-6 h-6" />
                        <div class="text-gray-900 dark:text-gray-400 ml-2">
                            {{ __('Description') }}:
                        </div>
                    </div>
                    <div>
                        {{ str_limit(assignment.description, 60) }}
                    </div>
                </div>
            </div>
        </span>
        <div class="mt-6 flex items-center justify-between overflow-hidden">
            <template v-if="view == 'detail'">
                <button type="button" @click="assignmentView(assignment.slug)"
                    class="bg-blue-500 hover:bg-blue-600 text-white whitespace-nowrap mr-2 px-4 py-2 rounded">
                    {{ __('Details') }}
                </button>
            </template>
            <template v-else>
                <template v-if="$page.props.auth.role == 'Student'">
                    <template v-if="assignment && assignment.total_mark && assignment.total_mark.completed">
                        <button disabled type="button"
                            class="bg-blue-500 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-blue-600 text-white whitespace-nowrap mr-2 px-4 py-2 rounded">
                            {{ __('Completed') }}
                        </button>
                    </template>
                    <template v-else>
                        <button @click="submitAssignmentFunction(assignment.id)" type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white whitespace-nowrap mr-2 px-4 py-2 rounded">
                            {{ assignment.submitted_done ? __('Submit Again') : __('Submit Now') }}
                        </button>
                    </template>
                </template>
            </template>

            <template v-if="assignment.status == 'Due'">
                <span class="text-md text-blue-500" v-if="assignment.submitted_done">{{ __('Submitted') }}</span>
                <span class="text-md text-gray-500" v-else>{{ __('Not Submitted Yet') }}</span>
            </template>

            <template v-if="assignment.status == 'Expired'">
                <div @click="assignmentView(assignment.slug)" class="overflow-hidden w-full"
                    :class="$page.props.auth.role == 'Student' || $page.props.auth.role == 'Teacher' ? 'flex flex-col' : 'flex gap-2 items-center'">
                    <div class="">
                        <span class="text-blue-500 mr-2">
                            {{ assignment.submissions }}%
                        </span>
                        <span
                            class="text-gray-900 whitespace-nowrap overflow-hidden text-ellipsis w-full dark:text-gray-400"
                            v-if="$page.props.auth.role == 'Student' || $page.props.auth.role == 'Teacher'">
                            ({{ assignment.submitted_count }} {{ __('Submissions') }}) {{ assignment.students }} {{
                                __('Students') }}
                        </span>
                    </div>
                    <div class="w-full">
                        <a-tooltip :title="assignment.submissions + '% Submissions'">
                            <a-progress :percent="assignment.submissions" :show-info="false" />
                        </a-tooltip>
                    </div>
                </div>
            </template>

        </div>
    </div>
</template>

<script>
import {
    BookOpenIcon,
    DocumentIcon,
    UserIcon,
    CalendarDaysIcon,
    CheckCircleIcon,
    HashtagIcon,
    FolderMinusIcon
} from "@heroicons/vue/24/outline";

export default {
    props: ['assignment', 'submitAssignmentFunctionParent', 'view'],
    methods: {
        submitAssignmentFunction: function (id) {
            this.submitAssignmentFunctionParent(id);
        },
        assignmentView(slug) {
            this.$inertia.get(route('assignment.detail', slug));
        },
        str_limit(value, size) {
            if (!value) return '';
            value = value.toString();

            if (value.length <= size) {
                return value;
            }
            return value.substr(0, size) + '...';
        },
    },
    components: {
        BookOpenIcon,
        DocumentIcon,
        UserIcon,
        CalendarDaysIcon,
        CheckCircleIcon,
        HashtagIcon,
        FolderMinusIcon
    },
};
</script>

<style lang="scss" scoped>
</style>
