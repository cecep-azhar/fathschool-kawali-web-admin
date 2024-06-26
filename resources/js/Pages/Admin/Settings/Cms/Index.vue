<template>
    <AppLayout :title="__('Cms Management | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Settings')" />
            <BreadcrumbLink :title=" __('Cms Management')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __('Cms Management') }}
                </div>
            </page-header>

            <SettingLayout>
                <aside class="pb-6 mt-2 lg:col-span-2">
                    <div class="flex gap-4 flex-wrap bg-white dark:bg-gray-600 rounded-md py-3 px-4">
                        <Link preserveScroll :href="route('cms.index')"
                            :class="route().current('cms.index') ? 'px-3 rounded-lg py-2 flex gap-2 items-center text-sm font-medium bg-blue-50 text-blue-500 dark:bg-gray-700 dark:text-gray-400' : 'px-3 rounded-lg py-2 flex gap-2 items-center text-sm font-medium text-gray-400'">
                        <div>Onboarding Content</div>
                        </Link>
                    </div>
                </aside>
                <div
                    class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                    <div class="p-6">
                        <Onboarding :onboarding_contents="onboarding_contents" />
                    </div>
                </div>
            </SettingLayout>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingLayout from '@/Layouts/SettingLayout.vue';
import Onboarding from './Onboarding.vue';

export default {
    props: ['onboarding_contents'],
    data() {
        return {
        }

    },
    components: {
        AppLayout,
        SettingLayout,
        Onboarding
    },

    methods: {
    },
}
</script>
