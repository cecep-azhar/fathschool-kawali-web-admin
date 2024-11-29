<template>
    <AppLayout :title="__('Teacher Attendance')">
        <template #header>
            {{ __("Teacher Attendance") }}
        </template>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Teacher Attendance')" :href="route('teacher.class')" />
        </Breadcrumb>
        <div>
            <page-header class="flex-col sm:flex-row">
                {{ __("Teacher Attendance") }}

            </page-header>
            <div class="mb-4">
                <form @submit.prevent="filterData">
                    <div class="flex items-center">
                        <input type="text" v-model="filter.name" id="name" placeholder="Name"
                            class="p-2 border rounded" />

                        <label for="month" class="ml-4 mr-2">{{ __("Date") }}:</label>
                        <input type="date" v-model="filter.month" id="month" class="p-2 border rounded mr-4" />

                        <div>
                            <a-select class="width-100" size="large" v-model:value="filter.study_program" show-search
                                :placeholder="__('Select a study program')" :options="options"
                                :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur"
                                @change="handleChange" />
                        </div>

                        <button type="submit"
                            class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __("Filter") }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3 items-start mb-6">
                <div class="flex flex-col gap-4 rounded-lg bg-white overflow-x-auto dark:bg-gray-800 p-6">
                    <!-- Chart Kehadiran -->
                    <div class="flex flex-col items-center justify-center w-full h-64 mb-5">

                        <canvas id="attendanceChart" class="mb-4 h-full"></canvas>
                        <div class="text-center text-lg font-bold text-sky-500">
                            {{ attendance_percentage }}% Kehadiran
                        </div>
                    </div>

                    <!-- Chart Ketidakhadiran -->
                    <div class="flex flex-col items-center justify-center w-full h-64">
                        <canvas id="absenceChart" class="mb-4 h-full"></canvas>
                        <div class="text-center text-lg font-bold text-rose-400	">
                            {{ absence_percentage }}% Ketidakhadiran
                        </div>
                    </div>
                </div>

                <!-- Table Section (right) -->
                <div class="xl:col-span-2 bg-white dark:bg-gray-800 rounded-lg">
                    <div
                        class="flex justify-between px-6 items-center pt-6 text-gray-900 dark:text-gray-400 text-base font-bold mb-2">
                        <div>{{ __("Attendance List") }}</div>
                        <!-- Tombol Export di sebelah kanan -->
                        <div class="ml-auto">
                            <global-button :loading="false" @click="exportAttendance()" type="button" theme="sky">
                                {{ __("Export") }}
                            </global-button>
                        </div>
                    </div>

                    <div class="overflow-x-auto overflow-y-auto max-h-[400px]">
                        <!-- Table -->
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-500 uppercase ">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Name") }}
                                    </th>

                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Study Program") }}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Date") }}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Time In") }}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Time Out") }}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Lateness") }}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Latlon In") }}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Latlon Out") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="attendanceteacher.length > 0">
                                    <template v-for="attendance in attendanceteacher" :key="attendance.id">
                                        <tr
                                            class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                {{ attendance.user.name }}
                                            </td>

                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                <template v-if="
                                                    attendance.user.department &&
                                                    attendance.user.department
                                                        .study_program
                                                ">
                                                    <div class="font-bold">
                                                        {{
                                                            attendance.user.department
                                                                .study_program.name
                                                        }}
                                                    </div>
                                                </template>
                                                <template v-else> - </template>
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                {{ attendance.date }}
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                {{ attendance.time_in }}
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                {{ attendance.time_out }}
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                {{ attendance.lateness }}
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                {{ attendance.latlon_in }}
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                {{ attendance.latlon_out }}
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td colspan="9" class="text-center p-4">
                                            <NothingFound asShow="div" />
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="xl:col-span-2 bg-white dark:bg-gray-800 rounded-lg">
                <div class="flex justify-between items-center px-6 py-4">
                    <!-- Judul "Absent List" di kiri -->
                    <div class="text-gray-900 dark:text-gray-400 text-lg font-bold">
                        {{ __("Absent List") }}
                    </div>

                    <!-- Tombol Export di kanan -->
                    <global-button :loading="false" @click="exportAbsent()" type="button" theme="sky">
                        {{ __("Export") }}
                    </global-button>
                </div>
            <global-table>
                <template #head>
                    <th class="py-4 px-5">{{ __("Name") }}</th>
                    <th class="py-4 px-5">{{ __("Study Program") }}</th>
                    <th class="py-4 px-5">{{ __("Date") }}</th>
                    <th class="py-4 px-5">{{ __("Leave Type") }}</th>
                    <th class="py-4 px-5">{{ __("Status") }}</th>
                </template>
                <template #body>
                    <template v-if="absentTeachers.length > 0">
                        <template v-for="absent in absentTeachers" :key="absent.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="py-4 px-5 text-gray-900 dark:text-white">
                                    {{ absent.name }}
                                </td>
                                <td class="py-4 px-5 text-gray-900 dark:text-white">
                                    <template v-if="
                                        absent.department &&
                                        absent.department
                                            .study_program
                                    ">
                                        <div class="font-bold">
                                            {{
                                                absent.department
                                                    .study_program.name
                                            }}
                                        </div>
                                    </template>
                                    <template v-else> - </template>
                                </td>
                                <td class="py-4 px-5 text-gray-900 dark:text-white">
                                    {{ absent.date }}
                                </td>
                                <td class="py-4 px-5 text-gray-900 dark:text-white">
                                    <template v-if="absent.leaves.length > 0">
                                        <div class="flex flex-wrap items-center gap-0.5">
                                            <template v-for="(
                                                    leave, index
                                                ) in absent.leaves" :key="leave.id">
                                                <div class="font-bold ml-0.5">
                                                    {{
                                                        leave.type
                                                            ? leave.type
                                                                .name
                                                            : "-"
                                                    }}
                                                    <template v-if="
                                                        absent.leaves
                                                            .length !=
                                                        index + 1
                                                    ">,</template>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-else> - </template>
                                </td>
                                <td class="py-4 px-5 text-gray-900 dark:text-white">
                                    <template v-if="absent.leaves.length > 0">
                                        <div class="flex flex-wrap items-center gap-0.5">
                                            <template v-for="(
                                                    leave, index
                                                ) in absent.leaves" :key="leave.id">
                                                <div class="font-bold ml-0.5">
                                                    {{
                                                        leave.status ?? '-'
                                                    }}
                                                    <template v-if="
                                                        absent.leaves
                                                            .length !=
                                                        index + 1
                                                    ">,</template>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-else> - </template>
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template v-else>
                        <tr>
                            <td colspan="9" class="text-center p-4">
                                <NothingFound asShow="div" />
                            </td>
                        </tr>
                    </template>
                </template>
            </global-table>
            </div>
            <div class="flex justify-center">
                <!-- Pagination bisa ditambahkan di sini jika diperlukan -->
            </div>
        </div>
    </AppLayout>
</template>

<script>
import Chart from "chart.js/auto";
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Shared/Breadcrumb.vue";
import BreadcrumbLink from "@/Shared/BreadcrumbLink.vue";
import NothingFound from "@/Shared/NothingFound.vue";
import ExportModal from "@/Shared/Modal.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default {
    components: {
        AppLayout,
        Breadcrumb,
        BreadcrumbLink,
        NothingFound,
        ExportModal,
    },
    props: {
        attendanceteacher: {
            type: Array,
            required: true,
        },
        absentTeachers: {
            type: Array,
            required: true,
        },
        filter_data: Object,
        study_programs: Object,
        attendance_percentage: Object,
        absence_percentage: Object,
    },
    data() {
        return {
            loading: false,
            options: [],
            options2: [],
            export_options: [],
            visible: false,
            export_visible: false,
            show_user: "",
            export_data: useForm({
                type: "Excel",
                study_program: "all",
            }),
            filter: {
                name: "",
                month: "",
                study_program: this.filter_data.study_program ?? null,
            },
        };
    },
    mounted() {
        // Chart Kehadiran
        const attendanceCtx = document.getElementById("attendanceChart");
        const attendanceData = {
            datasets: [
                {
                    label: "Attendance",
                    data: [this.attendance_percentage, this.absence_percentage],
                    backgroundColor: ["rgb(54, 162, 235)", "rgb(255, 99, 132)"], // Biru & Merah
                    hoverOffset: 4,
                },
            ],
        };
        new Chart(attendanceCtx, {
            type: "doughnut",
            data: attendanceData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });

        // Chart Ketidakhadiran
        const absenceCtx = document.getElementById("absenceChart");
        const absenceData = {
            datasets: [
                {
                    label: "Absence",
                    data: [this.absence_percentage, this.attendance_percentage],
                    backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)"], // Biru & Merah
                    hoverOffset: 4,
                },
            ],
        };
        new Chart(absenceCtx, {
            type: "doughnut",
            data: absenceData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });
    },
    created() {
        this.options.push({
            value: "",
            label: "All",
        });
        for (const [key, value] of Object.entries(this.study_programs)) {
            this.options.push({
                value: value.slug,
                label: value.name,
            });
        }
    },
    setup(props) {
        const attendanceteacher = ref(props.attendanceteacher);

        return {
            attendanceteacher,
        };
    },
    computed: {
        // Menghitung data yang sudah difilter berdasarkan nama dan bulan
        filteredAttendance() {
            return this.attendanceteacher.filter((attendance) => {
                let nameMatch = true;
                let monthMatch = true;

                // Filter berdasarkan nama
                if (this.filter.name.trim() !== "") {
                    nameMatch = attendance.user.name
                        .toLowerCase()
                        .includes(this.filter.name.trim().toLowerCase());
                }

                // Filter berdasarkan bulan
                if (this.filter.month !== "") {
                    let attendanceMonth = new Date(attendance.date)
                        .toISOString()
                        .slice(0, 7);
                    monthMatch = attendanceMonth === this.filter.month;
                }

                return nameMatch && monthMatch;
            });
        },
        filteredAbsent() {
            const result = this.absentTeachers.filter((attendance) => {
                let nameMatch = true;
                let monthMatch = true;

                // Filter berdasarkan nama
                if (this.filter.name.trim() !== "") {
                    nameMatch = attendance.user_name
                        .toLowerCase()
                        .includes(this.filter.name.trim().toLowerCase());
                }

                // Filter berdasarkan bulan
                if (this.filter.month !== "") {
                    let absentMonth = new Date(attendance.date)
                        .toISOString()
                        .slice(0, 7);
                    monthMatch = absentMonth === this.filter.month;
                }

                return nameMatch && monthMatch;
            });

            return result;
        },
    },
    methods: {
        // Metode untuk meng-handle submit filter
        filterData() {
            this.loading = true;
            // Filter berdasarkan nama
            if (this.filter.name.trim() !== "") {
                this.filter.name = this.filter.name.trim().toLowerCase(); // Menyimpan nilai nama yang difilter dalam format lowercase
            }

            if (this.filter.month !== "") {
                const filterDate = this.filter.month;
                this.filter.month = filterDate;
            }
            this.$inertia.get(this.route("teacher.attendance"), this.filter, {
                preserveScroll: true,
                onFinish: (visit) => {
                    this.loading = false;
                    this.attendanceteacher = visit.props.attendance; // Asumsi bahwa data dikirim dalam props.attendance
                    this.absentTeachers = visit.props.absentStudents; // Asumsi bahwa data dikirim dalam props.absentStudents
                },
            });
        },

        // Metode untuk mengekspor data
        exportAttendance() {
            this.loading = true;
            let exportData = {};

            // Jika ada filter nama yang aktif
            if (this.filter.name.trim() !== "") {
                exportData.name = this.filter.name.trim();
            }

            // Jika ada filter bulan yang aktif
            if (this.filter.month !== "") {
                exportData.month = this.filter.month;
            }

            // Tambahkan filter course jika ada
            if (this.filter.course && this.filter.course.trim() !== "") {
                exportData.course = this.filter.course.trim();
            }

            // Tambahkan filter study program jika ada
            if (this.filter.study_program && this.filter.study_program.trim() !== "") {
                exportData.study_program = this.filter.study_program.trim();
            }

            axios({
                url: this.route("teacherattendance.export"),
                method: "POST",
                data: {
                    ...this.export_data,
                    ...exportData,
                },
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                responseType: "blob",
            })
                .then((response) => {
                    let extension = this.export_data.type;
                    var fileURL = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    var fileLink = document.createElement("a");

                    fileLink.href = fileURL;
                    fileLink.setAttribute(
                        "download",
                        "studentattendance-report." + "xlsx"
                    );
                    document.body.appendChild(fileLink);

                    fileLink.click();

                    this.loading = false;
                    this.visible = false;
                })
                .catch((e) => {
                    this.loading = false;
                    this.visible = false;
                });
        },

        exportAbsent() {
            this.loading = true;
            let exportData = {};

            // Jika ada filter nama yang aktif
            if (this.filter.name.trim() !== "") {
                exportData.name = this.filter.name.trim();
            }

            // Jika ada filter bulan yang aktif
            if (this.filter.month !== "") {
                exportData.month = this.filter.month;
            }

            // Tambahkan filter course jika ada
            if (this.filter.course && this.filter.course.trim() !== "") {
                exportData.course = this.filter.course.trim();
            }

            // Tambahkan filter study program jika ada
            if (this.filter.study_program && this.filter.study_program.trim() !== "") {
                exportData.study_program = this.filter.study_program.trim();
            }

            axios({
                url: this.route("teacherabsent.export"),
                method: "POST",
                data: {
                    ...this.export_data,
                    ...exportData,
                },
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                responseType: "blob",
            })
                .then((response) => {
                    let extension = this.export_data.type;
                    var fileURL = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    var fileLink = document.createElement("a");

                    fileLink.href = fileURL;
                    fileLink.setAttribute(
                        "download",
                        "teacherabsent-report." + "xlsx"
                    );
                    document.body.appendChild(fileLink);

                    fileLink.click();

                    this.loading = false;
                    this.visible = false;
                })
                .catch((e) => {
                    this.loading = false;
                    this.visible = false;
                });
        },
    },
};
</script>

<style scoped>
.course {
    margin-bottom: 20px;
}
</style>
