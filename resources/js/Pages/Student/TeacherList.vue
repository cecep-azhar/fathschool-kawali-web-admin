<template>
    <AppLayout :title="__('Student Teacher')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Student Teacher')" />
        </Breadcrumb>

        <div >
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Student Teacher') }}
                </div>
            </page-header>
            <div class="mb-3 ml-0.5">
                <form class="grid grid-cols-1 md:grid-cols-7 gap-6 items-center" @submit.prevent="filterData()">
                    <div class="col-span-2">
                        <global-input id="search" v-model="form.keyword" type="search"
                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Keyword')" :error="$page.props.errors.keyword" />
                    </div>
                    <div class="col-span-2">
                        <a-select :class="$page.props.errors.department ? 'border-custom ' : ''"
                            size="large" class="width-100" v-model:value="form.department" show-search
                            :placeholder="__('Select a department')" :options="options" :filter-option="filterOption"
                            @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                        </a-select>
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
                    <th class="py-5">{{ __('Department') }}</th>
                    <th width="10%" class="py-5">{{ __('Action') }}</th>
                </template>
                <template #body>
                    <template v-if="teachers.length > 0">
                        <template v-for="teacher in teachers" :key="teacher.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="flex items-center py-5 px-5 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="w-10 h-10 rounded-full" :src="teacher.profile_photo_url"
                                        alt="Jese image" />
                                    <div class="pl-3">
                                        <div class="text-base font-semibold dark:text-gray-400">
                                            {{ teacher.name }}
                                        </div>
                                        <div class="font-normal text-gray-500 dark:text-gray-400">
                                            {{ teacher.email }}
                                        </div>
                                    </div>
                                </th>
                                <td class="py-5">
                                    {{ teacher.department ? teacher.department.name : '-' }}
                                </td>
                                <td class="py-5 flex gap-2">
                                    <button @click="sendMail(teacher.id)" type="button" class="group relative">
                                        <EnvelopeIcon class="w-6 h-6 text-purple-400 hover:text-purple-300" />
                                        <tool-tip text="Send Mail" />
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
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import ToolTip from '@/Shared/ToolTip.vue';
    import { useForm } from '@inertiajs/inertia-vue3';
    import { EnvelopeIcon } from '@heroicons/vue/24/outline';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        components: {
            AppLayout,
            EnvelopeIcon,
            ToolTip,
            NothingFound
        },
        props: {
            teachers: Object,
            departments: Object,
            filter_data: Object
        },
        data() {
            return {
                options: [],
                options2: [],
                form: useForm({
                    keyword: this.filter_data.keyword ?? '',
                    department: this.filter_data.department ?? null,
                })
            };
        },
        created() {
            // for department
            this.options.push({
                value: "",
                label: "All",
            });
            for (const [key, value] of Object.entries(this.departments)) {
                this.options.push({
                    value: value.slug,
                    label: value.name,
                });
            }

        },
        methods: {
            filterData() {
                this.form.get(this.route('teacher.list'));
            },
            sendMail() {
                alert('Coming Soon');
            }
        },
    };
</script>

<style lang="scss" scoped>

</style>
