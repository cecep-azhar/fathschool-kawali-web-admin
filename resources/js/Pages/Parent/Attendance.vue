<template>
    <AppLayout :title="__('Attendance List')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('All Attendance')" />
        </Breadcrumb>

        <div class="pb-12 ">
            <page-header>
                {{ __("All Attendance") }}
            </page-header>

            <div class="mb-4">
                <form class="items-center grid grid-cols-1 md:grid-cols-4 gap-6"
                    @submit.prevent="filterData()">
                    <div class="flex items-center">
                        <Multiselect id="recipient" v-model="filter.subject" :close-on-select="true" :can-clear="true"
                            :searchable="true" :create-option="false" :placeholder="__('Select Subject')" :options="subjects.map(item => ({
                                value: item.id, label: item.name
                            }))" autocomplete="off" />
                    </div>
                    <div class="md:col-span-2">
                        <tab-filter @setTabData="setTabValue" :filterData="filter_data ? filter_data.month : ''"
                            filter_column="month" :tab_data="[
                                        { title: 'All', id: 'all', value: 'all' },
                                        { title: 'This Month', id: 'this_month', value: 'this_month' },
                                        { title: 'Last Month', id: 'last_month', value: 'last_month' },
                                        { title: 'Last Six Month', id: 'last_six_month', value: 'last_six_month' },
                            ]" />
                    </div>
                    <div class="flex justify-start">
                        <global-button :loading="filter.processing" type="submit"
                            class="inline-flex">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>

            <div class="col-span-2 bg-white dark:bg-gray-800 dark:text-gray-600 rounded-lg">
                <global-table>
                    <template #head>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('#') }}</th>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Subject') }}</th>
                        <th class="py-4 px-5 whitespace-nowrap min-w-[300px]">{{ __('Present Score') }}</th>
                    </template>
                    <template #body>
                        <template v-if="attendance_arr.length > 0">
                            <template v-for="(attendance, index) in attendance_arr" :key="attendance.id">
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <td class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div>
                                            {{ index + 1 }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div class="text-base font-bold">
                                            {{ attendance.subject_name }}
                                        </div>
                                        <div class="text-gray-500 text-sm">
                                            {{ attendance.teacher ? attendance.teacher.name : '' }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-sm text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        <div>
                                            <label class="font-bold" for="">
                                                {{ attendance.present_score }} %
                                            </label>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                            <div class="bg-blue-600 h-2.5 rounded-full"
                                                :style="'width: ' + attendance.present_score + '%'"></div>
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
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import {
        MagnifyingGlassIcon,
    } from "@heroicons/vue/24/outline";
    import { useForm } from "@inertiajs/inertia-vue3";
    import Multiselect from '@vueform/multiselect'
    import '@vueform/multiselect/themes/default.css';

    export default {
        props: {
            attendance_arr: Array,
            subjects: Array,
            filter_data: Object
        },
        components: {
            AppLayout,
            Multiselect
        },
        data() {
            return {
                tab2: this.filter_data.month ?? 'all',
                filter: useForm({
                    subject: this.filter_data.subject ?? '',
                    month: this.filter_data.month ?? 'all'
                })
            }
        },
        methods: {
            setTabValue(arg) {

                let column = arg['filter_column_data'] ?? '';
                let value = arg['value'] ?? '';

                this.filter[column] = value;
            },
            filterData() {
                this.filter.get(this.route('my.attendance'), {
                    preserveScroll: true
                })
            }
        }
    };
</script>
<style scoped>
</style>
