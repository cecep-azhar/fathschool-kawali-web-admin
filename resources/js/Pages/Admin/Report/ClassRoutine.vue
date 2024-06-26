<template>
    <AppLayout :title="__('Class Schedule')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('reports.index')" title="Report" />
            <BreadcrumbLink :title="__('Class Schedule')" />
        </Breadcrumb>

        <div class="py-12">
            <page-header class="flex items-center justify-between">
                {{ __('Class Schedule') }}
            </page-header>
            <div class="mb-3 ml-0.5">
                <form class="grid grid-cols-1 md:grid-cols-7 gap-6 items-center" @submit.prevent="filterData()">
                    <div class="col-span-2">
                        <global-select v-model="filter.course_id" :error="$page.props.errors.course_id"
                            class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                            <option selected disabled value="">
                                {{ __('Select Course') }}
                            </option>
                            <option :value="course.id" v-for="course in classes" :key="course.id">
                                {{ course.name }}
                            </option>
                        </global-select>
                    </div>
                    <div class="col-span-2">
                        <Multiselect id="teacher" :close-on-select="true" :can-clear="true" :searchable="true"
                            v-model="filter.teacher_id" :create-option="false" :placeholder="__('Select Teacher')"
                            :options="teachers.map(item => ({
                                value: item.id, label: item.name
                            }))" autocomplete="off" />
                    </div>
                    <div class="col-span-1">
                        <global-button :loading="filter.processing" type="submit"
                            class="text-white bg-blue-500 dark:bg-blue-500 hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-300">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <global-table>
                <template #head>
                    <th class="py-5 px-6">{{ __('Course') }}</th>
                    <th class="py-5">{{ __('Teacher') }}</th>
                    <th class="py-5">{{ __('Subject') }}</th>
                    <th class="py-5">{{ __('Week-Day') }}</th>
                    <th class="py-5">{{ __('Start Time') }}</th>
                    <th class="py-5">{{ __('End Time') }}</th>
                    <th width="10%" class="py-5 px-6">Action</th>
                </template>
                <template #body>
                    <template v-if="routines.data.length > 0">
                        <template v-for="routine in routines.data" :key="routine.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="py-4 px-6">
                                    {{
                                    routine.course
                                    ? routine.course.name
                                    : "-"
                                    }}
                                </td>
                                <td class="py-4">
                                    {{
                                    routine.teacher
                                    ? routine.teacher.name
                                    : "-"
                                    }}
                                </td>
                                <td class="py-4">
                                    {{
                                    routine.subject
                                    ? routine.subject.name
                                    : "-"
                                    }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ routine.weekday }}
                                </td>
                                <td class="py-4">
                                    {{ formatTime(routine.start_time) }}
                                </td>
                                <td class="py-4">
                                    {{ routine.end_time }}
                                </td>
                                <td class="py-4 px-6 flex gap-2">
                                    <Link preserve-scroll :href="
                                            route(
                                                'routine.show',
                                                routine.id
                                            )
                                        " class="group relative cursor-pointer">
                                    <eye-icon classes="w-6 h-6 text-blue-400 hover:text-blue-300" />
                                    <tool-tip :text="__('Show Calendar')" />
                                    </Link>
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template v-else>
                        <tr>
                            <td colspan="4" class="text-center p-4">
                                <NothingFound asShow="div" />
                            </td>
                        </tr>
                    </template>
                </template>
            </global-table>
            <div class="flex justify-center">
                <pagination class="mt-6" :links="routines.links" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import ToolTip from "@/Shared/ToolTip.vue";
    import { PencilSquareIcon, TrashIcon, EyeIcon, EnvelopeIcon, ArrowRightIcon } from "@heroicons/vue/24/outline";
    import { useForm } from "@inertiajs/inertia-vue3";
    import Multiselect from '@vueform/multiselect'
    import '@vueform/multiselect/themes/default.css';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        components: {
            EnvelopeIcon,
            AppLayout,
            ToolTip,
            Pagination,
            TrashIcon,
            PencilSquareIcon,
            EyeIcon,
            ToolTip,
            ArrowRightIcon,
            Multiselect,
            NothingFound
        },
        props: {
            routines: Object,
            classes: Array,
            teachers: Array,
            filter_data: Object,
        },
        data() {
            return {
                filter: useForm({
                    course_id: this.filter_data.course_id ?? "",
                    teacher_id: this.filter_data.teacher_id ?? "",
                }),
            };
        },
        methods: {
            filterData() {
                this.filter.get(this.route("report.class-routine"));
            },
        },
    };
</script>
