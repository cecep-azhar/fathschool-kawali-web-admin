<template>
    <Head :title="__('Subject List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Subject')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __('Subject') }}
                </div>

            </page-header>

            <div class="mb-3" v-if="subjects.data.length > 0">
                <form class="flex gap-6 sm:items-end flex-col sm:flex-row" @submit.prevent="filterData()">
                    <div class="lg:w-1/4 sm:w-1/3 w-full">
                        <global-label for="class" value="Course" :required="false" />
                        <Multiselect id="class" :close-on-select="true" :can-clear="true" :searchable="true"
                            v-model="filter.course_id" :create-option="false" :placeholder="__('Select Course')" :options="
                                classes.map((item) => ({
                                    value: item.id,
                                    label: item.name,
                                }))
                            " autocomplete="off" />
                    </div>

                    <div class="inline-flex lg:w-1/4 sm:w-1/3 w-full">
                        <global-button :loading="filter.processing" type="submit" theme="primary">
                            {{ __('Filter Search') }}
                        </global-button>
                    </div>
                </form>
            </div>

            <div class="grid gap-6 grid-cols-1 xl:grid-cols-4 md:grid-cols-2">
                <div class="col-span-1 xl:col-span-3 auto-rows-min">
                    <div v-if="subjects.data.length > 0">
                        <div class="grid gap-6 grid-cols-1 xl:grid-cols-3">
                            <div class="card bg-white rounded-lg dark:bg-gray-800 dark:text-gray-400"
                                v-for="(subject, index) in subjects.data" :key="index">
                                <single-subject @edit="edit(subject)" :subject="subject" />
                            </div>
                        </div>
                    </div>
                    <div v-else class="text-center card bg-white dark:bg-gray-800 dark:text-white">
                        <div class="flex justify-center px-6 pt-6 pb-2.5">
                            <h2 class="text-gray-900 dark:text-gray-400">
                                <NothingFound asShow="div" />
                            </h2>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-center">
                            <pagination class="mt-6" :links="subjects.links" />
                        </div>
                    </div>
                </div>

                <div>
                    <div class="bg-white rounded-lg dark:bg-gray-800">
                        <h2 class="p-3.5 text-gray-900 dark:text-gray-400 text-base font-bold">
                            <span v-if="update">
                                <div class="flex justify-between">
                                    <div>
                                        {{ __('Update Subject') }}
                                    </div>
                                </div>
                            </span>
                            <span v-else>
                                {{ __('Create New Subject') }}
                            </span>
                        </h2>
                        <hr class="dark:border-gray-700" />
                        <create-form :classes="classes" v-if="!update" />
                        <update-form :classes="classes" v-if="update" :subject="subject" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import CreateForm from "@/Shared/Admin/Subject/CreateForm.vue";
import SingleSubject from "@/Shared/Admin/Subject/SingleSubject.vue";
import UpdateForm from "@/Shared/Admin/Subject/UpdateForm.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    components: {
        Multiselect,
        NothingFound,
        Pagination,
        AppLayout,
        SingleSubject,
        CreateForm,
        UpdateForm,
    },
    props: {
        subjects: Object,
        errors: Object,
        classes: Object,
        query: Object,
    },
    data() {
        return {
            filter: useForm({
                course_id: this.query.course_id ?? null,
            }),
            update: false,
            subject: "",
        };
    },
    methods: {
        edit(payload) {
            this.subject = payload;
            this.update = true;
        },
        filterData() {
            this.filter.get(this.route("subjects.index"), {
                preserveScroll: true,
            });
        },
    },
};
</script>
