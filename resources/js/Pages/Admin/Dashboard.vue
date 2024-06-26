<template>
    <AppLayout :title="__('Dashboard')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Dashboard')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __('Dashboard') }}
                </div>
            </page-header>
            <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mb-[25px]">
                <stat-card :title="`${__('Total Users')}`" :route="route('users.index')" :injected="true">
                    <div class="p-4 flex flex-wrap gap-2">
                        <span
                            class="bg-transparent text-blue-700 px-2 py-1.5 text-xs font-bold border border-blue-500 rounded">
                            {{ total_admins }} {{ __('Admins') }}
                        </span>
                        <span
                            class="bg-transparent text-blue-700 px-2 py-1.5 text-xs font-bold border border-blue-500 rounded">
                            {{ total_teachers }} {{ __('Teachers') }}
                        </span>
                        <span
                            class="bg-transparent text-blue-700 px-2 py-1.5 text-xs font-bold border border-blue-500 rounded">
                            {{ total_parents }} {{ __('Parents') }}
                        </span>
                        <span
                            class="bg-transparent text-blue-700 px-2 py-1.5 text-xs font-bold border border-blue-500 rounded">
                            {{ total_students }} {{ __('Students') }}
                        </span>
                        <span
                            class="bg-transparent text-blue-700 px-2 py-1.5 text-xs font-bold border border-blue-500 rounded">
                            {{ total_accountants }} {{ __('Accountants') }}
                        </span>
                        <span
                            class="bg-transparent text-blue-700 px-2 py-1.5 text-xs font-bold border border-blue-500 rounded">
                            {{ total_others }} {{ __('Others') }}
                        </span>
                    </div>
                </stat-card>
                <stat-card :title="`${__('Total Leave Requests')}`" :route="route('leave.requests')"
                    :value="total_leave_requests" :label="__('Requests')" />
                <stat-card :title="`${__('Exams (Current Month)')}`" :route="route('exam.index')"
                    :value="this_month_total_exams" :label="__('Exams')" />
                <stat-card :title="`${__('Events (Current Week)')}`" :route="route('event.index')" :value="this_week_events"
                    :label="__('Programs')" />
            </div>
            <div id="welcome"></div>
            <div class="grid xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-6 mb-[25px]">
                <div class="card bg-white dark:bg-gray-800 rounded-lg">
                    <div class="card-top px-6">
                        <div class="flex justify-between items-center">
                            <h2 class="text-black/[0.85] dark:text-gray-400 font-semibold text-base mb-0">
                                {{ __('Student Payment') }}
                            </h2>
                            <div class="py-4 flex gap-6 items-center lg:flex-row flex-col">
                                <ul class="flex mb-0">
                                    <li class="pl-6 cursor-pointer "
                                        :class="incomeGraphTab == 'today' ? 'text-blue-500' : 'text-black/[0.45] dark:text-gray-400'"
                                        @click="clickTab('today', 'income')">
                                        {{ __('Today') }}
                                    </li>
                                    <li class="pl-6 cursor-pointer "
                                        :class="incomeGraphTab == 'week' ? 'text-blue-500' : 'text-black/[0.45] dark:text-gray-400'"
                                        @click="clickTab('week', 'income')">
                                        {{ __('This Week') }}
                                    </li>
                                    <li class="pl-6 cursor-pointer "
                                        :class="incomeGraphTab == 'month' ? 'text-blue-500' : 'text-black/[0.45] dark:text-gray-400'"
                                        @click="clickTab('month', 'income')">
                                        {{ __('This Month') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr class="dark:border-gray-600">
                    <div class="card-bottom p-6 flex flex-wrap gap-4">
                        <BarChart :labels="paid_data_label_income" :data="paid_data_value_income" id="student_paid_chart" />
                    </div>
                </div>
                <div class="card bg-white dark:bg-gray-800 rounded-lg">
                    <div class="card-top px-6">
                        <div class="flex justify-between items-center">
                            <h2 class="text-black/[0.85] dark:text-gray-400 font-semibold text-base mb-0">
                                {{ __('Student Admission') }}
                            </h2>
                            <div class="py-4 flex gap-6 items-center lg:flex-row flex-col">
                                <ul class="flex mb-0">
                                    <li class="pl-6 cursor-pointer "
                                        :class="admissionGraphTab == 'today' ? 'text-blue-500' : 'text-black/[0.45] dark:text-gray-400'"
                                        @click="clickTab('today', 'admission')">
                                        {{ __('Today') }}
                                    </li>
                                    <li class="pl-6 cursor-pointer "
                                        :class="admissionGraphTab == 'week' ? 'text-blue-500' : 'text-black/[0.45] dark:text-gray-400'"
                                        @click="clickTab('week', 'admission')">
                                        {{ __('This Week') }}
                                    </li>
                                    <li class="pl-6 cursor-pointer "
                                        :class="admissionGraphTab == 'month' ? 'text-blue-500' : 'text-black/[0.45] dark:text-gray-400'"
                                        @click="clickTab('month', 'admission')">
                                        {{ __('This Month') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr class="dark:border-gray-600">
                    <div class="card-bottom p-6">
                        <BarChart :labels="admission_data_label_income" :data="admission_data_value_income"
                            id="student_admission_chart" />
                    </div>
                </div>
            </div>
            <div class="grid xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-6 mb-[25px]">
                <div class="card bg-white dark:bg-gray-800 rounded-lg">
                    <div class="card-top px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-black/[0.85] dark:text-gray-400 font-semibold text-base mb-0">
                                {{ __('Upcoming Birthdays') }}
                            </h2>
                        </div>
                    </div>
                    <hr class="dark:border-gray-600">
                    <div class="card-bottom">
                        <global-table>
                            <template #head>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Name') }}</th>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Type') }}</th>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Date') }}</th>
                            </template>
                            <template #body>
                                <template v-if="upcoming_birthdays && upcoming_birthdays.length > 0">
                                    <template v-for="birthday_user in upcoming_birthdays" :key="birthday_user.id">
                                        <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ birthday_user.name }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ __(birthday_user.role) }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ formatTime(birthday_user.next_birth_date) }}
                                                <!-- 5 days to go -->
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
                </div>
                <div class="card bg-white dark:bg-gray-800 rounded-lg">
                    <div class="card-top px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-black/[0.85] dark:text-gray-400 font-semibold text-base mb-0">
                                {{ __('Upcoming Events') }}
                            </h2>
                            <Link :href="route('event.index')" class="text-sm text-[#1890FF]">
                            {{ __('View all') }}
                            </Link>
                        </div>
                    </div>
                    <hr class="dark:border-gray-600">
                    <div class="card-bottom">
                        <global-table>
                            <template #head>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Title') }}</th>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Status') }}</th>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Date') }}</th>
                            </template>
                            <template #body>
                                <template v-if="upcoming_events && upcoming_events.length > 0">
                                    <template v-for="event in upcoming_events" :key="event.id">
                                        <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ event.title }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                <span
                                                    :class="event.status == 'Ended' ? 'bg-red-100 text-red-800 dark:bg-red-500 dark:opacity-60 dark:text-red-100' : 'bg-blue-100 text-blue-800 dark:bg-gray-700 dark:text-gray-400'"
                                                    class="capitalize text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                    {{ __(event.status) }}
                                                </span>
                                            </td>
                                            <td class="py-4">
                                                {{ formatTime(event.start) }} - {{
                                                    formatTime(event.end) }}
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
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg xl:col-span-2 xl:row-span-3">
                <div class="flex justify-between items-center">
                    <h2 class="px-6 py-4 text-base text-black/[0.85] mb-0 font-semibold dark:text-gray-400">
                        {{ __('Calendar') }}
                    </h2>
                    <Link :href="route('routine.index')" class="text-blue-500 px-6 py-4 text-base mb-0 dark:text-gray-400">
                    {{ __('Class Schedule') }}
                    </Link>
                </div>
                <hr class="dark:border-gray-600">

                <div class="dark:text-gray-400 overflow-x-auto dark:bg-gray-800 p-6">
                    <FullCalendar :options="calendarOptions" class="min-w-[991px]" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import LineChartOne from '@/Components/Chart/LineChartOne.vue';
import BarChart from '@/Components/Chart/BarChart.vue';
import StatCard from '@/Components/Dashboard/StatCard.vue'
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin from '@fullcalendar/interaction';
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    props: {
        total_admins: Number,
        total_teachers: Number,
        total_parents: Number,
        total_students: Number,
        total_accountants: Number,
        total_others: Number,
        total_leave_requests: Number,
        this_month_total_exams: Number,
        this_week_events: Number,
        paid_data_label_income: Array,
        today_events: Number,
        paid_data_value_income: Array,
        admission_data_label_income: Array,
        admission_data_value_income: Array,
        upcoming_events: Array,
        upcoming_birthdays: Array,
        events: Array,
        query: Object,
    },
    data() {
        return {
            activeTab: 'day',
            incomeGraphTab: this.query.query ? this.query.query : this.query.start_date ?? 'week',
            admissionGraphTab: this.query.admissionQuery ? this.query.admissionQuery : 'week',

            calendarOptions: {
                locale: this.$page.props.locale,
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    listPlugin,
                    interactionPlugin
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    prev: this.__('prev'),
                    next: this.__('next'),
                    today: this.__('today'),
                    month: this.__('month'),
                    week: this.__('week'),
                    day: this.__('day'),
                    list: this.__('list'),
                },
                // firstDay: this.$page.props.start_day_of_week,
                height: 800,
                initialView: 'timeGridWeek',
                events: this.events,
                eventContent: function (arg) {
                    return {
                        html: arg.event.title.replace(/<br>/g, '<br>')
                    }
                },
            }
        }
    },
    components: {
        AppLayout,
        LineChartOne,
        BarChart,
        FullCalendar,
        StatCard,
        NothingFound
    },
    methods: {
        clickTab(e, type) {
            if (type == 'income') {
                this.incomeGraphTab = e;
                this.$inertia.get(this.route('dashboard'), {
                    query: e,
                    admissionQuery: this.query.admissionQuery,
                });
            } else {
                this.admissionGraphTab = e;
                this.$inertia.get(this.route('dashboard'), {
                    query: this.query.query,
                    admissionQuery: e,
                });
            }

        },
    }
}
</script>
