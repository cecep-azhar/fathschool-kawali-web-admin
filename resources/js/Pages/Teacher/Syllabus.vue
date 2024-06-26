<template>
    <Head :title="__('Syllabus List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Syllabus List')" />
        </Breadcrumb>

        <div class="my-6">
            <page-header>{{ __('Syllabus List') }}</page-header>
            <form @submit.prevent="filterData" class="items-center grid grid-cols-1 md:grid-cols-7 gap-4">
                <div class="col-span-2">
                    <div class="relative w-full">
                        <global-input type="search" v-model="filter.title"
                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Keyword')" />
                        <button type="button"
                            class="absolute top-[1px] right-0 p-2.5 rounded-r text-gray-400 hover:text-gray-700 bg-blue-500 text-sm hover:bg-gray-400 border-l dark:border-gray-600">
                            <MagnifyingGlassIcon class="w-6 h-6 text-white font-bold" />
                        </button>
                    </div>
                </div>
                <div class="col-span-2">
                    <Multiselect v-model="filter.class" :close-on-select="true" :searchable="true" :create-option="false"
                        :placeholder="__('Select Course')" :options="classes.map(item => ({
                            value: item.slug, label: item.name
                        }))" autocomplete="off" />
                </div>
                <div class="col-span-1 text-right">
                    <global-button :loading="loading" type="submit" theme="primary">
                        {{ __('Search') }}
                    </global-button>
                </div>
            </form>
            <div class="mt-2 grid gap-6 grid-cols-1 md:grid-cols-3">
                <div class="col-span-2">
                    <global-table>
                        <template #head>
                            <th class="py-4 px-5 whitespace-nowrap">{{ __('Subject') }}</th>
                            <th class="py-4 px-5 whitespace-nowrap">{{ __('Course') }}</th>
                            <th class="py-4 px-5 whitespace-nowrap">{{ __('Syllabus') }}</th>
                            <th width="10%" class="py-4 px-5 whitespace-nowrap">{{ __('Action') }}</th>
                        </template>
                        <template #body>
                            <template v-if="syllabuses.data.length > 0">
                                <template v-for="syllabus in syllabuses.data" :key="syllabus.id">
                                    <tr
                                        class="text-left rtl:text-right border-t dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600">
                                        <td class="py-4 px-5 whitespace-nowrap">
                                            {{ syllabus.subject.name }}
                                        </td>
                                        <td class="py-4 px-5 whitespace-nowrap">
                                            {{ syllabus.class.name }}
                                        </td>
                                        <td class="py-4 px-5 whitespace-nowrap">
                                            <button @click="
                                                download(syllabus.syllabus)
                                                " class="text-blue-500 cursor-pointer">
                                                {{ __('Download Syllabus') }}
                                            </button>
                                        </td>
                                        <td class="py-4 px-5 whitespace-nowrap">
                                            <div
                                                class="flex items-start gap-2 text-gray-900 whitespace-nowrap dark:text-white">
                                                <button type="button" @click="edit(syllabus)" class="group relative" :id="'editSyllabus' + syllabus.id">
                                                    <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                                    <tool-tip text="Edit" />
                                                </button>

                                                <button type="button" @click="
                                                    destroy(syllabus.id)
                                                    " class="group relative" :id="'deleteSyllabus' + syllabus.id">
                                                    <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                                    <tool-tip :text="__('Delete')" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </template>
                            <template v-else>
                                <NothingFound asShow="tr" />
                            </template>
                        </template>
                    </global-table>
                    <template v-if="syllabuses.data.length > 0">
                        <div class="flex justify-center">
                            <pagination class="mt-6" :links="syllabuses.links" />
                        </div>
                    </template>
                </div>
                <!-- create form  -->
                <div
                    class="w-full bg-white rounded-lg dark:bg-gray-800 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <div class="p-3 text-gray-700 font-bold mt-2 ml-3 dark:text-gray-400">
                        <div v-if="update" class="flex items-center justify-between">
                            <span class="font-medium text-sm text-black dark:text-gray-400">
                                {{ __('Update Syllabus') }}
                            </span>
                            <div @click="index">
                                <back-button />
                            </div>
                        </div>
                        <span v-else class="font-medium text-sm text-black dark:text-gray-400">
                            {{ __('Create New Syllabus') }}
                        </span>
                    </div>
                    <form class="mt-2" @submit.prevent="submit()">
                        <div class="ml-6 mr-6">
                            <global-label for="class" value="Select Course" :required="true" />
                            <Multiselect id="class" v-model="form.class" :close-on-select="true" :can-clear="false"
                                :searchable="true" :create-option="false" :placeholder="__('Select Course')" :options="classes.map(item => ({
                                    value: item.id, label: item.name
                                }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.class" />
                        </div>
                        <div class="mt-3 ml-6 mr-6">
                            <global-label for="subject" value="Select Subject" :required="true" />
                            <Multiselect id="subject" v-model="form.subject" :close-on-select="true" :can-clear="false"
                                :searchable="true" :create-option="false" :placeholder="__('Select Subject')" :options="subjects_data.map(item => ({
                                    value: item.id, label: item.name
                                }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.subject" />
                        </div>
                        <div class="mt-3 ml-6 mr-6">
                            <global-label for="syllabus" value="Upload Syllabus" :required="true" />
                            <input type="file" @change="picFile($event)" id="syllabus" ref="fileInput" :class="$page.props.errors.syllabus
                                ? 'border-red-500 dark:border-red-500'
                                : ''
                                "
                                class="bg-gray-50 rounded-lg border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <input-error :error="$page.props.errors.syllabus" />
                        </div>
                        <div class="p-4 flex justify-end">
                            <global-button :loading="loading1" type="submit" cssClass="mr-2" theme="primary">
                                {{ __('Save') }}
                            </global-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import { MagnifyingGlassIcon, PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline';
import Multiselect from '@vueform/multiselect';
import '@vueform/multiselect/themes/default.css';
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    props: {
        syllabuses: Object,
        classes: Object,
        subjects: Object,
        errors: Object,
        filter_data: Object,
    },
    components: {
        AppLayout,
        TrashIcon,
        ToolTip,
        PencilSquareIcon,
        Pagination,
        MagnifyingGlassIcon,
        Multiselect,
        NothingFound
    },
    data() {
        return {
            loading: false,
            loading1: false,
            update: false,
            subjects_data: [],
            form: {
                id: "",
                teacher: this.$page.props.user.id,
                subject: "",
                class: "",
                syllabus: "",
                _method: null,
            },
            filter: {
                title: this.filter_data.title ?? "",
                class: this.filter_data.class ?? "",
                subject: this.filter_data.subject ?? "",
            },
        };
    },
    watch: {
        'form.class': {
            deep: true,
            handler(newVal, oldVal) {
                this.subject_filter(newVal);
            },
        },
    },
    mounted() {
        this.subject_filter(this.classes[0]?.id);
    },
    methods: {
        picFile(e) {
            this.form.syllabus = e.target.files[0];
        },
        subject_filter(course) {
            this.subjects_data = [];
            this.subjects.forEach(element => {
                if (element.course_id == course) {
                    this.subjects_data.push(element)
                }
            });
        },
        submit() {
            this.loading1 = true;
            if (this.update) {
                this.$inertia.post(
                    this.route("syllabus.update", this.form.id),
                    this.form,
                    {
                        onSuccess: (page) => {
                            this.index();
                        },
                        onFinish: (visit) => {
                            this.loading1 = false;
                        },
                    }
                );
            } else {
                this.$inertia.post(
                    this.route("syllabus.store"),
                    this.form,
                    {
                        onSuccess: (page) => {
                            this.index();
                        },
                        onFinish: (visit) => {
                            this.loading1 = false;
                        },
                    }
                );
            }
        },
        edit(item) {
            this.form.id = item.id;
            this.form.teacher = item.user_id;
            this.form.class = item.course_id;
            this.form.subject = item.subject_id;
            this.form._method = "PUT";
            this.update = true;
        },
        index() {
            this.$inertia.get(this.route("syllabus.index"));
        },
        destroy(arg) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(
                    this.route("syllabus.destroy", arg),
                    {
                        onSuccess: (page) => { },
                    }
                );
            } else {
                return false;
            }
        },
        filterData() {
            this.loading = true;
            this.$inertia.get(
                this.route("syllabus.index"),
                this.filter,
                {
                    onFinish: (visit) => {
                        this.loading = false;
                    },
                    preserveScroll: true,
                }
            );
        },
    },
};
</script>
<style>
</style>
