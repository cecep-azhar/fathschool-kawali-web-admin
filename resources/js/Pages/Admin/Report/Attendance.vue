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

                        <div class="ml-4 flex items-center">
                            <label for="month" class="mr-2"
                                >{{ __("From") }}:</label
                            >
                            <input
                                type="month"
                                v-model="filter.month"
                                id="month"
                                class="p-2 border rounded mr-4"
                            />
                        </div>

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
                <div
                    class="xl:col-span-3 bg-white dark:bg-gray-800 rounded-lg p-4"
                >
                    <div
                        class="flex justify-between items-center text-gray-900 dark:text-gray-400 text-base font-bold mb-4"
                    >
                        <div>{{ __("Attendance List") }}</div>
                        <global-button
                            :loading="false"
                            @click="exportAttendance"
                            type="button"
                            theme="sky"
                        >
                            {{ __("Export") }}
                        </global-button>
                    </div>

                    <div class="overflow-x-auto">
                        <table
                            class="w-full text-sm text-center text-gray-500 dark:text-gray-400 border border-gray-300"
                        >
                            <thead>
                                <!-- Baris Pertama: Label "Tanggal" -->
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th rowspan="2" class="px-3 py-2">No</th>
                                    <th rowspan="2" class="px-3 py-2">
                                        {{ __("Nama Siswa") }}
                                    </th>
                                    <th rowspan="2" class="px-3 py-2">
                                        {{ __("Kelas") }}
                                    </th>
                                    <th
                                        :colspan="datesInMonth.length"
                                        class="px-3 py-2"
                                    >
                                        {{ __("Tanggal") }}
                                    </th>
                                    <th rowspan="2" class="px-3 py-2">Hadir</th>
                                    <th rowspan="2" class="px-3 py-2">Sakit</th>
                                    <th rowspan="2" class="px-3 py-2">Ijin</th>
                                    <th rowspan="2" class="px-3 py-2">Alfa</th>
                                </tr>
                                <!-- Baris Kedua: Daftar Tanggal dalam Format DD/MM/YYYY -->
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th
                                        v-for="(date, index) in datesInMonth"
                                        :key="index"
                                        class="px-3 py-2"
                                    >
                                        {{ date }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="attendancestudent.length > 0">
                                    <template
                                        v-for="(
                                            attendance, index
                                        ) in attendancestudent"
                                        :key="attendance.id"
                                    >
                                        <tr
                                            class="hover:bg-gray-50 dark:hover:bg-gray-600"
                                        >
                                            <!-- No -->
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ index + 1 }}
                                            </td>
                                            <!-- Nama Siswa -->
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.user_name }}
                                            </td>
                                            <!-- Kelas -->
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.class || "-" }}
                                            </td>
                                            <!-- Kehadiran per tanggal -->
                                            <td
                                                v-for="(
                                                    status, i
                                                ) in attendance.attendance"
                                                :key="i"
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ status || "-" }}
                                            </td>
                                            <!-- Total Hadir -->
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.summary.hadir }}
                                            </td>
                                            <!-- Total Sakit -->
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.summary.sakit }}
                                            </td>
                                            <!-- Total Ijin -->
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.summary.ijin }}
                                            </td>
                                            <!-- Total Alfa -->
                                            <td
                                                class="py-4 px-5 text-gray-900 dark:text-white"
                                            >
                                                {{ attendance.summary.alfa }}
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
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
        settingTimeIn: Object,
        study_programs: Object,
        classes: Object,
    },
    data() {
        const currentYearMonth = new Date().toISOString().slice(0, 7); // Format: YYYY-MM

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
                month: this.filter_data.month || currentYearMonth, // 🔹 Gunakan format YYYY-MM
                course: this.filter_data.course ?? null,
                study_program: this.filter_data.study_program ?? null,
            },
        };
    },
    watch: {
        filter_data: {
            handler(newVal) {
                this.filter.name = newVal.keyword || "";
                this.filter.month =
                    newVal.month || new Date().toISOString().slice(0, 7);
                this.filter.course = newVal.course || null;
                this.filter.study_program = newVal.study_program || null;
            },
            immediate: true,
        },
    },
    created() {
        this.options.push({ value: "", label: "All" });
        for (const [key, value] of Object.entries(this.classes)) {
            this.options.push({
                value: value.slug,
                label: value.name,
            });
        }
        this.options2.push({ value: "", label: "All" });
        for (const [key, value] of Object.entries(this.study_programs)) {
            this.options2.push({
                value: value.slug,
                label: value.name,
            });
        }
    },
    setup(props) {
        const attendancestudent = ref(props.attendancestudent);

        return { attendancestudent };
    },
    computed: {
        // 🔹 Menghitung daftar tanggal dalam bulan yang dipilih
        datesInMonth() {
            let dates = [];
            let [year, month] = this.filter.month.split("-").map(Number); // Ambil dari filter
            let daysInMonth = new Date(year, month, 0).getDate(); // Hitung jumlah hari dalam bulan

            for (let day = 1; day <= daysInMonth; day++) {
                let formattedDate = `${day.toString().padStart(2, "0")}/${month
                    .toString()
                    .padStart(2, "0")}/${year}`;
                dates.push(formattedDate);
            }
            return dates;
        },

        // 🔹 Filter data berdasarkan nama & bulan yang dipilih
        filteredAttendance() {
            return this.attendancestudent.filter((attendance) => {
                let nameMatch = true;
                let monthMatch = true;

                // 🔹 Filter berdasarkan nama (jika ada)
                if (this.filter.name && this.filter.name.trim() !== "") {
                    const searchName = this.filter.name.trim().toLowerCase();
                    nameMatch =
                        attendance.user_name &&
                        attendance.user_name.toLowerCase().includes(searchName);
                }

                // 🔹 Filter berdasarkan bulan (format YYYY-MM)
                if (this.filter.month) {
                    if (attendance.date) {
                        try {
                            let attendanceMonth = new Date(attendance.date)
                                .toISOString()
                                .slice(0, 7); // Ambil format YYYY-MM
                            monthMatch = attendanceMonth === this.filter.month;
                        } catch (error) {
                            console.warn(
                                "Invalid date format for:",
                                attendance.date
                            );
                            monthMatch = false;
                        }
                    } else {
                        monthMatch = false;
                    }
                }

                return nameMatch && monthMatch;
            });
        },
    },
    methods: {
        // 🔹 Metode untuk mengubah filter data
        filterData() {
            this.loading = true;

            const params = {
                keyword: this.filter.name || null,
                month: this.filter.month, // 🔹 Pastikan ini dikirim dengan format YYYY-MM
                course: this.filter.course,
                study_program: this.filter.study_program,
            };

            this.$inertia.get(this.route("report.attendance"), params, {
                preserveScroll: true,
                onFinish: (visit) => {
                    this.loading = false;
                    this.attendancestudent = visit.props.attendance;
                },
            });
        },

        // 🔹 Metode untuk mengekspor data
        exportAttendance() {
            this.loading = true;

            let exportData = {};

            // 🔹 Pastikan hanya data yang diisi dikirim
            if (this.filter.name?.trim()) {
                exportData.name = this.filter.name.trim();
            }
            if (this.filter.course) {
                exportData.course = this.filter.course;
            }
            if (this.filter.month) {
                exportData.month = this.filter.month;
            }
            if (this.filter.study_program?.trim()) {
                exportData.study_program = this.filter.study_program.trim();
            }

            console.log("Export Data:", exportData); // 🔹 Debugging untuk memastikan filter benar

            axios({
                url: this.route("studentattendance.export"),
                method: "POST", // Pastikan backend menerima POST
                data: exportData,
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                responseType: "blob", // Mengatur agar menerima file sebagai respons
            })
                .then((response) => {
                    try {
                        let blob = new Blob([response.data]);
                        let fileURL = window.URL.createObjectURL(blob);
                        let fileLink = document.createElement("a");
                        fileLink.href = fileURL;

                        // 🔹 Pastikan nama file aman dari karakter tidak valid
                        let fileName = `studentattendance-report-${encodeURIComponent(
                            this.filter.course || "all"
                        )}-${encodeURIComponent(
                            this.filter.month || "unknown"
                        )}.xlsx`;

                        fileLink.setAttribute("download", fileName);
                        document.body.appendChild(fileLink);
                        fileLink.click();
                        document.body.removeChild(fileLink);
                        window.URL.revokeObjectURL(fileURL);
                    } catch (error) {
                        console.error("Error saat mengunduh file:", error);
                    }
                })
                .catch((error) => {
                    console.error("Export gagal:", error);
                    alert("Terjadi kesalahan saat mengunduh file.");
                })
                .finally(() => {
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
