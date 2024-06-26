<template>

    <Head :title="course.name" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :href="route('my-subject')" title="My Courses" />
            <BreadcrumbLink :title="course.name" />
        </Breadcrumb>

        <div class="my-2">
            <page-header >
                {{ course.name }}
                <template #content>
                    <div class="font-medium text-base text-black dark:text-gray-500 items-center mt-3">
                        <div class="flex gap-6">
                            <div @click="filter = 'class'"
                                class="hover:text-blue-500 relative group cursor-pointer text-sm font-normal">
                                {{ __('Details') }}
                                <div class="mt-2"></div>
                                <div :class="
                                    filter == 'class'
                                        ? 'opacity-100'
                                        : 'opacity-0'
                                "
                                    class="group-hover:opacity-100 duration-300 absolute left-0 bottom-0 right-0 z-10 border-b-2 border-blue-500 dark:border-gray-600">
                                </div>
                            </div>
                            <div @click="filter = 'schedule'"
                                class="hover:text-blue-500 relative group cursor-pointer text-sm font-normal">
                                {{ __('Course Schedule') }}
                                <div class="mt-2"></div>
                                <div :class="filter == 'schedule' ? 'opacity-100' : 'opacity-0'"
                                    class="group-hover:opacity-100 duration-300 absolute left-0 bottom-0 right-0 z-10 border-b-2 border-blue-500 dark:border-gray-600">
                                </div>
                            </div>
                            <div @click="filter = 'student'"
                                class="hover:text-blue-500 relative group cursor-pointer text-sm font-normal">
                                {{ __('Student List') }}
                                <div class="mt-2"></div>
                                <div :class="
                                    filter == 'student'
                                        ? 'opacity-100'
                                        : 'opacity-0'
                                "
                                    class="group-hover:opacity-100 duration-300 absolute left-0 bottom-0 right-0 z-10 border-b-2 border-blue-500 dark:border-gray-600">
                                </div>
                            </div>
                            <div @click="filter = 'assignment'"
                                class="hover:text-blue-500 relative group cursor-pointer text-sm font-normal">
                                {{ __('Assignments') }}
                                <div class="mt-2"></div>
                                <div :class="
                                    filter == 'assignment'
                                        ? 'opacity-100'
                                        : 'opacity-0'
                                "
                                    class="group-hover:opacity-100 duration-300 absolute left-0 bottom-0 right-0 z-10 border-b-2 border-blue-500 dark:border-gray-600">
                                </div>
                            </div>
                            <div @click="filter = 'online_class'"
                                class="hover:text-blue-500 relative group cursor-pointer text-sm font-normal">
                                {{ __('Online Class') }}
                                <div class="mt-2"></div>
                                <div :class="
                                    filter == 'online_class'
                                        ? 'opacity-100'
                                        : 'opacity-0'
                                "
                                    class="group-hover:opacity-100 duration-300 absolute left-0 bottom-0 right-0 z-10 border-b-2 border-blue-500 dark:border-gray-600">
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </page-header>
            <div class="grid gap-6 grid-cols-1 md:grid-cols-4">
                <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 col-span-3 auto-rows-min">
                    <!-- class details  -->
                    <div v-if="filter == 'class'" class="bg-white dark:bg-gray-800 rounded-lg p-6 col-span-3">
                        <div class="text-black dark:text-gray-400 font-bold text-2xl mb-2">
                            {{ course.name }}
                        </div>
                        <div class="text-black font-normal text-sm mt-1 dark:text-gray-400">
                            {{ __('Course') }}:
                            {{ course.course ? course.course.name : "" }}
                        </div>
                    </div>

                    <!-- course schedule  -->
                    <div v-if="filter == 'schedule'" class="col-span-3">
                        <div
                            class="dark:text-gray-400 px-6 py-4 rounded-lg bg-white dark:bg-gray-800 font-semibold text-base mb-5">
                            {{ __('Course Schedule') }}
                        </div>

                        <div class="overflow-x-auto relative rounded-lg">
                            <div class="col-span-2 bg-white overflow-x-auto rounded-lg dark:bg-gray-800 p-6">
                                <FullCalendar :options="calendarOptions" class="min-w-[991px]" />
                            </div>
                        </div>
                    </div>

                    <!-- Class Student s  -->
                    <div v-if="filter == 'student'" class="col-span-3">
                        <div
                            class="dark:text-gray-400 px-6 py-4 rounded-lg bg-white dark:bg-gray-800 font-semibold text-base mb-5">
                            {{ __('Student List') }}
                        </div>

                        <div class="overflow-x-auto relative rounded-lg">
                            <global-table>
                                <template #head>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Student Name') }}</th>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Student ID') }}</th>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Phone Number') }}</th>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Email') }}</th>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Date of Birth') }}</th>
                                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Action') }}</th>
                                </template>
                                <template #body>
                                    <template v-if="students.data.length > 0">
                                        <tr v-for="student in students.data" :key="student.id"
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="py-4 px-5">
                                                <span
                                                    class="flex items-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-12 h-12 rounded-full"
                                                        :src="student.user.profile_photo_url"
                                                        :alt="student.user.name" />
                                                    <div class="ml-2">
                                                        <h3 class="mb-1.5">
                                                            {{ student.user.name }}
                                                        </h3>
                                                        <p class="flex gap-3 items-center mb-0">
                                                            <span class="bg-gray-100 py-1 px-3 rounded-3xl">male</span>
                                                            <span class="bg-gray-100 py-1 px-3 rounded-3xl">Class
                                                                IV</span>
                                                        </p>
                                                    </div>
                                                </span>
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ student?.user?.profile?.student_id ?? '' }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                <p class="flex gap-2 items-center mb-0">
                                                    <PhoneIcon class="w-6 h-6" />
                                                    {{ student.user.phone }}
                                                </p>
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                <p class="flex gap-2 items-center mb-0">
                                                    <EnvelopeIcon class="w-6 h-6" /> {{ student.user.email }}
                                                </p>
                                            </td>
                                            <td class="py-4 px-5">
                                                <p class="flex whitespace-nowrap gap-2 items-center mb-0">
                                                    <CalendarIcon class="w-6 h-6" />
                                                    {{ student.user.join_date }}
                                                </p>
                                            </td>
                                            <td class="py-4 px-5">
                                                <Link preserve-scroll
                                                    :href="route('teacher.student.show', student.user.username)"
                                                    class="group relative">
                                                    <eye-icon class="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                                    <tool-tip :text="__('View')" />
                                                </Link>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="5">
                                                <div class="text-center p-4">
                                                    {{ __('Nothing Found') }}
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </global-table>
                            <div class="flex justify-center col-span-3">
                                <pagination class="mt-6" :links="students.links" />
                            </div>
                        </div>
                    </div>

                    <!-- Class Assignment  -->
                    <div v-if="filter == 'assignment'"
                        class="bg-white dark:bg-gray-800 dark:text-gray-400 rounded-lg px-6 py-4 font-semibold text-base col-span-3">
                        {{ __('Class Assignment') }}
                    </div>
                    <template v-if="filter == 'assignment'">
                        <template v-if="assignments.data.length > 0">
                            <div class="bg-white dark:bg-gray-800 rounded-lg dark:text-gray-400"
                                v-for="assignment in assignments.data" :key="assignment.id">
                                <div class="flex justify-between px-6 pt-6">
                                    <h2 class="text-black dark:text-gray-400 font-medium">
                                        {{ assignment.title }}
                                    </h2>
                                </div>
                                <hr class="dark:border-gray-700" />
                                <div class="mt-7 ml-6 mr-6">
                                    <div
                                        class="flex justify-between font-normal text-base text-black dark:text-gray-400">
                                        <div>{{ __('Subjects') }}</div>
                                        <div>{{ assignment.subject.name }}</div>
                                    </div>
                                    <div
                                        class="flex justify-between font-normal text-base text-black dark:text-gray-400">
                                        <div>{{ __('Course') }}</div>
                                        <div>{{ assignment.class.name }}</div>
                                    </div>
                                    <div class="mt-4 text-[ #767676] text-sm font-normal dark:text-gray-400">
                                        {{ __('Start Date') }}: {{ assignment.start_date }}
                                    </div>
                                    <div class="mt-4 text-[ #767676] text-sm font-normal dark:text-gray-400">
                                        {{ __('End Date') }}: {{ assignment.end_date }}
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
                                        class="flex justify-between mt-6 font-normal text-black dark:text-gray-400 text-sm">
                                        <div>{{ __('Submissions Progress') }}</div>
                                        <div>{{ assignment.submissions }}%</div>
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
                                        assignment.class.students.length > 0
                                    ">
                                        <img v-for="(student, i) in assignment
                                            .class.students" :key="student.id"
                                            :class="i == 0 ? '' : '-ml-3 z-[' + i0 + ']'"
                                            class="w-10 h-10 object-fill rounded-full"
                                            :src="student.user.profile_photo_url" :alt="student.name" />
                                    </div>
                                    <div class="mb-6"></div>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="text-center col-span-3 dark:text-gray-400">
                                No Assignment
                            </div>
                        </template>
                    </template>
                    <!-- online class  -->
                    <template v-if="filter == 'online_class'">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 col-span-3">
                            <div class="flex justify-between items-center text-center">
                                <div class="text-lg font-bold dark:text-gray-400">
                                    {{ __('Classes') }}
                                </div>
                                <global-button :loading="false" type="button" @click="showModal" theme="primary">
                                    {{ __('Create a new class') }}
                                </global-button>
                            </div>
                            <div class="flex flex-wrap gap-6 mt-1 dark:text-gray-400">
                                <Link preserve-scroll @click="filter = 'online_class'" :href="
                                    route('subject.details', course.id)" :data="{ status: 'all' }"
                                    type="button"
                                    :class="request_data && request_data.status == 'all' ? 'border-b-2 dark:border-gray-600' : '' || route().params.status ? '' : 'border-b-2 dark:border-gray-600'"
                                    class="font-semibold text-md">
                                {{ __('All') }}
                                </Link>
                                <Link preserve-scroll @click="filter = 'online_class'" :href="
                                    route('subject.details', course.id)" :data="{ status: 'upcoming' }"
                                    type="button"
                                    :class="request_data && request_data.status == 'upcoming' ? 'border-b-2 dark:border-gray-600' : ''"
                                    class="font-semibold text-md">
                                {{ __('Upcoming') }}
                                </Link>
                                <Link preserve-scroll @click="filter = 'online_class'" :href="
                                    route('subject.details', course.id )" :data="{ status: 'completed' }"
                                    type="button"
                                    :class="request_data && request_data.status == 'completed' ? 'border-b-2 dark:border-gray-600' : ''"
                                    class="font-semibold text-md">
                                {{ __('Completed') }}
                                </Link>
                            </div>
                        </div>
                        <template v-if="online_classes.data.length > 0">
                            <div v-for="course in online_classes.data" :key="course"
                                class="bg-white col-span-3 lg:col-span-1 rounded-lg dark:bg-gray-800">
                                <div
                                    class="p-3 flex justify-between text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-400">
                                    <div>{{ course.title }}</div>
                                    <div class="flex gap-1">
                                        <button @click="edit(course)" type="button">
                                            <pencil-icon class="w-6 h-6 text-purple-500 hover:text-purple-400" />
                                        </button>
                                        <button @click="destroy(course.id)" type="button">
                                            <trash-icon class="w-6 h-6 text-red-500 hover:text-red-400" />
                                        </button>
                                    </div>
                                </div>
                                <hr class="p-0 border dark:border-gray-600" />
                                <div class="p-3 text-base font-semibold dark:text-gray-400 mb-2">
                                    <div>{{ __('Course Topic') }}: {{ course.topic }}</div>
                                    <div>
                                        {{ __('Start Date') }}:
                                        {{ course.start_date_format }}
                                    </div>
                                    <div>
                                        {{ __('Subject') }}: {{ course.subject.name }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div>{{ __('Start Link') }}:</div>
                                        <a :href="course.start_url" target="__blank" class="text-sm font-bold">
                                            {{ __('Start Class') }}
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div>{{ __('Join Link') }}:</div>
                                        <a :href="course.join_url" target="__blank" class="text-sm font-bold">
                                            {{ __('Join') }}
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
                        </template>
                        <template v-else>
                            <div class="text-center col-span-3 text-gray-600 dark:text-gray-400">
                                {{ __('No Course Available') }}
                            </div>
                        </template>
                        <div class="flex justify-center col-span-3">
                            <pagination class="mt-6" :links="online_classes.links" />
                        </div>
                        <br>
                        <br>
                    </template>
                </div>
                <div class="col-span-3 md:col-span-1">
                    <div v-if="next_course" class="bg-white dark:bg-gray-800 dark:text-gray-400 rounded-lg">
                        <div class="py-4 px-6">
                            <div class="text-black dark:text-gray-400 font-bold text-lg">
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
                                        <div class="text-[#0E0E0E;] text-sm font-normal">
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
        <!-- online class create modal  -->
        <online-class :course="course" :subjects="subjects" :edit_item="edit_item" ref="online_class_form" />
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import OnlineClass from "./OnlineClass.vue";
    import { CalendarIcon, EnvelopeIcon, PhoneIcon, PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";
    import { Progress, Tooltip } from "ant-design-vue";

    import '@fullcalendar/core/vdom'
    import FullCalendar from '@fullcalendar/vue3'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import timeGridPlugin from '@fullcalendar/timegrid'
    import listPlugin from '@fullcalendar/list'
    import interactionPlugin, { Draggable } from "@fullcalendar/interaction";
    import dayjs, { Dayjs } from 'dayjs';

    export default {
        data() {
            return {
                filter: this.request_data.status ? "online_class" : "class",
                edit_item: "",
                calendarOptions: {
                    locale: this.$page.props.locale,
                    plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                    initialView: 'timeGridWeek',
                    selectable: false,
                    editable: false,
                    height: 800,
                    buttonText: {
                        prev: this.__('prev'),
                        next: this.__('next'),
                        today: this.__('today'),
                        month: this.__('month'),
                        week: this.__('week'),
                        day: this.__('day'),
                        list: this.__('list'),
                    },
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    // firstDay: this.$page.props.start_day_of_week,
                    events: this.schedules,
                    eventContent: function (arg) {
                        return {
                            html: arg.event.title.replace(/<br>/g, '<br>')
                        }
                    },
                },
            };
        },
        props: {
            course: Object,
            assignments: Object,
            students: Object,
            request_data: Object,
            online_classes: Object,
            next_course: Object,
            subjects: Object,
            schedules: Object,
        },
        components: {
            AppLayout,
            Pagination,
            OnlineClass,
            PencilSquareIcon,
            TrashIcon,
            EnvelopeIcon,
            PhoneIcon,
            EyeIcon,
            CalendarIcon,
            "a-progress": Progress,
            "a-tooltip": Tooltip,
            FullCalendar,
        },
        methods: {
            showModal() {
                this.$refs.online_class_form.showModal();
            },
            edit(arg) {
                this.edit_item = arg;
                this.$refs.online_class_form.showModal();
            },
            destroy(id) {
                if (confirm("Are you sure ?")) {
                    this.$inertia.delete(
                        this.route("online.class.destroy", id), {
                        preserveScroll: true,
                        onSuccess: (page) => {
                            this.visible = false;
                        },
                    }
                    );
                } else {
                    return false;
                }
            },
        },
    };
</script>
