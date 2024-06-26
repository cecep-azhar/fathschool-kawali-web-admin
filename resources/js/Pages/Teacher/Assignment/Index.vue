<template>
    <Head :title="__('Assignment List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Assignment List')" />
        </Breadcrumb>
        <page-header>
            {{ __('Assignment List') }}
            <template #content>
                <global-button :loading="false" type="button" @click="showModal()" theme="primary">
                    {{ __('Create New Assignment') }}
                </global-button>
            </template>
        </page-header>
        <div class="my-2">
            <filter-component :subjects="subjects" :filter_data="request_data" :loading="filter.processing"
                @filterDataSet="filterDataSet" />

            <template v-if="assignments.data.length != 0">
                <template v-for="(assignments, index) in assignments.data" :key="index">
                    <div class="font-bold text-xl py-6 dark:text-gray-400">
                        {{ index }}
                    </div>

                    <div class="w-full grid grid-cols-1  md:grid-cols-2 xl:grid-cols-3  2xl:grid-cols-4 gap-4">
                        <div class="bg-white dark:bg-gray-800 dark:text-gray-400 rounded-lg relative group"
                            v-for="assignment in assignments" :key="assignment.id">
                            <single-assignment :assignment="assignment" />

                            <div
                                class="flex gap-1 items-center justify-center bg-black opacity-0 group-hover:opacity-100 duration-300 absolute z-50 left-0 top-0 bottom-0 right-0 rounded-md">
                                <Link preserve-scroll :href="route('assignment.details', assignment.slug)">
                                <button type="button" class="bg-white relative rounded-full p-1.5" :id="assignment ? 'viewAssignment' + assignment.id : ''">
                                    <eye-icon class="w-6 h-6 z-60 text-blue-500" />
                                </button>
                                </Link>
                                <button @click="edit(assignment)" type="button" class="bg-white relative rounded-full p-1.5" :id="assignment ? 'editAssignment' + assignment.id : ''">
                                    <PencilSquareIcon class="w-6 h-6 z-60 text-purple-500" />
                                </button>
                                <button @click="destroy(assignment.id)" type="button" class="bg-white relative rounded-full p-1.5" :id="assignment ? 'deleteAssignment' + assignment.id : ''">
                                    <trash-icon class="w-6 h-6 z-60 text-red-500" />
                                </button>
                            </div>

                        </div>
                    </div>

                </template>
            </template>

            <template v-else>
                <div class="col-span-4 text-center">
                    <NothingFound cssClass="text-center" asShow="div" />
                </div>
            </template>
            <div class="flex justify-center">
                <pagination class="mt-6" :links="assignments.links" />
            </div>
        </div>
        <!-- Modal For Create N Update -->
        <a-modal v-model:visible="visible" width="400px" :title="update ? __('Update Assignment') : __('Assignment Create')"
            @ok="handleOk">
            <template #footer>
                <div class="flex gap-2">
                    <global-button :loading="loading" type="button" @click="submit" theme="primary">
                        {{ __('Save') }}
                    </global-button>
                    <global-button :loading="false" type="button" @click="handleOk" theme="outline-danger">
                        {{ __('Cancel') }}
                    </global-button>
                </div>
            </template>
            <form class="dark:bg-gray-800 rounded-lg">
                <div>
                    <global-label for="class" value="Select Course" :required="true" />
                    <select v-model="form.class" id="class" :class="
                        $page.props.errors.class
                            ? 'border-red-500 dark:border-red-500'
                            : ''
                    "
                        class="bg-gray-50 rounded-lg border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled value="">
                            {{ __("Select Course") }}
                        </option>
                        <option v-for="course in classes" :key="course" :value="course.id">
                            {{ course.name }}
                        </option>
                    </select>
                    <input-error :error="$page.props.errors.class" />
                </div>
                <div class="mt-3 ">
                    <global-label for="subject" value="Select Subject" :required="true" />
                    <select v-model="form.subject" id="subject" :class="
                        $page.props.errors.subject
                            ? 'border-red-500 dark:border-red-500'
                            : ''
                    "
                        class="bg-gray-50 rounded-lg border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled value="">
                            {{ __("Select Subject") }}
                        </option>
                        <option v-for="subject in subjects" :key="subject" :value="subject.id">
                            {{ subject.name }}
                        </option>
                    </select>
                    <input-error :error="$page.props.errors.subject" />
                </div>
                <div class="mt-3 mb-1 ">
                    <global-label for="title" value="Title" :required="true" />
                    <global-input type="text" v-model="form.title" id="title" name="title"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                        :placeholder="__('Assignment Title')" :error="$page.props.errors.title" />
                    <input-error :error="$page.props.errors.title" />
                </div>
                <div class="mt-3 mb-1 ">
                    <global-label for="date" value="Date" :required="true" />
                    <a-range-picker :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                        class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="form.date"
                        :format="customDateFormat" />
                    <input-error :error="$page.props.errors.date" />
                </div>
                <div class="mt-3 mb-1 ">
                    <global-label for="mark" value="Mark" :required="true" />
                    <global-input type="number" v-model="form.mark" id="mark" name="mark"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                        :placeholder="__('Assignment mark')" :error="$page.props.errors.mark" />
                    <input-error :error="$page.props.errors.mark" />
                </div>
                <div class="mt-3 mb-1 ">
                    <global-label for="description" value="Description" :required="false" />
                    <global-textarea v-model="form.description" id="description" name="description"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                        :placeholder="__('Description')" :error="$page.props.errors.description" />
                    <input-error :error="$page.props.errors.description" />
                </div>
            </form>
        </a-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import dayjs, { Dayjs } from "dayjs";
import { PencilSquareIcon, EyeIcon, TrashIcon } from '@heroicons/vue/24/outline'
import Pagination from "@/Shared/Admin/Pagination.vue";
import { Progress, Tooltip } from "ant-design-vue";
import SingleAssignment from '../../Student/SingleAssignment.vue'
import FilterComponent from './Filter.vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    props: {
        assignments: Object,
        subjects: Object,
        classes: Object,
        errors: Object,
        request_data: Object,
    },
    components: {
        AppLayout,
        FilterComponent,
        PencilSquareIcon,
        SingleAssignment,
        EyeIcon,
        TrashIcon,
        Pagination,
        "a-progress": Progress,
        "a-tooltip": Tooltip,
    },
    data() {
        return {
            loading: false,
            customDateFormat: "DD-MM-YYYY",
            visible: false,
            update: false,
            form: {
                id: "",
                teacher: this.$page.props.auth.id,
                subject: "",
                class: "",
                title: "",
                date: "",
                date2: "",
                mark: "",
                description: "",
                _method: null,
            },
            filter: useForm({
                keyword: this.request_data.keyword ?? '',
                status: this.request_data.status ?? '',
                subject_id: this.request_data.subject_id ?? '',
            })
        };
    },
    mounted() {
        if (this.route().params.id) {
            this.assignments.data.forEach((element) => {
                if (element.id == this.route().params.id) {
                    this.edit(element);
                }
            });
        }
    },
    watch: {
        update: {
            deep: true,
            handler(val, oldVal) {
                if (this.visible == false) {
                    this.update = false;
                }
            },
        },
    },
    methods: {
        showModal() {
            this.visible = true;
        },
        handleOk() {
            if (this.route().params.id) {
                this.$inertia.get(route("assignment.index"));
            }
            this.visible = false;
        },
        filterDataSet(filter) {
            this.filter.keyword = filter.keyword ?? '';
            this.filter.status = filter.status ?? '';
            this.filter.subject_id = filter.subject_id ?? '';
            this.filterData();
        },
        filterData() {
            this.filter.get(this.route('assignment.index'))
        },
        submit() {
            this.loading = true;
            let start = dayjs(this.form.date[0]).format("YYYY-MM-DD");
            let end = dayjs(this.form.date[1]).format("YYYY-MM-DD");

            this.form.date2 = [start, end];

            if (this.update) {
                this.$inertia.post(
                    this.route("assignment.update", this.form.id),
                    this.form,
                    {
                        onSuccess: (page) => {
                            this.reset();
                        },
                        onFinish: (visit) => {
                            this.loading = false;
                        },
                    }
                );
            } else {
                this.$inertia.post(
                    this.route("assignment.store"),
                    this.form,
                    {
                        onSuccess: (page) => {
                            this.reset();
                        },
                        onFinish: (visit) => {
                            this.loading = false;
                        },
                    }
                );
            }
        },
        edit(arg) {
            this.form.id = arg.id;
            this.form.teacher = arg.user_id;
            this.form.subject = arg.subject_id;
            this.form.class = arg.course_id;
            this.form.title = arg.title;
            this.form.mark = arg.mark;
            this.form.description = arg.description;
            this.form._method = "PUT";
            this.form.date = [
                dayjs(arg.start_date, this.customDateFormat),
                dayjs(arg.end_date, this.customDateFormat),
            ];
            this.form.date2 = [arg.start_date, arg.end_date];
            this.update = true;
            this.visible = true;
        },
        destroy(arg) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(
                    this.route("assignment.destroy", arg)
                );
            } else {
                return false;
            }
        },
        reset() {
            this.$inertia.get(route("assignment.index"));
        },
    },
};
</script>
<style scoped>
.custom-input {
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}
</style>
