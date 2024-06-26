<template>
    <AppLayout :title="__('Result List')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('reports.index')" title="Report" />
            <BreadcrumbLink :title="__('Student')" />
        </Breadcrumb>

        <div class="py-12">
            <page-header class="flex justify-between items-center">
                <div>
                    <h2 class="dark:text-gray-400 mb-0">
                        {{ __('Student Report') }}
                    </h2>
                </div>
            </page-header>
            <div class="mb-3 ml-0.5">
                <form class="grid grid-cols-1 md:grid-cols-7 gap-6 items-center" @submit.prevent="filterData()">
                    <div class="col-span-2">
                        <global-input id="search" v-model="filter.keyword" type="search"
                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Search: student name/email')" :error="$page.props.errors.keyword" />
                    </div>
                    <div class="col-span-2">
                        <Multiselect id="user" :close-on-select="true" :can-clear="true" :searchable="true"
                            v-model="filter.course_id" :create-option="false" :placeholder="__('Select Course')"
                            :options="classes.map(item => ({
                                value: item.id, label: item.name
                            }))" autocomplete="off" />
                    </div>
                    <div class="col-span-1">
                        <global-button :loading="filter.processing" type="submit"
                            class="text-white bg-blue-500 dark:bg-blue-500 hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-300">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <global-table>
                <template #head>
                    <th class="py-5 px-5" width="40%">{{ __('Name') }}</th>
                    <th class="py-5" width="20%">{{ __('Course') }}</th>
                    <th class="py-5" width="30%">{{ __('Joined at') }}</th>
                </template>
                <template #body>
                    <template v-if="students.data.length > 0">
                        <template v-for="student in students.data" :key="student.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center py-5 px-5 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="w-10 h-10 rounded-full" :src="student.profile_photo_url"
                                        alt="Jese image" />
                                    <div class="pl-3">
                                        <div class="text-base font-semibold dark:text-gray-400">
                                            {{ student.name }}
                                        </div>
                                        <div class="font-normal text-gray-500 dark:text-gray-400">
                                            {{ student.email }}
                                        </div>
                                    </div>
                                </th>
                                <td class="py-5" v-if="
                                    student.profile && student.profile.class
                                ">
                                    {{ student.profile.class.name }}
                                </td>
                                <td class="py-5">
                                    {{ student.join_date }}
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template v-else>
                        <tr>
                            <td colspan="4" class="text-center pt-8">
                                <NothingFound asShow="div" />
                            </td>
                        </tr>
                    </template>
                </template>
            </global-table>
            <div class="flex justify-center">
                <pagination class="mt-6" :links="students.links" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import ToolTip from "@/Shared/ToolTip.vue";
    import { PencilSquareIcon, TrashIcon, EyeIcon, ArrowRightIcon } from "@heroicons/vue/24/outline";
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import { useForm } from "@inertiajs/inertia-vue3";
    import Multiselect from '@vueform/multiselect'
    import '@vueform/multiselect/themes/default.css';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        components: {
            AppLayout,
            ToolTip,
            TrashIcon,
            PencilSquareIcon,
            Pagination,
            EyeIcon,
            ArrowRightIcon,
            Multiselect,
            NothingFound
        },
        props: {
            students: Array,
            classes: Array,
            filter_data: Object,
        },
        data() {
            return {
                filter: useForm({
                    keyword: this.filter_data.keyword ?? "",
                    course_id: this.filter_data.course_id ?? "",
                }),
            };
        },
        methods: {
            filterData() {
                this.filter.get(this.route("report.student"));
            },
        },
    };
</script>
