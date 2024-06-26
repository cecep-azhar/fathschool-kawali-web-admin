<template>
    <Head :title="assignment.title" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Assignment')" />
            <BreadcrumbLink :title="assignment.title" />
        </Breadcrumb>

        <div class="my-2">
            <page-header>
                {{ assignment.title }}
            </page-header>
            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-3">
                    <!-- submission list  -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg">
                        <div
                            class="border-b-2 dark:border-b-gray-600 p-4 text-black dark:text-gray-400 text-base font-bold">
                            {{ __(' Submission List') }}
                        </div>
                        <table class="w-full">
                            <thead class="border-b dark:border-b-gray-600 text-left rtl:text-right dark:text-gray-400">
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Student') }}</th>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('File') }}</th>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Description') }}</th>
                                <th class="py-4 px-5 whitespace-nowrap">{{ __('Mark') }}</th>
                            </thead>
                            <tbody>
                                <template v-if="submissions_list.data.length > 0">
                                    <tr v-for="assignment_item in submissions_list.data" :key="assignment_item.id"
                                        class="text-left rtl:text-right">
                                        <td class="py-4 px-5 whitespace-nowrap">
                                            <div class="text-left rtl:text-right flex gap-2 items-center">
                                                <img class="w-10 h-10 rounded-full"
                                                    :src="assignment_item.student.profile_photo_url" alt="">
                                                <div>
                                                    <div class="text-xs font-bold dark:text-gray-400">
                                                        {{ assignment_item.student.name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ __('Roll') }}: {{ assignment_item.student ?
                                                            assignment_item.student.profile ?
                                                                assignment_item.student.profile.roll_no : '' : '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-5 whitespace-nowrap">
                                            <div class="flex items-center gap-1">
                                                <DocumentIcon class="w-4 h-4 dark:text-gray-400" />
                                                <a :href="assignment_item.assignment_url" target="_blank" download=""
                                                    class="text-xs font-bold">
                                                    {{ __('Download File') }}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="py-4 px-5 cursor-pointer">
                                            <div class="dark:text-gray-400">
                                                <span v-if="submit_des_full == assignment_item.id"
                                                    @click="submit_des_full ? submit_des_full = '' : submit_des_full = assignment_item.id">
                                                    {{ assignment_item.description }} <span class="text-blue-400"> see less</span>
                                                </span>
                                                <span v-else
                                                    @click="submit_des_full ? submit_des_full = '' : submit_des_full = assignment_item.id">
                                                    {{ assignment_item.description.length > 15 ?
                                                        assignment_item.description.slice(0, 15) :
                                                        assignment_item.description }}
                                                    <span v-if="assignment_item.description.length > 15"
                                                        class="text-blue-400">see more...</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-5 whitespace-nowrap">
                                            <template v-if="$page.props.auth.role == 'Teacher'">
                                                <button @click="giveMark(assignment_item.id, assignment_item.gained_mark)"
                                                    type="button" class="text-blue-500">
                                                    {{ assignment_item.gained_mark }}
                                                </button>
                                            </template>
                                            <template v-else>
                                                <button type="button" class="text-blue-500">
                                                    {{ assignment_item.gained_mark }}
                                                </button>
                                            </template>
                                            <button v-if="assignment_item.completed" type="button"
                                                class="text-gray-500 ml-4">
                                                {{ __('Completed') }}
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <NothingFound asShow="tr" />
                                </template>
                            </tbody>
                        </table>
                        <div class="flex justify-center ">
                            <pagination class="mt-6" :links="submissions_list.links" />
                        </div>
                        <br>
                    </div>
                    <!-- remaining submission list  -->
                    <div class="mt-4">
                        <div class="bg-white dark:bg-gray-800 rounded-lg">
                            <div class="pt-5 px-4 flex justify-between items-center">
                                <div class="font-bold dark:text-gray-400">
                                    {{ __('Remaining Submissions') }}
                                </div>
                                <button v-if="can('remind.them')" type="button" @click="remindThem"
                                    class="text-blue-500 font-bold">
                                    {{ __('Remind Them') }}
                                </button>
                            </div>
                            <div class="grid grid-cols-3 gap-2 p-4">
                                <template v-if="remaining_students.data.length > 0">
                                    <!-- remaining_students -->
                                    <div v-for="student_item in remaining_students.data" :key="student_item.id"
                                        class="bg-gray-100 dark:bg-gray-700 p-3 rounded">
                                        <div class="text-left rtl:text-right flex gap-2 items-center">
                                            <img class="w-10 h-10 rounded-full" :src="student_item.profile_photo_url"
                                                alt="">
                                            <div>
                                                <div class="text-xs font-bold text-gray-700 dark:text-gray-400">
                                                    {{ student_item.name }}
                                                </div>
                                                <div class="text-xs text-gray-700 dark:text-gray-400">
                                                    {{ __('Roll') }}: {{ student_item.profile ?
                                                        student_item.profile.roll_no : '' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <NothingFound asShow="div" cssClass="text-center" />
                                </template>
                                <div class="flex justify-center">
                                    <pagination class="mt-6" :links="remaining_students.links" />
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <!-- assignment info  -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg">
                        <div class="pt-5 px-4 flex justify-between items-center">
                            <div class="font-bold dark:text-gray-400">
                                {{ __('Assignment Information') }}
                            </div>
                        </div>
                        <div class="p-4">
                            <div>
                                <div class="mb-3 text-left rtl:text-right flex gap-2 items-center">
                                    <DocumentIcon class="w-6 h-6 dark:text-gray-400" />
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Course') }}: </div>
                                    <div class="text-sm font-bold dark:text-gray-400">
                                        {{ assignment.class ? assignment.class.name : '' }}
                                    </div>
                                </div>
                                <div class="mb-3 text-left rtl:text-right flex gap-2 items-center">
                                    <DocumentCheckIcon class="w-6 h-6 dark:text-gray-400" />
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Subject') }}: </div>
                                    <div class="text-sm font-bold dark:text-gray-400">
                                        {{ assignment.subject ? assignment.subject.name : '' }}
                                    </div>
                                </div>
                                <div class="mb-3 text-left rtl:text-right flex gap-2 items-center">
                                    <UserCircleIcon class="w-6 h-6 dark:text-gray-400" />
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Teacher') }}: </div>
                                    <div class="text-sm font-bold dark:text-gray-400">
                                        {{ assignment.teacher ? assignment.teacher.name : '' }}
                                    </div>
                                </div>
                                <div class="mb-3 text-left rtl:text-right flex gap-2 items-center">
                                    <CalendarDaysIcon class="w-6 h-6 dark:text-gray-400" />
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Due Date') }}: </div>
                                    <div class="text-sm font-bold dark:text-gray-400">
                                        {{ assignment.deadline ?? '' }}
                                    </div>
                                </div>
                                <div class="mb-3 text-left rtl:text-right flex gap-2 items-center">
                                    <CheckCircleIcon class="w-6 h-6 dark:text-gray-400" />
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Status') }}: </div>
                                    <div :class="assignment.status == 'Expired' ? 'bg-red-500' : 'bg-blue-500'"
                                        class="rounded-full text-blue-100 px-3 dark:text-gray-900">
                                        <div>
                                            {{ assignment.status ?? '' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-left rtl:text-right flex gap-2 items-center">
                                    <div class="cursor-pointer text-sm text-gray-500 dark:text-gray-400 flex gap-2">
                                        <span class="flex gap-2">
                                            <BookOpenIcon class="w-6 h-6 dark:text-gray-400" />
                                            <span>{{ __('Description') }}:</span>
                                        </span>
                                        <div v-if="des_full" @click="des_full ? des_full = false : des_full = true">
                                            {{ assignment.description }}
                                        </div>
                                        <div v-else @click="des_full ? des_full = false : des_full = true">
                                            {{ str_limit(assignment.description, 60) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="border-b-2 dark:border-b-gray-600 mb-2"></div>
                                <div class="mb-3 text-left rtl:text-right flex gap-2 items-center">
                                    <UsersIcon class="w-6 h-6 dark:text-gray-400" />
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Student') }}: </div>
                                    <div class="text-sm font-bold dark:text-gray-400">
                                        {{ students }} {{ __('Total Students') }}
                                    </div>
                                </div>
                                <div class="mb-3 text-left rtl:text-right flex gap-2 items-center">
                                    <CheckCircleIcon class="w-6 h-6 dark:text-gray-400" />
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Submission') }}: </div>
                                    <div class="text-sm font-bold dark:text-gray-400">
                                        {{ submissions }} {{ __('Submissions') }}
                                    </div>
                                </div>
                                <div class="mb-3 text-left rtl:text-right flex gap-2 items-center">
                                    <DocumentIcon class="w-6 h-6 dark:text-gray-400" />
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Remaining') }}: </div>
                                    <div class="text-sm font-bold dark:text-gray-400">
                                        {{ students - submissions }} {{ __('Students Remaining') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="$page.props.auth.role == 'Student'" class="bg-white dark:bg-gray-800 mt-4 rounded-lg">
                        <div class="pt-5 px-4 flex justify-between items-center">
                            <div class="font-bold dark:text-gray-400">
                                {{ __('Submit Your Assignment') }}
                            </div>
                        </div>
                        <div class="p-4">
                            <form @submit.prevent="upload">
                                <div class="mb-3">
                                    <global-label for="file" value="File" :required="true" />
                                    <button type="button" @click="picFile"
                                        class="bg-gray-100 dark:bg-gray-700 w-full py-2.5 px-3 rounded-lg">
                                        <div class="flex gap-2 items-center">
                                            <div>
                                                <ArrowUpTrayIcon class="w-6 h-6" />
                                            </div>
                                            <div>
                                                <span v-if="file_name" class="text-blue-500">
                                                    {{ file_name }}
                                                </span>
                                                <span v-else>
                                                    {{ __('Upload File') }}
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                    <span class="text-gray-500">
                                        {{ __('Supported format - png, jpg, jpeg, pdf, zip, doc, docx') }}
                                    </span>
                                    <input @change="change"
                                        accept="image/*,application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                        type="file" ref="assignment_file" class="hidden" readonly>
                                    <input-error :error="$page.props.errors.file" />
                                </div>
                                <div class="mt-4">
                                    <global-label for="description" value="Description" :required="false" />
                                    <global-textarea id="description" v-model="form.description" type="text"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Description')" :error="$page.props.errors.description">
                                    </global-textarea>
                                    <input-error :error="$page.props.errors.description" />
                                </div>
                                <global-button :loading="form.processing" type="submit" cssClass="mt-3" theme="primary">
                                    {{ assignment.submitted_done ? __('Submit Again') : __('Submit') }}
                                </global-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal For Create N Update -->
        <a-modal v-model:visible="modal" width="400px" title="Give Mark" @ok="handleOk">
            <template #footer>
                <div class="flex gap-2">
                    <global-button :loading="loading" type="button" @click="storeMark" theme="primary">
                        {{ __('Save') }}
                    </global-button>
                    <global-button :loading="false" type="button" @click="modal = false" theme="outline-danger">
                        {{ __('Cancel') }}
                    </global-button>
                </div>
            </template>
            <form class=" dark:bg-gray-800 dark:p-4 rounded-lg">
                <div class="mb-1 mr-4">
                    <global-label for="mark" value="Mark" :required="true" />
                    <global-input type="number" v-model="giveMarkForm.mark" id="mark" name="mark"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                        :placeholder="__('Mark Amount')" :error="$page.props.errors.mark" />
                    <input-error :error="$page.props.errors.mark" />
                </div>
                <div class="mb-1 mr-4 mt-3">
                    <global-label for="completed" value="Completed" :required="false" />
                    <div class="flex items-center">
                        <input v-model="giveMarkForm.completed" id="completed" type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="completed" class="ml-2 text-sm font-medium text-gray-400 dark:text-gray-500">
                            {{ __('Mark As Completed') }}
                        </label>
                    </div>
                </div>
            </form>
        </a-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from '@/Shared/Admin/Pagination.vue';
import NothingFound from "@/Shared/NothingFound.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import {
    DocumentIcon,
    DocumentCheckIcon,
    UserCircleIcon,
    ArrowUpTrayIcon,
    CalendarDaysIcon,
    UsersIcon,
    CheckCircleIcon,
    BookOpenIcon
} from "@heroicons/vue/24/outline";

export default {
    props: {
        assignment: Object,
        students: Number,
        submissions: Number,
        remaining_students: Object,
        submissions_list: Object,
        remaining_student_ids: Array
    },
    components: {
        Pagination,
        AppLayout,
        DocumentIcon,
        BookOpenIcon,
        DocumentCheckIcon,
        UsersIcon,
        ArrowUpTrayIcon,
        UserCircleIcon,
        CheckCircleIcon,
        CalendarDaysIcon,
        NothingFound
    },
    data() {
        return {
            file_name: '',
            des_full: false,
            submit_des_full: '',
            modal: false,
            form: useForm({
                assignment: this.assignment.id,
                file: '',
                description: '',
            }),
            giveMarkForm: useForm({
                mark: '',
                assignment: '',
                completed: false
            })
        }
    },
    methods: {
        str_limit(value, size) {
            if (!value) return '';
            value = value.toString();

            if (value.length <= size) {
                return value;
            }
            return value.substr(0, size) + '...';
        },
        picFile() {
            this.$refs.assignment_file.click();
        },
        giveMark(id, mark) {
            this.modal = true;
            this.giveMarkForm.assignment = id;
            this.giveMarkForm.mark = mark;
        },
        change(e) {
            this.form.file = e.target.files[0];

            let selectedFiles = e.target.files[0];
            this.file_name = selectedFiles.name;
        },
        remindThem() {
            this.$inertia.post(route('teacher.remind.them'), {
                data: this.remaining_student_ids,
                assignment: this.assignment.id
            })
        },
        storeMark() {
            this.giveMarkForm.post(this.route('teacher.give.assignment.mark'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.modal = false;
                    giveMarkForm.reset('mark');
                },
            });
        },
        upload() {
            this.form.post(this.route('assignment.submit'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset('assignment', 'file', 'description')
                    this.$refs.assignment_file.value = '';
                },
            });
        },
        submit() {
            this.$inertia.post(this.route('teacher.give.assignment.mark'), this.form, {
                preserveScroll: true,
                onSuccess: (page) => {
                    this.edit_mark = false;
                }
            });

            return value.substr(0, size) + '...';
        },
    },
}
</script>
