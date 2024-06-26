<template>
    <AppLayout :title="__('Exam')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Exam')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="dark:text-gray-400 font-semibold">
                    {{ __('Exam') }}
                </div>
                <template #content>
                    <div class="flex items-center gap-1">
                        <global-button type="button" @click="visible = true" theme="secondary">
                            {{ __('Exam Grade Rules') }}
                        </global-button>
                        <global-button type="link" :url="route('exam.create')" theme="primary" id="createExamButton">
                            {{ __('Create Exam') }}
                        </global-button>
                    </div>
                </template>
            </page-header>
            <div class="xl:col-span-3 overflow-auto">
                <table-content @edit="edit" :exams="exams" />
                <div class="flex justify-center">
                    <pagination class="mt-6" :links="exams.links" />
                </div>
            </div>
        </div>

        <a-modal v-model:visible="visible" :title="__('Exam Grade Rules')" @ok="hide">
            <template #footer>
                <a-button key="back" @click="saveData">{{ __('Save') }}</a-button>
            </template>
            <div class="dark:bg-gray-800 rounded-lg dark:text-gray-400">
                <div class="w-full">
                    <div class="bg-white dark:bg-gray-800 rounded-lg">
                        <div class="mb-3">
                            <global-label class="text-lg text-gray-900 mb-3" for="comment" :value="__('Key to Grades')"
                                :required="true" />
                            <global-textarea :placeholder="__('Key to Grades')" v-model="form.grades" rows="3"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                            </global-textarea>
                        </div>
                        <div class="mb-3">
                            <global-label class="text-lg text-gray-900 mb-3" for="comment" :value="__('Grade Summary')"
                                :required="true" />
                            <global-textarea :placeholder="__('Grade Summary')" v-model="form.grades_summary" rows="3"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                            </global-textarea>
                        </div>
                    </div>
                </div>
            </div>
        </a-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import TableContent from "./Table.vue";
import CreateUpdateForm from "./Form.vue";

export default {
    components: {
        AppLayout,
        Pagination,
        TableContent,
        CreateUpdateForm,
    },
    props: {
        exams: Object,
        courses: Object,
    },
    data() {
        return {
            update: false,
            exam: "",
            visible: false,
            form: this.$inertia.form({
                grades: this.$page.props.setting.key_to_grades,
                grades_summary: this.$page.props.setting.grade_summary,
            }),
        };

    },
    methods: {
        edit(exam) {
            this.update = true;
            this.exam = exam;
        },
        hide() {
            this.visible = false
        },
        saveData() {
            this.form.put(route('settings.exam.grade.update'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.visible = false
                },
            });
        }
    },
};
</script>
