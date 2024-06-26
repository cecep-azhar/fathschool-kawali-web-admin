<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import BarChart from '@/Components/Chart/BarChartWithGrid.vue';
import PieChart from '@/Components/Chart/FeesCollectPieChart.vue';
import NothingFound from "@/Shared/NothingFound.vue";
import StatCard from '@/Components/Dashboard/StatCard.vue'
import dayjs, { Dayjs } from 'dayjs';
import PageHeader from '@/Shared/PageHeader.vue';

export default {
    props: {
        this_start_month: String,
        this_end_month: String,
        this_month_transaction_amount: Number,
        unpaid_total_transaction_count: Number,
        unpaid_total_transaction_amount: Number,
        expense_total_transaction_count: Number,
        expense_total_transaction_amount: Number,
        total_transaction_amount: Number,
        total_paid_amount: Number,
        five_transactions: Object,
        five_chart_transactions: Array,
        // chart data
        week_data_label_income: Array,
        week_data_value_income: Array,
        week_data_value_expense: Array,
        query: Object,
        pie_data: Array,
        two_events: Object,
        over_due_transactions: Number
    },
    data() {
        return {
            activeTab: this.query.query ? this.query.query : this.query.start_date ?? 'week',
            date: [
                this.query.start_date ? dayjs(this.query.start_date) : null,
                this.query.end_date ? dayjs(this.query.end_date) : null,
            ],
        }
    },
    components: {
        AppLayout,
        BarChart,
        PieChart,
        PageHeader,
        StatCard,
        NothingFound
    },
    methods: {
        clickTab(e) {
            this.activeTab = e;
            this.$inertia.get(this.route('dashboard'), {
                query: e
            });
        },
        dateWiseFilter() {
            let start_date = dayjs(this.date[0]).format('YYYY-MM-DD');
            let end_date = dayjs(this.date[1]).format('YYYY-MM-DD');

            this.$inertia.get(this.route('dashboard'), {
                start_date: start_date,
                end_date: end_date,
            }, {
                preserveScroll: true
            });
        }
    }
}
</script>

<template>
    <AppLayout :title="__('Dashboard')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Dashboard')"/>
        </Breadcrumb>

        <div >
            <page-header>
                {{__('Dashboard')}}
            </page-header>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-4">
                <stat-card
                    :title="__('Monthly Fees Collection')"
                    :route="route('all.transaction',{ start_date: this_start_month, end_date: this_end_month })"
                    :value="$page.props.default_currency_symbol +' '+ conversionRate('USD', $page.props.default_currency, this_month_transaction_amount)"
                    :label="`
                        ${formatTime(this_start_month, 'MMM D, YYYY')} -
                        ${formatTime(this_end_month, 'MMM D, YYYY')}
                    `"
                />
                <stat-card
                    :title="__('Fees Awaiting Payment')"
                    :route="route('all.transaction',{ status: 'unpaid' })"
                    :value="$page.props.default_currency_symbol +' '+ conversionRate('USD', $page.props.default_currency, unpaid_total_transaction_amount)"
                    :label="`${unpaid_total_transaction_count}`+' '+ __('Transactions')"
                />
                <stat-card
                    :title="__('Monthly Expense')"
                    :route="route('all.transaction',{ type: 'expense' })"
                    :value="$page.props.default_currency_symbol +' '+ conversionRate('USD', $page.props.default_currency, expense_total_transaction_amount)"
                    :label="`${expense_total_transaction_count}`+' '+ __('Transactions')"
                />
                <stat-card
                    :title="__('Over Due Transactions')"
                    :route="route('all.transaction', {over_due: 'over-due'})"
                    :value="over_due_transactions"
                    :label="__('Transactions')"
                />
            </div>
            <div class="grid xl:grid-cols-4 grid-cols-1 gap-6 pb-[25px]">
                <div class="xl:col-span-3 bg-white dark:bg-gray-800 rounded-lg">
                    <div class="px-6 flex justify-between lg:flex-row flex-col items-center">
                        <h2
                            class="text-base text-[#1890FF] dark:text-gray-400 dark:border-gray-400 inline-block -mb-2.5 py-4 border-b-2 border-[#1890FF]">
                            {{ __('Incomes & Expenses') }}
                        </h2>
                        <div class="py-4 flex gap-6 items-center lg:flex-row flex-col">
                            <ul class="flex mb-0">
                                <li class="pl-6 cursor-pointer "
                                    :class="activeTab == 'week' ? 'text-blue-500' : 'text-black/[0.45] dark:text-gray-400'"
                                    @click="clickTab('week')" id="testWeek">
                                    {{ __('This Week') }}
                                </li>
                                <li class="pl-6 cursor-pointer"
                                    :class="activeTab == 'month' ? 'text-blue-500' : 'text-black/[0.45] dark:text-gray-400'"
                                    @click="clickTab('month')" id="testMonth">
                                    {{ __('This Month') }}
                                </li>
                                <li class="pl-6 cursor-pointer"
                                    :class="activeTab == 'year' ? 'text-blue-500' : 'text-black/[0.45] dark:text-gray-400'"
                                    @click="clickTab('year')" id="testYear">
                                    {{ __('This Year') }}
                                </li>
                            </ul>
                            <a-range-picker :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                                class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                                :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="date"
                                @change="dateWiseFilter()" :format="customDateFormat" />
                        </div>
                    </div>
                    <hr class="dark:border-gray-600">
                    <div class="px-6 py-4">
                        <BarChart :data_set1_label="week_data_label_income" :data_set1_value="week_data_value_income"
                            :data_set2_value="week_data_value_expense" />
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg">
                    <h2 class="mb-0 text-black/[0.85] dark:text-gray-400 font-semibold text-base px-6 py-4">
                       {{ __('This Month Fees Collection') }}
                    </h2>
                    <hr class="dark:border-gray-600">
                    <div class="px-6 py-4">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="flex gap-2 items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#1890FF] inline-block"></span>
                                    <h2 class="mb-0 text-sm dark:text-gray-400 font-medium">
                                        {{ __('Fees Collected') }}
                                    </h2>
                                </div>
                                <h2 class="dark:text-gray-400">
                                    {{ convertAmount()+ conversionRate('USD', $page.props.default_currency, pie_data[0]) }}
                                </h2>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex gap-2 items-center">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full dark:text-gray-400 bg-[#FF4D4F] inline-block"></span>
                                    <h2 class="mb-0 text-sm font-medium dark:text-gray-400">
                                        {{ __('Pending Collection') }}
                                    </h2>
                                </div>
                                <h2 class="dark:text-gray-400">
                                   {{ convertAmount() + conversionRate('USD', $page.props.default_currency, pie_data[1]) }}
                                </h2>
                            </div>
                        </div>
                        <PieChart :data="pie_data" />
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg xl:col-span-3 xl:row-span-3">
                    <h2 class="px-6 py-4 text-base text-black/[0.85] mb-0 font-semibold dark:text-gray-400">
                        {{ __('Transactions') }}
                    </h2>
                    <hr class="dark:border-gray-600">
                    <div class="p-6">
                        <div class="w-full flex gap-12 items-center">
                            <div>
                                <div class="flex items-center gap-1 mb-1.5">
                                    <h2 class="dark:text-gray-400 mb-0 text-black/[0.45]">
                                        {{ __('Total Expenses Paid') }}
                                    </h2>
                                </div>
                                <h2 class="text-2xl font-bold dark:text-gray-400 mb-0 text-black/[0.85]">
                                    {{ convertAmount(decimalFormat(total_transaction_amount)) }}
                                </h2>
                                <LineChartOne :data='chartOneData' />
                            </div>
                            <div>
                                <div class="flex items-center gap-1 mb-1.5">
                                    <h2 class="dark:text-gray-400 mb-0 text-black/[0.45]">
                                        {{ __('Pending Expenses') }}
                                    </h2>
                                </div>
                                <h2 class="text-2xl font-bold dark:text-gray-400 mb-0 text-black/[0.85]">
                                    {{ convertAmount(decimalFormat(total_paid_amount)) }}
                                </h2>
                                <LineChartTwo :data='chartTwoData' />
                            </div>
                        </div>
                    </div>
                    <div class=" dark:text-gray-400 dark:bg-gray-800">
                        <global-table class="py-0">
                            <template #head>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Transactions') }}</th>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Amount') }}</th>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Paid Amount') }}</th>
                                <th width="12%" class="py-4 px-5 whitespace-nowrap">{{__('Payment Method')}}</th>
                            </template>
                            <template #body>
                                <template v-if="five_transactions.length > 0">
                                    <template v-for="transaction in five_transactions" :key="transaction.id">
                                        <tr
                                            class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ transaction.title }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ convertAmount(conversionRate(transaction.currency, $page.props.default_currency, transaction.amount))
                                                     }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ convertAmount(conversionRate(transaction.currency, $page.props.default_currency, transaction.paid_amount))
                                                     }}
                                            </td>
                                            <td class="py-4 px-5 whitespace-nowrap">
                                                {{ transaction.method }}
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
                <div class="bg-white dark:bg-gray-800 rounded-lg xl:col-span-1 xl:row-span-3">
                    <div class="flex justify-between items-center">
                        <h2 class="px-6 py-4 text-base text-black/[0.85] mb-0 font-semibold dark:text-gray-400">
                            {{ __('Event') }}
                        </h2>
                        <Link :href="route('event.index')"
                            class="px-6 py-4 text-sm text-blue-500 mb-0 font-semibold dark:text-gray-400">
                        {{__('View All')}}
                        </Link>
                    </div>
                    <hr class="dark:border-gray-600">
                    <div class="p-6">
                        <div class="w-full items-center">
                            <div v-for="(event, index) in two_events" :key="event.id"
                                class="card bg-white border dark:border-gray-400 dark:bg-gray-800 rounded-sm"
                                :class="index != 0 ? 'mt-2' : ''">
                                <div class="card-top px-6 py-4">
                                    <div class="flex justify-between items-center">
                                        <h2 class="text-black/[0.85] dark:text-gray-400 font-semibold text-base mb-0">
                                            {{ event.title }}
                                        </h2>
                                    </div>
                                </div>
                                <hr class="dark:border-gray-600">
                                <div class="card-bottom p-6">
                                    <h2 class="text-base text-black/[0.85] dark:text-gray-400 font-medium mb-2">
                                        {{ formatTime(event.start) }}
                                    </h2>
                                    <h3 class="text-black/[0.45] capitalize dark:text-gray-400 mb-0">
                                        {{ event.status }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

