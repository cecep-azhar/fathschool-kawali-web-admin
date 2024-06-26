<template>
    <AppLayout :title="__('Student Admission')">
        <template #header>
            {{ __('Student Admission') }}
        </template>
        <Breadcrumb>
            <BreadcrumbLink :title="__('All Student')" :href="route('student.admission.all')" />
        </Breadcrumb>

        <div>
            <page-header class="flex-col sm:flex-row">
                {{ __('All Student') }}
                <template #content>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <global-button :loading="false" @click="exportStudent()" type="button" theme="sky">
                            {{ __('Export') }}
                        </global-button>
                        <global-button preserve-scroll :loading="false" :url="route('student.bulk.admission')"
                            type="link" theme="secondary">
                            {{ __('Bulk Admission') }}
                        </global-button>
                        <global-button :loading="false" preserve-scroll type="link"
                            :url="route('student.admission.create')" theme="primary">
                            {{ __('New Admission') }}
                        </global-button>
                    </div>
                </template>
            </page-header>
            <div class="mb-4">
                <form class="items-center grid grid-cols-1 md:grid-cols-7 gap-6" @submit.prevent="filterData()">
                    <div class="flex col-span-2">
                        <div class="relative w-full">
                            <global-input type="search" v-model="filter.keyword"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Keyword')" />
                            <button type="submit"
                                class="absolute top-1 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <MagnifyingGlassIcon class="w-5 h-5" />
                                <span class="sr-only">
                                    {{ __('Search') }}
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <a-select class="width-100" size="large" v-model:value="filter.course" show-search
                            :placeholder="__('Select a course')" :options="options" :filter-option="filterOption"
                            @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                        </a-select>
                    </div>
                    <div class="col-span-1">
                        <global-button :loading="loading" type="submit" theme="primary">
                            {{ __('Search') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <global-table>
                <template #head>
                    <th class="py-4 px-5">{{ __('Name') }}</th>
                    <th class="py-4 px-5">{{ __('Guardian Name') }}</th>
                    <th class="py-4 px-5">{{ __('Course') }}</th>
                    <th class="py-4 px-5">{{ __('Account Hold') }}</th>
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
                                    <div v-for="parent in user.parents" :key="parent" class="flex">
                                        <Link :href="route('parent.show', parent.id)"
                                            class="bg-blue-100 text-blue-800 whitespace-nowrap text-xs font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-1">
                                        {{ parent ? parent.name : "" }}
                                        </Link>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <template v-if="user.courses.length > 0">
                                        <div class="flex flex-wrap items-center gap-0.5">
                                            <template v-for="(course, index) in user.courses" :key="course.id">
                                                <div class="font-bold ml-0.5">
                                                    {{ course.course ? course.course.name : "" }}
                                                    <template v-if="user.courses.length != index + 1">,</template>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                    <template v-else>
                                        -
                                    </template>
                                </td>
                                <td class="py-4 px-5">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input @change="accountHold($event, user.id)" :checked="user.account_hold"
                                            type="checkbox" class="sr-only peer">
                                        <div
                                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex gap-2">
                                        <button @click="sendMail(user.id)" type="button" class="group relative">
                                            <envelope class="text-purple-400 hover:text-purple-300" />
                                            <tool-tip :text="__('Send Mail')" />
                                        </button>
                                        <Link preserve-scroll :href="route('student.show', user.username)
                                            " class="group relative" :id="'show' + user.id">
                                        <EyeIcon class="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                        <tool-tip :text="__('View')" />
                                        </Link>
                                        <Link preserve-scroll :href="route(
                                                'student.admission.edit',
                                                user.id
                                            )
                                            " class="group relative" :id="'edit' + user.id">
                                        <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                        <tool-tip :text="__('Edit')" />
                                        </Link>
                                        <button type="button" @click="destroy(user.id)" class="group relative" :id="'delete' + user.id">
                                            <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                            <tool-tip :text="__('Delete')" />
                                        </button>
                                    </div>

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
        <!-- Data Export Modal  -->
        <export-modal :show="export_visible" @close="closeModal">
            <template #title>
                {{ __('Export Data') }}
            </template>

            <template #content>
                <!-- Content -->
                <div class="col-span-2">
                    <Multiselect id="course" :close-on-select="true" :can-clear="false" :searchable="true"
                        v-model="export_data.course" :create-option="false" :placeholder="__('Select Course')"
                        :options="export_options" autocomplete="off" />
                </div>
            </template>

            <template #footer>
                <global-button @click="exportSubmit()" :loading="loading" type="button"
                    class=" text-white bg-blue-500 dark:bg-blue-500 hover:bg-blue-500
                     active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 mr-2 mb-2 dark:focus:ring-blue-300">
                    {{ __('Export') }}
                </global-button>
                <global-button :loading="false" @click="export_visible = false" type="button"
                    class="text-white bg-red-500 dark:bg-red-500  hover:bg-red-500 active:bg-red-600 dark:active:bg-red-600 focus:border-red-600 dark:focus:border-red-600 focus:ring focus:ring-red-300 mr-2 mb-2 dark:focus:ring-red-300">
                    {{ __('Cancel') }}
                </global-button>
            </template>
        </export-modal>
        <!-- Data Export Modal End -->
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import TdUserShow from "@/Shared/TdUserShow.vue";
import NothingFound from "@/Shared/NothingFound.vue";
import { EyeIcon, MagnifyingGlassIcon, PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline'
import ExportModal from "@/Shared/Modal.vue";
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AppLayout,
        ToolTip,
        Multiselect,
        TdUserShow,
        PencilSquareIcon,
        TrashIcon,
        Pagination,
        EyeIcon,
        MagnifyingGlassIcon,
        NothingFound,
        ExportModal
    },
    props: {
        users: Object,
        filter_data: Object,
        classes: Object,
    },
    data() {
        return {
            loading: false,
            options: [],
            options2: [],
            export_options: [],
            visible: false,
            export_visible: false,
            show_user: "",
            filter: {
                keyword: this.filter_data.keyword ?? null,
                course: this.filter_data.course ?? null,
            },
            export_data: useForm({
                type: 'Excel',
                course: 'all'
            })
        };
    },
    created() {
        // export option
        this.export_options.push({
            value: "all",
            label: "All",
        });
        for (const [key, value] of Object.entries(this.classes)) {
            this.export_options.push({
                value: value.id,
                label: value.name,
            });
        }

        // for classes
        this.options.push({
            value: "",
            label: "All",
        });
        for (const [key, value] of Object.entries(this.classes)) {
            this.options.push({
                value: value.slug,
                label: value.name,
            });
        }
    },
    methods: {
        accountHold(event, user) {
            let value = event.target.checked;
            this.$inertia.post(this.route('user.account.hold', user), {
                status: value
            }, {
                preserveScroll: true
            })
        },
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
        exportStudent() {
            this.export_visible = true;
        },
        filterData() {
            this.loading = true;
            this.$inertia.get(
                this.route("student.admission.all"),
                this.filter,
                {
                    preserveScroll: true,
                    onFinish: (visit) => {
                        this.loading = false;
                    },
                }
            );
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },
        sendMail(user) {
            this.$inertia.post(this.route("student.send.mail"), {
                user: user,
            });
        },
        exportSubmit() {
            this.loading = true;
            axios({
                url: this.route('student.export'),
                method: "POST",
                data: this.export_data,
                responseType: "blob",
            }).then((response) => {

                let extension = this.export_data.type;

                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement("a");

                fileLink.href = fileURL;
                fileLink.setAttribute("download", "student-report." + 'xlsx');
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

<style lang="scss" scoped>
</style>
