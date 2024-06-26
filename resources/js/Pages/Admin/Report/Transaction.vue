<template>
    <AppLayout :title="__('Transactions Report')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('reports.index')" title="Report" />
            <BreadcrumbLink :title="__('Transactions')" />
        </Breadcrumb>

        <div class="py-12">
            <page-header>
                {{ __('Transactions Report') }}
                <template #content>
                    <global-button @click="showExportModal()" :loading="false" type="button"
                        class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-300">
                        {{ __('Export') }}
                    </global-button>
                </template>
            </page-header>
            <div class="mb-3 ml-0.5" v-if="transactions.data.length > 0">
                <form class="grid grid-cols-1 2xl:grid-cols-6 gap-2 items-center" @submit.prevent="filterData()">
                    <div class="2xl:col-span-2">
                        <global-input id="search" v-model="filter.keyword" type="search"
                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Search: Transactions Title')" :error="$page.props.errors.keyword" />
                    </div>
                    <div class="2xl:col-span-2 flex gap-2">
                        <Multiselect id="user" :close-on-select="true" :can-clear="true" :searchable="true"
                            v-model="filter.parent_id" :create-option="false" :placeholder="__('Select User')" :options="users.map(item => ({
                                value: item.id, label: item.name
                            }))" autocomplete="off" />
                    </div>
                    <div class="2xl:col-span-2 flex sm:flex-nowrap flex-wrap items-center gap-2">
                        <tab-filter
                            @setTabData="setTabValue"
                            :filterData="filter_data ? filter_data.status : ''"
                            filter_column="status"
                            :tab_data="[
                                    { title: 'All', id: 'all', value: 'all' },
                                    { title: 'Paid', id: 'paid', value: 'paid' },
                                    { title: 'Unpaid', id: 'unpaid', value: 'unpaid' },
                            ]" />
                            <tab-filter
                            @setTabData="setTabValue"
                            :filterData="filter_data ? filter_data.amountType : ''"
                            filter_column="amountType"
                            :tab_data="[
                                    { title: 'All', id: 'all2', value: 'all' },
                                    { title: 'Income', id: 'income', value: 'income' },
                                    { title: 'Expense', id: 'expense', value: 'expense' },
                            ]" />
                        <global-button :loading="filter.processing" type="submit"
                            class="text-white whitespace-nowrap bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-300">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <global-table>
                <template #head>
                    <th class="py-5 px-5" width="25%">{{ __('Title') }}</th>
                    <th class="py-5 px-5">{{ __('User') }}</th>
                    <th class="py-5 px-5">{{ __('Type') }}</th>
                    <th class="py-5">{{ __('Amount') }}</th>
                    <th class="py-5">{{ __('Paid Amount') }}</th>
                    <th class="py-5">{{ __('Date') }}</th>
                </template>
                <template #body>
                    <template v-if="transactions.data.length > 0">
                        <template v-for="transaction in transactions.data" :key="transaction.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="py-5 px-5">
                                    {{ transaction.title }}
                                </td>
                                <td class="py-5 px-5">
                                    {{ transaction.user.name }}
                                </td>
                                <td class="py-5 px-5" v-if="transaction && transaction.type">
                                    <span>{{ transaction.type.name }}</span> <br>
                                    <span class="dark:opacity-60 text-xs font-bold mr-2 px-2.5 py-0.5 rounded mt-3"
                                        :class="transaction.type.type == 'income' ? 'bg-green-100 dark:bg-green-200 text-green-800 dark:text-green-800' : 'bg-yellow-100  dark:bg-yellow-200 text-yellow-800 dark:text-yellow-800'">
                                        {{ ucf(transaction.type.type) }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    {{ convertAmount(transaction.amount) }} <br>
                                    <span class="text-xs font-bold mr-2 px-2.5 py-0.5 rounded mt-3"
                                        :class="transaction.status == 'paid' ? 'bg-green-100 text-green-600 dark:opacity-60' : 'bg-blue-100 text-blue-600 dark:opacity-60'">
                                        {{ ucf(transaction.status) }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    {{ convertAmount(transaction.paid_amount) }}
                                </td>
                                <td class="py-5">
                                    {{ transaction.date_time }}
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template v-else>
                        <NothingFound asShow="tr" />
                    </template>
                </template>
            </global-table>
            <div class="flex justify-center mb-4">
                <pagination class="mt-6" :links="transactions.links" />
            </div>
        </div>
        <!-- Data Export Modal  -->
        <export-modal :show="visible" @close="closeModal">
            <template #title>
                {{ __('Export Data') }}
            </template>

            <template #content>
                <!-- Content -->
                <div class="flex gap-6">
                    <div
                        class="w-full rounded-lg cursor-pointer flex items-center pl-4 border border-gray-200 dark:border-gray-700">
                        <input value="xlsx" id="excel" v-model="export_data.type" type="radio" name="export_type"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        <global-label for="excel"
                            class="py-3 ml-2 cursor-pointer w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                            value="Excel" :required="false" />
                    </div>
                    <label for="pdf"
                        class="w-full cursor-pointer rounded-lg flex items-center pl-4 border border-gray-200 dark:border-gray-700">
                        <input value="pdf" id="pdf" v-model="export_data.type" type="radio" name="export_type"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        <global-label for="pdf"
                            class="py-3 ml-2 w-full text-sm font-medium cursor-pointer text-gray-900 dark:text-gray-300"
                            value="PDF" :required="false" />
                    </label>
                </div>
            </template>

            <template #footer>
                <global-button @click="exportSubmit()" :loading="loading" type="button" theme="primary" class="mr-2" id="testExport">
                    {{ __('Export') }}
                </global-button>
                <global-button :loading="false" @click="visible = false" type="button" theme="outline-danger">
                    {{ __('Cancel') }}
                </global-button>
            </template>
        </export-modal>
        <!-- Data Export Modal End -->
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from '@inertiajs/inertia-vue3'
import Pagination from "@/Shared/Admin/Pagination.vue";
import { ArrowRightIcon } from "@heroicons/vue/24/outline";
import ExportModal from '@/Shared/Modal.vue';
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    components: {
        AppLayout,
        ArrowRightIcon,
        Pagination,
        ExportModal,
        Multiselect,
        NothingFound
    },
    props: {
        users: Array,
        filter_data: Object,
        transactions: Array,
    },
    data() {
        return {
            visible: false,
            form: useForm({
                assignment: '',
                file: '',
                description: '',
            }),
            filter: useForm({
                keyword: this.filter_data.keyword ?? '',
                status: this.filter_data.status ?? '',
                parent_id: this.filter_data.parent_id ?? '',
                type: this.filter_data.type ? this.filter_data.type : 'all',
                amountType: this.filter_data.amountType ? this.filter_data.amountType : 'all',
                start_date: this.filter_data.start_date ?? '',
                end_date: this.filter_data.end_date ?? '',
            }),
            loading: false,
            export_data: useForm({
                type: 'xlsx'
            })
        };
    },
    methods: {
        ucf(str) {
            const final = str.charAt(0).toUpperCase() + str.slice(1);
            return final;
        },
        setTabValue(arg){
            let column = arg['filter_column_data'] ?? '';
            let value = arg['value'] ?? '';

            this.filter[column] =  value;
            this.filterData()
        },
        filterData() {
            this.filter.get(this.route('report.transaction'))
        },
        showExportModal() {
            this.visible = true;
        },
        exportSubmit() {
            this.loading = true;
            axios({
                url: this.route('report.transaction.export'),
                method: "POST",
                data: this.export_data,
                responseType: "blob",
            }).then((response) => {

                let extension = this.export_data.type;

                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement("a");

                fileLink.href = fileURL;
                fileLink.setAttribute("download", "transactions-report." + extension);
                document.body.appendChild(fileLink);

                fileLink.click();

                this.loading = false;
                this.visible = false;
            }).catch((e) => {
                this.loading = false;
                this.visible = false;
            });
        }
    },
};
</script>
