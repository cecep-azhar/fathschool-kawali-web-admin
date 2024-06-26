<template>
    <AppLayout :title="__('Online Class List')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Online Class-List')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Online Class') }}
                <span class="bg-blue-500 px-1 text-white text-xs">
                    {{ online_classes.total }}
                </span>
                <template #content>
                    <global-button :loading="loading" @click="createNewClass = !createNewClass" type="button"
                        theme="primary">
                        {{ __('Create New Class') }}
                    </global-button>
                </template>
            </page-header>
            <div class="mb-3 ml-0.5">
                <form class="grid grid-cols-1 xl:grid-cols-4 gap-6 items-left" @submit.prevent="filterData()">
                    <div>
                        <global-input id="search" v-model="filter.keyword" type="search"
                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Keyword')" :error="$page.props.errors.keyword" />
                    </div>
                    <div>
                        <Multiselect id="course" :close-on-select="true" :can-clear="true" :searchable="true"
                            v-model="filter.course" :create-option="false" :placeholder="__('Select Course')" :options="courses && courses.map(item => ({
                                value: item.id,
                                label: item.name
                            }))" autocomplete="off" />
                    </div>
                    <div>
                        <Multiselect id="subject" :close-on-select="true" :can-clear="true" :searchable="true"
                            v-model="filter.subject" :create-option="false" :placeholder="__('Select Subject')" :options="subjects && subjects.map(item => ({
                                value: item.id, label: item.name
                            }))" autocomplete="off" />
                    </div>
                    <div class="">
                        <tab-filter @setTabData="setTabValue" :filterData="filter_data ? filter_data.status : ''"
                            filter_column="status" :tab_data="[
                                { title: 'All', id: 'all', value: 'all' },
                                { title: 'Upcoming', id: 'upcoming', value: 'upcoming' },
                                { title: 'Completed', id: 'completed', value: 'completed' },
                            ]">
                            <global-button :loading="form.processing" type="submit" theme="primary"
                                class="whitespace-nowrap">
                                {{ __('Search') }}
                            </global-button>
                        </tab-filter>
                    </div>
                </form>
            </div>
            <div class="grid xl:grid-cols-3 gap-6 pt-6">
                <template v-if="online_classes.data.length != 0">
                    <div class="xl:col-span-2" :class="createNewClass ? 'xl:col-span-2' : 'xl:col-span-3'">
                        <div class="" v-for="(online_classes, index) in online_classes.data" :key="index">
                            <div class="font-bold text-xl pb-4 dark:text-gray-400"
                                :class="index == 'Completed Class' ? 'mt-4' : ''">
                                {{ index }}
                            </div>
                            <div class="grid 2xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
                                <single-online-class :editFunction="edit" :item="item" v-for="item in online_classes"
                                    :key="item.id" />
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <pagination class="mt-6" :links="online_classes.links" />
                        </div>
                    </div>
                </template>
                <template v-else>
                    <NothingFound asShow="div" cssClass="text-center col-span-3" />
                </template>
                <div v-if="createNewClass" class="bg-white dark:bg-gray-800 p-3 rounded-md">
                    <div class="text-lg dark:text-gray-400 font-bold px-4 mb-3 mt-3">{{ __('Create New Class') }}</div>
                    <!-- Content -->
                    <form @submit.prevent="submit()" class="w-full px-4 dark:border-gray-700 rounded-lg">
                        <div class="mb-3">
                            <global-label for="topic" value="Topic" :required="true" />
                            <global-input type="text" v-model="form.topic" id="topic" name="topic"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Topic')" :error="$page.props.errors.topic" />
                            <input-error :error="$page.props.errors.topic" />
                        </div>
                        <div class="mb-3">
                            <global-label for="start_date" value="Start Date" :required="true" />
                            <a-date-picker :show-time="{ format: 'HH:mm' }" v-model:value="start_date_value" id="start_date"
                                class="w-full custom-input dark:bg-gray-500 dark:border-gray-700 dark:text-gray-400"
                                :format="getDateTimeFormat() + ' HH:mm:ss'" show-time
                                :placeholder="__('Select Start Date')" />
                            <input-error :error="$page.props.errors.start_date" />
                        </div>
                        <div class="mb-3">
                            <global-label for="title" value="Select Course" :required="true" />
                            <a-select :class="$page.props.errors.subject ? 'border-custom ' : ''" size="large"
                                class="width-100" v-model:value="form.course" show-search
                                :placeholder="__('Select a course')" :options="courses.map((item) => ({
                                    value: item.id,
                                    label: item.name,
                                }))
                                    " :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur"
                                @change="handleChange">
                            </a-select>
                            <input-error :error="$page.props.errors.course" />
                        </div>
                        <div class="mb-3">
                            <global-label for="title" value="Select Subject" :required="true" />
                            <a-select :class="$page.props.errors.subject ? 'border-custom ' : ''" size="large"
                                class="width-100" v-model:value="form.subject" show-search
                                :placeholder="__('Select a subject')" :options="subjects.map((item) => ({
                                    value: item.id,
                                    label: item.name,
                                }))
                                    " :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur"
                                @change="handleChange">
                            </a-select>
                            <input-error :error="$page.props.errors.subject" />
                        </div>
                        <div class="mb-3">
                            <global-label for="password" value="Class Password" :required="true" />
                            <global-input type="text" v-model="form.password" id="password" name="password"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter password')" :error="$page.props.errors.password" />
                            <input-error :error="$page.props.errors.password" />
                        </div>
                        <div class="mb-3 w-full">
                            <global-label for="status_waiting" value="Status" :required="true" />
                            <div class="flex justify-between items-center gap-2 w-full">
                                <div
                                    class="w-full flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                    <input v-model="form.status" id="status_waiting" type="radio" value="waiting"
                                        name="status"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="status_waiting"
                                        class="w-full py-2 ml-2 mr-4 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ __('Waiting') }}
                                    </label>
                                </div>
                                <div
                                    class="w-full flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                    <input v-model="form.status" id="status_upcoming" type="radio" value="upcoming"
                                        name="status"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="status_upcoming"
                                        class="w-full py-2 ml-2 mr-4 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ __('Upcoming') }}
                                    </label>
                                </div>
                                <div
                                    class="w-full flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                    <input v-model="form.status" id="status_completed" type="radio" value="completed"
                                        name="status"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="status_completed"
                                        class="w-full py-2 ml-2 mr-4 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ __('Completed') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <global-label for="description" :value="__('Class Description')" :required="false" />
                            <global-textarea v-model="form.description" id="description" name="description"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Description')" :error="$page.props.errors.description" />
                            <input-error :error="$page.props.errors.description" />
                        </div>
                        <div class="flex gap-4 mt-8">
                            <global-button cssClass="" :loading="form.processing" type="button" @click="submit()"
                                theme="primary">
                                {{ __('Save') }}
                            </global-button>
                            <global-button :loading="false" type="button" @click="createNewClass = false"
                                theme="outline-danger">
                                {{ __('Cancel') }}
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
import { PencilSquareIcon } from '@heroicons/vue/24/outline'
import Pagination from "@/Shared/Admin/Pagination.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import SingleOnlineClass from './SingleOnlineClass.vue'
import dayjs, { Dayjs } from "dayjs";
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    components: {
        AppLayout,
        ToolTip,
        PencilSquareIcon,
        Pagination,
        Multiselect,
        SingleOnlineClass,
        NothingFound
    },
    props: {
        online_classes: Object,
        filter_data: Object,
        courses: Object,
        subjects: Object,
    },
    data() {
        return {
            createNewClass: false,
            update: false,
            start_date_value: null,
            form: useForm({
                id: "",
                topic: "",
                start_date: "",
                password: "",
                description: "",
                _method: this.update ? "PUT" : "POST",
                course: null,
                subject: null,
                status: 'waiting'
            }),
            filter: useForm({
                keyword: this.filter_data.keyword ?? "",
                status: this.filter_data.status ?? "",
                course: this.filter_data.course ?? "",
                subject: this.filter_data.subject ?? "",
            }),
            tab: this.filter_data.status ?? "all",
        };
    },
    methods: {
        setTabValue(arg) {
            let column = arg['filter_column_data'] ?? '';
            let value = arg['value'] ?? '';

            this.filter[column] = value;
        },
        submit() {
            if (this.start_date_value) {
                this.form.start_date = dayjs(this.start_date_value).format(
                    "YYYY-MM-DDTHH:mm:ssZZ"
                );
            } else {
                this.form.start_date = "";
            }

            if (this.update) {
                this.form.post(this.route("online.class.update", this.form.id),
                    {
                        preserveScroll: true,
                        onSuccess: (page) => {
                            this.form.reset('id', 'topic', 'start_date', 'password', 'description', '_method', 'course', 'subject');
                            this.start_date_value = null;
                        },
                    }
                );
            } else {
                this.form.post(this.route("online.class.store"), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.form.reset('id', 'topic', 'start_date', 'password', 'description', '_method', 'course',
                            'subject');
                        this.start_date_value = null;
                    },
                });
            }
        },
        edit(arg) {
            this.form.id = arg.id;
            this.form.topic = arg.topic;
            this.form.start_date = arg.start_time;
            this.form.password = arg.password;
            this.form.description = arg.description;
            this.form._method = "PUT";
            this.form.course = arg.course_id;
            this.form.subject = arg.subject_id;
            this.form.status = arg.status;
            this.start_date_value = null;
            this.start_date_value = dayjs(arg.start_time);
            this.update = true;
            this.createNewClass = true;
        },
        filterData() {
            this.filter.get(this.route("online.class.index"));
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

.h-scroll {
    overflow: auto;
}
</style>
