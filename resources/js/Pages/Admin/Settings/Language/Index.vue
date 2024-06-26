<template>
    <AppLayout :title="__('Language | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Settings')"/>
            <BreadcrumbLink :title=" __('Language')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('All Language') }}
                <badge>
                    {{ languages.total }}
                </badge>
                <template #content>
                    <Link preserve-scroll :href="route('languages.create')">
                    <global-button :loading="false" type="button"
                        class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 w-full dark:focus:ring-blue-300">
                        {{ __('Create') }}
                    </global-button>
                    </Link>
                </template>
            </page-header>
            <SettingLayout>
                <div
                    class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                        <div>
                            <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">
                                {{ __('Language Information') }}
                            </h2>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 md:grid-cols-3 gap-4">
                            <template v-if="languages.data.length > 0">
                                <template v-for="language in languages.data" :key="language.id">
                                    <div
                                        class="px-6 pt-6 bg-white shadow-xs border-2 border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-700">
                                        <Link :href="route('languages.setting', language.code)">
                                        <h5
                                            class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-400">
                                            {{ language.name }}
                                            <span v-if="$page.props.locale == language.code"
                                                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:opacity-70 dark:text-blue-800">
                                                {{ __('Default') }}
                                            </span>
                                        </h5>
                                        </Link>
                                        <p class="mt-3 flex gap-3 font-normal text-gray-500 dark:text-gray-400">
                                            <span
                                                class="text-xs inline-block py-1 px-6 leading-none text-center whitespace-nowrap capitalize align-baseline font-bold dark:opacity-70 bg-green-500 text-white rounded">
                                                {{ language.code }}
                                            </span>
                                            <span
                                                class="text-xs inline-block py-1 px-6 leading-none text-center whitespace-nowrap capitalize align-baseline font-bold dark:opacity-70 bg-blue-500 text-white rounded">
                                                {{ language.direction }}
                                            </span>
                                        </p>
                                        <div class="mt-2 flex gap-2 mb-3 items-center text-blue-600 hover:underline">
                                            <Link preserve-scroll :href="route('languages.setting', language.code)"
                                                class="group relative" :id="'testTranslate'+language.id">
                                            <LanguageIcon class="text-pink-400 w-6 h-6" />
                                            <tool-tip :text="__('Translate')" />
                                            </Link>

                                            <Link preserve-scroll v-if="language.id != 1" :id="'testEdit'+language.id"
                                                :href="route('languages.edit', language.id)" class="group relative">
                                            <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                            <tool-tip :text="__('Edit')" />
                                            </Link>

                                            <button v-if="language.id != 1" type="button" @click="destroy(language.id)" :id="'testDelete'+language.id"
                                                class="group relative">
                                                <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                                <tool-tip :text="__('Delete')" />
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </template>
                            <template v-else>
                                <div class="text-center p-4">{{ __('Nothing Found') }}</div>
                            </template>
                        </div>
                        <div class="flex justify-center">
                            <pagination class="mt-6" :links="languages.links" />
                        </div>
                    </div>
                </div>
            </SettingLayout>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import SettingLayout from '@/Layouts/SettingLayout.vue';
import ToolTip from "@/Shared/ToolTip.vue";
import { PencilSquareIcon, TrashIcon, Cog6ToothIcon, ArrowRightIcon, LanguageIcon } from '@heroicons/vue/24/outline'
import Pagination from "@/Shared/Admin/Pagination.vue";

export default {
    components: {
        AppLayout,
        ToolTip,
        TrashIcon,
        PencilSquareIcon,
        Cog6ToothIcon,
        ArrowRightIcon,
        Pagination,
        SettingLayout,
        LanguageIcon,
    },
    props: {
        languages: Object,
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("languages.destroy", id));
            } else {
                return false;
            }
        },
    },
};
</script>
