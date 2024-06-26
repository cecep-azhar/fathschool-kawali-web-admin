<template>
    <AppLayout :title="__('Currency | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Settings')"/>
            <BreadcrumbLink :title="__('Currency')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Currency') }}
                </div>
            </page-header>

            <SettingLayout>
                <div class=" overflow-hidden">
                    <div>
                        <div>
                            <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">
                                {{ __('Currency Setting') }}
                            </h2>
                        </div>

                        <div class="grid lg:grid-cols-12 grid-cols-1 gap-8">
                            <div class="lg:col-span-8">
                                <table-content @edit="edit" :currencies="currencies" />
                                <div class="flex justify-center">
                                    <pagination class="mt-6" :links="currencies.links" />
                                </div>
                            </div>
                            <div class="lg:col-span-4">
                                <div
                                    class="w-full bg-white rounded-lg dark:bg-gray-800 text-sm rtl:text-right text-left text-gray-500 dark:text-gray-400">
                                    <div
                                        class="p-4 text-gray-700 font-bold  rounded-t-lg dark:bg-gray-800 dark:text-gray-400">
                                        <div v-if="update">
                                            <div class="flex justify-between">
                                                <div>
                                                    {{ __('Update Currency') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            {{ __('Create Currency') }}
                                        </div>
                                    </div>
                                    <create-form v-if="!update" />
                                    <update-form :currency="currency" v-if="update" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </SettingLayout>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingLayout from '@/Layouts/SettingLayout.vue';
import TableContent from "@/Shared/Admin/Setting/Currency/Table.vue";
import CreateForm from "@/Shared/Admin/Setting/Currency/CreateForm.vue";
import UpdateForm from "@/Shared/Admin/Setting/Currency/UpdateForm.vue";
import { ArrowRightIcon } from "@heroicons/vue/24/outline";

export default {
    props: {
        currencies: Array
    },
    data() {
        return {
            update: false,
            currency: "",
        }

    },
    components: {
        AppLayout,
        SettingLayout,
        TableContent,
        CreateForm,
        UpdateForm,
        ArrowRightIcon
    },

    methods: {
        edit(currency) {
            this.update = true;
            this.currency = currency;
        },
    },
}
</script>
