<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import StatCard from "@/Components/Dashboard/StatCard.vue";
import LineChartOne from "@/Components/Chart/LineChartOne.vue";
import "@fullcalendar/core/vdom";
import FullCalendar from "@fullcalendar/vue3";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    props: {
        total_subjects: Number,
        total_leaves: Number,
        total_accepted_leaves: Number,
        total_rejected_leaves: Number,
        total_assignments: Number,
        today_events: Number,
        pending_assignments: Array,
        schedules: Object,
    },
    data() {
        return {
            calendarOptions: {
                locale: this.$page.props.locale,
                plugins: [timeGridPlugin, interactionPlugin, dayGridPlugin],
                buttonText: {
                    prev: this.__("prev"),
                    next: this.__("next"),
                    today: this.__("today"),
                    month: this.__("month"),
                    week: this.__("week"),
                    day: this.__("day"),
                    list: this.__("list"),
                },
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay",
                },
                // firstDay: this.$page.props.start_day_of_week,
                height: 800,
                initialView: "timeGridWeek",
                events: this.schedules,
                eventContent: function (arg) {
                    return {
                        html: arg.event.title.replace(/<br>/g, "<br>"),
                    };
                },
            },
        };
    },
    components: {
        AppLayout,
        FullCalendar,
        StatCard,
        NothingFound,
    },
};
</script>

<template>
    <AppLayout :title="__('Dashboard')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Dashboard')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __("Dashboard") }}
            </page-header>
            <div
                class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mb-[25px]"
            >
                <stat-card
                    :title="__('Total Leave')"
                    :route="route('manage-leave.index')"
                    :injected="true"
                >
                    <div class="p-4 flex flex-wrap gap-2">
                        <div
                            class="bg-transparent text-blue-700 px-2 py-1.5 text-xs font-bold border border-blue-500 rounded"
                        >
                            {{ total_leaves }} {{ __("Leaves") }}
                        </div>
                        <div
                            class="bg-transparent text-blue-700 px-2 py-1.5 text-xs font-bold border border-blue-500 rounded"
                        >
                            {{ total_accepted_leaves }}
                            {{ __("Accepted Leaves") }}
                        </div>
                        <div
                            class="bg-transparent text-blue-700 px-2 py-1.5 text-xs font-bold border border-blue-500 rounded"
                        >
                            {{ total_rejected_leaves }}
                            {{ __("Rejected Leaves") }}
                        </div>
                    </div>
                </stat-card>
                <stat-card
                    :title="__('Total Subjects')"
                    :value="total_subjects"
                    :label="__('Subjects')"
                    :route="route('my-subject')"
                />
                <stat-card
                    :title="__('Pending Assignments')"
                    :value="total_assignments"
                    :label="__('Assignments')"
                    :route="route('assignment.index')"
                />
                <stat-card
                    :title="__('Events Today')"
                    :value="today_events"
                    :label="__('Programs')"
                    :route="route('event.index')"
                />
            </div>
            <div class="mb-[25px]">
                <div class="card bg-white dark:bg-gray-800 rounded-lg">
                    <div class="card-top px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h2
                                class="text-black/[0.85] dark:text-gray-400 font-semibold text-base mb-0"
                            >
                                {{ __("Pending Assignment List") }}
                            </h2>
                        </div>
                    </div>
                    <hr class="dark:border-gray-600" />
                    <div class="card-bottom overflow-hidden">
                        <global-table classes="bg-white">
                            <template #head>
                                <th class="py-4 px-5 whitespace-nowrap">
                                    {{ __("Title") }}
                                </th>
                                <th class="py-4 px-5 whitespace-nowrap">
                                    {{ __("Course") }}
                                </th>
                                <th class="py-4 px-5 whitespace-nowrap">
                                    {{ __("Subject") }}
                                </th>
                                <th class="py-4 px-5 whitespace-nowrap">
                                    {{ __("Deadline") }}
                                </th>
                            </template>
                            <template #body>
                                <template v-if="pending_assignments.length > 0">
                                    <template
                                        v-for="assignment in pending_assignments"
                                        :key="assignment.id"
                                    >
                                        <tr
                                            class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        >
                                            <td
                                                class="py-4 px-5 whitespace-nowrap"
                                            >
                                                {{ assignment.title }}
                                            </td>
                                            <td
                                                class="py-4 px-5 whitespace-nowrap"
                                            >
                                                {{
                                                    assignment.class?.name ??
                                                    "-"
                                                }}
                                            </td>
                                            <td
                                                class="py-4 px-5 whitespace-nowrap"
                                            >
                                                {{
                                                    assignment.subject?.name ??
                                                    "-"
                                                }}
                                            </td>
                                            <td
                                                class="py-4 px-5 whitespace-nowrap"
                                            >
                                                {{ assignment.deadline }}
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
            <div
                class="mt-5 bg-white dark:bg-gray-800 rounded-lg xl:col-span-2 xl:row-span-3"
            >
                <h2
                    class="px-6 py-4 text-base text-black/[0.85] mb-0 font-semibold dark:text-gray-400"
                >
                    {{ __("Your Schedule") }}
                </h2>
                <hr class="dark:border-gray-600" />

                <div
                    class="dark:text-gray-400 overflow-x-auto dark:bg-gray-800 p-6"
                >
                    <FullCalendar
                        :options="calendarOptions"
                        class="min-w-[991px]"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
