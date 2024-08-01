<template>
    <Head :title="__('Announcements')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Announcements')"/>
        </Breadcrumb>

        <div class="pb-12 ">
            <page-header>
                {{ __('Announcements') }}
                <!-- <template #content>
                    <global-button :loading="false" :url="route('notice-board.create')" type="link" theme="primary">
                        {{ __('Create New Announcement') }}
                    </global-button>
                </template> -->
            </page-header>
            <div class="grid gap-6 xl:grid-cols-3 items-start sm:grid-cols-2 grid-cols-1">
                <div class="xl:col-span-2">
                    <template v-if="notices.data.length > 0">
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                            <div v-for="noticee in notices.data" :key="noticee.id" class="bg-white mb-2 hover:cursor-pointer rounded-lg dark:bg-gray-800 dark:text-gray-400" :id="'testNotice' + noticee.id">
                                <div @click="show(noticee.slug)">
                                    <img class="w-full h-[200px] object-cover" :src="noticee.attachment_url"
                                        alt="" />
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <p @click="show(noticee.slug)" class="flex items-center gap-1.5 mb-0">
                                            <CalendarIcon class="w-6 h-6 text-blue-500" />
                                            <span>{{ formatTime(noticee.created_at,'','HH:mm') }}</span>
                                        </p>
                                        <div class="inline-flex gap-3 items-center">
                                            <button type="button" @click="edit(noticee)" :id="'edit' + noticee.id ">
                                                <PencilSquareIcon class="w-6 h-6 text-[#767676]" />
                                            </button>
                                            <button type="button" @click="destroy(noticee.id)" :id="'delete' + noticee.id ">
                                                <TrashIcon class="w-6 h-6 text-[#767676]" />
                                            </button>
                                        </div>
                                    </div>
                                    <h2 @click="show(noticee.slug)" class="text-2xl font-bold text-gray-900 line-clamp-1 dark:text-gray-400">
                                        {{ noticee.title }}
                                    </h2>
                                    <div @click="show(noticee.slug)" class="mt-4 mb-6 text-gray-900 dark:text-gray-500 line-clamp-3" v-html="noticee.description.substr(0, 300)"></div>
                                    <div @click="show(noticee.slug)" class="flex justify-between gap-4 items-center">
                                        <div class="flex gap-2 items-center">
                                            <div class="text-blue-500 inline-flex gap-1.5 items-center">{{ __('Read Full Notice') }}
                                                <ChevronDoubleRightIcon class="w-4 h-4" />
                                            </div>
                                            <div class="text-gray-900 dark:text-gray-500 inline-flex gap-1.5 items-center">
                                                <ChatBubbleOvalLeftIcon class="w-4 h-4" />
                                                {{ __('Comments') }} ({{ noticee.comments_count }})
                                            </div>
                                        </div>
                                        <div class="font-bold capitalize">
                                            {{ noticee.status }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="text-center text-gray-400 col-span-3 mt-4">
                            {{ __('No Announcement Available') }}
                        </div>
                    </template>
                </div>
                <form @submit.prevent="submit()" class="bg-white dark:bg-gray-800 rounded-lg p-6">
                    <div class="text-lg text-gray-900 dark:text-gray-400 font-bold mb-2">{{ __('Add New Notice') }}</div>
                    <div class="mb-4">
                        <global-label class="text-gray-900 dark:text-gray-400" for="title" :value="__('Board Title')" :required="true" />
                        <global-input placeholder="Title" id="title" v-model="form.title" type="text"
                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                        </global-input>
                        <input-error :error="$page.props.errors.title" />
                    </div>
                    <div class="mb-4">
                        <global-label class="text-gray-900" for="description" value="Description"
                            :required="true" />
                        <global-textarea rows="5" id="description" placeholder="Description" v-model="form.description"
                            type="text" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                        </global-textarea>
                        <input-error :error="$page.props.errors.description" />
                    </div>
                    <div class="mb-3">
                        <global-label for="file" class="tetx-lg" :value="__('Image')" :required="true" />
                        <button type="button" @click="picFile" class="bg-gray-100 dark:bg-gray-700 w-full py-2.5 px-3 rounded testImage">
                            <div class="flex gap-2 items-center">
                                <div>
                                    <ArrowUpTrayIcon class="w-6 h-6 dark:text-gray-400" />
                                </div>
                                <div>
                                    <span v-if="file_name" class="text-blue-500">
                                        {{ file_name }}
                                    </span>
                                    <span v-else class="dark:text-gray-500">
                                        {{ __('Upload Image') }}
                                    </span>
                                </div>
                            </div>
                        </button>
                        <span class="text-gray-500">
                            {{ __('Supported format - png, jpg, jpeg') }}
                        </span>
                        <input @change="change"
                            accept="image/*"
                            type="file" ref="assignment_file" class="hidden" readonly>
                        <input-error :error="$page.props.errors.file" />
                    </div>
                    <div class="mb-3">
                        <global-label class="text-gray-900" for="description" :value="__('Type')"
                            :required="true" />
                        <div class="flex gap-2 items-center">
                            <div class="flex w-1/2 items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 rounded dark:border-gray-700">
                                <input v-model="form.status" checked id="status_public" type="radio" value="public"
                                    name="status"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="status_public"
                                    class="w-full py-2.5 ml-2 rtl:ml-0 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ __('Public') }}
                                </label>
                            </div>
                            <div class="flex w-1/2 items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 rounded dark:border-gray-700">
                                <input v-model="form.status" id="status_private" type="radio" value="private" name="status"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="status_private"
                                    class="w-full py-2.5 ml-2 rtl:ml-0 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                   {{ __('Private') }}
                                </label>
                            </div>
                        </div>
                        <input-error :error="$page.props.errors.status" />
                    </div>
                    <div class="mb-3">
                        <global-label class="text-gray-900" for="roles" :value="__('Role')" :required="true" />
                        <div class="flex gap-2 items-center">
                            <div class="flex w-1/3 items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 rounded dark:border-gray-700">
                                <input v-model="form.roles" checked id="role_student" type="radio" value="Student" name="roles"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="role_student"
                                    class="w-full py-2.5 ml-2 rtl:ml-0 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ __('Student') }}
                                </label>
                            </div>
                            <div class="flex w-1/3 items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 rounded dark:border-gray-700">
                                <input v-model="form.roles" id="role_teacher" type="radio" value="Teacher" name="roles"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="role_teacher"
                                    class="w-full py-2.5 ml-2 rtl:ml-0 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ __('Teacher') }}
                                </label>
                            </div>
                            <div class="flex w-1/3 items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 rounded dark:border-gray-700">
                                <input v-model="form.roles" id="role_partner" type="radio" value="Partner" name="roles"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="role_partner"
                                    class="w-full py-2.5 ml-2 rtl:ml-0 rtl:mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ __('Partner') }}
                                </label>
                            </div>
                        </div>
                        <input-error :error="$page.props.errors.roles" />
                    </div>
                    <div class="flex justify-end">
                        <global-button type="submit" :loading="form.processing" cssClass="mt-3" theme="primary">
                            {{ __('Save') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <div class="flex justify-center">
                <pagination class="mt-6" :links="notices.links" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

import Pagination from "@/Shared/Admin/Pagination.vue";
import { CalendarIcon, PencilSquareIcon, ArrowUpTrayIcon, TrashIcon, ChatBubbleOvalLeftIcon, ChevronDoubleRightIcon } from '@heroicons/vue/24/outline'
import ToolTip from '@/Shared/ToolTip.vue';
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    props: {
        notices: Object,
    },
    data() {
        return {
            file_name: '',
            update: false,
            form: useForm({
                id: '',
                title: '',
                description: '',
                file: '',
                roles: '',
                status: 'public',
                _method: 'POST'
            })
        };
    },
    components: {
        CalendarIcon,
        AppLayout,
        ArrowUpTrayIcon,
        Pagination,
        PencilSquareIcon,
        TrashIcon,
        ChatBubbleOvalLeftIcon,
        ChevronDoubleRightIcon,
        ToolTip
    },
    methods: {
        picFile() {
        this.$refs.assignment_file.click();
    },
    change(e) {
        const file = e.target.files[0];
        const maxSizeMB = 1; // Batas ukuran maksimum dalam MB

        // Cek ukuran file
        if (file.size / 1024 / 1024 > maxSizeMB) {
            alert(`Ukuran file terlalu besar. Ukuran maksimum adalah ${maxSizeMB} MB.`);
            // Reset input file
            this.$refs.assignment_file.value = '';
            this.file_name = '';
            this.form.file = null;
        } else {
            this.file_name = file.name;
            this.form.file = file;
        }
    },
        submit() {
            if (this.update) {
                this.form.post(this.route('notice-board.update', this.form.id), {
                    onSuccess: () => {
                        this.form.reset('title', 'description', 'file', 'id', 'roles', '_method')
                    }
                })
            } else {
                this.form.post(this.route('notice-board.store'), {
                    onSuccess: () => {
                        this.form.reset('title', 'description', 'file', 'id', 'roles', '_method')
                    }
                })
            }
        },
        destroy(arg) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route("notice-board.destroy", arg), {
                    preserveScroll: true,
                });
            } else {
                return false;
            }
        },
        edit(arg) {
            this.form.title = arg.title
            this.form.description = arg.description
            this.form.status = arg.status
            this.update = true
            this.form.id = arg.id
            this.form._method = 'PUT'
        },
        show(slug) {
            this.$inertia.get(this.route('notice.board.details', slug));
        },
        togglePin(id) {
            this.$inertia.post(this.route("notice-board.pin", id), {
                preserveScroll: true,
            });
        },
    },
};
</script>
