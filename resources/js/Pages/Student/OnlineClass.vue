<template>
    <AppLayout :title="__('Online Class List')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Online Class List')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Online Class') }}
                    <span class="bg-blue-500 px-1 text-white text-xs">
                        {{ classes.total }}
                    </span>
                </div>
            </page-header>
            <div class="mb-3 ml-0.5" v-if="classes.data.length != 0">
                <form class="grid grid-cols-1 md:grid-cols-7 gap-6 items-center" @submit.prevent="filterData()">
                    <div class="col-span-2">
                        <global-input id="search" v-model="form.keyword" type="search"
                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Keyword')" :error="$page.props.errors.keyword" />
                    </div>
                    <div class="col-span-2">
                        <Multiselect id="status" :close-on-select="true" :can-clear="true" :searchable="false"
                            v-model="form.status" :create-option="false" :placeholder="__('Select Status')" :options="[
                                { value: '', label: __('All') },
                                { value: 'upcoming', label: __('Upcoming') },
                                { value: 'completed', label: __('Completed') },
                            ]" autocomplete="off" />
                    </div>
                    <div class="col-span-1">
                        <global-button :loading="form.processing" type="submit" theme="primary" class="whitespace-nowrap">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <div>
                <template v-if="classes.data.length != 0">

                    <div  v-for="(classes, index) in classes.data" :key="index">

                        <div class="font-bold text-xl py-6 dark:text-gray-400">
                            {{ __('My Online Classes') }}
                        </div>

                        <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-2">
                            <div  v-for="item in classes" :key="item.id">
                                <single-online-class :item="item" action="not-show" />
                            </div>
                        </div>

                    </div>

                </template>
                <template v-else>
                    <NothingFound asShow="div" cssClass="text-center" />
                </template>

                <div class="flex justify-center">
                    <pagination class="mt-6" :links="classes.links" />
                </div>
                <br>
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
import SingleOnlineClass from './../Teacher/SingleOnlineClass.vue';
import Multiselect from '@vueform/multiselect';
import '@vueform/multiselect/themes/default.css';
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    components: {
        AppLayout,
        ToolTip,
        SingleOnlineClass,
        PencilSquareIcon,
        Pagination,
        Multiselect,
        NothingFound
    },
    props: {
        classes: Object,
        filter_data: Object,
    },
    data() {
        return {
            update: false,
            item: "",
            form: useForm({
                keyword: this.filter_data.keyword ?? "",
                status: this.filter_data.status ?? "",
            }),
        };
    },
    methods: {
        filterData() {
            this.form.get(this.route("online.classes"));
        },
    },
};
</script>
