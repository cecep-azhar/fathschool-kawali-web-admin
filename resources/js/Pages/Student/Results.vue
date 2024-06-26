<template>
    <AppLayout :title="__('Exam & Results')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Exam & Results')" />
        </Breadcrumb>

        <div>
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Exam & Results') }}
                </div>
            </page-header>

            <ol v-if="results && results.length">
                <li class="p-2 bg-white dark:bg-gray-800 mt-2" v-for="result in results" :key="result.id">
                    <div class="mt-2 ml-4 mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                       <div>
                            <p class="text-sm text-neutral-500 dark:text-gray-400">
                                {{ formatTime(result?.exam?.start_date) ?? '' }} - {{ formatTime(result?.exam?.end_date) ?? '' }}
                            </p>
                            <h4 class="mb-1.5 text-xl font-semibold dark:text-gray-400">
                                {{ result?.exam?.name ?? '' }}
                            </h4>
                       </div>
                       <a :href="result.attachment_url" download>
                            <a :href="route('preview.result', result.exam.slug)" target="_blank" class="text-white bg-blue-500 dark:bg-blue-500 hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 mt-6 dark:focus:ring-blue-300">
                                <global-button type="button">
                                    {{ __('Preview Result Sheets') }}
                                </global-button>
                            </a>
                        </a>
                    </div>
                </li>
            </ol>
            <template v-else>
                <NothingFound asShow="div" />
            </template>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import { EnvelopeIcon } from '@heroicons/vue/24/outline';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        components: {
            AppLayout,
            EnvelopeIcon,
            NothingFound
        },
        props: {
            results: {
                type: Array,
                required: true
            }
        }
    };
</script>
