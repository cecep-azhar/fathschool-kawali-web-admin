<template>
    <AppLayout :title="__(invoice.title)">
        <Breadcrumb>
            <BreadcrumbLink :href="route('invoice.index')" title="Recurring Invoice"/>
            <BreadcrumbLink :title="__(invoice.title)"/>
        </Breadcrumb>

        <div >
            <page-header>
                {{ invoice.title }}
            </page-header>
            <div class="grid xl:grid-cols-4 grid-cols-1 rounded-lg gap-6 pb-[25px]">
                <div class="bg-white dark:bg-gray-800 rounded-lg xl:col-span-1 xl:row-span-3">
                    <h2 class="text-base px-6 py-4 border-b text-gray-900 mb-0 font-semibold dark:text-gray-400">
                        {{ __('Invoice') }}
                    </h2>
                    <hr class="dark:border-gray-600">
                    <div class="p-6">
                        <div class="w-full items-center">
                            <div>
                                <h2 class="font-semibold dark:text-gray-400 mb-0 text-gray-900">
                                    {{ __('Title') }}
                                </h2>
                                <h2 class="dark:text-gray-400 mb-0 text-gray-900">
                                    {{ invoice.title }}
                                </h2>
                            </div>
                            <div class="mt-2">
                                <h2 class="font-semibold dark:text-gray-400 mb-0 text-gray-900">
                                    {{ __('Invoice No') }}
                                </h2>
                                <h2 class="dark:text-gray-400 mb-0 text-gray-900">
                                    #{{ invoice.invoice_no }}
                                </h2>
                            </div>
                            <div class="mt-2">
                                <h2 class="font-semibold dark:text-gray-400 mb-0 text-gray-900">
                                    {{ __('Created At') }}
                                </h2>
                                <h2 class="dark:text-gray-400 mb-0 text-gray-900]">
                                    {{ invoice.invoice_date }}
                                </h2>
                            </div>
                            <div class="mt-2">
                                <h2 class="font-semibold dark:text-gray-400 mb-0 text-gray-900">
                                    {{ __('Due Date') }}
                                </h2>
                                <h2 class="dark:text-gray-400 mb-0 text-gray-900]">
                                    {{ invoice.due_date_format }}
                                </h2>
                            </div>
                            <div class="mt-2">
                                <h2 class="font-semibold dark:text-gray-400 mb-0 text-gray-900">
                                    {{ __('Status') }}
                                </h2>
                                <h2 class="capitalize dark:text-gray-400 mb-0 text-gray-900">
                                    {{ invoice.status }}
                                </h2>
                            </div>
                            <div class="mt-2">
                                <h2 class="font-semibold dark:text-gray-400 mb-0 text-gray-900">
                                    {{ __('Amount') }}
                                </h2>
                                <h2 class="dark:text-gray-400 mb-0 text-gray-900">
                                    {{ convertAmount(conversionRate(invoice.currency, $page.props.default_currency, invoice.amount)) }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-3 xl:row-span-3">
                    <div class="bg-white dark:bg-gray-800 rounded-sm">
                        <h2
                            class="px-6 py-4 border-b-2 text-base text-black/[0.85] mb-0 font-semibold dark:text-gray-400">
                            {{ __('Transactions') }}
                        </h2>
                        <div class=" dark:text-gray-400 dark:bg-gray-800">
                            <global-table>
                                <template #head>
                                    <th class="py-5 px-5">{{ __('Type') }}</th>
                                    <th class="py-5">{{ __('Title') }}</th>
                                    <th class="py-5">{{ __('Amount') }}</th>
                                    <th class="py-5">{{ __('Paid Amount') }}</th>
                                    <th class="py-5">{{ __('Document') }}</th>
                                    <th class="py-5">{{ __('Status') }}</th>
                                </template>
                                <template #body>
                                    <template v-if="transactions.data.length > 0">
                                        <template v-for="transaction in transactions.data" :key="transaction.id">
                                            <tr
                                                class="border-b dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="inline-flex relative">
                                                        <div
                                                            class="bg-blue-100 text-blue-800 dark:text-gray-400 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700">
                                                            {{ transaction.type.name }}
                                                        </div>
                                                        <div :class="transaction.type.type == 'income' ? 'bg-green-500 dark:opacity-60' : 'bg-red-500 dark:opacity-60'"
                                                            class="inline-flex absolute -top-3 rounded -right-5 px-1 justify-center items-center text-xs font-bold text-white capitalize">
                                                            {{ transaction.type.type }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 text-gray-900 dark:text-gray-400 whitespace-nowrap">
                                                    <div class="text-base font-semibold">
                                                        {{ transaction.title }}
                                                    </div>
                                                    <div class="flex text-base font-semibold">
                                                        <div>
                                                            <img class="w-8 h-8 rounded"
                                                                :src="transaction.user.profile_photo_url" alt="" />
                                                        </div>
                                                        <div class="ml-2">
                                                            {{ transaction.user.name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                    <div class="text-base font-semibold">
                                                        {{ convertAmount(conversionRate(transaction.currency, $page.props.default_currency, transaction.amount)) }}
                                                    </div>
                                                    <div class="text-sm font-semibold">
                                                        {{ transaction.date_time }}
                                                    </div>
                                                </td>
                                                <td class="py-4 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                    <div class="text-base font-semibold">
                                                        {{ convertAmount(conversionRate(transaction.currency, $page.props.default_currency, transaction.paid_amount)) }}
                                                    </div>
                                                    <div class="text-base font-semibold">{{ transaction.method }}</div>
                                                </td>
                                                <td class="py-4 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                    <div class="text-base font-semibold">
                                                        <span
                                                            class="text-sm text-blue-500 hover:text-blue-400 cursor-pointer"
                                                            @click="download(transaction.document)"
                                                            v-if="transaction.document">
                                                            {{ __('Download') }}
                                                        </span>
                                                        <template v-else> - </template>
                                                    </div>
                                                </td>
                                                <td class="py-4 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                    <div class="text-base font-semibold">
                                                        <span
                                                            class="capitalize text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                                                            :class="
                                                                transaction.status == 'paid'
                                                                    ? 'bg-green-400 text-white dark:opacity-60'
                                                                    : 'bg-blue-100 text-blue-800 dark:opacity-60'
                                                            ">
                                                            {{ transaction.status }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="7" class="text-center p-4">{{ __('Nothing Found') }}.</td>
                                        </tr>
                                    </template>
                                </template>
                            </global-table>
                            <div class="flex justify-center mb-2">
                                <pagination class="mt-6" :links="transactions.links" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    props: {
        invoice: Object,
        transactions: Object
    },
    data() {
    },
    components: {
        AppLayout,
    },
    methods: {
    }
}
</script>
