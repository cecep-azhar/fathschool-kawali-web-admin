<template>
    <AppLayout :title="__('Assignments')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Assignments')" />
        </Breadcrumb>

        <div >
            <page-header>
                {{ __('Assignment List') }}
            </page-header>
            <!-- <filter-component :teachers="teachers" :subjects="subjects" :filter_data="filter_data"
                :loading="filter.processing" @filterDataSet="filterDataSet" v-if="assignments.data.length != 0" /> -->

            <template v-if="assignments.data.length != 0">
                <template v-for="(assignments, index) in assignments.data" :key="index">
                    <div class="font-bold text-xl py-6 dark:text-gray-400">
                        {{ index }}
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
                        <template v-for="(assignment, i) in assignments" :key="i">
                            <single-assignment :submitAssignmentFunctionParent="submitAssignment"
                                :assignment="assignment" />
                        </template>
                    </div>
                </template>
            </template>
            <template v-else>
                <div class="text-center text-gray-400 text-base mt-4">
                    <NothingFound asShow="div" />
                </div>
            </template>

            <div class="flex justify-center">
                <pagination class="mt-6" :links="assignments.links" />
            </div>
            <br>
        </div>
        <!-- assignment submit modal  -->
        <file-upload-modal :show="visible" @close="closeModal">
            <template #title>
                {{ __('Submit Your Assignment') }}
            </template>

            <template #content>
                <!-- Content -->
                <global-label class="text-left" for="file" value="Select Your File" :required="true" />
                <global-input ref="file_input" type="file" @change="picFile($event)" :placeholder="__('Description')"
                    id="name" :error="$page.props.errors.file"
                    class="block w-full text-xs text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                <span class="block text-gray-500 !text-left">{{ __('Supported format') }} - png, jpg, jpeg, pdf, zip, doc, docx</span>
                <input-error :error="$page.props.errors.file" />
                <div v-if="form.file">
                    <progress class="mt-2 w-full rounded-full" v-if="form.progress" :value="form.progress.percentage"
                        max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                </div>

                <global-label for="file" value="Description" class="mt-5 text-left" />
                <global-textarea :placeholder="__('Description')" id="name" :error="$page.props.errors.description"
                    v-model="form.description"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" rows="6" />
            </template>

            <template #footer>
                <global-button :loading="false" theme="outline-danger" type="button" @click="closeModal(true)"
                    class="mr-2">
                    {{ __('Cancel') }}
                </global-button>
                <global-button :loading="form.processing" type="button" @click="upload()">
                    {{ __('Save') }}
                </global-button>
            </template>
        </file-upload-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from '@/Shared/ToolTip.vue';
import InboxOutlined from '@ant-design/icons-vue';
import FileUploadModal from '@/Shared/Modal.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import SingleAssignment from './SingleAssignment.vue'
import Pagination from '@/Shared/Admin/Pagination.vue';
import FilterComponent from '../Teacher/Assignment/Filter.vue';
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    components: {
        AppLayout,
        ToolTip,
        FilterComponent,
        Pagination,
        FileUploadModal,
        InboxOutlined,
        SingleAssignment,
        NothingFound
    },
    props: {
        assignments: Object,
        filter_data: Object,
        subjects: Array,
    },
    data() {
        return {
            visible: false,
            form: useForm({
                assignment: '',
                file: '',
                description: '',
            }),
            filter: useForm({
                keyword: this.filter_data.keyword ?? '',
                status: this.filter_data.status ?? '',
                teacher_id: this.filter_data.teacher_id ?? '',
                subject_id: this.filter_data.subject_id ?? '',
            })
        };
    },
    methods: {
        closeModal(button) {
            if (this.form.progress) {
                if (button && button != undefined) {
                    this.form.reset('file');
                    this.$refs.file_input.value = '';
                    this.visible = false;
                }
            } else {
                this.form.reset('file')
                this.$refs.file_input.value = '';
                this.visible = false;
            }
        },
        reviewMail(assignment) {
            this.$inertia.post(this.route('assignment.review.mail', assignment), {
                preserveState: true,
                onSuccess: () => form.reset('file', 'description'),
            });
        },
        picFile(e) {
            this.form.file = e.target.files[0]
        },
        submitAssignment(arg) {
            this.form.assignment = arg;
            this.visible = true;
        },
        upload() {
            this.form.post(this.route('assignment.submit'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal();
                },

            });
        },
        filterDataSet(filter) {
            this.filter.keyword = filter.keyword ?? '';
            this.filter.status = filter.status ?? '';
            this.filter.teacher_id = filter.teacher_id ?? '';
            this.filter.subject_id = filter.subject_id ?? '';
            this.filterData();
        },
        filterData() {
            this.filter.get(this.route('assignment.list'))
        }
    },
};
</script>

<style lang="scss" scoped>
</style>
