<template>
    <AppLayout :title="__('Teacher')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Teacher')" />
        </Breadcrumb>

        <div class="my-2">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __("Teacher Details") }}
                </div>
                <template #content>
                    <div
                        class="flex flex-wrap bg-gray-200/50 hover:bg-gray-200 rounded-lg transition py-1 px-2 dark:bg-gray-700 dark:hover:bg-gray-700/70"
                    >
                        <Link
                            :href="route('teacher.show', teacher.id)"
                            :data="{ tab: 'details' }"
                            :class="
                                !request_data.tab ||
                                request_data.tab === 'details'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold"
                        >
                            {{ __("Details") }}
                        </Link>
                        <Link
                            :href="route('teacher.show', teacher.id)"
                            :data="{ tab: 'subject' }"
                            :class="
                                request_data.tab == 'subject'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold"
                        >
                            {{ __("Subject") }}
                        </Link>
                        <Link
                            :href="route('teacher.show', teacher.id)"
                            :data="{ tab: 'assignments' }"
                            :class="
                                request_data.tab == 'assignments'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold"
                        >
                            {{ __("Assignments") }}
                        </Link>
                        <Link
                            @:href="route('teacher.show', teacher.id)"
                            :data="{ tab: 'online-classes' }"
                            :class="
                                request_data.tab == 'online-classes'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold"
                        >
                            {{ __("Online Classes") }}
                        </Link>
                        <Link
                            :href="route('teacher.show', teacher.id)"
                            :data="{ tab: 'leave-history' }"
                            :class="
                                request_data.tab == 'leave-history'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold"
                        >
                            {{ __("Leave History") }}
                        </Link>
                    </div>
                </template>
            </page-header>
            <div>
                <div v-if="!request_data.tab || request_data.tab == 'details'">
                    <div class="flex flex-col lg:flex-row gap-6">
                        <div
                            class="bg-white dark:bg-gray-800 p-6 rounded-lg flex lg:w-2/3"
                        >
                            <div>
                                <img
                                    width="110"
                                    height="110"
                                    class="rounded"
                                    :src="teacher.profile_photo_url"
                                    :alt="teacher.name"
                                />
                            </div>
                            <div class="ml-8">
                                <div
                                    class="col-span-1 md:col-span-2 dark:text-gray-400 text-2xl font-bold"
                                >
                                    {{ teacher.name }}
                                </div>
                                <div class="mt-2">
                                    <span
                                        class="font-semibold text-md dark:text-gray-400"
                                    >
                                        {{ __("Department") }} :
                                    </span>
                                    <span
                                        class="text-sm font-normal dark:text-gray-400"
                                    >
                                        {{
                                            teacher.department
                                                ? teacher.department.name
                                                : "-"
                                        }}
                                    </span>
                                </div>
                                <div>
                                    <span
                                        class="font-semibold text-md dark:text-gray-400"
                                    >
                                        {{ __("Date Of Birth") }} :
                                    </span>
                                    <span
                                        class="text-sm font-normal dark:text-gray-400"
                                    >
                                        {{ formatTime(teacher.date_of_birth) }}
                                    </span>
                                </div>
                                <div>
                                    <span
                                        class="font-semibold text-md dark:text-gray-400"
                                    >
                                        {{ __("Created") }} :
                                    </span>
                                    <span
                                        class="text-sm font-normal dark:text-gray-400"
                                    >
                                        {{ formatTime(teacher.create_at) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white rounded-lg dark:bg-gray-800 dark:text-gray-400 lg:w-1/3"
                        >
                            <div class="py-4">
                                <div
                                    class="px-6 pb-2 flex space-x-4 space-y-2 mt-2 font-bold text-lg border-b"
                                >
                                    {{ __("Teacher Information") }}
                                </div>
                                <div class="px-4 py-2">
                                    <div class="capitalize text-base">
                                        {{ __("NIK") }}: {{ teacher.nik }}
                                    </div>
                                    <div class="capitalize text-base">
                                        {{ __("RFID") }}: {{ teacher.rfid }}
                                    </div>
                                    <div class="capitalize text-base">
                                        {{ __("Email") }}: {{ teacher.email }}
                                    </div>
                                    <div class="capitalize text-base">
                                        {{ __("Phone") }}: {{ teacher.phone }}
                                    </div>
                                    <div class="capitalize text-base">
                                        {{ __("Address") }}:
                                        {{ teacher.address }}
                                    </div>
                                    <div class="capitalize text-base">
                                        {{ __("Gender") }}: {{ teacher.gender }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="request_data.tab == 'subject'">
                    <template v-if="Object.keys(subjects).length > 0">
                        <div
                            class="mb-8 pb-8 border-b-2 border-gray-200 dark:border-gray-600"
                            v-for="(item, index) in subjects"
                            :key="index"
                        >
                            <div class="flex items-center mb-3 pl-1">
                                <div
                                    class="mr-2 w-4 h-4 rounded-full bg-[ #3498db]"
                                ></div>
                                <h2
                                    class="text-xl font-bold m-0 dark:text-gray-400"
                                >
                                    {{ item[0].subject.course.name }} #{{
                                        index
                                    }}
                                </h2>
                            </div>
                            <div
                                class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 col-span-3 auto-rows-min"
                            >
                                <Link
                                    :href="
                                        route(
                                            'subject.details',
                                            subject.subject.slug
                                        )
                                    "
                                    :data="{ tab: tab }"
                                    class="bg-white hover:bg-slate-300 dark:bg-gray-800 rounded-lg"
                                    v-for="subject in item"
                                    :key="subject.id"
                                >
                                    <div class="flex justify-between px-6 pt-6">
                                        <h2
                                            class="text-black text-base dark:text-gray-500 font-bold"
                                        >
                                            {{
                                                subject.subject
                                                    ? subject.subject.name
                                                    : ""
                                            }}
                                        </h2>
                                    </div>
                                    <hr class="dark:border-gray-700" />
                                    <div class="mt-7 ml-6 mr-6">
                                        <div
                                            @click="tabSet('students')"
                                            v-if="
                                                subject.subject &&
                                                subject.subject.course &&
                                                subject.subject.course.students
                                                    .length > 0
                                            "
                                            class="flex -space-x-4"
                                        >
                                            <img
                                                v-for="(student, i) in subject
                                                    .subject.course.students"
                                                :key="i"
                                                class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                                :src="
                                                    student.user
                                                        .profile_photo_url
                                                "
                                                :alt="student.user.name"
                                            />
                                            <span
                                                v-if="
                                                    subject.total_students -
                                                        7 >=
                                                    1
                                                "
                                                class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800"
                                            >
                                                +
                                                {{
                                                    calStudent(
                                                        subject.total_students,
                                                        7
                                                    )
                                                }}
                                            </span>
                                        </div>
                                        <div class="mb-6"></div>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div
                            class="col-span-3 rounded-lg dark:text-gray-400 dark:bg-gray-800 text-center bg-gray-50 p-4"
                        >
                            {{ __("You dont have any subject") }}
                        </div>
                    </template>
                </div>
                <div v-if="request_data.tab == 'assignments'">
                    <div class="my-2">
                        <template v-if="assignments.data.length != 0">
                            <template
                                v-for="(assignments, index) in assignments.data"
                                :key="index"
                            >
                                <div
                                    class="font-bold text-xl py-6 dark:text-gray-400"
                                >
                                    {{ index }}
                                </div>

                                <div
                                    class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4"
                                >
                                    <div
                                        class="bg-white dark:bg-gray-800 dark:text-gray-400 rounded-lg relative group"
                                        v-for="assignment in assignments"
                                        :key="assignment.id"
                                    >
                                        <single-assignment
                                            :assignment="assignment"
                                        />
                                    </div>
                                </div>
                            </template>
                        </template>

                        <template v-else>
                            <div class="col-span-4 text-center">
                                <NothingFound
                                    cssClass="text-center"
                                    asShow="div"
                                />
                            </div>
                        </template>
                        <div class="flex justify-center">
                            <pagination
                                class="mt-6"
                                :links="assignments.links"
                            />
                        </div>
                    </div>
                </div>
                <div v-if="request_data.tab == 'online-classes'">
                    <div class="grid xl:grid-cols-3 gap-6 pt-6">
                        <template v-if="online_classes.data.length != 0">
                            <div
                                class="xl:col-span-2"
                                :class="
                                    createNewClass
                                        ? 'xl:col-span-2'
                                        : 'xl:col-span-3'
                                "
                            >
                                <div
                                    class=""
                                    v-for="(
                                        online_classes, index
                                    ) in online_classes.data"
                                    :key="index"
                                >
                                    <div
                                        class="font-bold text-xl pb-4 dark:text-gray-400"
                                        :class="
                                            index == 'Completed Class'
                                                ? 'mt-4'
                                                : ''
                                        "
                                    >
                                        {{ index }}
                                    </div>
                                    <div
                                        class="grid 2xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6"
                                    >
                                        <single-online-class
                                            :editFunction="edit"
                                            :item="item"
                                            v-for="item in online_classes"
                                            :key="item.id"
                                        />
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <pagination
                                        class="mt-6"
                                        :links="online_classes.links"
                                    />
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <NothingFound
                                asShow="div"
                                cssClass="text-center col-span-3"
                            />
                        </template>
                    </div>
                </div>
                <div v-if="request_data.tab == 'leave-history'">
                    <div class="bg-white dark:bg-gray-800 rounded-lg">
                        <div
                            class="text-lg font-bold dark:text-gray-400 border-b"
                        >
                            <div class="px-6 py-4">
                                {{ __("Leave History") }}
                            </div>
                        </div>
                        <div class="p-6 pt-2.5">
                            <div
                                class="flex justify-between font-bold dark:text-gray-400"
                            >
                                <div>{{ __("Date") }}</div>
                                <div>{{ __("Status") }}</div>
                            </div>
                            <template v-if="leaves.data.length > 0">
                                <div
                                    v-for="leave in leaves.data"
                                    :key="leave"
                                    class="mt-3 dark:text-gray-400 flex justify-between"
                                >
                                    <div
                                        class="font-semibold text-gray-600 dark:text-gray-400"
                                    >
                                        {{ formatTime(leave.start) }} -
                                        {{ formatTime(leave.end) }}
                                    </div>
                                    <span
                                        :class="
                                            leave.status == 'accepted'
                                                ? 'bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900'
                                                : '' ||
                                                  leave.status == 'rejected'
                                                ? 'bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900'
                                                : '' ||
                                                  leave.status == 'pending'
                                                ? 'bg-pink-100 text-pink-800 dark:bg-pink-200 dark:text-pink-900'
                                                : ''
                                        "
                                        class="text-xs dark:opacity-60 font-semibold px-2.5 py-0.5 rounded capitalize"
                                    >
                                        {{ leave.status }}
                                    </span>
                                </div>
                            </template>
                            <template v-else>
                                <div
                                    class="text-center text-sm text-gray-500 mt-2"
                                >
                                    <NothingFound asShow="div" />
                                </div>
                            </template>
                        </div>
                        <pagination
                            class="flex justify-center pb-4"
                            :links="leaves.links"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import NothingFound from "@/Shared/NothingFound.vue";
import dayjs, { Dayjs } from "dayjs";
import SingleAssignment from "../../Student/SingleAssignment.vue";
import SingleOnlineClass from "../../Teacher/SingleOnlineClass.vue";

export default {
    components: {
        AppLayout,
        Pagination,
        NothingFound,
        SingleAssignment,
        SingleOnlineClass,
    },
    props: {
        teacher: Object,
        leaves: Object,
        assignments: Object,
        subjects: Object,
        documents: Object,
        request_data: Object,
        online_classes: Object,
    },
    data() {
        return {
            filter: "Details",
        };
    },
    methods: {
        calStudent(total_amount, amount) {
            return total_amount - amount;
        },
    },
};
</script>

<style lang="scss" scoped></style>
