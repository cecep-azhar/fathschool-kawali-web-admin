<template>
    <AppLayout :title="__('Notice Board')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Notice Board')"/>
            <BreadcrumbLink :title="__(notice.title)"/>
        </Breadcrumb>

        <div >
            <page-header>
                {{ notice.title }}
            </page-header>
            <div class="grid gap-6 items-start xl:grid-cols-3 md:grid-cols-2 grid-cols-1" id="testNoticeDetails">
                <div
                    class="bg-white w-full md:col-span-2 mb-2 hover:cursor-pointer overflow-hidden rounded-lg dark:bg-gray-800 dark:text-gray-400">
                    <div>
                        <img class="w-full h-[424px] object-cover" :src="notice.attachment_url" alt="" />
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <p class="flex items-center gap-1.5 mb-0">
                                <CalendarIcon class="w-6 h-6 text-blue-500" />
                                <span>
                                    {{ notice.publish_at }}
                                </span>
                            </p>
                            <div v-if="$page.props.auth.role == 'Admin'" class="inline-flex gap-3 items-center">
                                <Link :href="route('notice-board.index')" :data="{ id: notice.id }">
                                <PencilSquareIcon class="w-5 h-5 text-[#767676]" />
                                </Link>
                                <Link :href="route('notice-board.index')" :data="{ id: notice.id }">
                                <TrashIcon class="w-5 h-5 text-[#767676]" />
                                </Link>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-400">
                            {{ notice.title }}
                        </h2>
                        <div v-html="notice.description" class="mt-4 mb-2 text-gray-900 dark:text-gray-500">
                        </div>
                    </div>
                </div>
                <div class="w-full rounded-lg bg-white dark:bg-gray-800">
                    <form @submit.prevent="comment()" class="border-b border-gray-300 dark:border-gray-600 p-6">
                        <global-label class="text-lg text-gray-900 mb-3" for="comment" :value="__('Write A Comment')"
                            :required="true" />
                        <global-textarea :placeholder="__('Description')" v-model="form.description" rows="3" id="comment"
                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                        </global-textarea>
                        <input-error :error="$page.props.errors.description" />
                        <global-button type="submit" cssClass="mt-3" theme="primary">
                            {{ __('Publish') }}
                        </global-button>
                    </form>
                    <div class="p-6" id="commentSection">
                        <h2 class="text-lg text-gray-900 dark:text-gray-400 mb-4">{{ __('Comments') }}</h2>
                        <ul>
                            <template v-if="comments.data.length > 0">
                                <li class="flex gap-3 items-start" v-for="(comment, index) in comments.data" :key="index">
                                    <div class="inline-flex overflow-hidden w-10 h-10">
                                        <img class="rounded-full w-full h-full object-cover"
                                            :src="comment.user ? comment.user.profile_photo_url : ''"
                                            :alt="comment.user ? comment.user.name : ''">
                                    </div>
                                    <div class="w-full">
                                        <div class="flex mb-1.5 justify-between items-center">
                                            <div class="flex gap-2 items-center">
                                                <h2 class="text-base mb-0 text-gray-900 dark:text-gray-400">
                                                    {{ comment.user ? comment.user.name : '' }}
                                                </h2>
                                                <p class="text-xs text-gray-900 dark:text-gray-500 mb-0">
                                                    {{ comment.time }}
                                                </p>
                                            </div>
                                            <div v-if="comment.user.id == $page.props.auth.id"
                                                class="flex gap-3 items-center">
                                                <button type="button" @click="edit(comment)" :id="'editComment' + comment.id"
                                                    class="w-6 h-6 text-gray-500">
                                                    <PencilSquareIcon />
                                                </button>
                                                <button type="button" @click="destroy(comment.id)" :id="'deleteComment' + comment.id"
                                                    class="w-6 h-6 text-gray-500">
                                                    <TrashIcon />
                                                </button>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-700 dark:text-gray-500">
                                            {{ comment.comment }}
                                        </p>
                                    </div>
                                </li>
                            </template>
                            <template v-else>
                                <li class="text-center">
                                    <NothingFound asShow="div" />
                                </li>
                            </template>
                        </ul>
                        <div class="flex justify-center">
                            <pagination class="mt-6" :links="comments.links" />
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
    import NothingFound from "@/Shared/NothingFound.vue";
    import { useForm } from "@inertiajs/inertia-vue3";
    import {
        CalendarIcon,
        PencilSquareIcon,
        TrashIcon,
    } from "@heroicons/vue/24/outline";

    export default {
        props: {
            notice: Object,
            comments: Object
        },
        components: {
            AppLayout,
            Pagination,
            CalendarIcon,
            PencilSquareIcon,
            TrashIcon,
            NothingFound
        },
        data() {
            return {
                update: false,
                form: useForm({
                    id: '',
                    notice_id: this.notice.id,
                    description: "",
                    _method: 'POST'
                }),
            };
        },
        methods: {
            edit(arg) {
                this.form.id = arg.id
                this.form.description = arg.comment
                this.form._method = 'PUT'
                this.update = true
            },
            destroy(id) {
                if (confirm('Are you sure ?')) {
                    this.form.delete(this.route("comment.destroy", id), {
                        preserveScroll: true,
                        onSuccess: page => {
                        }
                    });
                }
            },
            comment() {
                if (this.update) {
                    this.form.post(this.route("comment.update", this.form.id), {
                        preserveScroll: true,
                        onSuccess: page => {
                            this.form.reset("description", '_method');
                        }
                    });
                } else {
                    this.form.post(this.route("comment.store"), {
                        preserveScroll: true,
                        onSuccess: page => {
                            this.form.reset("description", '_method');
                        }
                    });
                }
            }
        }
    };
</script>
