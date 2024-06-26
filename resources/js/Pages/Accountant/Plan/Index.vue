<template>
    <AppLayout :title="__('Plan')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Plan')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Plan') }}
                <badge>
                    {{ plans.length }}
                </badge>
                <template #content>
                    <global-button :url="route('plan.create')" :loading="false" type="link" theme="primary">
                        {{ __('Add New Plan') }}
                    </global-button>
                </template>
            </page-header>
            <div>
                <template v-if="plans.length > 0">
                    <div class="grid grid-cols-1 md:grid-cols-2  xl:grid-cols-3 2xl:grid-cols-4 gap-3 testPlanBox">
                        <template v-for="plan in plans" :key="plan.id">
                            <div
                                class="relative w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
                                <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">
                                    {{ plan.title }}
                                </h5>
                                <div class="flex items-baseline text-gray-900 dark:text-white">
                                    <span class="text-5xl font-extrabold tracking-tight !break-all">
                                            {{ convertAmount(conversionRate(plan.currency, $page.props.default_currency, plan.price)) }}
                                    </span>
                                    <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">
                                        /{{__('month')}}
                                    </span>
                                </div>
                                <div class="text-sm mt-1 text-gray-400">
                                    {{ plan.description }}
                                </div>
                                <!-- List -->
                                <ul role="list" class="flex flex-col gap-4 my-4 mb-8">
                                    <li v-for="(benefit, index) in plan.benefits" :key="index" class="flex gap-3">
                                        <!-- Icon -->
                                        <CheckCircleIcon class="flex-shrink-0 w-6 h-6 text-blue-600 dark:text-blue-500" />
                                        <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">
                                            {{ benefit.title }}
                                        </span>
                                    </li>
                                </ul>
                                <div class="absolute bottom-4 right-0 px-6 w-full">
                                    <div class="flex justify-between items-center gap-2">
                                        <div>
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-3 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 group relative">
                                                {{ plan.course ? plan.course.name : '-' }}
                                                <tool-tip :text="__('Course')" />
                                            </span>
                                        </div>
                                        <div>
                                            <Link :href="route('plan.edit', plan.id)" type="button"
                                                @click="edit(plan)" class="group relative" :id="'editPlan' + plan.id">
                                            <PencilSquareIcon class="text-blue-400 hover:text-blue-300 w-6 h-6" />
                                            <tool-tip text="Edit" />
                                            </Link>
                                            <button type="button" @click="destroy(plan.id)" class="group relative" :id="'deletePlan' + plan.id">
                                                <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                                <tool-tip :text="__('Delete')" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
                <template v-else>
                    <NothingFound asShow="div" cssClass="mt-4" />
                </template>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import CreateUpdateForm from "./Form.vue";
import NothingFound from "@/Shared/NothingFound.vue";

import { TrashIcon, PencilSquareIcon, CheckCircleIcon } from '@heroicons/vue/24/outline'

export default {
    components: {
        AppLayout,
        ToolTip,
        CheckCircleIcon,
        TrashIcon,
        PencilSquareIcon,
        CreateUpdateForm,
        NothingFound
    },
    props: {
        plans: Object,
    },
    data() {
        return {
            update: false,
            item: "",
        };
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("plan.destroy", id));
            } else {
                return false;
            }
        },
        edit(data) {
            this.item = data;
            this.update = true;
        },
        updateFalse() {
            this.update = false;
        },
    },
};
</script>
