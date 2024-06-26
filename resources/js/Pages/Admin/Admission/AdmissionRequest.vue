<template>
    <AppLayout :title="__('Student Admission Request')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('student.admission.index')" title="Student Admission" />
            <BreadcrumbLink :title="__('Student Admission Request')" />
        </Breadcrumb>

        <div >
            <page-header>
                {{ __('Student Admission Request') }}
                <template #content>
                    <global-button :loading="false" preserve-scroll type="link"
                        :url="route('student.admission.index')" theme="primary">
                        {{ __('All Student') }}
                    </global-button>
                </template>
            </page-header>
            <div class="mb-4">
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
                        <a-select class="width-100" size="large" v-model:value="filter.course" show-search
                            :placeholder="__('Select a course')" :options="options" :filter-option="filterOption"
                            @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                        </a-select>
                    </div>
                    <div class="col-span-2">
                        <a-select class="width-100" size="large" v-model:value="filter.department"
                            show-search :placeholder="__('Select a department')" :options="options2"
                            :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur"
                            @change="handleChange">
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
                    <th class="py-5 px-5">{{ __('Student') }}</th>
                    <th class="py-5">{{ __('Parent Email') }}</th>
                    <th class="py-5">{{ __('Course') }}</th>
                    <th class="py-5">{{ __('Department') }}</th>
                    <th class="py-5 w-50">{{ __('Address') }}</th>
                    <th width="10%" class="py-5">{{ __('Action') }}</th>
                </template>
                <template #body>
                    <template v-if="admission_requests.data.length > 0">
                        <template v-for="admission_request in admission_requests.data" :key="admission_request.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center py-5 px-5 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold dark:text-gray-400">
                                            {{ admission_request.name }}
                                        </div>
                                        <div class="font-normal text-gray-500 dark:text-gray-400">
                                            {{ admission_request.email }}
                                        </div>
                                    </div>
                                </th>
                                <td class="py-5">
                                    {{ admission_request.parent_email }}
                                </td>
                                <td class="py-5">
                                    {{ admission_request.class?.name ?? "" }}
                                </td>
                                <td class="py-5">
                                    {{
                                    admission_request.department?.name ?? ""
                                    }}
                                </td>
                                <td class="py-5 w-96 pr-3">
                                    {{ admission_request.address ?? "" }}
                                </td>
                                <td class="py-5 flex gap-2">
                                    <Link preserve-scroll :href="
                                            route(
                                                'student.admission.request.accept',
                                                admission_request.id
                                            )
                                        " class="group relative">
                                    <CheckIcon classes="w-6 h-6 text-blue-400 hover:text-blue-300" />
                                    <tool-tip :text="__('Accept Request')" />
                                    </Link>
                                    <button type="button" @click.prevent="show(admission_request)"
                                        class="group relative">
                                        <EyeIcon classes="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                        <tool-tip :text="__('Details Request')" />
                                    </button>
                                    <button type="button" @click.prevent="
                                            destroy(admission_request.id)
                                        " class="group relative">
                                        <XMarkIcon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                        <tool-tip :text="__('Reject Request')" />
                                    </button>
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
                <pagination class="mt-6 mb-6" :links="admission_requests.links" />
            </div>
        </div>

        <a-modal v-model:visible="visible" title="Admission Details" @ok="hide">
            <template #footer>
                <a-button key="back" @click="hide">
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
    import NothingFound from "@/Shared/NothingFound.vue";
    import {
        MagnifyingGlassIcon,
        PencilSquareIcon,
        EyeIcon,
        CheckIcon,
        XMarkIcon,
    } from '@heroicons/vue/24/outline'
    import ShowModal from "./Show.vue";

    export default {
        components: {
            AppLayout,
            ToolTip,
            PencilSquareIcon,
            Pagination,
            EyeIcon,
            MagnifyingGlassIcon,
            CheckIcon,
            XMarkIcon,
            ShowModal,
            NothingFound
        },
        props: {
            admission_requests: Array,
            filter_data: Object,
            classes: Object,
            departments: Object,
        },
        data() {
            return {
                loading: false,
                visible: false,
                show_admission: "",
                options: [],
                options2: [],
                filter: {
                    keyword: this.filter_data.keyword ?? null,
                    course: this.filter_data.course ?? null,
                    department: this.filter_data.department ?? null,
                },
            };
        },
        methods: {
            filterData() {
                this.loading = true;
                this.$inertia.get(
                    this.route("student.admission.request"),
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
    };
</script>
