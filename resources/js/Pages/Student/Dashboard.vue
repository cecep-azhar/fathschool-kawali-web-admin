<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import StatCard from '@/Components/Dashboard/StatCard.vue';
import SingleAssignment from './SingleAssignment.vue'
import PieChart from '@/Components/Chart/FeesCollectPieChart.vue';
import BarChart from '@/Components/Chart/BarChart.vue';
import {
    BookOpenIcon,
    ClockIcon,
    CheckCircleIcon
} from '@heroicons/vue/24/outline';

export default {
    props: {
        total_students: Number,
        upcoming_events: Number,
        pending_assignments: Number,
        pending_fees: Number,
        today_classes: Object,
        next_assignments: Object,
        upcoming_exams: Object,
        upcoming_events: Object,
        total_amount: Number,
        total_due_amount: Number,
        total_assignments: Number,
        total_submitted_assignments: Number,
        total_remaining_assignments: Number,
        upcoming_classes: Number,
        present_classes: Number,
        late_classes: Number,
        absent_classes: Number,
        user_courses_name: Array,
        attendance_arr: Object,
        this_year_labels: Array,
        this_year_values: Array,
    },
    data() {
        return {
        }
    },
    components: {
        AppLayout,
        PieChart,
        StatCard,
        ClockIcon,
        BookOpenIcon,
        SingleAssignment,
        CheckCircleIcon,
        BarChart
    },
    methods: {
    }
}
</script>

<template>
    <AppLayout :title="__('Dashboard')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Dashboard')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __('Dashboard') }}
                </div>
            </page-header>
            <div class="grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mb-[25px]">
                <Link :href="route('my.courses')"
                    class="bg-white hover:shadow rounded-lg dark:hover:bg-gray-800 dark:bg-gray-800 dark:border-gray-700">
                <div class="border-b dark:border-gray-600">
                    <div class="p-4 text-gray-700 dark:text-gray-400 text-lg font-bold">
                        {{ __('My Courses') }}
                    </div>
                </div>
                <div class="p-4 text-gray-700 dark:text-gray-400" v-if="!injected">
                    <div class="text-lg mb-2 font-bold">
                        <template v-for="(name, index) in user_courses_name">
                            {{ name }}
                            <template v-if="index != user_courses_name.length - 1">,</template>
                        </template>
                    </div>
                    <div class="text-md text-gray-900 dark:text-gray-400">
                        {{ total_students }}+ {{ __('Students') }}
                    </div>
                </div>
                </Link>
                <stat-card :title="__('Upcoming Classes')" :route="route('online.classes')"
                    :value="upcoming_classes" :label="__('Upcoming Classes')" />
                <stat-card :title="__('Pending Assignments')" :route="route('assignment.list')"
                    :value="pending_assignments" :label="__('Pending Assignments')" />
                <stat-card :title="__('Pending Fees')" :route="route('all.transaction')" :value="pending_fees"
                    :label="__('Pending Fees')" />
            </div>

            <div class="grid md:grid-cols-2 2xl:grid-cols-4 gap-4">
                <!-- Today Classes  -->
                <div class="h-96 overflow-auto bg-white dark:bg-gray-800 rounded-lg">
                    <div class="border-b p-4 flex item-center justify-between">
                        <div class="dark:text-gray-400">{{__('Today Schedule')}}</div>
                        <Link :href="route('online.classes')" class="text-blue-500">{{__('View All')}}</Link>
                    </div>
                    <template v-if="today_classes.length > 0">
                        <template v-for="schedule in today_classes" :key="schedule.id">
                            <div class="p-4 border-b">
                                <div class="text-base dark:text-gray-400">
                                    {{ schedule.topic }}
                                </div>
                                <div class="py-2 space-y-2 dark:text-gray-400">
                                    <div class="flex items-center gap-2">
                                        <div>
                                            <BookOpenIcon class="w-6 h-6" />
                                        </div>
                                        <div class="text-gray-900 dark:text-gray-400">{{__('Subject')}}:</div>
                                        <div class="text-black dark:text-gray-400">
                                            {{ schedule.subject ? schedule.subject.name : '' }}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div>
                                            <ClockIcon class="w-6 h-6" />
                                        </div>
                                        <div class="text-gray-900 dark:text-gray-400">{{__('Start Time')}}:</div>
                                        <div class="text-black dark:text-gray-400">
                                            {{ schedule.start_date_format }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </template>
                    <template v-else>
                        <NothingFound asShow="div" cssClass="text-center" />
                    </template>
                </div>
                <!-- Next Assignment  -->
                <div class="h-96 overflow-auto bg-white dark:bg-gray-800 rounded-lg">
                    <div class="border-b p-4 flex item-center justify-between">
                        <div class="dark:text-gray-400">{{__('Next Assignment')}}</div>
                        <Link :href="route('assignment.list')" class="text-blue-500">{{__('View All')}}</Link>
                    </div>
                    <template v-if="next_assignments.length > 0">
                        <template v-for="assignment in next_assignments" :key="assignment.id">
                            <div class="border-b">
                                <single-assignment :assignment="assignment" />
                            </div>
                        </template>
                    </template>
                    <template v-else>
                        <NothingFound asShow="div" cssClass="text-center" />
                    </template>
                </div>
                <!-- upcoming exam  -->
                <div class="h-96 overflow-auto bg-white dark:bg-gray-800 rounded-lg">
                    <div class="border-b p-4 flex item-center justify-between">
                        <div class="dark:text-gray-400">{{__('Upcoming Exams')}}</div>
                        <div href="" class="text-blue-500">{{__('View All')}}</div>
                    </div>
                    <template v-if="upcoming_exams.length > 0">
                        <template v-for="exam in upcoming_exams" :key="exam.id">
                            <div class="p-4 border-b">
                                <div class="text-base dark:text-gray-400">
                                    {{ exam.name }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 p-2">
                                        <div>
                                            <ClockIcon class="w-6 h-6" />
                                        </div>
                                        <div class="text-gray-500">{{ __('Start Date') }}:</div>
                                        <div class="text-black">
                                            {{ formatTime(exam.start_time) }}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 p-2">
                                        <div>
                                            <ClockIcon class="w-6 h-6" />
                                        </div>
                                        <div class="text-gray-500">{{ __('End Date') }}:</div>
                                        <div class="text-black">
                                            {{ formatTime(exam.end_time) }}
                                        </div>
                                    </div>
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 ml-3 rounded dark:bg-green-900 dark:text-green-300">
                                        {{ exam.course ? exam.course.name : '' }}
                                    </span>
                                </div>
                            </div>
                        </template>
                    </template>
                    <template v-else>
                        <NothingFound asShow="div" cssClass="text-center" />
                    </template>
                </div>
                <!-- upcoming Event  -->
                <div class="h-96 overflow-auto bg-white dark:bg-gray-800 rounded-lg">
                    <div class="border-b p-4 flex item-center justify-between">
                        <div class="dark:text-gray-400">{{__('Upcoming Event')}}</div>
                        <Link :href="route('event.index')" class="text-blue-500">{{__('View All')}}</Link>
                    </div>
                    <template v-if="upcoming_events.length > 0">
                        <template v-for="event in upcoming_events" :key="event.id">
                            <div class="p-4 border-b dark:text-gray-400">
                                <div class="text-base">
                                    {{ event.title }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 py-2">
                                        <div>
                                            <ClockIcon class="w-6 h-6" />
                                        </div>
                                        <div class="text-gray-900 dark:text-gray-400">{{__('Date')}}:</div>
                                        <div class="text-black dark:text-gray-400">
                                            {{ event.start }}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 py-2">
                                        <div>
                                            <CheckCircleIcon class="w-6 h-6" />
                                        </div>
                                        <div class="text-gray-900 dark:text-gray-400">{{__('Status')}}:</div>
                                        <div class="text-black dark:text-gray-400">
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 ml-3 rounded dark:bg-green-900 dark:text-green-300">
                                                {{ event.status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </template>
                    <template v-else>
                        <NothingFound asShow="div" cssClass="text-center" />
                    </template>
                </div>
            </div>
        </div>

        <div class="grid 2xl:grid-cols-4 sm:grid-cols-2 items-start grid-cols-1 gap-6 mb-[25px]">
            <div class="2xl:col-span-2 bg-white dark:bg-gray-800 h-[670px] rounded-lg overflow-auto">
                <div class="border-b p-4 flex item-center justify-between">
                    <div class="dark:text-gray-400 text-base">
                        {{ __('Attendance') }}
                    </div>
                </div>
                <global-table>
                    <template #head>
                        <th class="py-4 px-5">{{ __('#') }}</th>
                        <th class="py-4 px-5">{{ __('Subject') }}</th>
                        <th class="py-4 px-5">{{ __('Present Score') }}</th>
                    </template>
                    <template #body>
                        <template v-if="attendance_arr.length > 0">
                            <template v-for="(attendance, index) in attendance_arr" :key="attendance.id">
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <td class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div>
                                            {{ index + 1 }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div class="text-base font-bold">
                                            {{ attendance.subject_name }}
                                        </div>
                                        <div class="text-gray-900 dark:text-gray-400 text-sm">
                                            {{ attendance.teacher ? attendance.teacher.name : '' }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div>
                                            <label class="font-bold" for="">
                                                {{ attendance.present_score }} %
                                            </label>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-800">
                                            <div class="bg-blue-600 h-2.5 rounded-full"
                                                :style="'width: ' + attendance.present_score + '%'"></div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </template>
                        <template v-else>
                            <NothingFound />
                        </template>
                    </template>
                </global-table>
            </div>
            <!-- attendance  -->
            <div class="bg-white mb-4 dark:bg-gray-800 rounded-lg">
                <h2 class="mb-0 text-black/[0.85] dark:text-gray-400 font-semibold text-base px-6 py-4">
                    {{ __('Attendance Statistics') }}
                </h2>
                <hr class="dark:border-gray-600">
                <div class="px-6 py-4">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex gap-2 items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#1890FF] inline-block"></span>
                                <h2 class="mb-0 text-sm dark:text-gray-400 font-medium">
                                    {{ __('Present Class') }}
                                </h2>
                            </div>
                            <h2 class="dark:text-gray-400">
                                {{ present_classes }}
                            </h2>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex gap-2 items-center">
                                <span class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-[#FF8A8A] inline-block"></span>
                                <h2 class="mb-0 text-sm font-medium dark:text-gray-400">
                                    {{ __('Late Class') }}
                                </h2>
                            </div>
                            <h2 class="dark:text-gray-400">
                                {{ late_classes }}
                            </h2>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex gap-2 items-center">
                                <span class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-red-500 inline-block"></span>
                                <h2 class="mb-0 text-sm font-medium dark:text-gray-400">
                                    {{ __('Absent Class') }}
                                </h2>
                            </div>
                            <h2 class="dark:text-gray-400">
                                {{ absent_classes }}
                            </h2>
                        </div>
                    </div>
                    <div class="mt-6">
                        <PieChart id="PiceChart2" :data="[present_classes, late_classes, absent_classes]"
                            :labels="['Present Class', 'Late Class', 'Absent Class']" :colors="['blue', '#FF8A8A', 'red']"
                            :height="300" />
                    </div>
                </div>
            </div>
            <!-- assignment  -->
            <div class="bg-white mb-4 dark:bg-gray-800 rounded-lg">
                <h2 class="mb-0 text-gray-900 dark:text-gray-400 font-semibold text-base px-6 py-4">
                    {{ __('Assignments Statistics') }}
                </h2>
                <hr class="dark:border-gray-600">
                <div class="px-6 py-4">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex gap-2 items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#1890FF] inline-block"></span>
                                <h2 class="mb-0 text-sm dark:text-gray-400 font-medium">
                                    {{ __('Total Assignments') }}
                                </h2>
                            </div>
                            <h2 class="dark:text-gray-400">
                                {{ total_assignments }}
                            </h2>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex gap-2 items-center">
                                <span class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-[#01cc67] inline-block"></span>
                                <h2 class="mb-0 text-sm font-medium dark:text-gray-400">
                                    {{ __('Total Submitted Assignments') }}
                                </h2>
                            </div>
                            <h2 class="dark:text-gray-400">
                                {{ total_submitted_assignments }}
                            </h2>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex gap-2 items-center">
                                <span class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-[#FF4D4F] inline-block"></span>
                                <h2 class="mb-0 text-sm font-medium dark:text-gray-400">
                                    {{ __('Total Remaining Assignments') }}
                                </h2>
                            </div>
                            <h2 class="dark:text-gray-400">
                                {{ total_remaining_assignments }}
                            </h2>
                        </div>
                    </div>
                    <div class="mt-6">
                        <PieChart id="assignmentPiechart"
                            :data="[total_assignments, total_submitted_assignments, total_remaining_assignments]"
                            :labels="['Total Assignments', 'Total Submitted Assignments', 'Total Remaining Assignments']"
                            :colors="['#1890FF', '#01cc67', '#FF4D4F']" />
                    </div>
                </div>
            </div>
        </div>

        <!-- transaction  -->
        <div class="bg-white mb-4 dark:bg-gray-800 rounded-lg">
            <h2 class="mb-0 text-black/[0.85] dark:text-gray-400 md:flex items-center justify-between font-semibold text-base px-6 py-4">
                <div>{{ __('This Year Transaction') }}</div>
                <div class="font-bold text-gray-500">
                    {{ __('Total Due Amount') }}:
                    <span class="text-black dark:text-gray-400">
                        {{ $page.props.default_currency_symbol ?? '' }}{{ total_due_amount }}
                    </span>
                </div>
            </h2>
            <hr class="dark:border-gray-600">
            <div>
                <bar-chart :labels="this_year_labels" :data="this_year_values" :barPercentage="0.1" />
            </div>
            <!-- <div class="px-6 py-4 flex items-center lg:flex-row flex-col">
                <div class="lg:w-1/2 w-full">
                    <div class="flex items-center justify-between">
                        <div class="flex gap-2 items-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#1890FF] inline-block"></span>
                            <h2 class="mb-0 text-sm dark:text-gray-400 font-medium">
                                {{ __('Total Amount') }}
                            </h2>
                        </div>
                        <h2 class="dark:text-gray-400">
                            {{ $page.props.default_currency_symbol ?? '' }} {{ total_amount }}
                        </h2>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-2 items-center">
                            <span class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-[#FF4D4F] inline-block"></span>
                            <h2 class="mb-0 text-sm font-medium dark:text-gray-400">
                                {{ __('Total Due Amount') }}
                            </h2>
                        </div>
                        <h2 class="dark:text-gray-400">
                            {{ $page.props.default_currency_symbol ?? '' }} {{ total_due_amount }}
                        </h2>
                    </div>
                </div>
                <div class="lg:w-1/2 w-full">
                    <PieChart :cutout="150" id="transactions" :colors="['#1890FF', '#FF4D4F']"
                        :labels="['Total Amount', 'Total Due Amount']" :data="[total_amount, total_due_amount]" />
                </div>
            </div> -->
        </div>

    </AppLayout>
</template>
