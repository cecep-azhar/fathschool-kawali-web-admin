<template>
    <AppLayout :title="__('Grade')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Grade')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400 font-semibold">
                    {{ __('Grade') }}
                </div>
            </page-header>
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mx-auto">
                <div class="xl:col-span-2">
                    <table-content @edit="edit" :grades="grades" />
                    <div class="flex justify-center">
                        <pagination class="mt-6" :links="grades.links" />
                    </div>
                </div>
                <div>
                    <div
                        class="w-full bg-white dark:bg-gray-800 rounded-lg text-sm rtl:text-right text-left text-gray-500 dark:text-gray-400">
                        <div class="p-5 text-gray-700 font-bold border-b-2 dark:border-gray-600 dark:text-gray-400">
                            <span v-if="update">
                                <div class="flex justify-between">
                                    <div>{{ __('Update') }}</div>
                                </div>
                            </span>
                            <span v-else> {{ __('Create New') }} </span>
                        </div>
                        <create-update-form :grade="grade" :update="update" />
                    </div>
                </div>
            </div>
        </div>
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
        grades: Object,
    },
    data() {
        return {
            update: false,
            grade: "",
        };
    },
    methods: {
        edit(grade) {
            this.update = true;
            this.grade = grade;
        },
    },
};
</script>
