<template>
    <AppLayout :title="__('Teacher / Adminstartion Leave Type')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('manage-leave.index')" title="Student Leave" />
            <BreadcrumbLink :title="__('Student Leave Type')" />
        </Breadcrumb>

        <div class="pb-5">
            <page-header>
                {{ __('Student Leave Type') }}
                <badge>
                    {{ leave_types.total }}
                </badge>
                <template #content>
                    <global-button :loading="false" type="link" :url="route('leave-student.index')" theme="primary">
                        {{ __('Leave Request') }}
                    </global-button>
                </template>
            </page-header>
            <div class="grid md:grid-cols-3 gap-2">
                <div class="col-span-2 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700">
                    <global-table>
                        <template #head>
                            <th class="py-5 px-5">{{ __('Name') }}</th>
                            <th class="py-5">{{ __('Role Type') }}</th>
                            <th width="10%" class="py-5">{{ __('Action') }}</th>
                        </template>
                        <template #body>
                            <template v-if="leave_types.data.length > 0">
                                <template v-for="leave_type in leave_types.data" :key="leave_type.id">
                                    <tr
                                        class="rounded-lg border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-4 px-6 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                            <div class="text-base font-semibold">
                                                {{ leave_type.name }}
                                            </div>
                                        </td>
                                        <td class="py-4 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                            <span
                                                :class="leave_type.type == 'expense' ? 'bg-red-100 text-red-800 dark:bg-red-500 dark:opacity-60 dark:text-red-100' : 'bg-blue-100 text-blue-800 dark:bg-gray-700 dark:text-gray-400'"
                                                class="capitalize text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                {{ leave_type.role_type }}
                                            </span>
                                        </td>
                                        <td class="py-4 flex gap-2">
                                            <button type="button" @click="edit(leave_type)" class="group relative" :id="'testEdit' + leave_type.id">
                                                <PencilSquareIcon class="text-blue-400 hover:text-blue-300 w-6 h-6" />
                                                <tool-tip :text="__('Edit')" />
                                            </button>
                                            <button type="button" @click="destroy(leave_type.id)" class="group relative" :id="'testDelete' + leave_type.id">
                                                <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
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
                        <pagination class="mt-6" :links="leave_types.links" />
                    </div>
                </div>
                <div class="bg-white rounded-lg dark:bg-gray-800 col-span-2 md:col-span-1 p-4">
                    <div class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <div class="p-3 text-gray-700 font-bold dark:text-gray-400">
                            <span v-if="updateStatus">
                                <div class="flex justify-between">
                                    <div>{{ __('Update') }}</div>
                                    <global-button :loading="false" type="link" :url="route('leave-type.index')"
                                        theme="primary">
                                        {{ __('Back') }}
                                    </global-button>
                                </div>
                            </span>
                            <span v-else> {{ __('Create New') }} </span>
                        </div>
                        <create-update-form @update="updateFunction" :data="item" :update_data="updateStatus" />
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
import CreateUpdateForm from "./Form.vue";
import { PencilSquareIcon, TrashIcon, ArrowLeftIcon } from "@heroicons/vue/24/outline";
import NothingFound from "@/Shared/NothingFound.vue";

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
        leave_types: Object,
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
                this.$inertia.delete(this.route("leave-type.destroy", id));
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
