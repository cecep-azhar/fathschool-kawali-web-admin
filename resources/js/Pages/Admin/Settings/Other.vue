<template>
    <AppLayout :title="__('Other Setting | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Settings')"/>
            <BreadcrumbLink :title="__('Other Setting')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Other Settings') }}
                </div>
            </page-header>

            <SettingLayout>
                <div class="grid xl:grid-cols-2 gap-8">
                    <div>
                        <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white dark:bg-gray-800 pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">
                                        {{ __('Cache') }}
                                    </h2>
                                </div>
                                <div
                                    class="divide-y divide-slate-400/20 rounded-lg text-[0.8125rem] leading-5 text-gray-900 dark:text-gray-400 ring-1 ring-slate-700/10">
                                    <div class="flex items-center p-4">

                                        <div class="flex-auto">
                                            <div class="font-medium">
                                                {{ __('Clear View Cache') }}
                                            </div>
                                        </div>
                                        <button @click.prevent="runCommand('view_cache')" type="button"
                                            class="pointer-events-auto flex-none rounded-md py-[0.3125rem] px-2 testView font-medium text-white shadow-sm ring-1 ring-slate-700/10 bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600">
                                            {{ __('Run Command') }}
                                        </button>
                                    </div>
                                    <div class="flex items-center p-4">
                                        <div class="flex-auto">
                                            <div class="font-medium">
                                                {{ __('Clear Route Cache') }}
                                            </div>
                                        </div>
                                        <button @click.prevent="runCommand('route_cache')" type="button"
                                            class="pointer-events-auto flex-none rounded-md py-[0.3125rem] testRoute px-2 font-medium text-white shadow-sm ring-1 ring-slate-700/10 bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600">
                                            {{ __('Run Command') }}
                                        </button>
                                    </div>
                                    <div class="flex items-center p-4">
                                        <div class="flex-auto">
                                            <div class="font-medium">
                                                {{ __('Clear Config Cache') }}
                                            </div>
                                        </div>
                                        <button @click.prevent="runCommand('config_cache')" type="button"
                                            class="pointer-events-auto flex-none rounded-md py-[0.3125rem] px-2 testConfig font-medium text-white shadow-sm ring-1 ring-slate-700/10 bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600">
                                            {{ __('Run Command') }}
                                        </button>
                                    </div>
                                    <div class="flex items-center p-4">
                                        <div class="flex-auto">
                                            <div class="font-medium">
                                                {{ __('Clear Application Cache') }}
                                            </div>
                                        </div>
                                        <button @click.prevent="runCommand('application_cache')" type="button"
                                            class="pointer-events-auto flex-none rounded-md py-[0.3125rem] px-2 testApplication font-medium text-white shadow-sm ring-1 ring-slate-700/10 bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600">
                                            {{ __('Run Command') }}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">
                                        {{ __('Migration') }}
                                    </h2>
                                </div>
                                <div
                                    class="rounded-lg text-[0.8125rem] leading-5 text-gray-900 dark:text-gray-400 ring-1 ring-slate-700/10">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-4">

                                        <div class="flex-auto">
                                            <div class="font-medium">
                                                {{ __('Migrate Database (If needed to migrate database)') }}
                                            </div>
                                        </div>
                                        <button @click.prevent="runCommand('migrate')" type="button"
                                            class="pointer-events-auto flex-none rounded-md py-[0.3125rem] px-2 testMigration font-medium text-white shadow-sm ring-1 ring-slate-700/10 bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600">
                                            {{ __('Run Command') }}
                                        </button>
                                    </div>
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
import { ArrowRightIcon } from "@heroicons/vue/24/outline";

export default {
    props: {

    },
    components: {
        AppLayout,
        SettingLayout,
        ArrowRightIcon,
    },
    methods: {
        runCommand(type) {
            this.$inertia.post(this.route('settings.run.command', {
                type: type
            }), {
                preserveScroll: true,
            })
        }
    },
}
</script>
