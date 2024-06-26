<template>
    <AppLayout :title="__('Transaction ') + text">
        <Breadcrumb>
            <BreadcrumbLink :href="route('all.transaction')" :title="__('All Transaction')" />
            <BreadcrumbLink :title="__('Transaction create')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Transaction') }} {{ __(text) }}
                <template #content>
                    <global-button preserve-scroll :loading="false" type="link" :url="route('all.transaction')"
                        theme="primary">
                        {{ __('Transaction List') }}
                    </global-button>
                </template>
            </page-header>
            <form class="mt-2" @submit.prevent="submit()" enctype="multipart/form-data">
                <template v-if="route().current('transaction.create')">
                    <div class="max-w-5xl flex flex-col gap-5 mx-auto">
                        <div
                            class="bg-white grid grid-cols-1 md:grid-cols-2 gap-3 border rounded-lg border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="col-span-2 md:col-span-1">
                                <global-label for="title" value="Title" :required="true" />
                                <global-input id="title" v-model="form.title" type="text"
                                    class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Title')" :error="$page.props.errors.title" />
                                <input-error :error="$page.props.errors.title" />
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <global-label for="type" value="Type" :required="true" />
                                <Multiselect v-model="form.type" :close-on-select="true" :searchable="true" id="type"
                                    :create-option="true" :placeholder="__('Write to add type') + '...'"
                                    :options="types_data" autocomplete="off" />
                                <input-error :error="$page.props.errors.type" />
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <global-label for="currency" value="Currency" :required="true" />
                                <Multiselect id="currency" :close-on-select="true" :can-clear="true" :searchable="true"
                                    v-model="form.currency" :create-option="false" :placeholder="__('Currency')" :options="currencies.map(item => ({
                                        value: item.code, label: item.name
                                    }))" autocomplete="off" />
                                <input-error :error="$page.props.errors.currency" />
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <global-label for="amount" value="Amount" :required="true" />
                                <global-input id="amount" v-model="form.amount" type="number"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Amount')" :error="$page.props.errors.amount" />
                                <input-error :error="$page.props.errors.amount" />
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <global-label for="date" value="Date" :required="true" />
                                <a-date-picker :class="errors.date ? 'ant-datepicker-custom-border' : ''" name="date"
                                    :format="getDateTimeFormat()" id="testDate"
                                    class="ant-datepicker-custom dark:bg-gray-700 dark:border-gray-700"
                                    v-model:value="value" :placeholder="__('Select Date')" />
                                <input-error :error="$page.props.errors.date" />
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <global-label for="paid" value="Status" :required="true" />
                                <div class="flex items-center gap-3">
                                    <label for="unpaid"
                                        class="w-full flex items-center pl-4 rtl:pl-0 rtl:pr-4 border rounded-lg dark:bg-gray-700 border-gray-200 dark:border-gray-700">
                                        <input type="radio" value="unpaid" v-model="form.status" id="unpaid" name="status"
                                            class="w-4 h-4 text-blue-600 rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600" />
                                        <label for="unpaid"
                                            class="py-2.5 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300 dark:bg-gray-700">
                                            {{ __('Unpaid') }}
                                        </label>
                                    </label>
                                    <label for="paid"
                                        class="w-full flex items-center pl-4 rtl:pl-0 rtl:pr-4 border rounded-lg dark:bg-gray-700 border-gray-200 dark:border-gray-700">
                                        <input type="radio" value="paid" v-model="form.status" id="paid" name="status"
                                            class="w-4 h-4 text-blue-600 rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600" />
                                        <label for="paid"
                                            class="py-2.5 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300 dark:bg-gray-700">
                                            {{ __('Paid') }}
                                        </label>
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <global-label for="payment_method" value="Payment Method" :required="false" />
                                <global-input id="payment_method" v-model="form.payment_method" type="text"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Payment Method')" :error="$page.props.errors.payment_method" />
                                <input-error :error="$page.props.errors.payment_method" />
                            </div>
                            <div class="col-span-2">
                                <global-label for="description" value="Description" :required="false" />
                                <global-textarea id="description" v-model="form.description" type="text"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Description')" :error="$page.props.errors.description">
                                </global-textarea>
                                <input-error :error="$page.props.errors.description" />
                            </div>
                            <div class="col-span-2">
                                <label for="document"
                                    class="block mb-2 items-center text-sm font-medium text-gray-900 dark:text-gray-400">
                                    <span>{{ __('Document ( invoice or file from a shop or company bill )') }}</span>
                                </label>
                                <div v-if="transaction && transaction.document">
                                    <button @click="download(transaction.document)"
                                        class="text-pink-500 border border-pink-500 hover:bg-pink-500 hover:text-white active:bg-pink-600 font-bold uppercase px-4 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        {{ __('Download Old') }}
                                    </button>
                                </div>
                                <input type="file" @change="picFile"
                                    :class="errors.document ? 'border-red-500 dark:border-red-500' : ''" id="document"
                                    name="document" accept="image/*, pdf/*, doc/*"
                                    class="pl-4 rtl:pl-0 rtl:pr-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="" />
                                <div class="font-bold text-xs ml-1 rtl:ml-0 rtl:mr-1 dark:text-gray-400 mt-0.5">
                                    {{ __('Supported extension .pdf, .doc, .docx, .zip, .jpeg, .png') }}
                                </div>
                                <input-error :error="$page.props.errors.document" />
                            </div>
                        </div>

                        <global-button :loading="loading" type="submit" cssClass="w-full mt-3" theme="primary">
                            {{ __('Save') }}
                        </global-button>
                    </div>
                </template>
                <template v-else>
                    <div class="max-w-5xl flex flex-col gap-5 mx-auto">
                        <div
                            class="bg-white grid grid-cols-1 md:grid-cols-2 gap-3 border rounded-lg border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div>
                                <global-label for="type" value="Select Type" :required="true" />
                                <div
                                    class="flex items-center pl-4 rtl:pl-0 rtl:pr-4 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <input @change="getType('income')" v-model="form.category_type" id="income" type="radio"
                                        value="income" name="bordered-radio"
                                        class=" text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="income"
                                        class="py-2.5 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ __('Income') }}
                                    </label>
                                    <input @change="getType('expense')" v-model="form.category_type" id="expense"
                                        type="radio" value="expense" name="bordered-radio"
                                        class=" text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="expense"
                                        class="py-2.5 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ __('Expense') }}
                                    </label>
                                </div>
                            </div>

                            <div v-if="form.category_type != 'expense'">
                                <global-label for="user" :value="__('Select User')" :required="true" />
                                <Multiselect v-model="form.particular" :close-on-select="true" :searchable="true"
                                    :create-option="false" :placeholder="__('Select User')" :options="users.data"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.particular" />
                            </div>
                            <div v-if="form.category_type != 'expense'">
                                <label for="document"
                                    class="block mb-2 items-center text-sm font-medium text-gray-900 dark:text-gray-400">
                                    <span>{{ __('Document ( invoice or file from a shop or company bill )') }}</span>
                                </label>
                                <div v-if="transaction && transaction.document">
                                    <button @click="download(transaction.document)"
                                        class="text-pink-500 border border-pink-500 hover:bg-pink-500 hover:text-white active:bg-pink-600 font-bold uppercase px-4 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        {{ __('Download Old') }}
                                    </button>
                                </div>
                                <input type="file" @change="picFile"
                                    :class="errors.document ? 'border-red-500 dark:border-red-500' : ''" id="document"
                                    name="document" accept="image/*, pdf/*, doc/*"
                                    class="pl-4 rtl:pl-0 rtl:pr-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="" />
                                <div class="font-bold text-xs ml-1 rtl:ml-0 rtl:mr-1 dark:text-gray-400 mt-0.5">
                                    {{ __('Supported extension .pdf, .doc, .docx, .zip, .jpeg, .png') }}
                                </div>
                                <input-error :error="$page.props.errors.document" />
                            </div>
                            <div>
                                <global-label for="description" value="Description" :required="false" />
                                <global-textarea id="description" v-model="form.description" type="text"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Description')" :error="$page.props.errors.description">
                                </global-textarea>
                                <input-error :error="$page.props.errors.description" />
                            </div>
                            <div>
                                <global-label for="type" value="Type" :required="true" />
                                <Multiselect v-model="form.type" :close-on-select="true" :searchable="true"
                                    :create-option="true" :placeholder="__('Write to add type') + '...'"
                                    :options="types_data" autocomplete="off" />
                                <input-error :error="$page.props.errors.type" />
                            </div>
                        </div>
                        <div
                            class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 bg-white border rounded-lg border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div>
                                <global-label for="currency" value="Currency" :required="true" />
                                <Multiselect id="currency" :close-on-select="true" :can-clear="true" :searchable="true"
                                    v-model="form.currency" :create-option="false" placeholder="Currency" :options="currencies.map(item => ({
                                        value: item.code, label: item.name
                                    }))" autocomplete="off" />
                                <input-error :error="$page.props.errors.currency" />
                            </div>
                            <div>
                                <global-label for="amount" value="Amount" :required="true" />
                                <global-input id="amount" v-model="form.amount" type="number"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Amount')" :error="$page.props.errors.amount" />
                                <input-error :error="$page.props.errors.amount" />
                            </div>
                        </div>
                        <div
                            class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 bg-white border rounded-lg border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div v-if="form.category_type != 'expense'">
                                <global-label for="paid_amount" value="Paid Amount" :required="false" />
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 rtl:right-0 rtl:left-auto flex items-center px-4 pointer-events-none dark:text-gray-400 border-r rtl:border-r-transparent rtl:border-l">
                                        <b class="dark:text-gray-400">{{ $page.props.default_currency }}</b>
                                    </div>
                                    <global-input id="paid_amount" v-model="form.paid_amount" type="number"
                                        class="pl-20 rtl:pl-0 rtl:pr-20 mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Paid Amount')" :error="$page.props.errors.paid_amount" />
                                    <input-error :error="$page.props.errors.paid_amount" />
                                </div>
                            </div>
                            <div>
                                <global-label for="payment_method" value="Payment Method" :required="false" />
                                <global-input id="payment_method" v-model="form.payment_method" type="text"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Payment Method')" :error="$page.props.errors.payment_method" />
                                <input-error :error="$page.props.errors.payment_method" />
                            </div>
                            <div>
                                <global-label for="title" value="Title" :required="true" />
                                <global-input id="title" v-model="form.title" type="text"
                                    class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Title')" :error="$page.props.errors.title" />
                                <input-error :error="$page.props.errors.title" />
                            </div>
                            <div>
                                <global-label for="date" value="Date" :required="true" />
                                <a-date-picker :class="errors.date ? 'ant-datepicker-custom-border' : ''" name="date"
                                    :format="getDateTimeFormat()"
                                    class="ant-datepicker-custom dark:bg-gray-700 dark:border-gray-700"
                                    v-model:value="value" :placeholder="__('Select Date')" />
                                <input-error :error="$page.props.errors.date" />
                            </div>
                            <div v-if="form.category_type != 'expense'">
                                <global-label for="due_date" value="Due Date" :required="false" />
                                <a-date-picker id="due_date" :class="errors.due_date ? 'ant-datepicker-custom-border' : ''"
                                    :format="getDateTimeFormat()" name="due_date"
                                    class="ant-datepicker-custom dark:bg-gray-700 dark:border-gray-700"
                                    v-model:value="due_date" :placeholder="__('Select Date')" />
                                <input-error :error="$page.props.errors.due_date" />
                            </div>
                            <div>
                                <global-label for="paid" value="Status" :required="true" />
                                <div class="flex items-center gap-3">
                                    <label for="unpaid"
                                        class="w-full flex items-center pl-4 rtl:pl-0 rtl:pr-4 border rounded-lg dark:bg-gray-700 border-gray-200 dark:border-gray-700">
                                        <input type="radio" value="unpaid" v-model="form.status" id="unpaid" name="status"
                                            class="w-4 h-4 text-blue-600 rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600" />
                                        <label for="unpaid"
                                            class="py-2.5 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300 dark:bg-gray-700">
                                            {{ __('Unpaid') }}
                                        </label>
                                    </label>
                                    <label for="paid"
                                        class="w-full flex items-center pl-4 rtl:pl-0 rtl:pr-4 border rounded-lg dark:bg-gray-700 border-gray-200 dark:border-gray-700">
                                        <input type="radio" value="paid" v-model="form.status" id="paid" name="status"
                                            class="w-4 h-4 text-blue-600 rounded-lg bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600" />
                                        <label for="paid"
                                            class="py-2.5 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300 dark:bg-gray-700">
                                            {{ __('Paid') }}
                                        </label>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <global-button :loading="loading" type="submit" cssClass="w-full mt-3" theme="primary">
                            {{ __('Save') }}
                        </global-button>
                    </div>
                </template>
            </form>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import dayjs, { Dayjs } from 'dayjs';
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';

export default {
    components: {
        AppLayout,
        Multiselect
    },
    props: {
        types: Object,
        users: Object,
        errors: Object,
        transaction: Object,
        currencies: Array
    },
    data() {
        return {
            loading: false,
            text: this.transaction ? 'Edit' : 'Create',
            types_data: [],
            customDateFormat: 'DD-MM-YYYY',
            value: this.transaction && this.transaction.date ? dayjs(this.transaction.date, this.customDateFormat) : null,
            due_date: this.transaction && this.transaction.due_date ? dayjs(this.transaction.due_date) : null,
            form: {
                category_type: '',
                type: this.transaction ? this.transaction.transaction_type_id : "",
                particular: this.transaction ? this.transaction.user_id : "",
                title: this.transaction ? this.transaction.title : "",
                amount: this.transaction ? this.transaction.amount : "",
                currency: this.transaction ? this.transaction.currency : "",
                date: this.transaction ? this.transaction.date : "",
                due_date: this.transaction ? this.transaction.due_date : null,
                paid_amount: this.transaction ? this.transaction.paid_amount : "",
                description: this.transaction ? this.transaction.description : "",
                status: this.transaction && this.transaction.status ? this.transaction.status : 'unpaid',
                document: "",
                payment_method: this.transaction ? this.transaction.method : "",
                _method: this.transaction ? "PUT" : "POST",
            },
        };
    },
    mounted() {
        let exist_type = this.transaction ? this.transaction.type.type : 'expense';
        this.getType(exist_type);
    },
    methods: {
        submit() {
            this.loading = true;
            if (this.value) {
                this.form.date = dayjs(this.value).format('YYYY-MM-DD');
            }
            if (this.due_date) {
                this.form.due_date = dayjs(this.due_date).format('YYYY-MM-DD');
            }
            if (this.transaction) {
                this.$inertia.post(
                    this.route("transaction.update", this.transaction.id),
                    this.form,
                    {
                        preserveScroll: true,
                        onSuccess: () => { },
                        onFinish: visit => { this.loading = false; },
                    }
                );
            } else {
                this.$inertia.post(this.route("transaction.store"), this.form, {
                    preserveScroll: true,
                    onSuccess: () => { },
                    onFinish: visit => { this.loading = false; },
                });
            }
        },
        picFile(e) {
            this.form.document = e.target.files[0];
        },
        toUpperCase(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        getType(arg) {
            this.form.category_type = arg;
            var items = [];
            this.types.forEach(item => { // loop all data to get specifics items
                if (arg == item.type) {
                    items.push({
                        value: item.id,
                        label: item.name + ' ( ' + this.toUpperCase(this.form.category_type) + ' )',
                    });
                }
            });
            this.types_data = items;
        },
    },
};
</script>

<style>
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
