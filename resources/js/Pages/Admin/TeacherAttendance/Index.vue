<template>
    <AppLayout :title="__('Teacher Attendance')">
        <template #header>
            {{ __("Teacher Attendance") }}
        </template>
        <Breadcrumb>
            <BreadcrumbLink
                :title="__('Teacher Attendance')"
                :href="route('teacher.attendance')"
            />
        </Breadcrumb>
        <div>
            <page-header class="flex-col sm:flex-row">
                {{ __("Teacher Attendance") }}
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
                            <label for="start_date" class="mr-2"
                                >{{ __("From") }}:</label
                            >
                            <input
                                type="date"
                                v-model="filter.start_date"
                                id="start_date"
                                class="p-2 border rounded"
                            />
                        </div>

                        <div class="ml-4 flex items-center">
                            <label for="end_date" class="mr-2"
                                >{{ __("To") }}:</label
                            >
                            <input
                                type="date"
                                v-model="filter.end_date"
                                id="end_date"
                                class="p-2 border rounded mr-4"
                            />
                        </div>

                        <div>
                            <a-select
                                class="width-100"
                                size="large"
                                v-model:value="filter.study_program"
                                show-search
                                :placeholder="__('Select a study program')"
                                :options="options"
                                :filter-option="filterOption"
                                @focus="handleFocus"
                                @blur="handleBlur"
                                @change="handleChange"
                            />
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

            <div class="xl:col-span-2 bg-white dark:bg-gray-800 rounded-lg">
                <div class="flex justify-between items-center px-6 py-4">
                    <div
                        class="text-gray-900 dark:text-gray-400 text-lg font-bold"
                    >
                        {{ __("Attendance List") }}
                    </div>
                    <global-button
                        :loading="false"
                        @click="exportAttendance"
                        type="button"
                        theme="sky"
                    >
                        {{ __("Export") }}
                    </global-button>
                </div>
                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table
                        class="w-full text-sm text-center text-gray-700 dark:text-gray-300"
                    >
                        <thead
                            class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200"
                        >
                            <!-- Baris Pertama: Label "Tanggal" -->
                            <tr>
                                <th rowspan="2" class="py-4 px-6">No</th>
                                <th rowspan="2" class="py-4 px-6">
                                    {{ __("Nama Guru") }}
                                </th>
                                <th rowspan="2" class="py-4 px-6">
                                    {{ __("Program Keahlian") }}
                                </th>
                                <th
                                    :colspan="datesInRange.length"
                                    class="py-4 px-6"
                                >
                                    {{ __("Tanggal") }}
                                </th>
                                <th rowspan="2" class="py-4 px-6">Hadir</th>
                                <th rowspan="2" class="py-4 px-6">Sakit</th>
                                <th rowspan="2" class="py-4 px-6">Ijin</th>
                                <th rowspan="2" class="py-4 px-6">Alfa</th>
                            </tr>
                            <!-- Baris Kedua: Daftar Tanggal -->
                            <tr class="border-b border-gray-300">
                                <th
                                    v-for="(date, index) in datesInRange"
                                    :key="index"
                                    class="py-3 px-5"
                                >
                                    {{ date }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="attendanceteacher.length > 0">
                                <template
                                    v-for="(
                                        attendance, index
                                    ) in attendanceteacher"
                                    :key="attendance.id"
                                >
                                    <tr
                                        class="border-b border-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600"
                                    >
                                        <td class="py-4 px-6 font-medium">
                                            {{ index + 1 }}
                                        </td>
                                        <td class="py-4 px-6 font-medium">
                                            {{ attendance.name }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{
                                                attendance.study_program || "-"
                                            }}
                                        </td>
                                        <td
                                            v-for="(
                                                status, i
                                            ) in attendance.attendance"
                                            :key="i"
                                            class="py-4 px-6"
                                        >
                                            {{ status || "-" }}
                                        </td>
                                        <td
                                            class="py-4 px-6 font-semibold dark:text-white"
                                        >
                                            {{ attendance.summary.hadir }}
                                        </td>
                                        <td
                                            class="py-4 px-6 font-semibold dark:text-white"
                                        >
                                            {{ attendance.summary.sakit }}
                                        </td>
                                        <td
                                            class="py-4 px-6 font-semibold dark:text-white"
                                        >
                                            {{ attendance.summary.ijin }}
                                        </td>
                                        <td
                                            class="py-4 px-6 font-semibold dark:text-white"
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
        attendanceteacher: {
            type: Array,
            required: true,
        },
        filter_data: Object,
        study_programs: Object,
    },
    data() {
        const today = new Date();
        const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1)
            .toISOString()
            .slice(0, 10); // Format: YYYY-MM-DD
        const endOfMonth = new Date(
            today.getFullYear(),
            today.getMonth() + 1,
            0
        )
            .toISOString()
            .slice(0, 10); // Format: YYYY-MM-DD

        return {
            loading: false,
            options: [],
            export_options: [],
            visible: false,
            export_visible: false,
            show_user: "",
            export_data: useForm({
                type: "Excel",
                study_program: "all",
            }),
            filter: {
                name: this.filter_data.keyword || "",
                start_date: this.filter_data.start_date || startOfMonth,
                end_date: this.filter_data.end_date || endOfMonth,
                study_program: this.filter_data.study_program ?? null,
            },
        };
    },
    watch: {
        filter_data: {
            handler(newVal) {
                this.filter.name = newVal.keyword || "";

                // Update ke format baru (start_date dan end_date)
                const today = new Date();
                const startOfMonth = new Date(
                    today.getFullYear(),
                    today.getMonth(),
                    1
                )
                    .toISOString()
                    .slice(0, 10);
                const endOfMonth = new Date(
                    today.getFullYear(),
                    today.getMonth() + 1,
                    0
                )
                    .toISOString()
                    .slice(0, 10);

                this.filter.start_date = newVal.start_date || startOfMonth;
                this.filter.end_date = newVal.end_date || endOfMonth;

                this.filter.course = newVal.course || null;
                this.filter.study_program = newVal.study_program || null;
            },
            immediate: true,
        },
    },
    created() {
        this.options.push({ value: "", label: "All" });
        for (const [key, value] of Object.entries(this.study_programs)) {
            this.options.push({
                value: value.slug,
                label: value.name,
            });
        }
    },
    setup(props) {
        const attendanceteacher = ref(props.attendanceteacher);

        return { attendanceteacher };
    },
    computed: {
         // 🔹 Menghitung daftar tanggal antara start_date dan end_date
         datesInRange() {
            const start = new Date(this.filter.start_date);
            const end = new Date(this.filter.end_date);
            const dates = [];

            for (
                let d = new Date(start);
                d <= end;
                d.setDate(d.getDate() + 1)
            ) {
                let formattedDate = d.toLocaleDateString("id-ID"); // format DD/MM/YYYY
                dates.push(formattedDate);
            }

            return dates;
        },

        // 🔹 Filter data berdasarkan nama & rentang tanggal
        filteredAttendance() {
            return this.attendancestudent.filter((attendance) => {
                let nameMatch = true;

                if (this.filter.name && this.filter.name.trim() !== "") {
                    const searchName = this.filter.name.trim().toLowerCase();
                    nameMatch =
                        attendance.user_name &&
                        attendance.user_name.toLowerCase().includes(searchName);
                }

                return nameMatch;
            });
        },
    },
    methods: {
        // 🔹 Metode untuk mengubah filter data
        filterData() {
            this.loading = true;

            const params = {
                keyword: this.filter.name || null,
                start_date: this.filter.start_date,
                end_date: this.filter.end_date,
                study_program: this.filter.study_program,
            };

            this.$inertia.get(this.route("teacher.attendance"), params, {
                preserveScroll: true,
                onFinish: (visit) => {
                    this.loading = false;
                    this.attendanceteacher = visit.props.attendance;
                },
            });
        },

        // 🔹 Metode untuk mengekspor data
        // exportAttendance() {
        //     this.loading = true;

        //     let exportData = {};

        //     // 🔹 Pastikan hanya data yang diisi dikirim
        //     if (this.filter.name?.trim()) {
        //         exportData.name = this.filter.name.trim();
        //     }
        //     if (this.filter.month) {
        //         exportData.month = this.filter.month;
        //     }
        //     if (this.filter.study_program?.trim()) {
        //         exportData.study_program = this.filter.study_program.trim();
        //     }

        //     console.log("Export Data:", exportData); // 🔹 Debugging untuk memastikan filter benar

        //     axios({
        //         url: this.route("teacherattendance.export"),
        //         method: "POST",
        //         data: exportData,
        //         headers: {
        //             "X-CSRF-TOKEN": document
        //                 .querySelector('meta[name="csrf-token"]')
        //                 .getAttribute("content"),
        //             "Content-Type": "application/json",
        //         },
        //         responseType: "blob", // 🔹 Agar menerima file sebagai respons
        //     })
        //         .then((response) => {
        //             try {
        //                 let blob = new Blob([response.data]);
        //                 let fileURL = window.URL.createObjectURL(blob);
        //                 let fileLink = document.createElement("a");
        //                 fileLink.href = fileURL;

        //                 // 🔹 Nama file sesuai filter
        //                 let fileName = `teacherattendance-report-${encodeURIComponent(
        //                     this.filter.study_program || "all"
        //                 )}-${encodeURIComponent(
        //                     this.filter.month || "unknown"
        //                 )}.xlsx`;

        //                 fileLink.setAttribute("download", fileName);
        //                 document.body.appendChild(fileLink);
        //                 fileLink.click();
        //                 document.body.removeChild(fileLink);
        //                 window.URL.revokeObjectURL(fileURL);
        //             } catch (error) {
        //                 console.error("Error saat mengunduh file:", error);
        //             }
        //         })
        //         .catch((error) => {
        //             console.error("Export gagal:", error);
        //             alert("Terjadi kesalahan saat mengunduh file.");
        //         })
        //         .finally(() => {
        //             this.loading = false;
        //             this.visible = false;
        //         });
        // },

        exportAttendance() {
            this.loading = true;

            let exportData = {
                start_date: this.filter.start_date,
                end_date: this.filter.end_date,
            };

            if (this.filter.name?.trim()) {
                exportData.name = this.filter.name.trim();
            }
            if (this.filter.course) {
                exportData.course = this.filter.course;
            }
            if (this.filter.study_program?.trim()) {
                exportData.study_program = this.filter.study_program.trim();
            }

            axios({
                url: this.route("teacherattendance.export"),
                method: "POST",
                data: exportData,
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/json",
                },
                responseType: "blob",
            })
                .then((response) => {
                    let blob = new Blob([response.data]);
                    let fileURL = window.URL.createObjectURL(blob);
                    let fileLink = document.createElement("a");
                    fileLink.href = fileURL;

                    let fileName = `teacherattendance-${this.filter.start_date}_to_${this.filter.end_date}.xlsx`;

                    fileLink.setAttribute("download", fileName);
                    document.body.appendChild(fileLink);
                    fileLink.click();
                    document.body.removeChild(fileLink);
                    window.URL.revokeObjectURL(fileURL);
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
