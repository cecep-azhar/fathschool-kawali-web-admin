<template>
    <AppLayout :title="__('Student Enrollment Report')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('reports.index')" title="Report" />
            <BreadcrumbLink :title="__('Student Enrollment Report')" />
        </Breadcrumb>

        <div class="py-12">
            <div
                class="mb-3 rounded-lg py-4 font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                <page-header class="flex justify-between items-center">
                    <div>
                        <h1 class="dark:text-gray-400 mb-0 text-2xl">
                            {{ __('Student Enrollment') }}
                        </h1>
                    </div>
                </page-header>
                <form class="grid grid-cols-1 md:grid-cols-8 gap-2 items-center px-6" @submit.prevent="exportSubmit()">
                    <div class="col-span-2">
                        <global-label for="year" value="Year" />
                        <div class="flex gap-3">
                            <a-date-picker size="large" :placeholder="__('Select Year')" picker="year" v-model:value="year"
                                format="YYYY" style="width: 400px" @change="handleYearSelection" />
                        </div>
                    </div>
                    <div class="col-span-2">
                        <global-button :loading="loading"
                            class="text-white mt-6 bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-300">
                            {{ __('Export') }}
                        </global-button>
                    </div>
                </form>
            </div>

            <!-- Individual report  -->
            <div class="text-center mt-52">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                    <NothingFound asShow="div" />
                </h3>
            </div>
        </div>
        <!-- Data Export Modal End -->
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from 'axios'; // Import axios library
import Multiselect from '@vueform/multiselect'
import { useForm } from "@inertiajs/inertia-vue3";
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    components: {
        AppLayout,
        Multiselect,
        NothingFound
    },
    props: {

    },
    data() {
        return {
            filter: useForm({
                year: '',
            }),

            visible: false,
            loading: false,
            export_data: {
                year: '',
                type: '',
            },
        };
    },
    methods: {
        exportSubmit() {
            this.loading = true;
            this.export_data.year = this.filter.year;
            axios({
                url: this.route('report.studentEnroll.export'),
                method: "POST",
                data: this.export_data,
                responseType: "blob",
            }).then((response) => {

                let extension = this.export_data.type;

                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement("a");

                fileLink.href = fileURL;
                fileLink.setAttribute("download", "student_enrollment_report.pdf");
                document.body.appendChild(fileLink);

                fileLink.click();

                fileLink.remove();
                this.loading = false;
                this.visible = false;
            }).catch((e) => {
                this.loading = false;
                this.visible = false;
            });
        },

        handleYearSelection() {
            const selectedYear = this.year.$y;
            this.filter.year = selectedYear;
        },
    },

};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
