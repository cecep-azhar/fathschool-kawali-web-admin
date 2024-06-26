<template>
    <AppLayout :title="__('Student Details')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('my-subject')" title="My Courses" />
            <BreadcrumbLink :title=" __('Student Details')"/>
        </Breadcrumb>

        <div class="my-2">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Student Details') }}
                </div>
            </page-header>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="bg-white rounded-md dark:bg-gray-800">
                        <div class="px-4 text-lg font-bold dark:text-gray-400">
                            <div class="mb-3 pt-3">
                               {{ __('Student Performance') }}
                            </div>
                        </div>
                        <hr class="border-gray-100">
                        <div class="px-6 rounded-lg flex">
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg flex">
                                <div>
                                    <img width="110" height="110" class="rounded" :src="student.profile_photo_url"
                                        :alt="student.name">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-0 gap-x-12 ml-8">
                                    <div class="col-span-1 md:col-span-2 dark:text-gray-400 text-2xl font-bold">
                                        {{ student.name }}
                                    </div>
                                    <div>
                                        <span class="font-semibold text-md dark:text-gray-400">{{ __('Roll No') }} : </span>
                                        <span class="text-sm font-normal dark:text-gray-400">
                                            {{ student.profile ? student.profile.roll_no : '-' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="font-semibold text-md dark:text-gray-400">{{ __('Gender ') }}: </span>
                                        <span class="text-sm font-normal dark:text-gray-400">
                                            {{ student.gender ?? '-' }}
                                        </span>
                                    </div>
                                    <div >
                                        <span class="font-semibold text-md dark:text-gray-400">{{ __('Date Of Birth') }} :
                                        </span>
                                        <span class="text-sm font-normal dark:text-gray-400">
                                            {{ student.date_of_birth ? formatTime(student.date_of_birth) : '-' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="font-semibold text-md dark:text-gray-400">{{ __('Course') }} : </span>
                                        <span class="text-sm font-normal dark:text-gray-400">
                                            {{
                                                student.profile && student.profile.class &&
                                                    student.profile.class.name
                                            }}
                                        </span>
                                    </div>
                                    <div >
                                        <span class="font-semibold text-md dark:text-gray-400">{{ __('Department') }} : </span>
                                        <span class="text-sm font-normal dark:text-gray-400">
                                            {{ student.department && student.department.name }}
                                        </span>
                                    </div>
                                    <div >
                                        <span class="font-semibold text-md dark:text-gray-400">{{ __('Session') }} : </span>
                                        <span class="text-sm font-normal dark:text-gray-400">
                                            {{ student.profile ? student.profile.session : '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="bg-white rounded-lg dark:bg-gray-800 dark:text-gray-400">
                            <div class="px-4 text-lg font-bold dark:text-gray-400">
                                <div class="mb-3 pt-3">
                                   {{ __('Parent Information') }}
                                </div>
                            </div>
                            <hr class="border-gray-100">
                            <div class="py-4 px-6">
                                <div class="flex justify-start space-x-4 space-y-2">
                                    <div>
                                        <img width="100" height="100" class="rounded"
                                            :src="student.profile ? student.profile.parent ? student.profile.parent.profile_photo_url : '-' : '-'"
                                            :alt="student.profile ? student.profile.parent ? student.profile.parent.name : '-' : '-'">
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold dark:text-gray-400">
                                            {{
                                                student.profile ? student.profile.parent ? student.profile.parent.name : ''
                                                    :
                                                    '-'
                                            }}
                                        </div>
                                        <div class="mt-2 font-semibold dark:text-gray-400">
                                            <div class="flex">
                                                <span>{{ __('Email') }}:</span>
                                                <span class="ml-2 capitalize">
                                                    {{
                                                        student.profile ?
                                                            student.profile.parent ?
                                                                student.profile.parent.email : '-' : '-'
                                                    }}
                                                </span>
                                            </div>
                                            <div class="flex">
                                                <span>{{ __('Phone Number') }}:</span>
                                                <span class="ml-2 capitalize">
                                                    {{
                                                        student.profile ?
                                                            student.profile.parent ?
                                                                student.profile.parent.phone : '-' : '-'
                                                    }}
                                                </span>
                                            </div>
                                            <div class="flex">
                                                <span>{{ __('Address') }}:</span>
                                                <span class="ml-2 capitalize">
                                                    {{
                                                        student.profile ?
                                                            student.profile.parent ?
                                                                student.profile.parent.address : '-' : '-'
                                                    }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div >
                        <div class="bg-white dark:bg-gray-800 rounded-lg py-6">
                            <div class="px-4 text-lg font-bold dark:text-gray-400">
                                <div class="mb-3 ">
                                    {{ __('Student Performance') }}
                                </div>
                            </div>
                            <hr class="border-gray-100">
                            <div class="mt-3 px-5 flex justify-between dark:text-gray-400">
                                <div class="font-semibold">
                                    {{ __('Average Assignment Mark') }}
                                </div>
                                <div>
                                    {{ assignment_marks }}%
                                </div>
                            </div>
                            <div class="mt-3 px-5 flex justify-between dark:text-gray-400">
                                <div class="font-semibold">
                                    {{ __('Average Attendance Mark') }}
                                </div>
                                <div>
                                    {{ attendance_marks }}%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="bg-white dark:bg-gray-800 rounded-lg py-6">
                            <div class="px-4 mb-3 text-lg font-bold dark:text-gray-400">
                                {{ __('Student Documents') }}
                            </div>
                            <hr class="border-gray-100">
                            <div class="px-5 flex justify-between mt-3 font-bold dark:text-gray-400">
                                <div>{{ __('Tittle') }}</div>
                                <div>{{ __('Download') }}</div>
                            </div>
                            <template v-if="student.documents.length > 0">
                                <div v-for="document in student.documents" :key="document.id"
                                    class="mt-3 px-5 dark:text-gray-400 flex justify-between">
                                    <div class="Capitalize font-semibold text-gray-600 dark:text-gray-400">
                                        {{ document.title }}
                                    </div>
                                    <a :href="document.file_url_format" target="_blank" download=""
                                        class="text-xs dark:opacity-60 font-semibold mr-2 px-2.5 py-0.5 rounded capitalize">
                                        {{ __('Download') }}
                                    </a>
                                </div>
                            </template>
                            <template v-else>
                                <NothingFound asShow="dev" cssClass="text-center p-2" />
                            </template>
                        </div>
                    </div>
                </div>
                <div>
                    <div >
                        <div class="bg-white dark:bg-gray-800 rounded-lg ">
                            <div class="p-4 font-bold text-lg dark:text-gray-400">
                                {{ __('Invoice History') }}
                            </div>
                            <hr class="border-gray-100">
                            <global-table classes="!bg-white">
                                <template #head>
                                    <th class="py-5 px-5">{{ __('Title') }}</th>
                                    <th class="py-5">{{ __('Amount') }}</th>
                                    <th class="py-5">{{ __('Paid Amount') }}</th>
                                    <th class="py-5">{{ __('Status') }}</th>
                                </template>
                                <template #body>
                                    <template v-if="transactions.data.length > 0">
                                        <template v-for="transaction in transactions.data" :key="transaction.id">
                                            <tr
                                                class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="py-5 px-5">
                                                    {{ transaction.title }}
                                                </td>
                                                <td class="py-5">
                                                    {{ number_format(transaction.amount) }} {{ transaction.currency }}
                                                </td>
                                                <td class="py-5">
                                                    {{ number_format(transaction.paid_amount) }} {{ transaction.currency }}
                                                </td>
                                                <td class="py-5 capitalize">
                                                    {{ transaction.status }}
                                                </td>
                                            </tr>
                                        </template>
                                    </template>
                                    <template v-else>
                                        <NothingFound asShow="tr"/>
                                    </template>
                                </template>
                            </global-table>
                            <div class="flex justify-center">
                                <pagination class="mt-6" :links="transactions.links" />
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="bg-white dark:bg-gray-800 rounded-lg py-6">
                            <div class="px-4 mb-3 text-lg font-bold dark:text-gray-400">
                                {{ __('Leave History') }}
                            </div>
                            <hr class="border-gray-100">
                            <div class="px-5 flex justify-between mt-3 font-bold dark:text-gray-400">
                                <div>{{ __('Date') }}</div>
                                <div>{{ __('Status') }}</div>
                            </div>
                            <template v-if="leaves.length > 0">
                                <div v-for="leave in leaves" :key="leave"
                                    class="mt-3 px-5 dark:text-gray-400 flex justify-between">
                                    <div class="font-semibold text-gray-600 dark:text-gray-400">
                                        {{ formatTime(leave.start) }} - {{ formatTime(leave.end) }}
                                    </div>
                                    <span
                                        :class="leave.status == 'accepted' ? 'bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900' : '' || leave.status == 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900' : '' || leave.status == 'pending' ? 'bg-pink-100 text-pink-800 dark:bg-pink-200 dark:text-pink-900' : ''"
                                        class="text-xs dark:opacity-60 font-semibold px-2.5 py-0.5 rounded capitalize">
                                        {{ leave.status }}
                                    </span>
                                </div>
                            </template>
                            <template v-else>
                                <NothingFound asShow="div" cssClass="text-center p-2" />
                            </template>
                        </div>
                    </div>
                </div>
                <div>
                    <div >
                        <div class="bg-white dark:bg-gray-800 rounded-lg ">
                            <div class="p-4 font-bold text-lg dark:text-gray-400">
                               {{ __('Attendance History') }}
                            </div>
                            <hr class="border-gray-100">
                            <global-table classes="!bg-white">
                                <template #head>
                                    <th class="py-5 px-5">{{ __('Subject') }}</th>
                                    <th class="py-5">{{ __('Status') }}</th>
                                    <th class="py-5 px-5">{{ __('Date') }}</th>
                                </template>
                                <template #body>
                                    <template v-if="attendances_data.data.length > 0">
                                        <template v-for="attendance in attendances_data.data" :key="attendance.id">
                                            <tr
                                                class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="py-5 px-5">
                                                    {{ attendance.subject ? attendance.subject.name : '-' }}
                                                </td>
                                                <td class="py-5 capitalize">
                                                    <span v-if="attendance.status == 'late'">
                                                        {{ attendance.late_amount }} {{ __('Minutes') }}
                                                    </span>
                                                    {{ attendance.status }}
                                                </td>
                                                <td class="py-5">
                                                    {{ attendance.date_time }}
                                                </td>
                                            </tr>
                                        </template>
                                    </template>
                                    <template v-else>
                                          <NothingFound asShow="tr"/>
                                    </template>
                                </template>
                            </global-table>
                            <div class="flex justify-center">
                                <pagination class="mt-6" :links="attendances_data.links" />
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="bg-white dark:bg-gray-800 rounded-lg ">
                            <div class="p-4 font-bold text-lg dark:text-gray-400">
                                {{ __('Exam List') }}
                            </div>
                            <hr class="border-gray-100">
                            <global-table classes="!bg-white">
                                <template #head>
                                    <th class="py-5 px-5">{{ __('Name') }}</th>
                                    <th class="py-5">{{ __('Grade') }}</th>
                                    <th class="py-5 px-5">{{ __('GPA') }}</th>
                                    <th class="py-5 px-5">{{ __('Status') }}</th>
                                </template>
                                <template #body>
                                    <template v-if="exams.data.length > 0">
                                        <template v-for="exam in exams.data" :key="exam.id">
                                            <tr
                                                class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="py-5 px-5">
                                                    {{ exam.name ?? '-' }}
                                                </td>
                                                <td class="py-5 capitalize">
                                                    {{ exam.grade }}
                                                </td>
                                                <td class="py-5">
                                                    {{ exam.gpa }}
                                                </td>
                                                <td class="py-5">
                                                    {{ exam.status }}
                                                </td>
                                            </tr>
                                        </template>
                                    </template>
                                    <template v-else>
                                        <NothingFound asShow="tr"/>
                                    </template>
                                </template>
                            </global-table>
                            <div class="flex justify-center">
                                <pagination class="mt-6" :links="exams.links" />
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from '@/Shared/Admin/Pagination.vue';
import dayjs, { Dayjs } from 'dayjs';
import TableContent from '../Admin/Exam/Table.vue';
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    components: {
        AppLayout,
        Pagination,
        TableContent,
        NothingFound
    },
    props: {
        student: Object,
        leaves: Object,
        transactions: Object,
        assignment_marks: Number,
        attendance_marks: Number,
        attendances_data: Object,
        exams: Object
    },
    data() {
        return {
        };
    }
};
</script>

<style lang="scss" scoped>

</style>
