<template>
    <AppLayout :title="__('Upgrade Guide | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Settings')" />
            <BreadcrumbLink :title="__('Upgrade Guide')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __('Upgrade Guide') }}
                </div>
            </page-header>

            <SettingLayout>
                <page-header>
                <div class="dark:text-gray-400">
                    {{ __('If you want to learn more about upgrading your application, you are in the right place. Below we have added 8 easy steps to upgrade your application today') }}
                </div>
            </page-header>
                <div
                    class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">

                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                        <div>
                            <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">
                    {{ __('Application version : V-2.9.21') }}

                            </h2>
                        </div>

                        <div class="grid grid-cols-12 divide-y-0 divide-x  dark:divide-gray-600 gap-8">
                            <div class="col-span-12">
                                <ul class="space-y-1 list-disc list-inside text-gray-500 dark:text-gray-400">
                                    <li>
                                        {{ __('Visit your application root directory and delete en.json file from inside \'lang\' folder') }}
                                    </li>
                                    <li>
                                        {{ __('Backup the important files') }} .-> This 3 folder <strong>(public/uploads, lang, storage)</strong> and <strong>.env</strong> file
                                    </li>
                                    <li>
                                        {{ __('Delete all of the files that are located inside your domain root') }}
                                    </li>
                                    <li>
                                        {{ __('Download the latest version from your codecanyon account') }}
                                        <a target="_blank" href="https://codecanyon.net/downloads">
                                            {{ __('Check Here') }}
                                        </a>
                                    </li>
                                    <li>
                                        {{ __('Extract the downloaded file and upload the app.zip file to your domain root') }}
                                    </li>
                                    <li>
                                        {{ __("Extract the app.zip file to your domain root") }}
                                    </li>
                                    <li>
                                        {{ __("Please replace the following backup files and folders in their respective directories") }}
                                        .-> This 3 folder <strong>(public/uploads, lang, storage)</strong> and <strong>.env</strong> file
                                    </li>
                                    <li>
                                        {{ __('Finally click the below "Upgrade Now" button') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class=" border-gray-700 mb-1">
                        <div class="flex justify-end py-4 gap-4 px-4 sm:px-6">
                            <global-button @click="upgrade()" type="button" cssClass="w-full mt-3" theme="primary">
                                {{ __('Upgrade Now') }}
                            </global-button>
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
        ArrowRightIcon
    },
    methods: {
        upgrade() {
            if (confirm('Are you sure to upgrade the application ?')) {
                this.$inertia.post(this.route('settings.upgrade'), {
                    preserveScroll: true,
                })
            }
        }
    },
}
</script>
