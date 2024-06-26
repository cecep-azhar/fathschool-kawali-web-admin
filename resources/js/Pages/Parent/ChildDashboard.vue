<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import PieChart from '@/Components/Chart/FeesCollectPieChart.vue';
import BarChart from '@/Components/Chart/BarChart.vue';
import StatCard from '@/Components/Dashboard/StatCard.vue'

export default {
    props: {
        pending_fees: Number,
        today_assignment_submit: Number,
        today_classes: Number,
        present_classes: Number,
        late_classes: Number,
        absent_classes: Number,
        total_assignments: Number,
        total_submitted_assignments: Number,
        total_remaining_assignments: Number,
        total_tr_amount: Number,
        total_due_amount: Number,
        attendance_arr: Array,
        total_amount: Number,
        total_due_amount: Number,
        this_year_labels: Array,
        this_year_values: Array,
    },
    components: {
        AppLayout,
        PieChart,
        StatCard,
        BarChart
    }
}
</script>

<template>
    <AppLayout :title="__('Dashboard')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Dashboard')" />
        </Breadcrumb>

        <div class="pb-12">
            <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mb-[25px]">
                <stat-card :title="__('Today Classes')" :value="today_classes"
                    :label="__('Classes')" />
                <stat-card :title="__('Pending Assignments')" :route="route('assignment.list')"
                    :value="today_assignment_submit" :label="__('Assignment')" />
                <stat-card :title="__('Pending Fees')" :value="pending_fees" :label="__('Pending Fees')" />
            </div>
            <div class="grid xl:grid-cols-4 grid-cols-1 gap-6 pb-[25px]">

                <!-- attendance  -->
                <div class="xl:col-span-2">
                    <div class=" bg-white dark:bg-gray-800 dark:text-gray-600 rounded-lg h-[600px] overflow-auto">
                        <h2
                            class="mb-0 text-black/[0.85] border-b dark:border-gray-600 dark:text-gray-400 font-semibold text-base px-6 py-4">
                            {{ __('Attendance') }}
                        </h2>
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
                                            <td
                                                class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                <div>
                                                    {{ index + 1 }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                <div class="text-lg font-bold">
                                                    {{ attendance.subject_name }}
                                                </div>
                                                <div class="text-gray-500 text-sm">
                                                    {{ attendance.teacher ? attendance.teacher.name : '' }}
                                                </div>
                                            </td>
                                            <td
                                                class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                <div>
                                                    <label class="font-bold" for="">
                                                        {{ attendance.present_score }} %
                                                    </label>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
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
                                    <span
                                        class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-[#FF8A8A] inline-block"></span>
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
                                    <span
                                        class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-red-500 inline-block"></span>
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
                                :labels="['Present Class', 'Late Class', 'Absent Class']"
                                :colors="['blue', '#FF8A8A', 'red']" :height="400" />
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
                                    <span
                                        class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-[#01cc67] inline-block"></span>
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
                                    <span
                                        class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-[#FF4D4F] inline-block"></span>
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
        <div v-if="$page.props.auth.role == 'Parent'" class="bg-white mb-4 dark:bg-gray-800 rounded-lg">
            <h2
                class="mb-0 text-gray-900 dark:text-gray-400 md:flex items-center justify-between font-semibold text-base px-6 py-4">
                <div>{{ __('This Year Transaction') }}</div>
                <div class="font-bold text-gray-500">
                    {{ __('Total Due Amount') }}:
                    <span class="text-gray-900 dark:text-gray-400">
                        {{ $page.props.default_currency_symbol ?? '' }}{{ total_due_amount }}
                    </span>
                </div>
            </h2>
            <hr class="dark:border-gray-600">
            <div class="p-6">
                <bar-chart :labels="this_year_labels" :data="this_year_values" :barPercentage="0.1" />
            </div>
            <!-- <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="px-6 py-4 flex items-center lg:flex-row flex-col">
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
                                            <PieChart :cutout="150" id="transactions" :colors="['#1890FF', '#FF4D4F']" :labels="['Total Amount', 'Total Due Amount']"
                                                :data="[total_amount, total_due_amount]" />
                                        </div>
                                    </div> -->
            </div>
        </div>
    </AppLayout>
</template>
