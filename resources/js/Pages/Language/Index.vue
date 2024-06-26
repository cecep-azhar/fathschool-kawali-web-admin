<template>
    <AppLayout :title="__('Language')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Language')" />
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
                        {{ __('Create Language') }}
                    </global-button>
                    </Link>
                </template>
            </page-header>
            <global-table>
                <template #head>
                    <th class="py-5 px-5">{{ __('Name') }}</th>
                    <th class="py-5">{{ __('Code') }}</th>
                    <th class="py-5">{{ __('Direction') }}</th>
                    <th width="10%" class="py-5 px-6">{{ __('Action') }}</th>
                </template>
                <template #body>
                    <template v-if="languages.data.length > 0">
                        <template v-for="language in languages.data" :key="language.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-gray-400">
                                    <div class="text-base font-semibold">
                                        {{ language.name }}
                                        <span v-if="$page.props.locale == language.code"
                                            class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{
                                            __('Default') }}</span>
                                    </div>
                                </th>
                                <td>
                                    <div class="capitalize font-normal text-gray-500">
                                        {{ language.code }}
                                    </div>
                                </td>
                                <td>
                                    <div class="capitalize font-normal text-gray-500">
                                        {{ language.direction }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 flex gap-2">
                                    <Link preserve-scroll :href="route('languages.setting', language.code)"
                                        class="group relative">
                                    <Cog6ToothIcon class="text-pink-400" />
                                    <tool-tip :text="__('Translate')" />
                                    </Link>

                                    <Link preserve-scroll v-if="language.id != 1"
                                        :href="route('languages.edit', language.id)" class="group relative">
                                    <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                    <tool-tip :text="__('Edit')" />
                                    </Link>

                                    <button v-if="language.id != 1" type="button" @click="destroy(language.id)"
                                        class="group relative">
                                        <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                        <tool-tip :text="__('Delete')" />
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template v-else>
                        <NothingFound asShow="tr" />
                    </template>
                </template>
            </global-table>
            <div class="flex justify-center">
                <pagination class="mt-6" :links="languages.links" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import ToolTip from "@/Shared/ToolTip.vue";
    import { PencilSquareIcon, TrashIcon, Cog6ToothIcon } from '@heroicons/vue/24/outline'
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        components: {
            AppLayout,
            ToolTip,
            TrashIcon,
            PencilSquareIcon,
            Cog6ToothIcon,
            Pagination,
            NothingFound
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
