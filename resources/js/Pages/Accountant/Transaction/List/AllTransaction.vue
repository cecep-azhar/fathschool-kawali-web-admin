<template>
    <AppLayout :title="__('Transaction List')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('All Transaction')" />
        </Breadcrumb>

        <div class="pb-12 ">
            <page-header>
                {{ __("All Transaction") }}
                <template #content>
                    <div class="flex justify-between items-center gap-4">
                        <global-button v-if="can('transaction.create')" :loading="false" :url="route('transaction.create')" id="addNewTransaction"
                            type="link" theme="primary">
                            {{ __("Add Transaction") }}
                        </global-button>
                        <!-- <global-button type="button" @click="showExportModal()" theme="secondary">
                            {{ __("Export") }}
                        </global-button> -->
                    </div>
                </template>
            </page-header>

            <div v-if="$page.props.auth.role == 'Parent'" class="bg-white mb-4 dark:bg-gray-800 rounded-lg">
                <h2
                    class="mb-0 text-black/[0.85] dark:text-gray-400 md:flex items-center justify-between font-semibold text-base px-6 py-4">
                    <div>{{ __('This Year Transaction') }}</div>
                    <div class="font-bold text-gray-500">
                        {{ __('Total Due Amount') }}:
                        <span class="text-black dark:text-gray-400">
                            {{ $page.props.default_currency_symbol ?? '' }}{{ total_due_amount }}
                        </span>
                    </div>
                </h2>
                <hr class="dark:border-gray-600">
                <div class="p-6">
                    <bar-chart :labels="this_year_labels" :data="this_year_values" :barPercentage="0.1" />
                </div>
            </div>

            <div class="mb-4">
                <form class="items-center grid grid-cols-1 2xl:grid-cols-8 2xl:gap-x-4 sm:gap-y-6 gap-y-1.5"
                    @submit.prevent="filterData()">
                    <div class="flex items-center col-span-2">
                        <div class="relative w-full">
                            <global-input v-model="filter.keyword" type="text"
                                class="mt-1 block w-full placeholder:text-xs sm:placeholder:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Insert Title, Expense/Income or Type')" />
                            <button type="submit"
                                class="absolute top-1 rtl:right-auto rtl:left-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <MagnifyingGlassIcon class="w-5 h-5" />
                                <span class="sr-only">{{ __('Search') }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <a-range-picker :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                            class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                            :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="date2"
                            :format="customDateFormat" />
                    </div>
                    <div class="2xl:col-span-4 flex flex-col lg:flex-row sm:gap-6 gap-1.5 lg:items-center">
                        <div class="sm:flex-row flex flex-col sm:gap-4 gap-1.5 w-full">
                            <template v-if="$page.props.auth.role != 'Parent' && $page.props.auth.role != 'Student'">
                                <tab-filter @setTabData="setTabValue" :filterData="filter_data ? filter_data.type : ''"
                                    filter_column="type" :tab_data="[
                                        { title: 'All', id: 'all3', value: 'all' },
                                        { title: 'Income', id: 'income', value: 'income' },
                                        { title: 'Expense', id: 'expense', value: 'expense' },
                                    ]" />
                            </template>
                            <tab-filter @setTabData="setTabValue" :filterData="filter_data ? filter_data.status : ''"
                                filter_column="status" :tab_data="[
                                    { title: 'All', id: 'all2', value: 'all' },
                                    { title: 'Paid', id: 'paid', value: 'paid' },
                                    { title: 'Unpaid', id: 'unpaid', value: 'unpaid' },
                                ]" />
                            <tab-filter @setTabData="setTabValue" :filterData="filter_data ? filter_data.over_due : ''"
                                filter_column="over_due" :tab_data="[
                                    { title: 'All', id: 'all', value: 'all' },
                                    { title: 'Over Due', id: 'over-due', value: 'over-due' }
                                ]" />
                        </div>
                        <global-button :loading="filter.processing" type="submit"
                            class="text-white inline-flex whitespace-nowrap">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <div class="col-span-2 bg-white dark:bg-gray-800 dark:text-gray-600 rounded-lg" id="transactionTable" >
                <global-table>
                    <template #head>
                        <th class="py-4 px-5">{{ __('Invoice') }}</th>
                        <th class="py-4 px-5">{{ __('Total Amount') }}</th>
                        <th class="py-4 px-5">{{ __('Paid Amount') }}</th>
                        <th class="py-4 px-5" width="30%">{{ __('Info') }}</th>
                        <th class="py-4 px-5">{{ __('Status') }}</th>
                        <th class="py-4 px-5 flex justify-end">{{ __('Action') }}</th>
                    </template>
                    <template #body>
                        <template v-if="transactions.data.length > 0">
                            <template v-for="transaction in transactions.data" :key="transaction.id">
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <td class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div>
                                            {{ __('Transaction') }}: #{{ transaction.id }}
                                        </div>
                                        <p class="mb-0 font-medium">
                                            {{ transaction.type ? transaction.type.name : '' }}
                                        </p>
                                    </td>
                                    <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div class="text-base flex gap-2 font-semibold">
                                            <span class="text-sm">
                                                <!-- {{ convertAmount(conversionRate(transaction.currency, $page.props.default_currency, transaction.amount)) }} -->
                                                {{ this.$page.props.default_currency_symbol + ' ' + transaction.amount }}
                                            </span>
                                            <span class="capitalize text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                                                :class="transaction.type.type === 'income' ? 'bg-blue-100 text-blue-800 dark:bg-gray-700 dark:text-gray-400' : 'bg-red-100 text-red-800 dark:bg-red-500 dark:opacity-60 dark:text-red-100'">
                                                {{ transaction.type.type }}
                                            </span>
                                        </div>
                                        <div class="text-sm font-medium">
                                            {{ __('Due Date') }}:
                                            {{ transaction.due_date_format }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div class="font-medium">
                                            <!-- {{ convertAmount(conversionRate(transaction.currency, $page.props.default_currency, transaction.paid_amount)) }} -->
                                            {{ this.$page.props.default_currency_symbol + ' ' +  transaction.paid_amount }}
                                        </div>
                                        <div class="font-semibold">
                                            {{ transaction.method }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-gray-900 dark:text-gray-400">
                                        <div class="text-sm font-medium">
                                            <p class="flex items-center gap-3 mb-1 whitespace-nowrap">
                                                <a :href="transaction.document" download="" target="_blank"
                                                    class="text-sm inline-flex gap-2 items-center text-blue-500 hover:text-blue-400 cursor-pointer"
                                                    v-if="transaction.document">
                                                    <LinkIcon class="w-6 h-6" /> {{ __('Attached File') }}
                                                </a>
                                            </p>
                                            <p class="mb-0 whitespace-nowrap">
                                                {{ __('Date of Issue') }}: {{ formatTime(transaction.date_time) }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div class="text-base font-semibold inline-flex">
                                            <span class="capitalize text-xs font-semibold px-2.5 py-0.5 rounded"
                                                :class="transaction.status == 'paid' ? 'bg-green-400 text-white dark:opacity-60' : 'bg-blue-100 text-blue-800 dark:opacity-60'">
                                                {{ transaction.status }}
                                            </span>
                                        </div>

                                    </td>

                                    <td class="py-5 px-5">
                                        <div class="flex justify-end items-center gap-2">
                                            <Link v-if="transaction.status == 'unpaid' && can('transaction.update')"
                                                method="POST" :href="route('transaction.mark.as.paid', transaction.id)"
                                                class="whitespace-nowrap text-blue-500 hover:text-blue-400">
                                            {{ __('Mark as Paid') }}
                                            </Link>

                                            <a :href="route('transaction.details', transaction.transaction_no)"
                                                target="_blank" class="group relative">
                                                <EyeIcon class="text-purple-500 w-6 h-6 hover:text-purple-400" />
                                                <tool-tip text="View Details" />
                                            </a>
                                            <Link v-if="can('transaction.edit')" preserve-scroll
                                                :href="route('transaction.edit', transaction.id)" type="button"
                                                class="group relative" :id="'testEditTransaction' + transaction.id" >
                                            <pencil-square-icon class="text-blue-500 w-6 h-6 hover:text-blue-400" />
                                            <tool-tip text="Edit" />
                                            </Link>
                                            <button v-if="can('transaction.destroy')" type="button"
                                                @click="destroy(transaction.id)" class="group relative"  :id="'testDeleteTransaction' + transaction.id">
                                                <TrashIcon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                                <tool-tip :text="__('Delete')" />
                                            </button>
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
                    <pagination class="mt-6 mb-6" :links="transactions.links" />
                </div>
            </div>
        </div>
        <!-- Data Export Modal  -->
        <export-modal :show="visible" @close="closeModal">
            <template #title>
                <div class="text-left">
                    {{ __('Export Data') }}
                </div>
            </template>

            <template #content>
                <!-- Content -->
                <div class=" mb-2">
                    <div class="text-left">
                        <label for="this_month"
                            class="w-full py-3 pb-1 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('Choose Time Period') }}
                        </label>
                    </div>
                    <div class="md:flex gap-1 items-center">
                        <div
                            class="w-full mt-1 md:mt-0 flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                            <input v-model="export_data.month" id="this_month" type="radio" value="this_month"
                                name="bordered-radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="this_month"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ __('This Month') }}
                            </label>
                        </div>
                        <div
                            class="w-full mt-1 md:mt-0 flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                            <input v-model="export_data.month" id="last_month" type="radio" value="last_month"
                                name="bordered-radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="last_month"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ __('Last Month') }}
                            </label>
                        </div>
                        <div
                            class="w-full mt-1 md:mt-0 flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                            <input v-model="export_data.month" id="last_six_month" type="radio" value="last_six_month"
                                name="bordered-radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="last_six_month"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ __('Last Six Month') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="text-left">
                        <label for="excel"
                            class="w-full text-left py-3 pb-1 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('Choose Data Format') }}
                        </label>
                    </div>
                    <div class="md:flex gap-6 items-center">
                        <label
                            class="w-full mt-1 md:mt-0 rounded-lg cursor-pointer flex items-center pl-4 border border-gray-200 dark:border-gray-700">
                            <input value="xlsx" id="excel" v-model="export_data.type" type="radio" name="export_type"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <global-label for="excel"
                                class="py-2 ml-2 mt-1 cursor-pointer w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                value="Excel" :required="false" />
                        </label>
                        <label for="pdf"
                            class="w-full mt-1 md:mt-0 cursor-pointer rounded-lg flex items-center pl-4 border border-gray-200 dark:border-gray-700">
                            <input value="pdf" id="pdf" v-model="export_data.type" type="radio" name="export_type"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <global-label for="pdf"
                                class="py-2 ml-2 mt-1 w-full text-sm font-medium cursor-pointer text-gray-900 dark:text-gray-300"
                                value="PDF" :required="false" />
                        </label>
                    </div>
                </div>
            </template>

            <template #footer>
                <global-button @click="exportSubmit()" :loading="loading" type="button" class="mr-2" id="exportTransaction">
                    {{ __('Export') }}
                </global-button>
                <global-button :loading="false" @click="visible = false" type="button" class="mr-2" theme="outline-danger">
                    {{ __('Cancel') }}
                </global-button>
            </template>
        </export-modal>
        <!-- Data Export Modal End -->
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import BarChart from '@/Components/Chart/BarChart.vue';
import {
    MagnifyingGlassIcon,
    PencilSquareIcon,
    LinkIcon,
    EyeIcon,
    TrashIcon
} from "@heroicons/vue/24/outline";
import dayjs, { Dayjs } from "dayjs";
import { useForm } from "@inertiajs/inertia-vue3";
import ExportModal from "@/Shared/Modal.vue";
import NothingFound from "@/Shared/NothingFound.vue";
export default {
    components: {
        AppLayout,
        ToolTip,
        TrashIcon,
        LinkIcon,
        PencilSquareIcon,
        Pagination,
        MagnifyingGlassIcon,
        ExportModal,
        NothingFound,
        EyeIcon,
        BarChart
    },
    props: {
        filter_data: Object,
        transactions: Object,
        total_amount: Number,
        total_due_amount: Number,
        this_year_labels: Array,
        this_year_values: Array
    },
    data() {
        return {
            visible: false,
            update: false,
            item: "",
            customDateFormat: "DD-MM-YYYY",
            date2: [
                this.filter_data.start_date
                    ? dayjs(this.filter_data.start_date)
                    : null,
                this.filter_data.end_date
                    ? dayjs(this.filter_data.end_date)
                    : null
            ],
            filter: useForm({
                keyword: this.filter_data.keyword ?? "",
                status: this.filter_data.status ?? "",
                start_date: this.filter_data.start_date ?? "",
                end_date: this.filter_data.end_date ?? "",
                type: this.filter_data.type ?? "",
                over_due: this.filter_data.over_due ?? ""
            }),
            tab: this.filter_data.type ?? "all",
            tab2: this.filter_data.status ?? "all",
            tab3: this.filter_data.over_due ?? "all",
            export_data: useForm({
                type: "xlsx",
                month: 'this_month'
            }),
            loading: false
        };
    },
    watch: {
        date2: {
            deep: true,
            handler(val, oldVal) {
                if (val != null) {
                    if (this.date2[0] != null && this.date2[1] != null) {
                        let start = dayjs(this.date2[0]).format("YYYY-MM-DD");
                        let end = dayjs(this.date2[1]).format("YYYY-MM-DD");
                        this.filter.start_date = start;
                        this.filter.end_date = end;
                    } else {
                        this.filter.start_date = "";
                        this.filter.end_date = "";
                    }
                } else {
                    this.filter.start_date = "";
                    this.filter.end_date = "";
                }
            }
        }
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(
                    this.route("transaction.destroy", id)
                );
            } else {
                return false;
            }
        },
        filterData() {
            this.filter.get(this.route("transaction.index"), {
                preserveScroll: true
            });
        },
        showModal() {
            this.$refs.modal.showModal();
        },
        showExportModal() {
            this.visible = true;
        },
        exportSubmit() {
            this.loading = true;
            axios({
                url: this.route("report.transaction.export"),
                method: "POST",
                data: this.export_data,
                responseType: "blob"
            })
                .then(response => {
                    let extension = this.export_data.type;
                    var fileURL = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    var fileLink = document.createElement("a");
                    fileLink.href = fileURL;
                    fileLink.setAttribute(
                        "download",
                        "transactions-report." + extension
                    );
                    document.body.appendChild(fileLink);
                    fileLink.click();
                    this.loading = false;
                    this.visible = false;
                })
                .catch(e => {
                    this.loading = false;
                    this.visible = false;
                });
        },
        setTabValue(arg) {

            let column = arg['filter_column_data'] ?? '';
            let value = arg['value'] ?? '';

            this.filter[column] = value;
        }
    }
};
</script>
<style scoped>
.custom-input {
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}
</style>
