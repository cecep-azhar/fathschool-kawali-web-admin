<template>
    <Head :title="__('Attendance List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Attendance List')" />
        </Breadcrumb>

        <div class="my-6">
            <page-header>
                {{ __('Attendance List') }}
            </page-header>
            <form @submit.prevent="filterData" class="items-center grid grid-cols-1 md:grid-cols-7 gap-4 mt-4">
                <div class="col-span-2">
                    <Multiselect id="subject" :close-on-select="true" :can-clear="false" :searchable="true"
                        v-model="filter.subject" :create-option="false" :placeholder="__('Select Subject')" :options="subjects.map(item => ({
                            value: item.id, label: item.name
                        }))" autocomplete="off" />
                </div>
                <div class="col-span-2">
                    <a-date-picker name="date"
                        class="ant-datepicker-custom dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        :format="getDateTimeFormat()" v-model:value="date_value" />
                </div>
                <div class="col-span-1 text-right">
                    <global-button :loading="loading" type="submit" theme="primary">
                        {{ __('Search') }}
                    </global-button>
                </div>
            </form>
            <div class="w-full mt-4" v-if="filter_data != ''">
                <global-table>
                    <template #head>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Student Name') }}</th>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Student ID') }}</th>
                        <th style="width:35%" class="py-4 px-5 whitespace-nowrap">{{ __('Status') }}</th>
                        <th class="py-4 px-5 whitespace-nowrap">{{ __('Today action') }}</th>
                    </template>
                    <template #body>
                        <template v-if="students.data.length > 0">
                            <tr class="rounded-lg border-b dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600"
                                v-for="student in students.data" :key="student.id">
                                <td class="py-4 px-5 text-black dark:text-gray-400 whitespace-nowrap">
                                    <span
                                        class="inline-flex gap-2 items-center text-sm text-gray-900 dark:text-gray-400 font-medium">
                                        <img class="w-10 h-10 rounded-full" :src="student.profile_photo_url"
                                            :alt="student.name" />
                                        <div class="flex flex-col">
                                            <span class="font-medium">
                                                {{ student.name }}
                                            </span>
                                            <span>
                                                {{ student.email }}
                                            </span>
                                        </div>
                                    </span>
                                </td>
                                <td class="py-4 px-5 text-black dark:text-gray-400 whitespace-nowrap">
                                    {{ student?.profile?.student_id ?? '' }}
                                </td>
                                <td class="py-4 px-5 text-black dark:text-gray-400 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <template v-for="attendance in student.attendances" :key="attendance.id">
                                            <div v-if="filter.subject == attendance.subject_id">
                                                <template v-if="attendance.status == 'present'">
                                                    <div class="flex items-center gap-1 text-center">
                                                        <CheckIcon class="text-green-500 w-4 h-4" />
                                                        <span class="text-green-500 capitalize">
                                                            {{ attendance.status }}
                                                        </span>
                                                    </div>
                                                </template>
                                                <template v-if="attendance.status == 'absent'">
                                                    <div class="flex gap-1 items-center text-center">
                                                        <XMarkIcon class="text-red-500 w-4 h-4" />
                                                        <span class="text-red-500 capitalize">
                                                            {{ attendance.status }}
                                                        </span>
                                                    </div>
                                                </template>
                                                <template v-if="attendance.status == 'late'">
                                                    <div class="flex gap-1 items-center text-center">
                                                        <div class="flex gap-1 items-center">
                                                            <div>
                                                                <ClockIcon class="text-purple-500 w-6 h-6" />
                                                            </div>
                                                            <span class="text-purple-500 capitalize">
                                                                {{ attendance.late_amount }} {{ attendance.late_amount > 1
                                                                    ? __('Minutes Late') : __('Minute Late') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                </td>
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <div class="flex gap-1 text-center whitespace-nowrap w-full">
                                        <div class="flex w-28 items-center cursor-pointer pl-4 rounded border border-gray-300 dark:border-gray-700"
                                            @click="submit(student.id, 'present')">
                                            <input :id="'present' + student.id" type="radio" value="" name="bordered-radio"
                                                class="text-blue-600 inline-block bg-gray-100 border-gray-300 focus:ring-blue-500 cursor-pointer dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                            <label :for="'present' + student.id"
                                                class="py-2 ml-2 whitespace-nowrap cursor-pointer mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-400">
                                                {{ __('Present') }}
                                            </label>
                                        </div>
                                        <div class="flex w-28 items-center cursor-pointer pl-4 rounded border border-gray-300 dark:border-gray-700"
                                            @click="submit(student.id, 'absent')">
                                            <input :id="'absent' + student.id" type="radio" value="" name="bordered-radio"
                                                class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 cursor-pointer dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                            <label :for="'absent' + student.id"
                                                class="py-2 ml-2 mr-2 cursor-pointer w-full text-sm font-medium text-gray-900 dark:text-gray-400">
                                                {{ __('Absent') }}
                                            </label>
                                        </div>
                                        <div class="flex w-28 items-center cursor-pointer pl-4 rounded border border-gray-300 dark:border-gray-700"
                                            @click="submit(student.id, 'late')">
                                            <input :id="'late' + student.id" type="radio" value="" name="bordered-radio"
                                                class="text-blue-600 cursor-pointer bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                            <label :for="'late' + student.id"
                                                class="py-2 ml-2 mr-2 cursor-pointer w-full text-sm font-medium text-gray-900 dark:text-gray-400">
                                                {{ __('Late') }}
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="4" class="text-center p-4">{{ __('No Students') }}</td>
                            </tr>
                        </template>
                    </template>
                </global-table>
                <div class="flex justify-center col-span-3">
                    <pagination class="mt-6" :links="students.links" />
                </div>
            </div>
            <div class="w-full mt-8 text-center text-lg pt-8" v-else>
                Please select the subject and date to take attendance.
            </div>
        </div>
        <a-modal v-model:visible="visible" :title="__('Late Time')" @ok="save()">
            <form action="">
                <div class="mb-1 ml-4 mr-4">
                    <label for="late_minutes"
                        class="block mb-2 items-center text-sm font-medium text-gray-900 dark:text-gray-400">
                        <span>{{ __('Late Minutes') }}</span>
                        <span class="text-red-500 ml-1 text-md">∗</span>
                    </label>
                    <input type="number" :class="errors.title ? 'border-red-500 dark:border-red-500' : ''" id="late_minutes"
                        v-model="form.late_minutes" name="late_minutes"
                        class="pl-4 bg-gray-50 rounded-lg border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :placeholder="__('Late Minutes')" />
                    <input-error :error="$page.props.errors.title" />
                </div>
            </form>
        </a-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import dayjs, { Dayjs } from 'dayjs';
import { MagnifyingGlassIcon, XMarkIcon, CheckIcon, ClockIcon } from '@heroicons/vue/24/outline'
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';

export default {
    props: {
        errors: Object,
        students: Object,
        subjects: Object,
        filter_data: Object,
    },

    components: {
        AppLayout,
        Pagination,
        CheckIcon,
        XMarkIcon,
        ClockIcon,
        Multiselect,
        MagnifyingGlassIcon
    },
    data() {
        return {
            visible: false,
            loading: false,
            date_value: this.filter_data.date ? dayjs(this.filter_data.date) : '',
            customDateFormat: 'YYYY-MM-DD',
            form: {
                student: "",
                status: "",
                late_amount: "",
                subject: '',
                date: this.filter_data.date ? this.filter_data.date : '',
            },
            filter: {
                // keyword: this.filter_data.keyword ?? "",
                subject: this.filter_data.subject ? this.filter_data.subject : this.subjects[0]?.id,
                date: this.filter_data.date ? this.filter_data.date : '',
            },
        };
    },

    watch: {
        'filter.subject': function (newVal, oldVal) {
            // Check if both date and subject have values
            if (dayjs(this.filter.date).isValid() && newVal !== oldVal) {
                this.filterData(); // Call filterData method
            }
        },
    },
    
    methods: {
        filterData() {
            this.loading = true;
            this.$inertia.get(this.route("student.attendance.index"), this.filter,
                {
                    preserveScroll: true,
                    onFinish: visit => { this.loading = false },
                });
        },

        submit(id, status) {
            this.form.student = id;
            this.form.status = status;
            if (status != "late") {
                this.save();
            }
            if (status == "late") {
                this.visible = true;
            }
        },
        save() {
            this.form.subject = this.filter.subject;
            this.form.date = this.filter_data.date;
            this.$inertia.post(this.route("student.attendance.store"), this.form, {
                preserveScroll: true,
                onSuccess: (page) => {
                    this.visible = false;
                },
            });
        },

        getDateTimeFormat() {
            if (isNaN(this.date_value)) {

            } else {
                const formattedDate = dayjs(this.date_value).format('YYYY-MM-DD')
                this.filter.date = formattedDate;
            }
        }
    },
};
</script>
<style scoped>
.ant-datepicker-custom {
    display: block;
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.ant-datepicker-custom-border {
    border-color: red;
    border-right-width: 1px !important;
}
</style>
