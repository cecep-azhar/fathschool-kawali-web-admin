<template>
    <AppLayout :title="__('Course') + routine.course.name + __('Routine')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Class Routine')" />
        </Breadcrumb>

        <div>
            <page-header>
                {{ __('Course') + routine.course.name + __('Routine') }}
            </page-header>
            <global-table>
                <template #head>
                    <th width="8%" class="py-5 px-6">
                        {{ __('Time') }}
                    </th>
                    <th width="11.25%" class="py-5 px-6" v-for="day in weekDays" :key="day">
                        {{ day }}
                    </th>
                </template>
                <template #body>
                    <tr v-for="(time, days) in calendarData" :key="days"
                        class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6 border">
                            {{ days }}
                        </td>
                        <template v-for="value in time" :key="value">
                            <template v-if="value">
                                <td :rowspan="value['rowspan']" class="py-4 px-6 border text-center">
                                    <div class="flex flex-wrap items-center justify-center font-semibold"
                                        v-if="value['teacher_name']">
                                        <div>{{ __('Teacher') }} :</div>
                                        <div class="ml-2">
                                            {{ value["teacher_name"] }}
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center justify-center font-semibold"
                                        v-if="value['subject_name']">
                                        <div>{{ __('Subject') }} :</div>
                                        <div class="ml-2">
                                            {{ value["subject_name"] }}
                                        </div>
                                    </div>
                                </td>
                            </template>
                            <template v-else-if="value === 1">
                                <td class="py-4 px-6 border"></td>
                            </template>
                        </template>
                    </tr>
                </template>
            </global-table>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    props: ['weekDays', 'calendarData', 'routine'],
    components: {
        AppLayout,
    },
};
</script>

<style>
</style>
