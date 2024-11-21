<template>
    <AppLayout :title="__('Student Attendance')">
        <template #header>
            {{ __("Student Attendance") }}
        </template>
        <Breadcrumb>
            <BreadcrumbLink
                :title="__('Student Attendance')"
                :href="route('student.attendance')"
            />
        </Breadcrumb>
        <div>
            <page-header class="flex-col sm:flex-row">
                {{ __("Student Attendance") }}
                <template #content>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <global-button
                            :loading="false"
                            @click="exportSubmit()"
                            type="button"
                            theme="sky"
                        >
                            {{ __("Export") }}
                        </global-button>
                    </div>
                </template>
            </page-header>
            <div class="mb-4">
                <form @submit.prevent="filterData">
                    <div class="flex items-center">
                        <input
                            type="text"
                            v-model="filter.name"
                            id="name"
                            placeholder="Name"
                            class="p-2 border rounded"
                        />

                        <label for="month" class="ml-4 mr-2"
                            >{{ __("Date") }}:</label
                        >
                        <input
                            type="date"
                            v-model="filter.month"
                            id="month"
                            class="p-2 border rounded mr-4"
                        />

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <a-select
                                    class="width-100"
                                    size="large"
                                    v-model:value="filter.course"
                                    show-search
                                    :placeholder="__('Select a course')"
                                    :options="options"
                                    :filter-option="filterOption"
                                    @focus="handleFocus"
                                    @blur="handleBlur"
                                    @change="handleChange"
                                />
                            </div>
                            <div>
                                <a-select
                                    class="width-100"
                                    size="large"
                                    v-model:value="filter.study_program"
                                    show-search
                                    :placeholder="__('Select a study program')"
                                    :options="options2"
                                    :filter-option="filterOption"
                                    @focus="handleFocus"
                                    @blur="handleBlur"
                                    @change="handleChange"
                                />
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            {{ __("Filter") }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3 items-start mb-6">
                <!-- Chart Section (left) -->
                <div class="xl:col-span-1 rounded-lg bg-white overflow-x-auto dark:bg-gray-800 flex flex-col items-center justify-center p-6">
                     <canvas id="myChart" class="mb-4"></canvas> <!-- Chart -->
                </div>

                <!-- Table Section (right) -->
                <div class="xl:col-span-2 bg-white dark:bg-gray-800 rounded-lg">
                    <div
                        class="flex justify-between px-6 items-center pt-6 text-gray-900 dark:text-gray-400 text-base font-bold"
                    >
                        <div>{{ __("Attendance List") }}</div>
                        <!-- You can add your "Create Event" or other buttons here if needed -->
                    </div>

                    <div class="overflow-x-auto overflow-y-auto max-h-[400px]">
                        <!-- Table -->
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase dark:bg-gray-600 dark:text-gray-400"
                            >
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
                                <template v-if="filteredAttendance.length > 0">
                                    <template
                                        v-for="attendance in filteredAttendance"
                                        :key="attendance.id"
                                    >
                                        <tr
                                            class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        >
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.user_name }}
                                            </td>
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                <template
                                                    v-if="
                                                        attendance.user.courses
                                                            .length > 0
                                                    "
                                                >
                                                    <div
                                                        class="flex flex-wrap items-center gap-0.5"
                                                    >
                                                        <template
                                                            v-for="(
                                                                course, index
                                                            ) in attendance.user
                                                                .courses"
                                                            :key="course.id"
                                                        >
                                                            <div
                                                                class="font-bold ml-0.5"
                                                            >
                                                                {{
                                                                    course.course
                                                                        ? course
                                                                              .course
                                                                              .name
                                                                        : ""
                                                                }}
                                                                <template
                                                                    v-if="
                                                                        attendance
                                                                            .user
                                                                            .courses
                                                                            .length !=
                                                                        index +
                                                                            1
                                                                    "
                                                                    >,</template
                                                                >
                                                            </div>
                                                        </template>
                                                    </div>
                                                </template>
                                                <template v-else> - </template>
                                            </td>
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                <template
                                                    v-if="
                                                        attendance.user.courses
                                                            .length > 0
                                                    "
                                                >
                                                    <div
                                                        class="flex flex-wrap items-center gap-0.5"
                                                    >
                                                        <template
                                                            v-for="(
                                                                course, index
                                                            ) in attendance.user
                                                                .courses"
                                                            :key="course.id"
                                                        >
                                                            <div
                                                                class="font-bold ml-0.5"
                                                            >
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
                                                                <template
                                                                    v-if="
                                                                        attendance
                                                                            .user
                                                                            .courses
                                                                            .length !=
                                                                        index +
                                                                            1
                                                                    "
                                                                    >,</template
                                                                >
                                                            </div>
                                                        </template>
                                                    </div>
                                                </template>
                                                <template v-else> - </template>
                                            </td>
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.date }}
                                            </td>
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.time_in }}
                                            </td>
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.time_out }}
                                            </td>
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.lateness }}
                                            </td>
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.latlon_in }}
                                            </td>
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
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

            <global-table>
                <template #head>
                    <th class="py-4 px-5">{{ __("Name") }}</th>
                    <th class="py-4 px-5">{{ __("Class") }}</th>
                    <th class="py-4 px-5">{{ __("Study Program") }}</th>
                    <th class="py-4 px-5">{{ __("Date") }}</th>
                    <th class="py-4 px-5">{{ __("Time In") }}</th>
                    <th class="py-4 px-5">{{ __("Time Out") }}</th>
                    <th class="py-4 px-5">{{ __("lateness") }}</th>
                    <th class="py-4 px-5">{{ __("Latlon In") }}</th>
                    <th class="py-4 px-5">{{ __("Latlon Out") }}</th>
                </template>
                <template #body>
                    <template v-if="filteredAttendance.length > 0">
                        <template
                            v-for="attendance in filteredAttendance"
                            :key="attendance.id"
                        >
                            <tr
                                class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
                                    {{ attendance.user_name }}
                                </td>

                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
                                    <template
                                        v-if="
                                            attendance.user.courses.length > 0
                                        "
                                    >
                                        <div
                                            class="flex flex-wrap items-center gap-0.5"
                                        >
                                            <template
                                                v-for="(
                                                    course, index
                                                ) in attendance.user.courses"
                                                :key="course.id"
                                            >
                                                <div class="font-bold ml-0.5">
                                                    {{
                                                        course.course
                                                            ? course.course.name
                                                            : ""
                                                    }}
                                                    <template
                                                        v-if="
                                                            attendance.user
                                                                .courses
                                                                .length !=
                                                            index + 1
                                                        "
                                                        >,</template
                                                    >
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-else> - </template>
                                </td>

                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
                                    <template
                                        v-if="
                                            attendance.user.courses.length > 0
                                        "
                                    >
                                        <div
                                            class="flex flex-wrap items-center gap-0.5"
                                        >
                                            <template
                                                v-for="(
                                                    course, index
                                                ) in attendance.user.courses"
                                                :key="course.id"
                                            >
                                                <div class="font-bold ml-0.5">
                                                    {{
                                                        course.course
                                                            .study_program
                                                            ? course.course
                                                                  .study_program
                                                                  .name
                                                            : "-"
                                                    }}
                                                    <template
                                                        v-if="
                                                            attendance.user
                                                                .courses
                                                                .length !=
                                                            index + 1
                                                        "
                                                        >,</template
                                                    >
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-else> - </template>
                                </td>
                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
                                    {{ attendance.date }}
                                </td>

                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
                                    {{ attendance.time_in }}
                                </td>
                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
                                    {{ attendance.time_out }}
                                </td>
                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
                                    {{ attendance.lateness }}
                                </td>
                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
                                    {{ attendance.latlon_in }}
                                </td>
                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
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
                </template>
            </global-table>
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
        filter_data: Object,
        classes: Object,
        study_programs: Object,
        settingTimeIn: Object,
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
                course: "all",
            }),
            filter: {
                name: "",
                month: "",
                course: this.filter_data.course ?? null,
                study_program: this.filter_data.study_program ?? null,
            },
        };
    },
    mounted() {
        const ctx = document.getElementById("myChart");

        // Data untuk chart
        const data = {
            labels: ["Kehadiran", "Ketidakhadiran"],
            datasets: [
                {
                    label: "Attendance",
                    data: [this.attendance_percentage, this.absence_percentage],
                    backgroundColor: ["rgb(54, 162, 235)", "rgb(255, 99, 132)"],
                    hoverOffset: 4,
                },
            ],
        };

        // Membuat chart
        const myChart = new Chart(ctx, {
            type: "doughnut",
            data: data,
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
            if (this.filter.month !== "") {
                // Format bulan ke tanggal pertama bulan itu
                const filterDate = this.filter.month; // e.g. "2024-11-01"
                this.filter.month = filterDate;
            }
            this.$inertia.get(this.route("report.attendance"), this.filter, {
                preserveScroll: true,
                onFinish: (visit) => {
                    this.loading = false;
                    this.attendancestudent = this.filteredAttendance;
                },
            });
            // Filter data berdasarkan nilai yang dimasukkan
            // Jika Anda ingin menampilkan loading indicator, Anda bisa mengatur this.loading = true; di sini

            // Lakukan filter berdasarkan nama dan bulan
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },

        // Metode untuk mengekspor data
        exportSubmit() {
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

            axios({
                url: this.route("studentattendance.export"),
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
    },
};
</script>

<style scoped>
.course {
    margin-bottom: 20px;
}
</style>
