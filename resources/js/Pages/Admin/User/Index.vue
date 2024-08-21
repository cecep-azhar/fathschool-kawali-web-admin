<template>
    <AppLayout :title="__('Users')">

    <Breadcrumb>
        <BreadcrumbLink :title=" __('Users')"/>
    </Breadcrumb>

        <div >
            <div class="flex gap-6 flex-wrap lg:flex-nowrap w-full mb-3">
                <Link v-for="(item, index) in stats" :key="index" preserve-scroll :href="route('users.index', { query: item.query })"
                    class="hover:bg-gray-50 shadow-sm flex items-center w-64 flex-grow gap-4 p-6 bg-white border border-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-800 rounded-lg" :id="'test_' + item.query">
                    <span class="p-3 text-blue-600 bg-blue-100 dark:bg-blue-500/20 rounded-full">
                        <UserGroupIcon class="w-6 h-6" />
                    </span>
                    <div>
                        <h3 class="text-2xl mb-0 font-medium text-gray-900 dark:text-gray-400">
                            {{ item.data }}
                        </h3>
                        <p class="text-sm mb-0 text-gray-400">
                            {{ item.title }}
                        </p>
                    </div>
                </Link>
            </div>
            <page-header>
                {{ __('All User') }}
                <badge>
                    {{ users.total }}
                </badge>
                <template #content>
                    <Link preserve-scroll :href="route('users.index')" v-if="term">
                    <global-button :loading="false" type="button"
                        class="text-white bg-pink-500 dark:bg-pink-500  hover:bg-pink-400 active:bg-pink-600 dark:active:bg-pink-600 focus:border-pink-600 dark:focus:border-pink-600 focus:ring focus:ring-pink-300 dark:focus:ring-pink-300">
                        {{ __('All User') }}
                    </global-button>
                    </Link>
                    <global-button :loading="false" @click="exportSubmit()" type="button" theme="sky">
                    {{ __('Export') }}
                    </global-button>
                    <global-button preserve-scroll :loading="false" type="link" cssClass="ml-2"
                        :url="route('users.create')" theme="primary">
                        {{ __('Create User') }}
                    </global-button>
                </template>
            </page-header>
            <div class="mb-3">
                <form class="items-center grid grid-cols-1 md:grid-cols-9 gap-6" @submit.prevent="filterData()">
                    <div class="flex col-span-4">
                        <div class="relative w-full">
                            <global-label for="name" value="Search Here" :required="false" />
                            <global-input type="search"
                                class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Name, Email or Role')" v-model="filter.keyword" />
                            <button type="submit"
                                class="absolute top-6 rtl:left-0 rtl:right-auto right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rtl:rounded-r-0 rtl:rounded-l-lg rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <MagnifyingGlassIcon class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                    <div class="col-span-4 mt-0.5">
                        <global-label for="name" value="Select Role" :required="false" />
                        <Multiselect :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                            v-model="filter.query"  :placeholder="__('Select a role')" :options="[
                                { 'label': 'All', 'value': 'all' },
                                { 'label': 'Admins', 'value': 'Admin' },
                                { 'label': 'Parents', 'value': 'Parent' },
                                { 'label': 'Admission', 'value': 'Student' },
                                { 'label': 'Teachers', 'value': 'Teacher' },
                                { 'label': 'Accountant', 'value': 'Other' },
                            ]" autocomplete="off" />
                    </div>
                    <div class="col-span-1 md:mt-5">
                        <global-button :loading="filter.processing" type="submit" theme="primary">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <global-table>
                <template #head>
                    <th class="py-4 px-5">
                        {{ __('Name') }}
                    </th>
                    <th class="py-4 px-5">{{ __('Role') }}</th>
                    <th class="py-4 px-5">{{ __('Active/Ban') }}</th>
                    <th width="10%" class="py-4 px-5">{{ __('Action') }}</th>
                </template>
                <template #body>
                    <template v-if="users.data.length > 0">
                        <template v-for="user in users.data" :key="user.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td scope="row"
                                    class="flex items-center py-4 px-5 text-gray-900 whitespace-nowrap dark:text-white">
                                    <td-user-show :image="user.profile_photo_url" :name="user.name" :email="user.email" />
                                </td>
                                <td class="py-4 px-5">
                                    <div>
                                        <span v-for="role in user.roles" :key="role.id"
                                            class="bg-blue-100 dark:bg-gray-700 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:text-gray-400">
                                            {{ role.name }}
                                        </span>
                                    </div>
                                    <div class="text-xs mt-1">
                                        {{ user.join_date }}
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <small class="text-red-500 block" v-if="user.role == 'Admin' && user.id == $page.props.auth.id">
                                        {{ __('You cant ban yourself') }}
                                    </small>
                                    <label class="relative inline-flex items-center cursor-pointer" v-else>
                                        <input :disabled="user.role == 'Admin' && user.id == $page.props.auth.id ? true: false" @change="updateStatus($event, user.id)" :checked="user.status" type="checkbox" class="sr-only peer" :class="user.role == 'Admin' && user.id == $page.props.auth.id ? 'cursor-not-allowed':'' ">
                                        <div :class="user.role == 'Admin' && user.id == $page.props.auth.id ? 'opacity-50':'' " class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex gap-2">
                                        <template v-if="user.role == 'Student'">
                                            <Link preserve-scroll :href="route('student.show', user.username)" class="group relative" :id="'show'+user.id">
                                            <eye-icon class="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                            <tool-tip :text="__('View')" />
                                            </Link>
                                        </template>
                                        <template v-else-if="user.role == 'Teacher'">
                                            <Link preserve-scroll :href="route('teacher.show', user.id)" class="group relative" :id="'show'+user.id">
                                            <eye-icon class="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                            <tool-tip :text="__('View')" />
                                            </Link>
                                        </template>
                                        <template v-else>
                                            <button type="button" @click="show(user)" class="group relative" :id="'show'+user.id">
                                                <eye-icon class="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                                <tool-tip :text="__('View')" />
                                            </button>
                                        </template>
                                        <template v-if="user.role == 'Student'">
                                            <Link preserve-scroll :href="route('student.admission.edit', user.id)" class="group relative" :id="'edit'+user.id">
                                            <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                            <tool-tip :text="__('Edit')" />
                                            </Link>
                                        </template>
                                        <template v-else-if="user.role == 'Teacher'">
                                            <Link preserve-scroll :href="route('teachers.edit', user.id)" class="group relative" :id="'edit'+user.id">
                                            <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                            <tool-tip :text="__('Edit')" />
                                            </Link>
                                        </template>
                                        <template v-else>
                                            <Link preserve-scroll :href="route('users.edit', user.id)" class="group relative" :id="'edit'+user.id">
                                            <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                            <tool-tip :text="__('Edit')" />
                                            </Link>
                                        </template>
                                        <template v-if="user.role == 'Teacher'">
                                            <Link preserve-scroll :href="route('teacher.classes', user.id)" class="group relative cursor-pointer" :id="'teacherSubject'+user.id">
                                            <Square2StackIcon class="w-6 h-6 text-purple-400 hover:text-purple-300" />
                                            <tool-tip :text="__('Subjects')" />
                                            <div
                                                class="inline-flex dark:text-gray-400 absolute z-10 -top-4 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900">
                                                {{ user.subjects_count }}
                                            </div>
                                            </Link>
                                        </template>
                                        <button type="button" @click="destroy(user.id)" class="group relative" :id="'delete'+user.id">
                                            <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                            <tool-tip :text="__('Delete')" />
                                        </button>
                                    </div>
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
                <pagination class="mt-6 mb-6" :links="users.links" />
            </div>
        </div>
        <a-modal v-model:visible="visible" :title="show_user.name" @ok="hide">
            <template #footer>
                <a-button key="back" @click="hide">
                    {{ __('Close') }}
                </a-button>
            </template>
            <show-modal :user="show_user" />
        </a-modal>
    </AppLayout>
</template>

<script>
import { ref } from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import { PencilSquareIcon, UsersIcon, TrashIcon, UserGroupIcon, MagnifyingGlassIcon, Square2StackIcon, EyeIcon, } from '@heroicons/vue/24/outline';
import Pagination from "@/Shared/Admin/Pagination.vue";
import ShowModal from "./Show.vue";
import { useForm } from '@inertiajs/inertia-vue3';
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
import TdUserShow from "@/Shared/TdUserShow.vue";
import NothingFound from "@/Shared/NothingFound.vue";
import ExportModal from "@/Shared/Modal.vue";
import axios from 'axios';

export default {
    components: {
        AppLayout,
        ToolTip,
        TrashIcon,
        UsersIcon,
        PencilSquareIcon,
        Pagination,
        UserGroupIcon,
        TdUserShow,
        EyeIcon,
        Square2StackIcon,
        MagnifyingGlassIcon,
        ShowModal,
        Multiselect,
        NothingFound,
        ExportModal
    },
    props: {
        users: Object,
        admins: Number,
        parents: Number,
        students: Number,
        teachers: Number,
        others: Number,
        query: Object,
    },
    data() {
        return {
            visible: false,
            show_user: "",
            export_data: useForm({
            type: 'Excel',
            course: 'all'
            }),
            filter: useForm({
                keyword: this.query.keyword ?? '',
                query: this.query.query ?? 'all',
            }),
            stats: [
                {
                    data: this.admins,
                    title: "Total Admins",
                    query: "admin"
                },
                {
                    data: this.parents,
                    title: "Total Parents",
                    query: "parent"
                },
                {
                    data: this.students,
                    title: "Total Students",
                    query: "student"
                },
                {
                    data: this.teachers,
                    title: "Total Teachers",
                    query: "teacher"
                },
                {
                    data: this.others,
                    title: "Others",
                    query: "other"
                },
                
            ]
        };
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("users.destroy", id));
            } else {
                return false;
            }
        },
        show(user) {
            this.show_user = user;
            this.visible = true;
        },
        hide(e) {
            this.visible = false;
        },
        filterData() {
            this.filter.get(this.route('users.index'), {
                preserveScroll: true
            });
        },
        updateStatus(event, user) {

            let value = event.target.checked;
            this.$inertia.post(this.route('user.status.update', user), {
                status: value
            }, {
                preserveScroll: true
            })
        },
        exportSubmit() {
                this.loading = true;
                let exportData = {};
    
                // Jika ada filter nama yang aktif
                if (this.filter.query !== '') {
                    exportData.query = this.filter.query;
                }
    
                axios({
                    url: this.route('all.user.export'),
                    method: "POST",
                    data: {
                    ...this.export_data,
                    ...exportData
                    },
                    headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    responseType: "blob",
                }).then((response) => {
                    console.log('asdjiwfuqhiqjdqwjdoiwqjdiow');
                    let extension = this.export_data.type;
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement("a");
    
                    fileLink.href = fileURL;
                    fileLink.setAttribute("download", "allteacher-report." + 'xlsx');
                    document.body.appendChild(fileLink);
    
                    fileLink.click();
    
                    this.loading = false;
                    this.visible = false;
                }).catch((e) => {
                    this.loading = false;
                    this.visible = false;
                });
            }
    },
};
</script>
