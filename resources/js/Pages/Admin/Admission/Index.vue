<template>
    <AppLayout :title="__('Student Admission')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Student Admission')" />
        </Breadcrumb>

        <div>
            <page-header class="flex-col sm:flex-row">
                {{ __('Student Admission Request') }}
                <template #content>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <global-button v-if="can('bulk.admission')" preserve-scroll :loading="false" :url="route('student.bulk.admission')"
                            type="link" theme="secondary">
                            {{ __('Bulk Admission') }}
                        </global-button>
                        <global-button :loading="false" preserve-scroll type="link"
                            :url="route('student.admission.create')" theme="primary">
                            {{ __('New Admission') }}
                        </global-button>
                    </div>
                </template>
            </page-header>
            <div class="mb-4" v-if="admission_requests.length > 0">
                <form class="items-center grid grid-cols-1 md:grid-cols-7 gap-6" @submit.prevent="filterData()">
                    <div class="flex col-span-2">
                        <div class="relative w-full">
                            <global-input type="search" v-model="filter.keyword"
                                class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Keyword')" />
                            <button type="submit"
                                class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <MagnifyingGlassIcon class="w-5 h-5" />
                                <span class="sr-only">
                                    {{ __('Search') }}
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <a-select size="large" class="width-100" v-model:value="filter.course" show-search
                            :placeholder="__('Select a course')" :options="options" :filter-option="filterOption"
                            @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                        </a-select>
                    </div>
                    <div class="col-span-1">
                        <global-button :loading="loading" type="submit" theme="primary">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>

            <global-table>
                <template #head>
                    <th class="py-5 px-5 whitespace-nowrap">{{ __('Student') }}</th>
                    <th class="py-5 px-5 whitespace-nowrap">{{ __('Parent Email') }}</th>
                    <th class="py-5 px-5 whitespace-nowrap">{{ __('Course') }}</th>
                    <th width="10%" class="py-5 px-5 whitespace-nowrap">{{ __('Action') }}</th>
                </template>
                <template #body>
                    <template v-if="admission_requests.length > 0">
                        <template v-for="admission_student in admission_requests" :key="admission_student.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center py-5 px-5 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold dark:text-gray-400">
                                            {{ admission_student.name }}
                                        </div>
                                        <div class="font-normal text-gray-500 dark:text-gray-400">
                                            {{ admission_student.email }}
                                        </div>
                                    </div>
                                </th>
                                <td class="py-5">
                                    {{ admission_student.guardian_email }}
                                </td>
                                <td class="py-5">
                                    <template v-for="(course, index) in admission_student.course_names" :key="index">
                                        <div class="font-bold ml-0.5">
                                            {{ course }}
                                            <template v-if="admission_student.course_names.length != index + 1">,</template>
                                        </div>
                                    </template>
                                </td>
                                <td class="py-5 flex gap-2">
                                    <Link :href="route('student.admission.show', admission_student.id)"
                                        class="group relative">
                                    <EyeIcon class="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                    <tool-tip :text="__('Details Request')" />
                                    </Link>
                                    <Link :href="route('student.admission.request.accept', admission_student.id)"
                                        class="group relative">
                                    <CheckIcon class="w-6 h-6 text-blue-500 hover:text-blue-300" />
                                    <tool-tip :text="__('Accept Request')" />
                                    </Link>
                                    <button type="button" @click.prevent="destroyAdmission(admission_student.id)"
                                        class="group relative">
                                        <XMarkIcon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                        <tool-tip :text="__('Reject Request')" />
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template v-else>
                        <tr>
                            <td colspan="6" class="text-center p-4">
                                <NothingFound asShow="div" />
                            </td>
                        </tr>
                    </template>
                </template>
            </global-table>
        </div>

        <a-modal v-model:visible="visible" title="Admission Details" @ok="hide">
            <template #footer>
                <a-button key="back" @click="hide">
                    {{ __('Close') }}</a-button>
            </template>
            <show-modal :admission="show_admission" />
        </a-modal>
        <a-modal v-model:visible="visibleAdmission" title="Admission Details" @ok="hideAdmission">
            <template #footer>
                <a-button key="back" @click="hideAdmission">
                    {{ __('Close') }}</a-button>
            </template>
            <show-modal :admission="show_admission" />
        </a-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import { EyeIcon, MagnifyingGlassIcon, PencilSquareIcon, TrashIcon, CheckIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import ShowModal from "./Show.vue";
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    components: {
        AppLayout,
        ToolTip,
        PencilSquareIcon,
        Pagination,
        EyeIcon,
        CheckIcon,
        XMarkIcon,
        ShowModal,
        MagnifyingGlassIcon,
        NothingFound
    },
    props: {
        admission_requests: Array,
        users: Array,
        filter_data: Object,
        classes: Object,
    },
    data() {
        return {
            loading: false,
            show_admission: "",
            visibleAdmission: false,
            options: [],
            options2: [],
            filter: {
                keyword: this.filter_data.keyword ?? null,
                course: this.filter_data.course ?? null,
            },
        };
    },
    methods: {
        filterData() {
            this.loading = true;
            this.$inertia.get(
                this.route("student.admission.index"),
                this.filter,
                {
                    preserveScroll: true,
                    onFinish: (visit) => {
                        this.loading = false;
                    },
                }
            );
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },
        destroy(id) {
            if (confirm("Are you sure to reject the request?")) {
                this.$inertia.delete(
                    this.route("student.admission.request.reject", id)
                );
            } else {
                return false;
            }
        },
        show(admission) {
            this.show_admission = admission;
            this.visible = true;
        },
        hide(e) {
            this.visible = false;
        },
    },
    created() {
        // for classess
        this.options.push({
            value: "",
            label: "All",
        });
        for (const [key, value] of Object.entries(this.classes)) {
            this.options.push({
                value: value.slug,
                label: value.name,
            });
        }
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("users.destroy", id));
            } else {
                return false;
            }
        },
        destroyAdmission(id) {
            if (confirm("Are you sure to reject the request?")) {
                this.$inertia.delete(
                    this.route("student.admission.request.reject", id)
                );
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

        showAdmission(admission) {
            this.show_admission = admission;
            this.visibleAdmission = true;
        },
        hideAdmission(e) {
            this.visibleAdmission = false;
        },

        filterData() {
            this.loading = true;
            this.$inertia.get(
                this.route("student.admission.index"),
                this.filter,
                {
                    preserveScroll: true,
                    onFinish: (visit) => {
                        this.loading = false;
                    },
                }
            );
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },
        sendMail(user) {
            this.$inertia.post(this.route("student.send.mail"), {
                user: user,
            });
        },
    },
};
</script>
