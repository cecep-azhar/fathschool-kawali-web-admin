<template>
    <Head :title="__('Attendance List')" />

    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Attendance List')"/>
        </Breadcrumb>

        <div>
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Attendance List') }}
                </div>
            </page-header>
            <div class="ml-0.5 my-5" v-if="attendances.length > 0">
                <form class="grid grid-cols-1 md:grid-cols-7 gap-6 items-center" @submit.prevent="filterData()">
                    <div class="col-span-2">
                        <Multiselect v-model="filter.subject_id" :close-on-select="true" :searchable="true" :create-option="false" :placeholder="__('Select Subject')" :options="subject_data" autocomplete="off" />
                    </div>
                    <div class="col-span-2">
                        <global-button :loading="filter.processing" type="submit" theme="primary">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <div class="w-full">
                <div class="sm:px-6 lg:px-8">
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <div class="overflow-hidden w-full">
                                    <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="py-4 px-5 whitespace-nowrap text-left rtl:text-right text-sm font-semibold text-gray-900 dark:text-gray-400 sm:pl-6">{{ __('Date') }}</th>
                                            <th scope="col" class="py-4 px-5 whitespace-nowrap text-left rtl:text-right text-sm font-semibold text-gray-900 dark:text-gray-400">{{ __('Teacher') }}</th>
                                            <th scope="col" class="py-4 px-5 whitespace-nowrap text-left rtl:text-right text-sm font-semibold text-gray-900 dark:text-gray-400">{{ __('Total Class') }}</th>
                                            <th scope="col" class="py-4 px-5 whitespace-nowrap text-left rtl:text-right text-sm font-semibold text-gray-900 dark:text-gray-400">{{ __('Present Class') }}</th>
                                            <th scope="col" class="py-4 px-5 whitespace-nowrap text-left rtl:text-right text-sm font-semibold text-gray-900 dark:text-gray-400">{{ __('Present Rate') }}</th>
                                            <th scope="col" class="py-4 px-5 whitespace-nowrap text-left rtl:text-right text-sm font-semibold text-gray-900 dark:text-gray-400">{{ __('Export Sheet') }}</th>
                                        </tr>
                                        </thead>
                                            <template v-if="attendances.length > 0">
                                                <tbody class="bg-white dark:bg-gray-800" v-for="(subjectAttendance,index) in attendances" :key="index">
                                                    <tr class="border-t border-gray-200">
                                                        <th colspan="5" scope="colgroup" class="bg-gray-50 dark:bg-gray-700 px-5 py-2 text-left text-sm font-semibold text-gray-900 dark:text-gray-400 sm:px-6">{{ subjectAttendance[0].subject.name }}</th>
                                                        <th colspan="1" scope="colgroup" class="bg-gray-50 dark:bg-gray-700 px-5 py-2 text-right text-sm font-semibold text-gray-900 dark:text-gray-400 sm:px-6">
                                                            <global-button @click="showExportModal(subjectAttendance[0].subject)" :loading="false" type="button" theme="primary">
                                                                Export
                                                            </global-button>
                                                        </th>
                                                    </tr>
                                                    <template v-if="subjectAttendance && subjectAttendance.length">
                                                        <tr class="border-t border-gray-300" v-for="(studentAttendance, i) in subjectAttendance" :key="i">
                                                            <td class="whitespace-nowrap py-4 px-5 text-sm font-medium text-gray-900 dark:text-gray-400">
                                                                {{ studentAttendance.date_time }}
                                                            </td>
                                                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-500">{{ studentAttendance.teacher.name }}</td>
                                                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-500"> {{ studentAttendance.total_class }}</td>
                                                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-500"> {{ studentAttendance.present_days }}</td>
                                                            <td colspan="2" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> {{ studentAttendance.present_percentage }} %</td>
                                                        </tr>
                                                    </template>
                                                    <div v-else>
                                                        <tr>
                                                            <td colspan="10" class="text-center p-4">No Attendance Found</td>
                                                        </tr>
                                                    </div>
                                                </tbody>
                                            </template>
                                            <template v-else>
                                                <NothingFound asShow="tr" />
                                            </template>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Export Modal  -->
        <export-modal :show="visible" @close="closeModal">
            <template #title>
                {{ __('Export Data') }}
            </template>

            <template #content>
                <!-- Content -->
                <div class="flex gap-6">
                    <div
                        class="w-full rounded-lg cursor-pointer flex items-center pl-4 border border-gray-200 dark:border-gray-700">
                        <input value="xlsx" id="excel" v-model="exportData.type" type="radio" name="export_type"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        <global-label for="excel"
                            class="py-3 ml-2 cursor-pointer w-full text-sm font-medium text-gray-900 dark:text-gray-400"
                            value="Excel" :required="false" />
                    </div>
                    <label for="pdf"
                        class="w-full cursor-pointer rounded-lg flex items-center pl-4 border border-gray-200 dark:border-gray-700">
                        <input value="pdf" id="pdf" v-model="exportData.type" type="radio" name="export_type"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        <global-label for="pdf"
                            class="py-3 ml-2 w-full text-sm font-medium cursor-pointer text-gray-900 dark:text-gray-400"
                            value="PDF" :required="false" />
                    </label>
                </div>
            </template>

            <template #footer>
                <global-button @click="exportSubmit()" :loading="loading" type="button" theme="primary" class="mr-2">
                    {{ __('Export') }}
                </global-button>
                <global-button :loading="false" @click="visible = false" type="button" theme="outline-danger">
                    {{ __('Cancel') }}
                </global-button>
            </template>
        </export-modal>
        <!-- Data Export Modal End -->
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from '@inertiajs/inertia-vue3';
import Multiselect from '@vueform/multiselect'
import ExportModal from '@/Shared/Modal.vue';
import '@vueform/multiselect/themes/default.css';
import NothingFound from '@/Shared/NothingFound.vue';
export default {
    props: {
        attendances: Object,
        filter_data: Object,
        subjects: Array,
    },
    components: {
        AppLayout,
        Multiselect,
        useForm,
        ExportModal,
        NothingFound
    },
    data() {
        return {
            subject_data: [],

            filter: useForm({
                keyword: this.filter_data.keyword ?? '',
                status: this.filter_data.status ?? '',
                subject_id: this.filter_data.subject_id ?? '',
            }),
            loading: false,
            visible:false,
            exportData:{
                type: 'xlsx',
                subject: ''
            }
        };
    },
    methods: {
        getSubject() {
            var items = [];
            this.subjects.forEach(item => {
                items.push({
                    value: item.id,
                    label: item.name,
                });
            });
            this.subject_data = items;
        },
        filterData(){
            this.filter.get(this.route('my.attendance'))
        },
        showExportModal(arg) {
            this.exportData.subject = arg;
            this.visible = true;
        },
        exportSubmit(arg){

            this.loading = true;
            axios({
                url: this.route('attendance.export'),
                method: "POST",
                data: this.exportData,
                responseType: "blob",
            }).then((response) => {

                let extension = this.exportData.type;

                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement("a");

                fileLink.href = fileURL;
                fileLink.setAttribute("download", "attendance-report." + extension);
                document.body.appendChild(fileLink);

                fileLink.click();

                this.loading = false;
                this.visible = false;
            }).catch((e) => {
                this.loading = false;
                this.visible = false;
            });
        }
    },
    mounted() {
        this.getSubject();
    }
};
</script>

