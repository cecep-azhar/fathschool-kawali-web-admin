<template>
    <AppLayout :title="__('Teacher List')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Teacher List')" />
        </Breadcrumb>

        <div>
            <page-header>
                {{ __('All Teachers') }}
                <badge>
                    {{ users.total }}
                </badge>
                <template #content>
                    <global-button :url="route('teachers.create')" type="link" theme="primary">
                        {{ __('Add Teachers') }}
                    </global-button>
                </template>
            </page-header>
            <div class="mb-4">
                <form class="items-center grid grid-cols-1 md:grid-cols-7 md:gap-6 gap-1.5" @submit.prevent="filterData()">
                    <div class="md:col-span-3">
                        <div class="relative w-full">
                            <global-input type="search" v-model="filter.keyword"
                                class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Keyword')" />
                            <button type="submit"
                                class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <MagnifyingGlassIcon class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <a-select size="large" class="width-100" v-model:value="filter.department" show-search
                            :placeholder="__('Select a department')" :options="options2" :filter-option="filterOption"
                            @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                        </a-select>
                    </div>
                    <div class="md:col-span-1">
                        <global-button :loading="loading" type="submit" theme="primary" class="w-full">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <global-table>
                <template #head>
                    <th class="py-4 px-5">{{ __('Name') }}</th>
                    <th class="py-4 px-5">{{ __('Department') }}</th>
                    <th class="py-4 px-5">{{ __('Joined at') }}</th>
                    <th class="py-4 px-5">{{ __('Account Hold') }}</th>
                    <th width="10%" class="py-4 px-5">{{ __('Action') }}</th>
                </template>
                <template #body>
                    <template v-if="users.data.length > 0">
                        <template v-for="user in users.data" :key="user.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td scope="row"
                                    class="flex items-center py-4 px-5 text-gray-900 whitespace-nowrap dark:text-white">
                                    <td-user-show :image="user.profile_photo_url" :name="user.name" :email="user.email" />
                                </td>
                                <td class="py-4 px-5">
                                    {{
                                        user.department
                                        ? user.department.name
                                        : "-"
                                    }}
                                </td>
                                <td class="py-4 px-5">
                                    {{ formatTime(user.created_at,'MMMM D, YYYY') }}
                                </td>
                                <td class="py-4 px-5">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input @change="accountHold($event, user.id)" :checked="user.account_hold"
                                            type="checkbox" class="sr-only peer">
                                        <div
                                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex gap-2">
                                        <button @click="sendMail(user.id)" type="button" class="group relative">
                                            <EnvelopeIcon class="text-purple-400 hover:text-purple-300" />
                                            <tool-tip :text="__('Send Mail')" />
                                        </button>
                                        <Link preserve-scroll :href="route(
                                                    'teacher.classes',
                                                    user.id
                                                )
                                                " class="group relative cursor-pointer">
                                        <Square2StackIcon class="w-6 h-6 text-purple-400 hover:text-purple-300" />
                                        <tool-tip :text="__('Subjects')" />
                                        <div
                                            class="inline-flex dark:text-gray-400 absolute z-10 -top-4 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900">
                                            {{ user.subjects_count }}
                                        </div>
                                        </Link>
                                        <Link preserve-scroll :href="route('teacher.show', user.id)
                                            " class="group relative">
                                        <eye-icon class="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                        <tool-tip :text="__('View')" />
                                        </Link>
                                        <Link preserve-scroll :href="route(
                                                'teachers.edit',
                                                user.id
                                            )
                                            " class="group relative" :id="'edit'+user.id">
                                        <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                        <tool-tip :text="__('Edit')" />
                                        </Link>
                                        <button type="button" @click="destroy(user.id)" class="group relative" :id="'delete'+user.id">
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
                            <td colspan="4" class="text-center p-4">
                                <NothingFound asShow="div" />
                            </td>
                        </tr>
                    </template>
                </template>
            </global-table>
            <div class="flex justify-center">
                <pagination class="mt-6" :links="users.links" />
            </div>
        </div>
        <a-modal v-model:visible="visible" :title="show_user.name" @ok="hide">
            <template #footer>
                <a-button key="back" @click="hide">
                    {{ __('Close') }}
                </a-button>
            </template>
            <show-modal :user="show_user" />
        </a-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import { MagnifyingGlassIcon, TrashIcon, PencilSquareIcon, EnvelopeIcon, EyeIcon, Square2StackIcon } from '@heroicons/vue/24/outline'
import TdUserShow from "@/Shared/TdUserShow.vue";
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    components: {
        AppLayout,
        ToolTip,
        TdUserShow,
        TrashIcon,
        PencilSquareIcon,
        Pagination,
        EyeIcon,
        Square2StackIcon,
        MagnifyingGlassIcon,
        EnvelopeIcon,
        NothingFound
    },
    props: {
        users: Object,
        filter_data: Object,
        departments: Object,
    },
    data() {
        return {
            loading: false,
            options: [],
            options2: [],
            visible: false,
            show_user: "",
            filter: {
                keyword: this.filter_data.keyword ?? null,
                course: this.filter_data.course ?? null,
                department: this.filter_data.department ?? null,
            },
        };
    },
    created() {
        // for department
        this.options2.push({
            value: "",
            label: "All",
        });
        for (const [key, value] of Object.entries(this.departments)) {
            this.options2.push({
                value: value.slug,
                label: value.name,
            });
        }
    },
    methods: {
        accountHold(event, user) {
            let value = event.target.checked;
            this.$inertia.post(this.route('user.account.hold', user), {
                status: value
            }, {
                preserveScroll: true
            })
        },
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("users.destroy", id));
            } else {
                return false;
            }
        },
        show(user) {
            this.show_user = user;
            this.visible = true;
        },
        hide(e) {
            this.visible = false;
        },
        filterData() {
            this.loading = true;
            this.$inertia.get(this.route("teachers.index"), this.filter, {
                preserveScroll: true,
                onSuccess: () => { },
                onFinish: (visit) => {
                    this.loading = false;
                },
            });
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },
        sendMail(user) {
            this.$inertia.post(this.route("teacher.send.mail"), {
                user: user,
            });
        },
    },
};
</script>

<style lang="scss" scoped>
</style>
