<template>
    <global-table>
        <template #head>
            <th class="py-4 px-5 whitespace-nowrap">{{ __('Invoice') }}</th>
            <th class="py-4 px-5 whitespace-nowrap">{{ __('Total Amount') }}</th>
            <th class="py-4 px-5 whitespace-nowrap">{{ __('Paid Amount') }}</th>
            <th class="py-4 px-5 whitespace-nowrap" style="width: 30%;">{{ __('Info') }}</th>
            <th class="py-4 px-5 whitespace-nowrap">{{ __('Status') }}</th>
            <th class="py-4 px-5 whitespace-nowrap flex justify-end">{{ __('Action') }}</th>
        </template>
        <template #body>
            <template v-if="transactions.data.length > 0">
                <template v-for="transaction in transactions.data" :key="transaction.id">
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                            <div>
                                {{ __('Transaction') }}: {{ transaction.id }}
                            </div>
                            <p class="mb-0 font-medium">
                                {{ transaction.type ? transaction.type.name : '' }}
                            </p>
                        </td>
                        <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                            <div class="text-base flex gap-2 font-semibold">
                                <span class="text-sm">
                                    {{ convertAmount(conversionRate(transaction.currency, $page.props.default_currency, transaction.amount))
                                                     }}
                                </span>
                            </div>
                            <div class="text-sm font-medium">
                                {{ __('Due Date') }}:
                                {{ transaction.due_date_format }}
                            </div>
                        </td>
                        <td class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                            <div class="font-medium">
                                {{ convertAmount(conversionRate(transaction.currency, $page.props.default_currency, transaction.paid_amount)) }}
                            </div>
                            <div class="font-semibold">
                                {{ transaction.method }}
                            </div>
                        </td>
                        <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                            <div class="text-sm font-medium">
                                <p class="flex items-center gap-3 mb-1 whitespace-nowrap">
                                    <a :href="transaction.document" download="" target="_blank"
                                        class="text-sm inline-flex gap-2 items-center text-blue-500 hover:text-blue-400 cursor-pointer"
                                        v-if="transaction.document">
                                        <LinkIcon class="w-6 h-6" /> {{ __('Attached File') }}
                                    </a>
                                </p>
                                <p class="mb-0 whitespace-nowrap">
                                    {{ __('Date of Issue') }}:
                                    {{ transaction.date_time }}
                                </p>
                            </div>
                        </td>
                        <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                            <div class="text-base font-semibold mb-2">
                                <span class=" capitalize text-xs font-semibold mr-2 px-2.5 py-0.5 rounded" :class="
                                    transaction.status == 'paid'
                                        ? 'bg-green-400 text-white dark:opacity-60'
                                        : 'bg-blue-100 text-blue-800 dark:opacity-60'
                                ">
                                    {{ transaction.status }}
                                </span>
                                <div class="text-base font-semibold"></div>
                            </div>
                        </td>

                        <td class="py-5 px-5">
                            <div class="flex justify-end items-center gap-4">
                                <a :href="route('transaction.details', transaction.transaction_no)" target="_blank"
                                    class="group relative text-blue-400 whitespace-nowrap hover:text-blue-300">
                                    {{__('View Details')}}
                                </a>
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
</template>

<script>
import ToolTip from "@/Shared/ToolTip.vue";
import {
    EyeIcon,
    LinkIcon
} from "@heroicons/vue/24/outline";
export default {
    components: {
        EyeIcon,
        LinkIcon
    },
    props: {
        transactions: Object,
    },
    data() {
        return {
        };
    },
    methods: {
    }
};
</script>
<style scoped>
</style>
