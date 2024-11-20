<template>
    <AppLayout :title="__('Teacher Attendance')">
        <template #header>
            {{ __("Teacher Attendance") }}
        </template>
        <Breadcrumb>
            <BreadcrumbLink
                :title="__('Teacher Attendance')"
                :href="route('teacher.class')"
            />
        </Breadcrumb>
        <div>
            <page-header class="flex-col sm:flex-row">
                {{ __("Teacher Attendance") }}
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
            <global-table>
                <template #head>
                    <th class="py-4 px-5">{{ __("Name") }}</th>
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
                                    {{ attendance.user.name }}
                                </td>
                                <td
                                    class="py-4 px-5 text-gray-900 dark:text-white"
                                >
                                    <template
                                        v-if="
                                            attendance.user.department &&
                                            attendance.user.department
                                                .study_program
                                        "
                                    >
                                        <div class="font-bold">
                                            {{
                                                attendance.user.department
                                                    .study_program.name
                                            }}
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
                            <td colspan="6" class="text-center p-4">
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
        filter_data: Object,
        study_programs: Object,
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
                study_program: this.filter_data.study_program ?? null,
            },
        };
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
    },
    methods: {
        // Metode untuk meng-handle submit filter
        filterData() {
            this.loading = true;
            if (this.filter.month !== "") {
                const filterDate = this.filter.month;
                this.filter.month = filterDate;
            }
            this.$inertia.get(this.route("teacher.attendance"), this.filter, {
                preserveScroll: true,
                onFinish: (visit) => {
                    this.loading = false;
                    this.attendanceteacher = this.filteredAttendance;
                },
            });
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
                        "teacherattendance-report." + "xlsx"
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
