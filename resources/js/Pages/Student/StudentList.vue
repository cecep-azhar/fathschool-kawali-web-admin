<template>
    <AppLayout :title="__('Student List')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Student List')" />
        </Breadcrumb>

        <v-md-preview :text="text"></v-md-preview>
        <div >
            <page-header >
                <h2 class="dark:text-gray-400 mb-0">
                    {{ __('Students') }}
                    <span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5">
                        {{ students.total }}
                    </span>
                </h2>
            </page-header>
            <div class="mb-3 ml-0.5">
                <form class="grid grid-cols-1 md:grid-cols-7 gap-6 items-center" @submit.prevent="filterData()">
                    <div class="col-span-2">
                        <global-input id="search" v-model="form.keyword" type="search"
                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Keyword')" :error="$page.props.errors.keyword" />
                    </div>
                    <div class="col-span-1">
                        <global-button :loading="form.processing" type="submit" theme="primary">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <global-table>
                <template #head>
                    <th class="py-5 px-5">{{ __('Name') }}</th>
                    <th class="py-5">{{ __('Guardian Name') }}</th>
                    <th class="py-5">{{ __('Contact Number') }}</th>
                    <th width="10%" class="py-5">{{ __('Action') }}</th>
                </template>
                <template #body>
                    <template v-if="students.data.length > 0">
                        <template v-for="student in students.data" :key="student.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center py-5 px-5 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="w-10 h-10 rounded-full" :src="student.user.profile_photo_url" alt="" />
                                    <div class="pl-3">
                                        <div class="text-base font-semibold dark:text-gray-400">
                                            {{ student.user.name }}
                                        </div>
                                        <div class="font-normal text-gray-500 dark:text-gray-400">
                                            {{ student.user.email }}
                                        </div>
                                    </div>
                                </th>
                                <td class="py-5">
                                    {{ student.parent.name }}
                                </td>
                                <td class="py-5">
                                    {{ student.user ? student.user.phone : '-' }}
                                </td>
                                <td class="py-5">
                                    <a :href="`mailto:${student.user.email}`"
                                        class="py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        {{ __('Send Email') }}
                                    </a>
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
                <pagination class="mt-6" :links="students.links" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import { useForm } from '@inertiajs/inertia-vue3';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        components: {
            AppLayout,
            Pagination,
            NothingFound
        },
        props: {
            students: Object,
            filter_data: Object
        },
        data() {
            return {
                email: '',
                form: useForm({
                    keyword: this.filter_data.keyword ?? ''
                })
            };
        },
        methods: {
            filterData() {
                this.form.get(this.route('student.list'))
            }
        },
    };
</script>
