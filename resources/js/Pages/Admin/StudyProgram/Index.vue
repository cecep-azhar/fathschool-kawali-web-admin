<template>
    <AppLayout :title="__('Study Programs')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Study Programs') "/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400 font-semibold">
                    {{ __('Study Program') }}
                </div>
            </page-header>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mx-auto">
                <div>
                    <table-content @edit="edit" :study_programs="study_programs" />
                    <div class="flex justify-center">
                        <pagination class="mt-6" :links="study_programs.links" />
                    </div>
                </div>
                <div >
                    <div
                        class="w-full bg-white rounded-lg dark:bg-gray-800 text-sm rtl:text-right text-left text-gray-500 dark:text-gray-400">
                        <div
                            class="p-4 text-gray-700 font-bold border-b-2 dark:border-gray-600 rounded-t-lg dark:bg-gray-800 dark:text-gray-400">
                            <div v-if="update">
                                <div class="flex justify-between">
                                    <div>{{ __('Update') }}</div>
                                </div>
                            </div>
                            <div v-else>{{ __('Create New') }}</div>
                        </div>
                        <create-form v-if="!update" />
                        <update-form :study_program="study_program" v-if="update" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import TableContent from "@/Shared/Admin/StudyProgram/Table.vue";
import CreateForm from "@/Shared/Admin/StudyProgram/CreateForm.vue";
import UpdateForm from "@/Shared/Admin/StudyProgram/UpdateForm.vue";

export default {
    components: {
        AppLayout,
        Pagination,
        TableContent,
        CreateForm,
        UpdateForm,
    },
    props: {
        study_programs: Object,
    },
    data() {
        return {
            update: false,
            study_program: "",
        };
    },
    methods: {
        edit(study_program) {
            this.update = true;
            this.study_program = study_program;
        },
    },
};
</script>
