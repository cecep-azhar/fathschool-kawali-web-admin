<template>
    <AppLayout :title="__('Student Details')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Student')" />
            <BreadcrumbLink :title="__(student.name)" />
        </Breadcrumb>

        <div class="my-2">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ student.name }} {{ __("Details") }}
                </div>
                <template #content>
                    <div
                        class="flex flex-wrap bg-gray-200/50 hover:bg-gray-200 rounded-lg transition py-1 px-2 dark:bg-gray-700 dark:hover:bg-gray-700/70"
                    >
                        <Link
                            :href="route('student.show', student.username)"
                            :data="{ tab: 'details' }"
                            :class="
                                !request_data.tab ||
                                request_data.tab == 'details'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold testStudent"
                        >
                            {{ __("Student") }}
                        </Link>
                        <Link
                            :href="route('student.show', student.username)"
                            :data="{ tab: 'attendance' }"
                            :class="
                                request_data.tab == 'attendance'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold testAttendance"
                        >
                            {{ __("Attendance") }}
                        </Link>
                        <Link
                            :href="route('student.show', student.username)"
                            :data="{ tab: 'transactions' }"
                            :class="
                                request_data.tab == 'transactions'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold testTransactions"
                        >
                            {{ __("Payment Invoices") }}
                        </Link>
                        <Link
                            :href="route('student.show', student.username)"
                            :data="{ tab: 'exams' }"
                            :class="
                                request_data.tab == 'exams'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold testExams"
                        >
                            {{ __("Exams and Grades") }}
                        </Link>
                        <Link
                            :href="route('student.show', student.username)"
                            :data="{ tab: 'leave-history' }"
                            :class="
                                request_data.tab == 'leave-history'
                                    ? 'bg-white dark:bg-gray-500'
                                    : ''
                            "
                            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold testLeaveHistory"
                        >
                            {{ __("Leave History") }}
                        </Link>
                    </div>
                </template>
            </page-header>
            <div>
                <div v-if="!request_data.tab || request_data.tab == 'details'">
                    <div
                        class="flex flex-col gap-6 lg:items-start lg:flex-row mb-6"
                    >
                        <div
                            class="lg:w-1/2 w-full bg-white dark:bg-gray-800 rounded-lg p-6"
                        >
                            <div
                                class="flex gap-4 items-center pb-4 border-b-2 dark:border-gray-600"
                            >
                                <img
                                    :src="student.profile_photo_url"
                                    alt=""
                                    class="w-20 h-20 rounded-full object-cover"
                                />
                                <div>
                                    <h2 class="mb-2 text-lg dark:text-gray-400">
                                        {{ student.name }}
                                    </h2>
                                    <p
                                        class="mb-2 text-sm flex gap-1 items-center dark:text-gray-400"
                                    >
                                        <EnvelopeIcon class="w-6 h-6" />
                                        {{ student.email }}
                                    </p>
                                    <p
                                        class="mb-0 text-sm flex gap-1 items-center dark:text-gray-400"
                                    >
                                        <PhoneIcon class="w-6 h-6" />
                                        {{ student.phone }}
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 pt-4">
                                <div class="flex gap-2">
                                    <div>
                                        <HashtagIcon
                                            class="w-6 h-6 text-blue-600"
                                        />
                                    </div>
                                    <div>
                                        <h4
                                            class="text-gray-900 dark:text-gray-500 mb-1"
                                        >
                                            {{ __("NISN") }}:
                                        </h4>
                                        <h3
                                            class="text-gray-600 dark:text-gray-400 mb-0 flex"
                                        >
                                            {{ student?.nisn ?? "" }}
                                            <template
                                                v-if="student?.nisn ?? false"
                                            >
                                            </template>
                                        </h3>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <div>
                                        <HashtagIcon
                                            class="w-6 h-6 text-blue-600"
                                        />
                                    </div>
                                    <div>
                                        <h4
                                            class="text-gray-900 dark:text-gray-500 mb-1"
                                        >
                                            {{ __("RFID") }}:
                                        </h4>
                                        <h3
                                            class="text-gray-600 dark:text-gray-400 mb-0 flex"
                                        >
                                            {{ student?.rfid ?? "" }}
                                            <template
                                                v-if="student?.rfid ?? false"
                                            >
                                            </template>
                                        </h3>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <div>
                                        <HashtagIcon
                                            class="w-6 h-6 text-blue-600"
                                        />
                                    </div>
                                    <div>
                                        <h4
                                            class="text-gray-900 dark:text-gray-500 mb-1"
                                        >
                                            {{ __("Student ID") }}:
                                        </h4>
                                        <h3
                                            class="text-gray-600 dark:text-gray-400 mb-0 flex"
                                        >
                                            {{
                                                student?.profile?.student_id ??
                                                ""
                                            }}
                                            <template
                                                v-if="
                                                    student?.profile
                                                        ?.student_id ?? false
                                                "
                                            >
                                                <CopyText
                                                    :text="
                                                        student.profile
                                                            .student_id
                                                    "
                                                />
                                            </template>
                                        </h3>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <div>
                                        <HashtagIcon
                                            class="w-6 h-6 text-blue-600"
                                        />
                                    </div>
                                    <div>
                                        <h4
                                            class="text-gray-900 dark:text-gray-500 mb-1"
                                        >
                                            {{ __("Roll No") }}:
                                        </h4>
                                        <h3
                                            class="text-gray-600 dark:text-gray-400 mb-0"
                                        >
                                            {{
                                                student.profile
                                                    ? student.profile.roll_no
                                                    : "-"
                                            }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <div>
                                        <Square3Stack3DIcon
                                            class="w-6 h-6 text-blue-600"
                                        />
                                    </div>
                                    <div>
                                        <h4
                                            class="text-gray-900 dark:text-gray-500 mb-1"
                                        >
                                            {{ __("Date of Birth") }}:
                                        </h4>
                                        <h3
                                            class="text-gray-600 dark:text-gray-400 mb-0"
                                        >
                                            {{ student.date_of_birth ?? "-" }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <div>
                                        <DocumentCheckIcon
                                            class="w-6 h-6 text-blue-600"
                                        />
                                    </div>
                                    <div>
                                        <h4
                                            class="text-gray-900 dark:text-gray-500 mb-1"
                                        >
                                            {{ __("Average Attendance") }}:
                                        </h4>
                                        <h3
                                            class="text-gray-600 dark:text-gray-400 mb-0"
                                        >
                                            {{ attendance_marks }}%
                                        </h3>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <div>
                                        <BookOpenIcon
                                            class="w-6 h-6 text-blue-600"
                                        />
                                    </div>
                                    <div>
                                        <h4
                                            class="text-gray-900 dark:text-gray-500 mb-1"
                                        >
                                            {{ __("Course") }}:
                                        </h4>
                                        <h3
                                            class="text-gray-600 dark:text-gray-400 mb-0"
                                        >
                                            <template v-if="courses.length > 0">
                                                <template
                                                    v-for="(
                                                        course, index
                                                    ) in courses"
                                                    :key="index"
                                                >
                                                    {{ course }}
                                                    <template
                                                        v-if="
                                                            index !=
                                                            courses.length - 1
                                                        "
                                                        >,</template
                                                    >
                                                </template>
                                            </template>
                                            <template v-else>-</template>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:w-1/2">
                            <div
                                class="w-full bg-white dark:bg-gray-800 rounded-lg"
                            >
                                <div class="text-xl dark:text-gray-400 p-6">
                                    {{ __("Student Documents") }}
                                </div>
                                <hr class="dark:border-gray-600" />
                                <ul class="flex flex-col gap-4 mb-0">
                                    <template
                                        v-if="student.documents.length > 0"
                                    >
                                        <li
                                            v-for="(
                                                document, index
                                            ) in student.documents"
                                            :key="index"
                                            class="flex justify-between items-center p-6"
                                        >
                                            <div>
                                                <div
                                                    class="text-base flex gap-1.5 items-center mb-0 dark:text-gray-400"
                                                >
                                                    <DocumentTextIcon
                                                        class="w-6 h-6"
                                                    />
                                                    {{ document.title }}
                                                </div>
                                            </div>
                                            <a
                                                :href="document.file_url_format"
                                                target="_blank"
                                                download=""
                                            >
                                                <FolderArrowDownIcon
                                                    class="w-8 h-8 text-blue-600"
                                                />
                                            </a>
                                        </li>
                                    </template>
                                    <template v-else>
                                        <li
                                            class="flex justify-center items-center"
                                        >
                                            <NothingFound
                                                asShow="div"
                                                cssClass="text-center"
                                            />
                                        </li>
                                    </template>
                                </ul>
                            </div>
                            <div
                                class="mt-2 w-full bg-white dark:bg-gray-800 rounded-lg"
                            >
                                <div class="text-xl dark:text-gray-400 p-6">
                                    {{ __("Student Additional Information") }}
                                </div>
                                <hr class="dark:border-gray-600" />
                                <div class="px-4 flex flex-col gap-4 mb-0">
                                    <div
                                        class="grid grid-cols-1 lg:grid-cols-3 gap-4 pt-4"
                                    >
                                        <div class="flex gap-2">
                                            <div>
                                                <ArrowLongRightIcon
                                                    class="w-6 h-6 text-blue-600"
                                                />
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-gray-900 dark:text-gray-500 mb-1"
                                                >
                                                    {{ __("Blood Group") }}:
                                                </h4>
                                                <h3
                                                    class="text-gray-600 dark:text-gray-400 mb-0"
                                                >
                                                    {{
                                                        student.profile
                                                            ? student.profile
                                                                  .blood_group
                                                            : "-"
                                                    }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <div>
                                                <ArrowLongRightIcon
                                                    class="w-6 h-6 text-blue-600"
                                                />
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-gray-900 dark:text-gray-500 mb-1"
                                                >
                                                    {{
                                                        __(
                                                            "Physical Disability"
                                                        )
                                                    }}:
                                                </h4>
                                                <h3
                                                    class="text-gray-600 dark:text-gray-400 mb-0"
                                                >
                                                    {{
                                                        student.profile
                                                            ? student.profile
                                                                  .physical_disability
                                                            : "-"
                                                    }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <div>
                                                <ArrowLongRightIcon
                                                    class="w-6 h-6 text-blue-600"
                                                />
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-gray-900 dark:text-gray-500 mb-1"
                                                >
                                                    {{
                                                        __(
                                                            "Previous School Name"
                                                        )
                                                    }}:
                                                </h4>
                                                <h3
                                                    class="text-gray-600 dark:text-gray-400 mb-0"
                                                >
                                                    {{
                                                        student.profile
                                                            ? student.profile
                                                                  .previous_school_name
                                                            : "-"
                                                    }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <div>
                                                <ArrowLongRightIcon
                                                    class="w-6 h-6 text-blue-600"
                                                />
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-gray-900 dark:text-gray-500 mb-1"
                                                >
                                                    {{
                                                        __(
                                                            "Previous School Year Of Exist"
                                                        )
                                                    }}:
                                                </h4>
                                                <h3
                                                    class="text-gray-600 dark:text-gray-400 mb-0"
                                                >
                                                    {{
                                                        student.profile
                                                            ? student.profile
                                                                  .previous_school_year_of_exist
                                                            : "-"
                                                    }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <div>
                                                <ArrowLongRightIcon
                                                    class="w-6 h-6 text-blue-600"
                                                />
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-gray-900 dark:text-gray-500 mb-1"
                                                >
                                                    {{ __("Religion") }}:
                                                </h4>
                                                <h3
                                                    class="text-gray-600 dark:text-gray-400 mb-0"
                                                >
                                                    {{
                                                        student.profile
                                                            ? student.profile
                                                                  .religion
                                                            : "-"
                                                    }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <div>
                                                <ArrowLongRightIcon
                                                    class="w-6 h-6 text-blue-600"
                                                />
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-gray-900 dark:text-gray-500 mb-1"
                                                >
                                                    {{
                                                        __(
                                                            "National Identification Number"
                                                        )
                                                    }}:
                                                </h4>
                                                <h3
                                                    class="text-gray-600 dark:text-gray-400 mb-0"
                                                >
                                                    {{
                                                        student.profile
                                                            ? student.profile
                                                                  .national_identification_number
                                                            : "-"
                                                    }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <div>
                                                <ArrowLongRightIcon
                                                    class="w-6 h-6 text-blue-600"
                                                />
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-gray-900 dark:text-gray-500 mb-1"
                                                >
                                                    {{ __("Bank Name") }}:
                                                </h4>
                                                <h3
                                                    class="text-gray-600 dark:text-gray-400 mb-0"
                                                >
                                                    {{
                                                        student.profile
                                                            ? student.profile
                                                                  .bank_name
                                                            : "-"
                                                    }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <div>
                                                <ArrowLongRightIcon
                                                    class="w-6 h-6 text-blue-600"
                                                />
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-gray-900 dark:text-gray-500 mb-1"
                                                >
                                                    {{
                                                        __(
                                                            "Bank Account Number"
                                                        )
                                                    }}:
                                                </h4>
                                                <h3
                                                    class="text-gray-600 dark:text-gray-400 mb-0"
                                                >
                                                    {{
                                                        student.profile
                                                            ? student.profile
                                                                  .bank_account_number
                                                            : "-"
                                                    }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <div>
                                                <ArrowLongRightIcon
                                                    class="w-6 h-6 text-blue-600"
                                                />
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-gray-900 dark:text-gray-500 mb-1"
                                                >
                                                    {{ __("Note") }}:
                                                </h4>
                                                <h3
                                                    class="text-gray-600 dark:text-gray-400 mb-0"
                                                >
                                                    {{
                                                        student.profile
                                                            ? student.profile
                                                                  .note
                                                            : "-"
                                                    }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white rounded-lg dark:bg-gray-800 dark:text-gray-400"
                    >
                        <div class="px-4 text-lg font-bold dark:text-gray-400">
                            <div class="mb-3 pt-3">
                                {{ __("Parent List") }}
                            </div>
                        </div>
                        <hr class="border-gray-100 dark:border-gray-600" />
                        <div
                            class="grid lg:grid-cols-2 sm:grid-cols-2 grid-cols-1 p-6"
                        >
                            <template v-if="parents.length">
                                <Link
                                    v-for="parent in parents"
                                    :key="parent.id"
                                    :href="route('parent.show', parent.id)"
                                    class="py-4 px-6 bg-white dark:bg-gray-700 rounded-lg"
                                >
                                    <div
                                        class="flex items-center gap-2 border dark:border-gray-600 p-3"
                                    >
                                        <div>
                                            <img
                                                width="100"
                                                height="100"
                                                class="rounded"
                                                :src="parent.profile_photo_url"
                                            />
                                        </div>
                                        <div
                                            class="mt-2 font-semibold dark:text-gray-400"
                                        >
                                            <div class="flex">
                                                <span>{{ __("Email") }}:</span>
                                                <span class="ml-2 capitalize">
                                                    {{ parent.email }}
                                                </span>
                                            </div>
                                            <div class="flex">
                                                <span
                                                    >{{
                                                        __("Phone Number")
                                                    }}:</span
                                                >
                                                <span class="ml-2 capitalize">
                                                    {{ parent.phone }}
                                                </span>
                                            </div>
                                            <div class="flex">
                                                <span
                                                    >{{ __("Address") }}:</span
                                                >
                                                <span class="ml-2 capitalize">
                                                    {{ parent.address }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </Link>
                            </template>
                            <div v-else class="text-center p-4">
                                {{ __("Nothing Found") }}
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="request_data.tab == 'attendance'">
                    <div class="bg-white dark:bg-gray-800 rounded-lg">
                        <div class="p-4 font-bold text-lg dark:text-gray-400">
                            {{ __("Attendance History") }}
                        </div>
                        <hr class="border-gray-100" />
                        <global-table>
                            <template #head>
                                <th class="py-5 px-5">{{ __("Subject") }}</th>
                                <th class="py-5">{{ __("Status") }}</th>
                                <th class="py-5 px-5">{{ __("Date") }}</th>
                            </template>
                            <template #body>
                                <template
                                    v-if="attendances_data.data.length > 0"
                                >
                                    <template
                                        v-for="attendance in attendances_data.data"
                                        :key="attendance.id"
                                    >
                                        <tr
                                            class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        >
                                            <td class="py-5 px-5">
                                                {{
                                                    attendance.subject
                                                        ? attendance.subject
                                                              .name
                                                        : "-"
                                                }}
                                            </td>
                                            <td class="py-5 capitalize">
                                                <span
                                                    v-if="
                                                        attendance.status ==
                                                        'late'
                                                    "
                                                >
                                                    {{ attendance.late_amount }}
                                                    {{ __("Minutes") }}
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
                                    <NothingFound asShow="tr" />
                                </template>
                            </template>
                        </global-table>
                        <div class="flex justify-center">
                            <pagination
                                class="mt-6"
                                :links="attendances_data.links"
                            />
                        </div>
                        <br />
                    </div>
                </div>
                <div v-if="request_data.tab == 'transactions'">
                    <div class="bg-white dark:bg-gray-800 rounded-lg">
                        <div class="p-4 font-bold text-lg dark:text-gray-400">
                            {{ __("Invoice History") }}
                        </div>
                        <hr class="border-gray-100" />
                        <global-table>
                            <template #head>
                                <th class="py-5 px-5">{{ __("Title") }}</th>
                                <th class="py-5">{{ __("Amount") }}</th>
                                <th class="py-5">{{ __("Paid Amount") }}</th>
                                <th class="py-5">{{ __("Status") }}</th>
                            </template>
                            <template #body>
                                <template v-if="transactions.data.length > 0">
                                    <template
                                        v-for="transaction in transactions.data"
                                        :key="transaction.id"
                                    >
                                        <tr
                                            class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        >
                                            <td class="py-5 px-5">
                                                {{ transaction.title }}
                                            </td>
                                            <td class="py-5">
                                                {{ transaction.amount }}
                                                {{ transaction.currency }}
                                            </td>
                                            <td class="py-5">
                                                {{ transaction.paid_amount }}
                                                {{ transaction.currency }}
                                            </td>
                                            <td class="py-5 capitalize">
                                                {{ transaction.status }}
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
                            <pagination
                                class="mt-6"
                                :links="transactions.links"
                            />
                        </div>
                        <br />
                    </div>
                    <div class="mt-2">
                        <div class="bg-white dark:bg-gray-800 rounded-lg">
                            <div
                                class="p-4 font-bold text-lg dark:text-gray-400"
                            >
                                {{ __("Exam List") }}
                            </div>
                            <hr class="border-gray-100" />
                            <global-table>
                                <template #head>
                                    <th class="py-5 px-5">{{ __("Name") }}</th>
                                    <th class="py-5">{{ __("Grade") }}</th>
                                    <th class="py-5 px-5">{{ __("GPA") }}</th>
                                    <th class="py-5 px-5">
                                        {{ __("Status") }}
                                    </th>
                                </template>
                                <template #body>
                                    <template v-if="exams.data.length > 0">
                                        <template
                                            v-for="exam in exams.data"
                                            :key="exam.id"
                                        >
                                            <tr
                                                class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                            >
                                                <td class="py-5 px-5">
                                                    {{ exam.name ?? "-" }}
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
                                        <NothingFound asShow="tr" />
                                    </template>
                                </template>
                            </global-table>
                            <div class="flex justify-center">
                                <pagination class="mt-6" :links="exams.links" />
                            </div>
                            <br />
                        </div>
                    </div>
                </div>
                <div v-if="request_data.tab == 'exams'">
                    <div class="bg-white dark:bg-gray-800 rounded-lg">
                        <div class="p-4 font-bold text-lg dark:text-gray-400">
                            {{ __("Exams and Grades") }}
                        </div>
                        <hr class="border-gray-100" />
                        <global-table>
                            <template #head>
                                <th class="py-4 px-5">{{ __("Name") }}</th>
                                <th class="py-4 px-5">{{ __("Grade") }}</th>
                                <th class="py-4 px-5">{{ __("GPA") }}</th>
                                <th class="py-4 px-5">{{ __("Status") }}</th>
                            </template>
                            <template #body>
                                <template v-if="exams.data.length > 0">
                                    <template
                                        v-for="exam in exams.data"
                                        :key="exam.id"
                                    >
                                        <tr
                                            class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        >
                                            <td class="py-4 px-5">
                                                {{ exam.name ?? "-" }}
                                            </td>
                                            <td class="py-4 px-5 capitalize">
                                                {{ exam.grade }}
                                            </td>
                                            <td class="py-4 px-5">
                                                {{ exam.gpa }}
                                            </td>
                                            <td class="py-4 px-5">
                                                {{ exam.status }}
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
                            <pagination class="mt-6" :links="exams.links" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="bg-white dark:bg-gray-800 rounded-lg">
                            <div
                                class="p-4 font-bold text-lg dark:text-gray-400"
                            >
                                {{ __("Exam Results") }}
                            </div>
                            <hr class="border-gray-100" />
                            <global-table>
                                <template #head>
                                    <th class="py-5 px-5">{{ __("Exam") }}</th>
                                    <th class="py-5">{{ __("Result") }}</th>
                                </template>
                                <template #body>
                                    <template v-if="results?.data.length > 0">
                                        <template
                                            v-for="result in results.data"
                                            :key="result.id"
                                        >
                                            <tr
                                                class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                            >
                                                <td class="py-5 px-5">
                                                    {{
                                                        result?.exam?.name ?? ""
                                                    }}
                                                </td>
                                                <td class="py-5">
                                                    <a
                                                        :href="
                                                            result.attachment_url
                                                        "
                                                        download
                                                    >
                                                        <global-button
                                                            type="submit"
                                                            class="text-white bg-gray-500 dark:bg-gray-500 hover:bg-gray-500"
                                                        >
                                                            {{
                                                                __(
                                                                    "Download Sheets"
                                                                )
                                                            }}
                                                        </global-button>
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
                                <pagination class="mt-6" :links="exams.links" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import dayjs, { Dayjs } from "dayjs";
import NothingFound from "@/Shared/NothingFound.vue";
import CopyText from "@/Shared/CopyText.vue";
import {
    DocumentTextIcon,
    DocumentCheckIcon,
    FolderArrowDownIcon,
    BookOpenIcon,
    EnvelopeIcon,
    PhoneIcon,
    HashtagIcon,
    Square3Stack3DIcon,
    ArrowLongRightIcon,
} from "@heroicons/vue/24/outline";

export default {
    components: {
        AppLayout,
        Pagination,
        NothingFound,
        CopyText,
        DocumentTextIcon,
        FolderArrowDownIcon,
        EnvelopeIcon,
        PhoneIcon,
        HashtagIcon,
        Square3Stack3DIcon,
        DocumentCheckIcon,
        BookOpenIcon,
        ArrowLongRightIcon,
    },
    props: {
        student: Object,
        leaves: Object,
        transactions: Object,
        assignment_marks: Number,
        attendance_marks: Number,
        attendances_data: Object,
        exams: Object,
        courses: Array,
        request_data: Object,
        parents: Object,
    },
    data() {
        return {
            filter: "Student",
        };
    },
    methods: {
        dateFormat(value) {
            return dayjs(value).format("MMM DD, YYYY");
        },
    },
};
</script>

<style lang="scss" scoped></style>
