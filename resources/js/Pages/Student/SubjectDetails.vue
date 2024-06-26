<template>

    <Head :title="subject.name" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="subject.name" />
        </Breadcrumb>

        <div class="my-2">
            <page-header :classes="flex-wrap">
                <div class="font-medium text-base text-gray-900 dark:text-gray-500 flex justify-between items-center">
                    <div>{{ __('Subject Details') }}</div>
                </div>
                <div class="font-medium text-base text-gray-900 dark:text-gray-500 items-center mt-3">
                    <div class="flex gap-6">
                        <Link preserveScroll :href="route('subject.show', subject.slug)" :data="{ filter: 'details' }" class="hover:text-blue-500 relative group cursor-pointer text-sm font-normal">
                            {{ __('Details') }}
                            <div class="mt-2"></div>
                            <div :class=" filter == 'details' ? 'opacity-100': 'opacity-0'" class="group-hover:opacity-100 duration-300 absolute left-0 bottom-0 right-0 z-10 border-b-2 border-blue-500 dark:border-gray-600">
                            </div>
                        </Link>
                        <Link preserveScroll :href="route('subject.show', subject.slug)" :data="{ filter: 'student' }" class="hover:text-blue-500 relative group cursor-pointer text-sm font-normal">
                            {{ __('Student List') }}
                            <div class="mt-2"></div>
                            <div :class="filter == 'student' ? 'opacity-100' : 'opacity-0'" class="group-hover:opacity-100 duration-300 absolute left-0 bottom-0 right-0 z-10 border-b-2 border-blue-500 dark:border-gray-600">
                            </div>
                        </Link>
                        <Link preserveScroll :href="route('subject.show', subject.slug)" :data="{ filter: 'online_class' }" class="hover:text-blue-500 relative group cursor-pointer text-sm font-normal">
                            {{ __('Online Class') }}
                            <div class="mt-2"></div>
                            <div :class="filter == 'online_class' ? 'opacity-100' : 'opacity-0'" class="group-hover:opacity-100 duration-300 absolute left-0 bottom-0 right-0 z-10 border-b-2 border-blue-500 dark:border-gray-600">
                            </div>
                        </Link>
                        <Link preserveScroll :href="route('subject.show', subject.slug)" :data="{ filter: 'assignment' }" class="hover:text-blue-500 relative group cursor-pointer text-sm font-normal">
                            {{ __('Assignments') }}
                            <div class="mt-2"></div>
                            <div :class="filter == 'assignment' ? 'opacity-100' : 'opacity-0'" class="group-hover:opacity-100 duration-300 absolute left-0 bottom-0 right-0 z-10 border-b-2 border-blue-500 dark:border-gray-600">
                            </div>
                        </Link>
                    </div>
                </div>
            </page-header>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="col-span-2">
                    <!-- subject details  -->
                    <div v-if="filter == 'details'" class="bg-white dark:bg-gray-800 rounded-lg p-5">
                        <div class="text-gray-900 dark:text-gray-400 font-bold text-2xl mb-2">
                            {{ subject.name }}
                        </div>
                        <div class="text-gray-900 font-normal text-sm mt-1 dark:text-gray-400">
                            {{ __('Course') }}: {{ subject.course.name ?? "" }}
                        </div>
                    </div>
                    <!-- Subject class Student's  -->
                    <div v-if="filter == 'student'" class="col-span-3">
                        <div
                            class="dark:text-gray-400 px-6 py-4 rounded-lg bg-white dark:bg-gray-800 font-semibold text-base mb-5">
                            {{ __('Student List') }}
                        </div>

                        <div class="overflow-x-auto relative rounded-lg">
                            <global-table>
                                <template #head>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Student Name') }}</th>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Roll') }}</th>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Guardian Name') }}</th>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Contact Number') }}</th>
                                    <th width="10%" class="py-4 px-5 whitespace-nowrap">{{ __('Email') }}</th>
                                </template>
                                <template #body>
                                    <template v-if="students.data.length > 0">
                                        <tr v-for="student in students.data" :key="student.id"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="py-4 px-5">
                                                <span
                                                    class="flex items-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-8 h-8 rounded" :src="
                                                            student.user
                                                                .profile_photo_url
                                                        " :alt="student.user.name" />
                                                    <span class="ml-2">
                                                        {{ student.user.name }}
                                                    </span>
                                                </span>
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ student.roll_no }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ student.user ? student.user.profile ? student.user.profile.parent ?
                                                student.user.profile.parent.name : '' : '' : '' }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ student.user.phone }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ student.user.email }}
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <NothingFound asShow="tr" />
                                    </template>
                                </template>
                            </global-table>
                            <div class="flex justify-center col-span-3">
                                <pagination class="mt-6" :links="students.links" />
                            </div>
                        </div>
                    </div>
                    <!-- Subject Class Online lesion  -->
                    <template v-if="filter == 'online_class'">
                        <template v-if="filter == 'online_class'">
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 col-span-3">
                                <div class="flex justify-between items-center text-center">
                                    <div class="text-lg font-bold dark:text-gray-400">
                                        {{ __('Classes') }}
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-6 mt-1 dark:text-gray-400">
                                    <Link preserve-scroll @click="filter = 'online_class'" :href="
                                            route(
                                                'subject.show',
                                                subject.slug
                                            )
                                        " :data="{
                                            status: 'all',
                                            filter: 'online_class',
                                        }" type="button" :class="
                                            request_data &&
                                            request_data.status == 'all'
                                                ? 'border-b-2 dark:border-gray-600'
                                                : '' || route().params.status
                                                ? ''
                                                : 'border-b-2 dark:border-gray-600'
                                        " class="font-semibold text-md">
                                    {{ __('All') }}
                                    </Link>
                                    <Link preserve-scroll @click="filter = 'online_class'" :href="
                                            route(
                                                'subject.show',
                                                subject.slug
                                            )
                                        " :data="{
                                            status: 'upcoming',
                                            filter: 'online_class',
                                        }" type="button" :class="
                                            request_data &&
                                            request_data.status == 'upcoming'
                                                ? 'border-b-2 dark:border-gray-600'
                                                : ''
                                        " class="font-semibold text-md">
                                    {{ __('Upcoming') }}
                                    </Link>
                                    <Link preserve-scroll @click="filter = 'online_class'" :href="
                                            route(
                                                'subject.show',
                                                subject.slug
                                            )
                                        " :data="{
                                            status: 'completed',
                                            filter: 'online_class',
                                        }" type="button" :class="
                                            request_data &&
                                            request_data.status == 'completed'
                                                ? 'border-b-2 dark:border-gray-600'
                                                : ''
                                        " class="font-semibold text-md">
                                    {{ __('Completed') }}
                                    </Link>
                                </div>
                            </div>
                            <template v-if="online_classes.data.length > 0">
                                <div class="grid grid-cols-3 gap-4 mt-3">
                                    <div v-for="course in online_classes.data" :key="course"
                                        class="bg-white col-span-3 lg:col-span-1 rounded-lg dark:bg-gray-800">
                                        <div
                                            class="p-3 flex justify-between text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-400">
                                            <div>{{ course.topic }}</div>
                                        </div>
                                        <hr class="p-0 border dark:border-gray-600" />
                                        <div class="p-3 text-base font-semibold dark:text-gray-400 mb-2">
                                            <div>
                                                {{ __('Start Date') }}:
                                                {{ course.start_date_format }}
                                            </div>
                                            <div>
                                                {{ __('Subject') }}:
                                                {{ course.subject.name }}
                                            </div>
                                            <div>
                                                {{ __('Join Link') }} :
                                                <a :href="course.join_url" target="__blank"
                                                    class="text-base font-semibold text-center">
                                                    <span
                                                        class="text-sm text-blue-500 hover:text-blue-400 cursor-pointer">
                                                        {{ __('Join Class') }}
                                                    </span>
                                                </a>
                                            </div>
                                            <span :class="
                                                    course.status == 'Upcoming'
                                                        ? 'border border-yellow-400 text-yellow-800'
                                                        : 'border border-green-400'
                                                "
                                                class="inline-flex mt-4 items-center py-1 px-3 mr-2 border border-blue-400 text-sm font-medium hover:bg-blue-100 rounded dark:bg-blue-200 dark:text-blue-800">
                                                {{ course.status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <div class="text-center col-span-3 text-gray-600 dark:text-gray-400">
                                    <div class="p-2">{{ __('No Course Available') }} .</div>
                                </div>
                            </template>
                            <div class="flex justify-center col-span-3">
                                <pagination class="mt-6" :links="online_classes.links" />
                            </div>
                        </template>
                    </template>
                    <!-- Class Assignment  -->
                    <div v-if="filter == 'assignment'"
                        class="bg-white dark:bg-gray-800 dark:text-gray-400 rounded-lg px-6 py-4 font-semibold text-base col-span-3">
                        {{ __('Subject Assignment') }}
                    </div>
                    <template v-if="filter == 'assignment'">
                        <template v-if="assignments.data.length > 0">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                                <div class="bg-white dark:bg-gray-800 rounded-lg dark:text-gray-400 mt-2"
                                    v-for="assignment in assignments.data" :key="assignment.id">
                                    <div class="flex justify-between px-6 pt-6">
                                        <h2 class="text-gray-900 dark:text-gray-400 font-medium">
                                            {{ assignment.title }}
                                        </h2>
                                    </div>
                                    <hr class="dark:border-gray-700" />
                                    <div class="mt-7 ml-6 mr-6">
                                        <div
                                            class="flex justify-between font-normal text-base text-gray-900 dark:text-gray-400">
                                            <div>{{ __('Subjects') }}</div>
                                            <div>
                                                {{ assignment.subject.name }}
                                            </div>
                                        </div>
                                        <div
                                            class="flex justify-between font-normal text-base text-gray-900 dark:text-gray-400">
                                            <div>{{ __('Course') }}</div>
                                            <div>
                                                {{ assignment.class.name }}
                                            </div>
                                        </div>
                                        <!-- <div
                                            class="flex justify-between font-normal text-base text-gray-900 dark:text-gray-400">
                                            <div>{{ __('Total Students') }}</div>
                                            <div>209</div>
                                        </div>
                                        <div
                                            class="flex justify-between mt-1 font-normal text-base text-gray-900 dark:text-gray-400">
                                            <div>{{ __('Submissions') }}</div>
                                            <div>23</div>
                                        </div> -->
                                        <div class="mt-4 text-[ #767676] text-sm font-normal dark:text-gray-400">
                                            {{ __('Start Date') }}:
                                            {{ formatTime(assignment.start_date) }}
                                        </div>
                                        <div class="mt-4 text-[ #767676] text-sm font-normal dark:text-gray-400">
                                            {{ __('End Date') }}: {{ formatTime(assignment.end_date) }}
                                        </div>
                                        <div class="mt-4 text-[ #767676] text-sm font-normal dark:text-gray-400">
                                            {{ __('Status') }}:
                                            <span :class="
                                                    assignment.status == 'Due'
                                                        ? 'bg-blue-100 text-blue-800 dark:bg-blue-200 dark:text-blue-800'
                                                        : 'bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-800'
                                                " class="text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                {{ assignment.status }}
                                            </span>
                                        </div>
                                        <div v-if="assignment.status == 'Due'"
                                            class="mt-4 text-[ #767676] text-sm font-normal dark:text-gray-400">
                                            {{ __('Remaining Submissions') }}:
                                            {{ assignment.remaining_days }} {{ __('Days') }}
                                        </div>
                                        <div
                                            class="flex justify-between mt-6 font-normal text-gray-900 dark:text-gray-400 text-sm">
                                            <div>{{ __('Submissions Progress') }}</div>
                                            <div>
                                                {{ assignment.submissions }} %
                                            </div>
                                        </div>
                                        <div class="mt-3 dark:text-gray-400">
                                            <a-tooltip title="Total Submissions">
                                                <a-progress strokeWidth="12" strokeColor="#f5f5f5" :percent="100"
                                                    :success-percent="
                                                        assignment.submissions
                                                    " />
                                            </a-tooltip>
                                        </div>
                                        <div class="flex mt-3" v-if="
                                                assignment.class.students
                                                    .length > 0
                                            ">
                                            <img v-for="(
                                                    student, i
                                                ) in assignment.class.students" :key="student.id" :class="
                                                    i == 0
                                                        ? ''
                                                        : '-ml-3 z-[' + i0 + ']'
                                                " class="w-10 h-10 object-fill rounded-full" :src="
                                                    student.user
                                                        .profile_photo_url
                                                " :alt="student.name" />
                                        </div>
                                        <div class="mb-6"></div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="text-center col-span-3 dark:text-gray-400">
                                {{ __('No Assignment') }}
                            </div>
                        </template>
                        <div class="flex justify-center col-span-3">
                            <pagination class="mt-6" :links="assignments.links" />
                        </div>
                    </template>
                </div>
                <div class="col-span-1">
                    <div v-if="next_course" class="bg-white dark:bg-gray-800 dark:text-gray-400 rounded-lg">
                        <div class="py-4 px-6">
                            <div class="text-gray-900 dark:text-gray-400 font-bold text-lg">
                                {{ __('Next Class') }}
                            </div>
                            <div class="mt-4">
                                <div class="flex justify-between items-center">
                                    <div class="font-bold text-sm flex items-center">
                                        <div class="ml-1.5">{{ __('Course by') }}</div>
                                    </div>
                                    <div class="text-sm font-normal flex items-center">
                                        <div>
                                            <img class="w-6 h-6 rounded-full" :src="
                                                    next_course.teacher
                                                        .profile_photo_url
                                                " :alt="next_course.teacher.name" />
                                        </div>
                                        <div class="ml-1">
                                            {{ next_course.teacher.name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 flex justify-between items-center">
                                    <div class="font-bold text-sm flex items-center">
                                        <div class="ml-1.5">{{ __('Start Date') }}</div>
                                    </div>
                                    <div class="text-sm font-normal flex items-center">
                                        <div class="ml-1">
                                            {{ next_course.start_date_format }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 flex justify-between items-center">
                                    <div class="font-bold text-sm flex items-center">
                                        <div class="ml-1.5">{{ __('Subject') }}</div>
                                    </div>
                                    <div class="text-sm font-normal flex items-center">
                                        <div class="ml-1">
                                            <a :href="next_course.join_url" target="__blank" class="text-sm font-bold">
                                                {{ __('Join') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 flex justify-between items-center">
                                    <div class="font-bold text-sm flex items-center">
                                        <div class="ml-1.5">{{ __('Status') }}</div>
                                    </div>
                                    <div class="text-sm font-normal flex items-center bg-blue-100 rounded-sm">
                                        <div class="text-blue-500 p-0.5 px-2 rounded me-1 text-[12px]">
                                            {{ next_course.status }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 flex justify-between items-center">
                                    <div class="font-bold text-sm flex items-center">
                                        <div class="ml-1.5">{{ __('Password') }}</div>
                                    </div>
                                    <div class="text-sm font-normal flex items-center">
                                        <div class="text-gray-900 dark:text-gray-400 text-sm font-normal">
                                            {{ next_course.password }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center mt-9 mb-4">
                                    <a :href="next_course.join_url" target="__blank">
                                        <global-button :loading="false" type="button" cssClass="px-6" theme="primary">
                                            {{ __('Join Class') }}
                                        </global-button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import {
        Progress,
        Tooltip
    } from "ant-design-vue";
    import {
        PencilSquareIcon,
        TrashIcon
    } from '@heroicons/vue/24/outline';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        data() {
            return {
                filter: this.request_data.length != 0 ?
                    this.request_data.filter :
                    "details",
            };
        },
        props: {
            subject: Object,
            assignments: Object,
            students: Object,
            request_data: Object,
            online_classes: Object,
            next_course: Object,
        },
        components: {
            AppLayout,
            Pagination,
            TrashIcon,
            PencilSquareIcon,
            NothingFound,
            "a-progress": Progress,
            "a-tooltip": Tooltip,
        },
        methods: {},
    };
</script>
<style lang="css">
    .ant-progress-text {
        color: white !important;
    }
</style>
