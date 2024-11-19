<template>
    <AppLayout :title="__('Departments')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Departments') "/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400 font-semibold">
                    {{ __('Departments') }}
                </div>
            </page-header>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mx-auto">
                <div>
                    <table-content @edit="edit" :departments="departments" />
                    <div class="flex justify-center">
                        <pagination class="mt-6" :links="departments.links" />
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
                        <create-form :study_programs="study_programs" v-if="!update" />
                        <update-form :department="department" v-if="update" :study_programs="study_programs" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import TableContent from "@/Shared/Admin/Department/Table.vue";
import CreateForm from "@/Shared/Admin/Department/CreateForm.vue";
import UpdateForm from "@/Shared/Admin/Department/UpdateForm.vue";

export default {
    components: {
        AppLayout,
        Pagination,
        TableContent,
        CreateForm,
        UpdateForm,
    },
    props: {
        departments: Object,
        study_programs: Object,
    },
    data() {
        return {
            update: false,
            department: "",
        };
    },
    methods: {
        edit(department) {
            this.update = true;
            this.department = department;
        },
    },
};
</script>
