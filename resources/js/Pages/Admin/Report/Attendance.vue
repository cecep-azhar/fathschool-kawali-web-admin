<template>
    <AppLayout :title="__('Student Attendance')">
        <template #header>
            {{ __("Student Attendance") }}
        </template>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Student Attendance')" :href="route('student.attendance')" />
        </Breadcrumb>
        <div>
            <page-header class="flex-col sm:flex-row">
                {{ __("Student Attendance") }}

            </page-header>
            <div class="mb-4">
                <form @submit.prevent="filterData">
                    <div class="flex items-center">
                        <input type="text" v-model="filter.name" id="name" placeholder="Name"
                            class="p-2 border rounded" />

                        <div class="ml-4 flex items-center">
                            <label for="start_date" class="mr-2">{{ __("From") }}:</label>
                            <input type="date" v-model="filter.start_date" id="start_date" class="p-2 border rounded" />
                        </div>

                        <div class="ml-4 flex items-center">
                            <label for="end_date" class="mr-2">{{ __("To") }}:</label>
                            <input type="date" v-model="filter.end_date" id="end_date"
                                class="p-2 border rounded mr-4" />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <a-select class="width-100" size="large" v-model:value="filter.course" show-search
                                    :placeholder="__('Select a course')" :options="options"
                                    :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur"
                                    @change="handleChange" />
                            </div>
                            <div>
                                <a-select class="width-100" size="large" v-model:value="filter.study_program"
                                    show-search :placeholder="__('Select a study program')" :options="options2"
                                    :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur"
                                    @change="handleChange" />
                            </div>
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
                            <thead class="text-xs uppercase">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Name") }}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{ __("Class") }}
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
                                <template v-if="attendancestudent.length > 0">
                                    <template v-for="attendance in attendancestudent" :key="attendance.id">
                                        <tr
                                            class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                {{ attendance.user_name }}
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                <template v-if="
                                                    attendance.user.courses
                                                        .length > 0
                                                ">
                                                    <div class="flex flex-wrap items-center gap-0.5">
                                                        <template v-for="(
                                                                course, index
                                                            ) in attendance.user
                                                                        .courses" :key="course.id">
                                                            <div class="font-bold ml-0.5">
                                                                {{
                                                                    course.course
                                                                        ? course
                                                                            .course
                                                                            .name
                                                                        : ""
                                                                }}
                                                                <template v-if="
                                                                    attendance
                                                                        .user
                                                                        .courses
                                                                        .length !=
                                                                    index +
                                                                    1
                                                                ">,</template>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </template>
                                                <template v-else> - </template>
                                            </td>
                                            <td class="py-4 px-5 text-gray-900 dark:text-white">
                                                <template v-if="
                                                    attendance.user.courses
                                                        .length > 0
                                                ">
                                                    <div class="flex flex-wrap items-center gap-0.5">
                                                        <template v-for="(
                                                                course, index
                                                            ) in attendance.user
                                                                        .courses" :key="course.id">
                                                            <div class="font-bold ml-0.5">
                                                                {{
                                                                    course
                                                                        .course
                                                                        .study_program
                                                                        ? course
                                                                            .course
                                                                            .study_program
                                                                            .name
                                                                        : "-"
                                                                }}
                                                                <template v-if="
                                                                    attendance
                                                                        .user
                                                                        .courses
                                                                        .length !=
                                                                    index +
                                                                    1
                                                                ">,</template>
                                                            </div>
                                                        </template>
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

            <div class="xl:col-span-2 bg-white dark:bg-gray-800 rounded-lg ">
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
                <div class="overflow-x-auto overflow-y-auto max-h-[500px]">


                    <global-table>
                        <template #head>
                            <th class="py-4 px-5">{{ __("Name") }}</th>
                            <th class="py-4 px-5">{{ __("Class") }}</th>
                            <th class="py-4 px-5">{{ __("Study Program") }}</th>
                            <th class="py-4 px-5">{{ __("Date") }}</th>
                            <th class="py-4 px-5">{{ __("Leave Type") }}</th>
                            <th class="py-4 px-5">{{ __("Status") }}</th>
                        </template>

                        <template #body>
                            <template v-if="absentStudents.length > 0">
                                <template v-for="absent in absentStudents" :key="absent.id">
                                    <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-4 px-5 text-gray-900 dark:text-white">{{ absent.name }}</td>
                                        <td class="py-4 px-5 text-gray-900 dark:text-white">
                                            <div v-if="absent.courses.length">
                                                <div class="flex flex-wrap items-center gap-0.5">
                                                    <template v-for="(course, index) in absent.courses"
                                                        :key="course.id">
                                                        <div class="font-bold ml-0.5">
                                                            {{ course.course?.name }}<template
                                                                v-if="absent.courses.length !== index + 1">,</template>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                            <span v-else>-</span>
                                        </td>
                                        <td class="py-4 px-5 text-gray-900 dark:text-white">
                                            <div v-if="absent.courses.length">
                                                <div class="flex flex-wrap items-center gap-0.5">
                                                    <template v-for="(course, index) in absent.courses"
                                                        :key="course.id">
                                                        <div class="font-bold ml-0.5">
                                                            {{ course.course?.study_program?.name ?? "-" }}
                                                            <template
                                                                v-if="absent.courses.length !== index + 1">,</template>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                            <span v-else>-</span>
                                        </td>
                                        <td class="py-4 px-5 text-gray-900 dark:text-white">{{ absent.date }}</td>
                                        <td class="py-4 px-5 text-gray-900 dark:text-white">
                                            <div v-if="absent.leaves.length">
                                                <div class="flex flex-wrap items-center gap-0.5">
                                                    <template v-for="(leave, index) in absent.leaves" :key="leave.id">
                                                        <div class="font-bold ml-0.5">
                                                            {{ leave.type?.name ?? "-" }}
                                                            <template
                                                                v-if="absent.leaves.length !== index + 1">,</template>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                            <span v-else>-</span>
                                        </td>
                                        <td class="py-4 px-5 text-gray-900 dark:text-white">
                                            <div v-if="absent.leaves.length">
                                                <div class="flex flex-wrap items-center gap-0.5">
                                                    <template v-for="(leave, index) in absent.leaves" :key="leave.id">
                                                        <div class="font-bold ml-0.5">
                                                            {{ leave.status ?? "-" }}
                                                            <template
                                                                v-if="absent.leaves.length !== index + 1">,</template>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                            <span v-else>-</span>
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
import { data } from "autoprefixer";

export default {
    components: {
        AppLayout,
        Breadcrumb,
        BreadcrumbLink,
        NothingFound,
        ExportModal,
    },
    props: {
        attendancestudent: {
            type: Array,
            required: true,
        },
        absentStudents: {
            type: Array,
            required: true,
        },
        filter_data: Object,
        classes: Object,
        study_programs: Object,
        settingTimeIn: Object,
        attendance_percentage: Object,
        absence_percentage: Object,
    },
    data() {
        const today = new Date().toISOString().slice(0, 10);
        const firstDayOfMonth = new Date(new Date().getFullYear(), new Date().getMonth(), 1).toISOString().slice(0, 10);

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
                course: "all",
                study_program: "all",
            }),
            filter: {
                name: this.filter_data.keyword || "",
                start_date: this.filter_data.start_date || firstDayOfMonth,
                end_date: this.filter_data.end_date || today,
                course: this.filter_data.course ?? null,
                study_program: this.filter_data.study_program ?? null,
            },
        };
    },
    watch: {
        'filter_data': {
            handler(newVal) {
                const today = new Date().toISOString().slice(0, 10);
                const firstDayOfMonth = new Date(new Date().getFullYear(), new Date().getMonth(), 1).toISOString().slice(0, 10);

                this.filter.name = newVal.keyword || "";
                this.filter.start_date = newVal.start_date || firstDayOfMonth;
                this.filter.end_date = newVal.end_date || today;
                this.filter.study_program = newVal.study_program || null;
            },
            immediate: true
        }
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
        for (const [key, value] of Object.entries(this.classes)) {
            this.options.push({
                value: value.slug,
                label: value.name,
            });
        }
        this.options2.push({
            value: "",
            label: "All",
        });
        for (const [key, value] of Object.entries(this.study_programs)) {
            this.options2.push({
                value: value.slug,
                label: value.name,
            });
        }
    },
    setup(props) {
        const attendancestudent = ref(props.attendancestudent);

        return {
            attendancestudent,
        };
    },
    computed: {
        // Menghitung data yang sudah difilter berdasarkan nama dan bulan
        filteredAttendance() {
            const result = this.attendancestudent.filter((attendance) => {
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
                    let attendanceMonth = new Date(attendance.date)
                        .toISOString()
                        .slice(0, 7);
                    monthMatch = attendanceMonth === this.filter.month;
                }

                return nameMatch && monthMatch;
            });

            return result;
        },
        filteredAbsent() {
            const result = this.absentStudents.filter((attendance) => {
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
        calculatedLateness() {
            if (!this.settingTimeIn || !this.settingTimeIn.time_in) return []; // Pastikan settingTimeIn ada

            const settingTime = dayjs(this.settingTimeIn.time_in, "HH:mm");
            return this.attendancestudents.map((attendance) => {
                const timeIn = dayjs(attendance.time_in, "HH:mm");
                const lateness = timeIn.isAfter(settingTime)
                    ? timeIn.diff(settingTime, "minute")
                    : 0;
                return { ...attendance, lateness };
            });
        },
    },
    methods: {
        // Metode untuk meng-handle submit filter
        filterData() {
            this.loading = true; // Menandakan bahwa data sedang dimuat

            const params = {
                keyword: this.filter.name || null,  // Sesuaikan dengan parameter yang digunakan di controller
                start_date: this.filter.start_date,
                end_date: this.filter.end_date,
                course: this.filter.course,
                study_program: this.filter.study_program
            };

            // Lakukan permintaan dengan Inertia
            this.$inertia.get(this.route("report.attendance"), params, {
                preserveScroll: true,
                onFinish: (visit) => {
                    this.loading = false;
                    // Assign hasil yang diterima dari server ke variabel lokal
                    this.attendancestudent = visit.props.attendance;
                    this.absentStudents = visit.props.absentStudents;
                },
            });

            // Filter data berdasarkan nilai yang dimasukkan
            // Jika Anda ingin menampilkan loading indicator, Anda bisa mengatur this.loading = true; di sini
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },

        // Metode untuk mengekspor data
        exportAttendance() {
            this.loading = true;
            let exportData = {};

            if (this.filter.name.trim() !== "") {
                exportData.name = this.filter.name.trim();
            }
            if (this.filter.course !== "") {
                exportData.course = this.filter.course;
            }

            if (this.filter.start_date !== "") {
                exportData.start_date = this.filter.start_date;
            }

            if (this.filter.end_date !== "") {
                exportData.end_date = this.filter.end_date;
            }

            if (this.filter.study_program && this.filter.study_program.trim() !== "") {
                exportData.study_program = this.filter.study_program.trim();
            }

            axios({
                url: this.route("studentattendance.export"),
                method: "POST",
                data: exportData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                responseType: "blob",
            })
                .then((response) => {
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement("a");
                    fileLink.href = fileURL;

                    // Tambahkan tanggal di nama file untuk lebih jelas
                    const fileName = `studentattendance-report-(${this.filter.course})-(${this.filter.start_date})-to-(${this.filter.end_date}).xlsx`;
                    fileLink.setAttribute("download", fileName);

                    document.body.appendChild(fileLink);
                    fileLink.click();
                    this.loading = false;
                    this.visible = false;
                })
                .catch((error) => {
                    this.loading = false;
                    this.visible = false;
                });
        },



        exportAbsent() {
            this.loading = true;
            let exportData = {};

            if (this.filter.name.trim() !== "") {
                exportData.name = this.filter.name.trim();
            }
            if (this.filter.course !== "") {
                exportData.course = this.filter.course;
            }

            if (this.filter.start_date !== "") {
                exportData.start_date = this.filter.start_date;
            }

            if (this.filter.end_date !== "") {
                exportData.end_date = this.filter.end_date;
            }

            if (this.filter.study_program && this.filter.study_program.trim() !== "") {
                exportData.study_program = this.filter.study_program.trim();
            }

            axios({
                url: this.route("studentabsent.export"),
                method: "POST",
                data: exportData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                responseType: "blob",
            })
                .then((response) => {
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement("a");
                    fileLink.href = fileURL;

                    // Tambahkan tanggal di nama file untuk lebih jelas
                    const fileName = `studentabsent-report-(${this.filter.course})-(${this.filter.start_date})-to-(${this.filter.end_date}).xlsx`;
                    fileLink.setAttribute("download", fileName);

                    document.body.appendChild(fileLink);
                    fileLink.click();
                    this.loading = false;
                    this.visible = false;
                })
                .catch((error) => {
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
