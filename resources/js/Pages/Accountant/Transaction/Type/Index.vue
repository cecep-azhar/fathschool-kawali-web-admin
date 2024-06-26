<template>
    <AppLayout :title="__('Category')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Transaction Categories')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Transaction Categories') }}
                <badge>
                    {{ types.total }}
                </badge>
            </page-header>
            <div class="grid lg:grid-cols-3 gap-2 overflow-hidden">
                <div class="lg:col-span-2 overflow-auto lg:order-1 order-2">
                    <div class="rounded-lg overflow-auto bg-white dark:bg-gray-800 dark:border-gray-700">
                        <global-table>
                            <template #head>
                                <th class="py-4 px-5">{{ __('Name') }}</th>
                                <th class="py-4 px-5">{{ __('Type') }}</th>
                                <th width="10%" class="py-4 px-5">{{ __('Action') }}</th>
                            </template>
                            <template #body>
                                <template v-if="types.data.length > 0">
                                    <template v-for="transaction_type in types.data" :key="transaction_type.id">
                                        <tr
                                            class="rounded-lg border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                <div class="text-base font-semibold">
                                                    {{ transaction_type.name }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                <span
                                                    :class="transaction_type.type == 'expense' ? 'bg-red-100 text-red-800 dark:bg-red-500 dark:opacity-60 dark:text-red-100' : 'bg-blue-100 text-blue-800 dark:bg-gray-700 dark:text-gray-400'"
                                                    class="capitalize text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                    {{ transaction_type.type }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-4 flex gap-2">
                                                <button type="button" @click="edit(transaction_type)"
                                                    class="group relative" :id="'transactionTypeEdit' + transaction_type.id">
                                                    <PencilSquareIcon class="text-blue-400 hover:text-blue-300 w-6 h-6" />
                                                    <tool-tip text="Edit" />
                                                </button>
                                                <button type="button" @click="destroy(transaction_type.id)"
                                                    class="group relative" :id="'transactionTypeDelete' + transaction_type.id">
                                                    <TrashIcon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                                    <tool-tip :text="__('Delete')" />
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                                <template v-else>
                                    <NothingFound asShow="div" />
                                </template>
                            </template>
                        </global-table>
                        <div class="flex justify-center">
                            <pagination class="mt-6" :links="types.links" />
                        </div>
                    </div>
                </div>
                <div class="lg:order-2 order-1">
                    <div class="bg-white rounded-lg dark:bg-gray-800 col-span-2 md:col-span-1">
                        <div class="w-full rtl:text-right text-gray-500 dark:text-gray-400">
                            <div class=" text-gray-700 dark:text-gray-400 border-b dark:border-gray-500">
                                <div class="p-4" v-if="updateStatus">
                                    <div class="flex justify-between">
                                        <div>{{ __('Update Category') }}</div>
                                        <Link preserve-scroll :href="route('transaction-type.index')"
                                            class="hover:text-gray-500">
                                        <ArrowLeftIcon class="text-gray-700 dark:text-gray-400 w-6 h-6" />
                                        </Link>
                                    </div>
                                </div>
                                <div class="p-4" v-else>
                                    {{ __('Add New Category') }}
                                </div>
                            </div>
                            <create-update-form @update="updateFunction" :data="item" :update_value="updateStatus" class="p-3" />
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import NothingFound from "@/Shared/NothingFound.vue";
import CreateUpdateForm from "./Form.vue";
import { ArrowLeftIcon, PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";
export default {
    components: {
        AppLayout,
        ToolTip,
        TrashIcon,
        PencilSquareIcon,
        Pagination,
        CreateUpdateForm,
        ArrowLeftIcon,
        NothingFound
    },
    props: {
        types: Object,
    },
    data() {
        return {
            updateStatus: false,
            item: "",
        };
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("transaction-type.destroy", id));
            } else {
                return false;
            }
        },
        edit(data) {
            this.item = data;
            this.updateStatus = true;
        },
        updateFunction() {
            this.updateStatus = false;
        },
    },
};
</script>
