<template>
    <AppLayout :title="__('Invoice List')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Recurring Invoice')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] sm:text-sm">
                        {{ __('Recurring Invoice') }}
                    </span>
                    <badge>{{ invoices.total }}</badge>
                    <div class="group relative">
                        <ExclamationCircleIcon class="sm:w-6 sm:h-6 w-4 h-4 text-red-500 hover:text-red-400" />
                        <tool-tip :text="__('One time invoices can be found on the transaction page.')" />
                    </div>
                </div>
                <template #content>
                    <global-button :loading="false" :url="route('invoice.create')" type="link" theme="primary" id="testInvoiceButton">
                        {{ __('Create Invoice') }}
                    </global-button>
                </template>
            </page-header>
            <div class="sm:mb-4 mb-1.5">
                <form class="flex sm:flex-wrap sm:flex-row flex-col sm:gap-4 gap-1.5" @submit.prevent="filterData()">
                    <div class="relative flex-grow">
                        <global-input type="search" v-model="filter.keyword"
                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Invoice No or Recipient Email')" />
                        <button type="submit"
                            class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <MagnifyingGlassIcon class="w-5 h-5" />
                        </button>
                    </div>
                    <div class="flex-grow">
                        <a-range-picker :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                            class=" custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                            :disabled-date="disabledDate" :placeholder="[__('From Invoice Date'), __('End Invoice Date')]"
                            :disabled-time="disabledRangeTime" v-model:value="date2" :format="customDateFormat" />
                    </div>
                    <div class="flex-grow-0">
                        <tab-filter @setTabData="setTabValue" :filterData="filter_data ? filter_data.recurring : ''" filter_column="recurring"
                            :tab_data="[
                                                    { title: 'All', id: 'all', value: 'all' },
                                                    { title: 'Recurring', id: 'recurring_status_true', value: 'recurring_status_true' },
                                                    { title: 'Cancelled', id: 'recurring_status_false', value: 'recurring_status_false' },
                                                ]" />
                    </div>
                    <div>
                        <global-button :loading="loading" type="submit" class="whitespace-nowrap" theme="primary">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <div class="col-span-2 bg-white dark:bg-gray-800 dark:text-gray-600 rounded-lg" id="testInvoiceDataTable">
                <global-table>
                    <template #head>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Invoice No') }}</th>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Title') }} ({{ __('Create Date') }})</th>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Recipient Email') }}</th>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Total Amount') }} ({{ __('Due Date') }})</th>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Recurring') }}</th>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Next Recurring Date') }}</th>
                        <th class="py-4 px-5 whitespace-nowrap flex justify-end">{{ __('Action') }}</th>
                    </template>
                    <template #body>
                        <template v-if="invoices.data.length > 0">
                            <template v-for="invoice in invoices.data" :key="invoice.id">
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div class="font-semibold">
                                            #{{ invoice.invoice_no }}
                                        </div>
                                        <div
                                            class="text-white inline-flex bg-gray-400 dark:bg-gray-600 dark:text-gray-400 capitalize rounded px-2">
                                            {{ invoice.recurring ? 'recurring' : 'one time' }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div class="font-semibold">
                                            {{ invoice.title }}
                                        </div>
                                        <div class="text-sm">
                                            {{ invoice.invoice_date }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <td-user-show :image="invoice.user.profile_photo_url" :name="invoice.user.name"
                                            :email="invoice.user.email" />
                                    </td>
                                    <td class="py-4 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div class="text-base font-semibold">
                                            {{ convertAmount(conversionRate(invoice.currency, $page.props.default_currency, invoice.items_sum_amount)) }}
                                        </div>
                                        <div class="font-normal text-sm">
                                            {{ invoice.due_date_format }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div v-if="invoice.recurring" class="text-base font-semibold">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input @change="status($event, invoice.id)"
                                                    :checked="invoice.recurring_status" type="checkbox" id="hs-small-switch"
                                                    class="sr-only peer" />
                                                <div
                                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>
                                            </label>
                                        </div>
                                        <div v-else> - </div>
                                    </td>
                                    <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div>
                                            {{ invoice.next_recurring_date }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5">
                                        <div class="flex gap-2 items-center justify-end">
                                            <Link :href="route('invoice.show', invoice.id)" class="group relative" :id="'testInvoiceShow' + invoice.id">
                                            <eye-icon class="text-yellow-400 w-6 h-6 hover:text-yellow-300" />
                                            <tool-tip :text="__('Details')" />
                                            </Link>
                                            <Link :href="route('invoice.edit', invoice.id)" class="group relative" :id="'testInvoiceEdit' + invoice.id">
                                            <PencilSquareIcon class="text-blue-400 hover:text-blue-300 h-6 w-6" />
                                            <tool-tip :text="__('Edit')" />
                                            </Link>
                                            <button type="button" @click="sendInvoiceViaEmail(invoice.id)"
                                                class="group relative" :id="'testInvoiceSendEmail' + invoice.id">
                                                <div v-if="mail_sending == invoice.id" class="h-6 w-6">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                                                            opacity=".25" />
                                                        <path
                                                            d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"
                                                            class="spinner_ajPY" />
                                                    </svg>
                                                </div>
                                                <envelope-icon v-else class="text-green-400 h-6 w-6 hover:text-green-300" />
                                                <tool-tip :text="__('Send Via Email')" />
                                            </button>
                                            <a :href="route('invoice.download', invoice.id)" class="group relative"
                                                target="_blank">
                                                <ArrowDownTrayIcon class="text-purple-400 hover:text-purple-300 w-6 h-6" />
                                                <tool-tip text="Download" />
                                            </a>
                                            <button type="button" @click="destroy(invoice.id)" class="group relative" :id="'testInvoiceDelete' + invoice.id">
                                                <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                                <tool-tip :text="__('Delete')" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="7" class="text-center p-4">{{ __('Nothing Found') }}</td>
                            </tr>
                        </template>
                    </template>
                </global-table>
                <div class="flex justify-center mb-3">
                    <pagination class="mt-6 mb-4" :links="invoices.links" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import TdUserShow from "@/Shared/TdUserShow.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import {
    MagnifyingGlassIcon,
    TrashIcon,
    PencilSquareIcon,
    EyeIcon,
    EnvelopeIcon,
    ArrowDownTrayIcon,
    PrinterIcon,
    ExclamationCircleIcon
} from '@heroicons/vue/24/outline'
import dayjs, { Dayjs } from 'dayjs';

export default {
    components: {
        AppLayout,
        ToolTip,
        TrashIcon,
        PencilSquareIcon,
        Pagination,
        ExclamationCircleIcon,
        MagnifyingGlassIcon,
        PrinterIcon,
        ArrowDownTrayIcon,
        EnvelopeIcon,
        TdUserShow,
        EyeIcon,
    },
    props: {
        invoices: Object,
        filter_data: Object,
        users: Object,
        all_invoices: Object,
    },
    data() {
        return {
            loading: false,
            mail_sending: '',
            customDateFormat: 'DD-MM-YYYY',
            date2: [
                this.filter_data.start_date ? dayjs(this.filter_data.start_date) : null,
                this.filter_data.end_date ? dayjs(this.filter_data.end_date) : null,
            ],
            filter: {
                keyword: this.filter_data.keyword ?? "",
                start_date: this.filter_data.start_date ?? '',
                end_date: this.filter_data.end_date ?? '',
                recurring: this.filter_data.recurring ?? '',
            },
            tab: this.filter_data.recurring ?? 'all',
        };
    },
    watch: {
        date2: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal != null) {
                    if (this.date2[0] != null && this.date2[1] != null) {
                        let start = dayjs(this.date2[0]).format('YYYY-MM-DD');
                        let end = dayjs(this.date2[1]).format('YYYY-MM-DD');
                        this.filter.start_date = start;
                        this.filter.end_date = end;
                    } else {
                        this.filter.start_date = '';
                        this.filter.end_date = '';
                    }
                } else {
                    this.filter.start_date = '';
                    this.filter.end_date = '';
                }
            },
        },
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("invoice.destroy", id));
            } else {
                return false;
            }
        },
        filterData() {
            this.loading = true;
            this.$inertia.get(this.route("invoice.index"), this.filter, {
                onFinish: visit => { this.loading = false },
            });
        },
        sendInvoiceViaEmail(arg) {
            this.mail_sending = arg;
            this.$inertia.get(route('invoice.send.email', arg), {
                preserveScroll: true,
            }, {
                onFinish: visit => {
                    this.mail_sending = false;
                },
            })
        },
        setTabValue(arg) {
            let column = arg['filter_column_data'] ?? '';
            let value = arg['value'] ?? '';

            this.filter[column] = value;
        },
        status(event, id) {
            let value = event.target.checked;
            this.$inertia.post(this.route('invoice.recurring.status', id), {
                status: value
            }, {
                preserveScroll: true
            });
        },
    },
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
