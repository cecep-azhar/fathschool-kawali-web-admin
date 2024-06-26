<template>
    <AppLayout :title="__('Fees Report')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('reports.index')" title="Report" />
            <BreadcrumbLink :title="__('Export Fees')" />
        </Breadcrumb>

        <div class="py-12">
            <div
                class="mb-3 rounded-lg py-4 font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                <page-header class="flex justify-between items-center">
                    <div>
                        <h1 class="dark:text-gray-400 mb-0 text-2xl">
                            {{ __('Student Fees') }}
                        </h1>
                    </div>
                </page-header>
                <form class="grid grid-cols-1 md:grid-cols-9 gap-2 items-center px-6" @submit.prevent="exportSubmit()">
                    <div class="col-span-2">
                        <global-label for="class" value="Course" />
                        <Multiselect id="class" class="dark:text-gray-900" v-model="filter.course_id"
                            :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                            :placeholder="__('Select Course')"
                            :options="courses.map(item => ({ value: item.id, label: item.name }))" autocomplete="off" />
                    </div>
                    <div class="col-span-2">
                        <global-label for="student" value="Student" />
                        <Multiselect id="student" class="dark:text-gray-900" v-model="filter.student_id"
                            :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                            :placeholder="__('Select Student')"
                            :options="students.map(item => ({ value: item.id, label: item.name }))" autocomplete="off" />
                    </div>
                    <div class="col-span-2">
                        <global-label for="month" value="Month" />
                        <div class="flex gap-3">
                            <a-date-picker size="large" :placeholder="__('Select Month')" picker="month"
                                v-model:value="month_value" format="MMM YYYY" style="width: 400px" />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <global-button :loading="loading"
                            class="text-white mt-6 bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-300">
                            {{ __('Export Fees') }}
                        </global-button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-52">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                    <NothingFound asShow="div" />
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{ __('Please choose the course student and month') }}
                </p>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import { PencilSquareIcon, TrashIcon, EyeIcon, ArrowRightIcon } from "@heroicons/vue/24/outline";
import Pagination from "@/Shared/Admin/Pagination.vue";
import dayjs, { Dayjs } from 'dayjs';
import PieChart from '@/Components/Chart/PieChart.vue';
import ExportModal from '@/Shared/Modal.vue';
import Multiselect from '@vueform/multiselect'
import { useForm } from "@inertiajs/inertia-vue3";
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
        dayjs,
        PieChart,
        ExportModal,
        Multiselect,
        NothingFound
    },
    props: {
        courses: Array,
        students: Array,
        filter_data: Object,
    },
    data() {
        return {
            filter: useForm({
                course_id: this.filter_data.course_id ?? '',
                student_id: this.filter_data.student_id ?? '',
                month: this.filter_data.month ?? '',
                year: this.filter_data.year ?? '',
            }),

            customDateFormat: 'YYYY-MM-DD',
            customMonthFormat: 'YYYY-MM',

            month_value: this.filter_data.month ? dayjs(dayjs(this.filter_data.month).format('MMM') + this.filter_data.year, this.customMonthFormat) : null,
            students: this.students,

            selected_month: this.filter_data.month,
            selected_year: this.filter_data.year,

            visible: false,
            loading: false,
            export_data: {
                student: '',
                month: '',
                year: '',
                course : '',
            }
        };
    },
    watch: {
        "month_value": function (value) {
            if (value) {
                this.filter.month = dayjs(value).format('MM');
                this.filter.year = dayjs(value).format('YYYY');
            } else {
                this.filter.month = null;
                this.filter.year = null;
            }
        },
        'filter.course_id': function (newVal, oldVal) {
            if (newVal) {
                this.filterData();
            }
        }
    },
    methods: {

        filterData() {
            this.filter.get(this.route('report.student.fees'));
        },
        exportSubmit() {
            this.loading = true;
            this.export_data.course = this.filter.course_id;
            this.export_data.student = this.filter.student_id;
            this.export_data.month = this.filter.month;
            this.export_data.year = this.filter.year;

            axios({
                url: this.route('report.studentFee.export'),
                method: "POST",
                data: this.export_data,
                responseType: "blob",
            }).then((response) => {

                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement("a");

                fileLink.href = fileURL;
                const contentDisposition = response.headers['content-disposition'];
                const startIndex = contentDisposition.indexOf('"') + 1;
                const endIndex = contentDisposition.lastIndexOf('"');
                const fileName = contentDisposition.substring(startIndex, endIndex);
                fileLink.setAttribute("download", fileName);

                document.body.appendChild(fileLink);

                fileLink.click();

                this.loading = false;
                this.visible = false;
            }).catch((e) => {
                this.loading = false;
                this.visible = false;
            });
        },
        getMonthName(month) {
            return dayjs(`${this.selected_year}-${month}`).format("MMMM");
        },
    },
    computed: {
        daysInMonth() {
            if (this.selected_year == "" || this.selected_month == "") {
                return false;
            }

            return dayjs(
                `${this.selected_year}-${this.selected_month}`
            ).daysInMonth();
        }
    },
    mounted() {

    }
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
