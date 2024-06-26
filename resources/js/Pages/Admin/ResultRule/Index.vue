<template>
    <AppLayout :title="__('Result Rule')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Result Rule')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400 font-semibold">
                    {{ __('Result Rule') }}
                </div>
            </page-header>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mx-auto">
                <div class="md:col-span-2">
                    <table-content @edit="edit" :rules="rules" />
                    <div class="flex justify-center">
                        <pagination class="mt-6" :links="rules.links" />
                    </div>
                </div>
                <div class="md:col-span-1">
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
                        <update-form :rule="rule" v-if="update" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import TableContent from "@/Shared/Admin/ResultRule/Table.vue";
import CreateForm from "@/Shared/Admin/ResultRule/CreateForm.vue";
import UpdateForm from "@/Shared/Admin/ResultRule/UpdateForm.vue";

export default {
    components: {
        AppLayout,
        Pagination,
        TableContent,
        CreateForm,
        UpdateForm,
    },
    props: {
        rules: Object,
    },
    data() {
        return {
            update: false,
            rule: "",
        };
    },
    methods: {
        edit(rule) {
            this.update = true;
            this.rule = rule;
        },
    },
};
</script>
