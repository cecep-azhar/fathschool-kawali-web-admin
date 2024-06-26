<template>
    <div class="col-span-2 bg-white dark:bg-gray-800 dark:text-gray-600 rounded-lg">
        <global-table>
            <template #head>
                <th class="py-5 px-5">{{ __('Name') }}</th>
                <th class="py-5 px-5">{{ __('Code') }}</th>
                <th class="py-5 px-5">{{ __('Symbol') }}</th>
                <th class="py-5 px-5">{{ __('Rate') }}</th>
                <th class="py-5 px-5">{{ __('Show/Hide') }}</th>
                <th width="10%" class="py-5">{{ __('Action') }}</th>
            </template>
            <template #body>
                <template v-if="currencies.data.length > 0">
                    <template v-for="currency in currencies.data" :key="currency.id">
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-5 px-5">{{ currency.name }}
                                <component class="w-5 h-5 text-green-700 border-green-500 float-left"
                                    :is="this.$page.props.setting.app_currency === currency.code ? 'CheckBadgeIcon' : 'span'">
                                </component>
                            </td>
                            <td class="py-5 px-5">{{ currency.code }}</td>
                            <td class="py-5 px-5">{{ currency.symbol }}</td>
                            <td class="py-5 px-5">
                                {{ currency.rate }}
                            </td>
                            <td class="py-5 px-5">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input @change="updateStatus($event, currency.id)" :checked="currency.status"
                                        type="checkbox" class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </td>
                            <td class="py-5 flex rtl:justify-end gap-2">
                                <button type="button" @click="edit(currency)" class="group relative"
                                    :id="'edit' + currency.id">
                                    <pencil-square-icon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                    <tool-tip text="Edit" />
                                </button>
                                <button type="button" @click="destroy(currency.id)" class="group relative"
                                    :id="'delete' + currency.id">
                                    <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                    <tool-tip :text="__('Delete')" />
                                </button>
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
</template>

<script>
import ToolTip from "@/Shared/ToolTip.vue";
import { PencilSquareIcon, TrashIcon, CheckBadgeIcon } from '@heroicons/vue/24/outline';
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    props: {
        currencies: Array,
    },
    components: {
        ToolTip,
        TrashIcon,
        PencilSquareIcon,
        NothingFound,
        CheckBadgeIcon,
    },
    data() {
        return {
            status: ''
        }
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("settings.currency.destroy", id));
            } else {
                return false;
            }
        },
        edit(currency) {
            this.$emit("edit", currency);
        },
        updateStatus(event, currency) {

            let value = event.target.checked;
            this.$inertia.post(this.route('settings.currency.status.update', currency), {
                status: value
            }, {
                preserveScroll: true
            })
        }
    },
};
</script>
