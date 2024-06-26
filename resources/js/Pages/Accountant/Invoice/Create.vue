<template>
    <AppLayout :title="__('New Invoice')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('invoice.index')" title="Recurring Invoice"/>
            <BreadcrumbLink :title="__('New Invoice')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('New Invoice') }}
                <template #content>
                    <global-button :loading="false" type="link" :url="route('invoice.index')"
                        theme="primary">
                        {{ __('Back To List') }}
                    </global-button>
                </template>
            </page-header>
            <form @submit.prevent="submit()" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <div class="bg-white dark:bg-gray-800 rounded-lg">
                            <div class="w-full p-6 dark:border-gray-700">
                                <template v-for="(item, i) in transaction_items" :key="i">
                                    <div class="mb-4">
                                        <div class="flex justify-end items-end">
                                            <button type="button" v-if="i != 0" @click="removeItem(item, i)"
                                                class="bg-red-500 hover:bg-red-500 rounded-full p-1" id="testRemoveItem">
                                                <trash-icon class="w-6 h-6 text-white" />
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div >
                                                <global-label for="description" value="Description" :required="false" />
                                                <global-textarea cols="30" rows="1" id="description"
                                                    v-model="form.description[i]" type="text"
                                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Description')" :error="$page.props.errors.description">
                                                </global-textarea>
                                                <input-error :error="$page.props.errors.description" />
                                            </div>
                                            <div >
                                                <global-label for="amount" value="Amount" :required="true" />
                                                <global-input @keyup="totalSum()" id="amount" v-model="form.amount[i]"
                                                    type="number"
                                                    class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Amount')" :error="$page.props.errors.amount" />
                                                <input-error :error="$page.props.errors.amount" />
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <div class="mt-2">
                                    <div @click="addNew()" class="cursor-pointer text-lg font-bold text-blue-500" id="testAddItem">
                                        +{{ __('Add Item') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white mt-2 dark:bg-gray-800 rounded-lg">
                            <div class="w-full p-6 dark:border-gray-700">
                                <div class="mt-4">
                                    <global-label for="document" :value="__('Attachments')" :required="false" />
                                    <div v-if="transaction && transaction.document">
                                        <button @click="download(transaction.document)"
                                            class="text-pink-500 border border-pink-500 hover:bg-pink-500 hover:text-white active:bg-pink-600 font-bold uppercase px-4 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            type="button">
                                            {{ __('Download Old') }}
                                        </button>
                                    </div>
                                    <input type="file" multiple @change="attachment"
                                        :class="$page.props.errors.document ? 'border-red-500 dark:border-red-500' : ''"
                                        id="document" name="document" accept="image/*, pdf/*, doc/*"
                                        class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                    <div class="font-bold text-xs ml-1 dark:text-gray-400 mt-0.5">
                                        {{ __('Supported extension') }} .pdf, .doc, .docx, .zip, .jpeg, .png
                                    </div>
                                    <input-error :error="$page.props.errors.document" />
                                </div>
                                <div class="mt-4">
                                    <global-label for="message" :value="__('Message To Recipient')" :required="false" />
                                    <global-textarea id="message" v-model="form.message" type="text"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Message To Recipient')" :error="$page.props.errors.message">
                                    </global-textarea>
                                    <input-error :error="$page.props.errors.message" />
                                </div>
                            </div>
                        </div>
                        <div class="bg-white mt-2 dark:bg-gray-800 rounded-lg">
                            <div class="w-full p-6 dark:border-gray-700">
                                <div class="mt-2">
                                    <div class="flex justify-between items-center">
                                        <div class="font-extrabold text-xl dark:text-gray-400">{{ __('Total Amount') }}</div>
                                        <div class="font-extrabold text-xl dark:text-gray-400">{{ convertAmount(form.total_amount) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="bg-white dark:bg-gray-800 rounded-lg mb-2">
                            <div class="px-4 py-2 dark:border-gray-700">
                                <global-label for="recipient" value="Invoice Type" class="ml-1 mt-3 mb-1"
                                    :required="true" />
                                <div
                                    class="flex items-center pl-4 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <input @click="recurringOption(false)" :checked="!form.recurring"
                                        id="one_time_invoice" type="radio" name="one_time_invoice"
                                        class=" text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="one_time_invoice"
                                        class="py-2.5 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ __('One Time Invoice') }}
                                    </label>
                                    <input @click="recurringOption(true)" :checked="form.recurring"
                                        id="recurring_invoice" type="radio" name="recurring_invoice"
                                        class=" text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="recurring_invoice"
                                        class="py-2.5 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ __('Recurring Invoice') }}
                                    </label>
                                </div>
                            </div>
                            <div class="px-4 py-0 dark:border-gray-700">
                                <div v-if="form.recurring" class="mb-3">
                                    <global-label for="recurring_days" :value="__('Repeat Every')" :required="true" />
                                    <div class="flex gap-3">
                                        <global-input id="recurring_days" v-model="form.recurring_days" type="number"
                                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Days')" :error="$page.props.errors.recurring_days" />
                                    </div>
                                    <input-error :error="$page.props.errors.recurring_days" />
                                </div>
                            </div>
                            <div class="px-4 py-0 dark:border-gray-700">
                                <global-label for="currency" :value="__('Select Currency')" class="ml-1 mb-1"
                                    :required="true" />
                                <div class="w-full">
                                    <Multiselect id="currency" :close-on-select="true" :can-clear="false"
                                        :searchable="true" v-model="form.currency" :create-option="false"
                                        :placeholder="__('Currency')" :options="currencies.map(item => ({
                                            value: item.code, label: item.name
                                        }))" autocomplete="off" />
                                    <input-error :error="$page.props.errors.user" />
                                </div>
                            </div>
                            <div class="w-full px-4 py-2 dark:border-gray-700">
                                <global-label for="recipient" :value="__('Select Recipient')" class="ml-1 mb-1"
                                    :required="true" />
                                <div class="mb-3 flex items-center gap-6">
                                    <div>
                                        <img class="h-12 w-16 rounded-lg" :src="selected_user_image"
                                            alt="Recipient image">
                                    </div>
                                    <div class="w-full">
                                        <Multiselect @change="getImage()" id="recipient" v-model="form.user"
                                            :close-on-select="true" :can-clear="false" :searchable="true"
                                            :create-option="false" :placeholder="__('Select Recipient')"
                                            :options="users.data" autocomplete="off" />
                                        <input-error :error="$page.props.errors.user" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg">
                            <div class="w-full p-6 dark:border-gray-700">
                                <div class="mb-3">
                                    <global-label for="invoice_title" :value="__('Invoice Title')" :required="true" />
                                    <global-input id="invoice_title" v-model="form.title" type="text"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Invoice Title')" :error="$page.props.errors.title" />
                                    <input-error :error="$page.props.errors.title" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="invoice_number" :value="__('Invoice Number')" :required="true" />
                                    <global-input id="invoice_number" v-model="form.invoice_number" type="text"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Invoice No')" :error="$page.props.errors.invoice_number" />
                                    <input-error :error="$page.props.errors.invoice_number" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="paid" value="Status" :required="false" />
                                    <label for="paid"
                                        class="w-full flex items-center pl-4 border rounded-lg dark:bg-gray-700 border-gray-200 dark:border-gray-700">
                                        <input checked type="checkbox" value="paid" v-model="form.status" id="paid"
                                            name=""
                                            class="w-4 h-4 text-blue-600 rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600" />
                                        <label for="paid"
                                            class="py-2.5 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300 dark:bg-gray-700">
                                            {{ __('Paid') }}
                                        </label>
                                    </label>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="mb-3">
                                        <global-label for="invoice_date" :value="__('Invoice Date')" :required="true" />
                                        <a-date-picker
                                            :class="$page.props.errors.date ? 'ant-datepicker-custom-border' : ''"
                                            name="date"
                                            class="ant-datepicker-custom dark:bg-gray-700 dark:border-gray-700"
                                            :format="getDateTimeFormat()" v-model:value="date_value" placeholder="Select Date" />
                                        <input-error :error="$page.props.errors.date" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="due_date_in" value="Due Date" :required="true" />
                                        <Multiselect id="due_date_in" v-model="form.due_date_in" :close-on-select="true"
                                            :can-clear="false" :searchable="true" :create-option="true"
                                            :placeholder="__('Due Date')" :options="dueDate" autocomplete="off" />
                                        <input-error :error="$page.props.errors.due_date_in" />
                                    </div>
                                </div>
                                <div class="mb-3" v-if="form.due_date_in == 'date'">
                                    <global-label for="invoice_date" value="Select Specific Date" :required="true" />
                                    <a-date-picker
                                        :class="$page.props.errors.due_date ? 'ant-datepicker-custom-border' : ''"
                                        name="due_date"
                                        class="ant-datepicker-custom dark:bg-gray-700 dark:border-gray-700"
                                        :format="getDateTimeFormat()" v-model:value="due_date_value"
                                        :placeholder="__('Select Specific Date')" />
                                    <input-error :error="$page.props.errors.due_date" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <global-button :loading="loading" type="submit" cssClass="w-full mt-3" theme="primary">
                    {{ __('Create New Invoice') }}
                </global-button>
            </form>
        </div>
        <a-modal v-model:visible="visible" :title="__('Recurring Invoice Schedule')" @ok="hide">
            <template #footer>
                <a-button key="back" @click="hide">{{ __('Save') }}</a-button>
            </template>
            <div class="dark:bg-gray-800 rounded-lg dark:text-gray-400">
                <div class="w-full">
                    <div class="bg-white dark:bg-gray-800 rounded-lg">
                        <div class="grid grid-cols-2 gap-2 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="invoice_date" value="Invoice Start Date" :required="true" />
                                <a-date-picker :class="$page.props.errors.date ? 'ant-datepicker-custom-border' : ''"
                                    name="date" class="ant-datepicker-custom dark:bg-gray-700 dark:border-gray-700"
                                    :format="getDateTimeFormat()" v-model:value="date_value" :placeholder="__('Select Date')" />
                                <input-error :error="$page.props.errors.date" />
                            </div>
                            <div class="mb-3">
                                <global-label for="recurring_days" value="Repeat Every" :required="true" />
                                <div class="flex gap-3">
                                    <global-input id="recurring_days" v-model="form.recurring_days" type="number"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Days')" :error="$page.props.errors.recurring_days" />
                                </div>
                                <input-error :error="$page.props.errors.recurring_days" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Multiselect from '@vueform/multiselect'
import dayjs, { Dayjs } from 'dayjs';
import '@vueform/multiselect/themes/default.css';

import { TrashIcon } from '@heroicons/vue/24/outline'

export default {
    components: {
        AppLayout,
        Multiselect,
        TrashIcon
    },
    props: {
        invoice_no: Object,
        users: Object,
        currencies: Object
    },
    data() {
        return {
            loading: false,
            visible: false,
            transaction_items: [1],
            selected_user_image: this.users.data[0].image,
            date_value: dayjs(),
            due_date_value: dayjs(),
            form: {
                user: this.users.data[0].value,
                date: dayjs(),
                due_date_in: '',
                due_date: dayjs(),
                amount: [],
                description: [],
                message: '',
                invoice_number: this.invoice_no,
                title: '',
                currency: this.$page.props.setting.app_currency,
                attachments: [],
                status: '',
                //
                recurring: false,
                recurring_days: '',
                total_amount: 0,
            },
            dueDate: [
                { value: '0', label: 'No Due Date' },
                { value: 'date', label: 'On Specific Date' },
                { value: '10', label: 'In 10 Days' },
                { value: '15', label: 'In 15 Days' },
                { value: '30', label: 'In 30 Days' },
            ],
        };
    },
    watch: {
        date_value: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal) {
                    let date = dayjs(newVal).format('YYYY-MM-DD');
                    this.form.date = date;
                } else {
                    this.form.date = null;
                }
            },
        },
        due_date_value: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal) {
                    let date = dayjs(newVal).format('YYYY-MM-DD');
                    this.form.due_date = date;
                } else {
                    this.form.due_date = null;
                }
            },
        },
        form: {
            deep: true,
            handler(newVal, oldVal) {
                this.totalSum();
            },
        },
    },
    mounted() {
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(this.route("invoice.store"), this.form, {
                onFinish: visit => { this.loading = false },
            });
        },
        addNew() {
            let length = this.transaction_items.length;
            this.transaction_items.push(length + 1);
        },
        totalSum() {

            setInterval(() => {
                let total = 0;
                for (let i = 0; i < this.form.amount.length; i++) {
                    total = parseInt(total) + parseInt(this.form.amount[i]);
                }
                // push total value
                this.form.total_amount = this.form.amount.length > 0 ? parseFloat(total).toFixed(2) : 0;
            }, 1000);

        },
        removeItem(item, index) {

            var arr = this.transaction_items;
            for (var i = 0; i < arr.length; i++) {
                if (arr[i] === item) {
                    arr.splice(i, 1);
                }
            }
            // remove data
            this.form.item.splice(index, 1);
            this.form.amount.splice(index, 1);
            this.form.description.splice(index, 1);
            // re_sum total amount
            this.totalSum();
        },
        getImage() {
            setTimeout(() => {
                let select_id = this.form.user;
                let select_user_name = '';
                this.users.data.forEach(element => {
                    if (element.value == select_id) {
                        this.selected_user_image = element.image;
                        select_user_name = element;
                        select_user_name = element.label;
                    }
                });
                this.generateInvoiceTitle(select_user_name);
            }, 100);
        },
        attachment(e) {
            for (let i = 0; i < e.target.files.length; i++) {
                this.form.attachments.push(e.target.files[i]);
            }
        },
        recurringOption(arg) {
            this.form.recurring = arg;
            this.visible = arg
        },
        hide() {
            this.visible = false
        },
        generateInvoiceTitle(arg) {
            if (!this.form.title.length > 0) {
                let requiring_title = this.form.recurring ? 'Recurring' : '';
                let date = dayjs().format('YYYY-MM-DD');
                let final_title = arg + ' ' + requiring_title + ' ' + date;
                this.form.title = final_title;
            }
        }
    },
};
</script>
<style scoped>
.ant-datepicker-custom {
    display: block;
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.ant-datepicker-custom-border {
    border-color: red;
    border-right-width: 1px !important;
}
</style>
