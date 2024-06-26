<template>

    <Head :title="__('Group Chat')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Group Chat')" />
        </Breadcrumb>

        <div class="my-6">
            <page-header>
                {{ __('Group Chat') }}
            </page-header>
        </div>

        <div>
            <div class="w-full">
                <div class="max-h-[660px]">
                    <div
                        class="relative flex lg:flex-row flex-col rounded-lg bg-white dark:border-gray-700 overflow-y-auto max-h-[660px]">
                        <!-- Left -->
                        <div class="lg:w-1/3 max-h-[660px] overflow-y-auto overflow-x-hidden lg:border-r-2 bg-white dark:bg-gray-800 dark:border-gray-600 flex flex-col" :class="isMessageClick ? 'hidden lg:block': ''" >

                            <!-- Header -->
                            <div
                                class="py-4 pt-4 px-3 flex items-center bg-white dark:bg-gray-800 border-b-2 dark:border-gray-600">
                                <div>
                                    <img class="w-12 h-12 border-2 border-white dark:border-gray-600 rounded-full mr-4"
                                        :src="$page.props.auth.profile_photo_url" />
                                </div>
                                <div class="relative w-full">
                                    <global-input v-model="filter.keyword" type="search"
                                        class="block w-full focus:ring-1 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Group Name')" />
                                    <button @click.prevent="searchGroup" type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-0 focus:outline-none focus:ring-gray-700 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-0">
                                        <MagnifyingGlassIcon class="w-5 h-5" />
                                        <span class="sr-only">
                                            {{ __('Search') }}
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <!-- Contacts -->
                            <div class="bg-white dark:bg-gray-800 flex-1 overflow-y-auto overflow-x-hidden">
                                <template v-if="groups && groups.length">
                                    <div class="flex items-center bg-white dark:bg-gray-800 cursor-pointer"
                                        v-for="group in groups" :key="group.id">
                                        <div :class="activeGroup == group.id ? 'bg-gray-100 dark:bg-gray-600' : ''"
                                            class="flex-1 border-b-2 dark:border-gray-500 dark:text-gray-400"
                                            @click="getMessages(group)" :id="'testGroup' + group.id">
                                            <div class="px-7 py-2 flex items-bottom justify-between">
                                                <div class="text-grey-darkest">
                                                    <div class="font-bold">
                                                        {{ group.name }}
                                                        <span v-if="group.subject && group.subject.course">
                                                            ( {{ group.subject.course.name }} )
                                                        </span>
                                                    </div>
                                                    <div class="text-grey-dark mt-1 text-sm">
                                                        {{ group.last_messages }}
                                                    </div>
                                                </div>
                                                <div class="text-xs text-grey-darkest">
                                                    {{ group.last_messages_created_time }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <p class="text-center mt-4" v-else>{{ __('No group found') }}</p>
                            </div>
                        </div>

                        <!-- Right -->
                        <div class="lg:w-2/3 max-h-[660px] pb-[76px] lg:pb-0 dark:border-gray-700 overflow-x-hidden flex flex-col" :class="!isMessageClick ? 'hidden lg:block': ''" v-if="selectedGroup">
                            <div class="lg:static absolute top-0 left-0 right-0 py-2 px-3 bg-white dark:bg-gray-800 border-b-2 dark:border-gray-600 flex flex-row justify-between items-center">
                                <div class="flex items-center">
                                    <div @click="isMessageClick = !isMessageClick" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M15 18l-6-6 6-6" />
                                        </svg>
                                    </div>
                                    <div class="ml-4 leading-tight">
                                        <div class="text-grey-darkest dark:text-gray-400 font-bold">
                                            {{ selectedGroup.name }}
                                        </div>
                                        <div class="text-grey-darker text-xs text-gray-500 dark:text-gray-400">
                                            {{ selectedGroup.description }}
                                        </div>
                                    </div>
                                </div>
                                <button @click="openDrawer">
                                    <DocumentMagnifyingGlassIcon class="dark:text-gray-400 w-6 h-6 cursor-pointer" />
                                </button>
                            </div>
                            <div class="flex-1 max-h-[600px] pt-6 overflow-y-auto overflow-x-hidden flex-col-reverse bg-white dark:bg-gray-800 dark:text-gray-400" ref="msgContainer">
                                <div class="py-2 px-3" id="chat-list-ul">
                                    <div class="mb-2" v-for="message in messages" :key="message.id">
                                        <div class="flex flex-col"
                                            :class="$page.props.auth.id == message?.sender?.id ? 'items-end' : 'items-start'">
                                            <div class="flex gap-2 items-start">
                                                <div class="inline-flex w-10 h-10"
                                                    :class="$page.props.auth.id == message?.sender?.id ? 'hidden' : ''">
                                                    <img class="w-full h-full object-cover rounded-full"
                                                        :src="message.sender.profile_photo_url" alt="">
                                                </div>
                                                <div>
                                                    <div class="flex gap-8 mb-1 justify-between items-center">
                                                        <div class="text-sm text-teal">
                                                            {{ $page.props.auth.id == message?.sender?.id ? '' :
                                                            message?.sender?.name }}
                                                        </div>
                                                        <div
                                                            class="text-right dark:text-gray-400 text-xs text-grey-dark">
                                                            {{ message.created_time }}
                                                        </div>
                                                    </div>
                                                    <div class="rounded py-2 px-3"
                                                        :class="$page.props.auth.id == message?.sender?.id ? 'bg-[#E2F7CB]' : 'bg-[#F2F2F2] dark:bg-gray-900'">
                                                        <template v-if="message.file">
                                                            <img class="h-20 w-20" :src="message.file_url"
                                                                v-if="message.file && message.file_type && message.file_type.split('/')[0] == 'image'" />
                                                            <img class="h-20 w-20" :src="fileImage" v-else />
                                                            <a :href="message.file_url" download>Download</a>
                                                        </template>

                                                        <div class="text-sm mt-1 dark:text-gray-500">
                                                            {{ message.message }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-3 dark:bg-gray-600" v-if="attachment && attachment.file && attachment.previewFile">
                                <span class="relative">
                                    <img class="h-20 w-20" :src="attachment.previewFile" />
                                    <TrashIcon v-if="!imgUploading" @click="removeFile" class="w-6 h-6 absolute top-0 right-0 text-red-500 cursor-pointer" />
                                    <div v-if="imgUploading"
                                        class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                                        <svg aria-hidden="true"
                                            class="w-8 h-8 text-gray-200 dark:text-gray-400 animate-spin fill-blue-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                    </div>
                                </span>
                            </div>

                            <div class="lg:static absolute bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t-2 dark:border-gray-600 px-4 py-4 flex items-center">
                                <div class="flex gap-2">
                                    <button @click="$refs.attachment.click()">
                                        <DocumentPlusIcon class="dark:text-gray-400 w-6 h-6" />
                                    </button>
                                    <input type="file" hidden ref="attachment" @change="selectAttachment">
                                </div>
                                <div class="flex-1 mx-4">
                                    <global-input :placeholder="__('Your Message')" @keyup.enter="sendMessage"
                                        v-model="form.message"
                                        class="block w-full focus:ring-1 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                                        type="text" :disabled="loading"/>
                                </div>
                                <div>
                                    <button type="button" @click="sendMessage" :disabled="loading || imgUploading">
                                        <svg v-if="loading" aria-hidden="true" class="w-6 h-6 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        <PaperAirplaneIcon v-else class="dark:text-gray-400 w-6 h-6" />
                                    </button>
                                </div>
                            </div>
                            <Drawer ref="drawer" :group="selectedGroup"/>
                            <div class="drawer-overlay"></div>
                        </div>
                        <div class="hidden w-2/3 border dark:border-gray-600 lg:flex flex-col max-h-[660px]" v-else>
                            <div class="flex-1 overflow-auto bg-white dark:bg-gray-800">
                                <div class="flex items-center justify-center h-full">
                                    <div class="rounded py-2 px-4 bg-[#FCF4CB]">
                                        <div class="text-xs">
                                            {{ __('Select a message group') }}
                                        </div>
                                    </div>
                                </div>
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
    import Drawer from "./Drawer.vue";
    import {
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
    } from '@headlessui/vue'
    import { useForm } from "@inertiajs/inertia-vue3";
    import {
        TrashIcon,
        MagnifyingGlassIcon,
        PaperAirplaneIcon,
        DocumentPlusIcon,
        DocumentMagnifyingGlassIcon,
    } from '@heroicons/vue/24/outline';

    export default {
        props: {
            groups: {
                type: Array,
                default: () => [],
            },
            request: {
                type: Object,
                default: () => [],
            }
        },
        components: {
            AppLayout,
            Menu,
            MenuButton,
            PaperAirplaneIcon,
            MenuItem,
            MenuItems,
            MagnifyingGlassIcon,
            TrashIcon,
            DocumentPlusIcon,
            DocumentMagnifyingGlassIcon,
            Drawer
        },
        watch: {
            messages: function () {
                this.scrollToBottom()
            }
        },
        data() {
            return {
                messages: [],
                selectedGroup: '',
                activeGroup: 0,
                loading: false,
                imgUploading: false,
                visible: false,
                isMessageClick: false,
                filter: useForm({
                    keyword: this.request.keyword,
                }),
                form: useForm({
                    message: '',
                    file: '',
                    file_type: '',
                    chat_group_id: '',
                }),

                attachment: {
                    file: '',
                    previewFile: '',
                },

                fileImage: '../../../../files/files.png'
            };
        },
        computed: {
            attachments() {
                return this.messages.find(message => message.file);
            }
        },
        methods: {
            async getMessages(group) {
                this.isMessageClick = !this.isMessageClick;
                this.selectedGroup = group
                this.activeGroup = group.id;
                let response = await axios.get(route('group.messages', group.id))
                this.messages = response.data.conversations
            },
            async sendMessage() {
                if (this.loading) { return; }
                if (!this.form.message && !this.form.file) { return; }

                this.loading = true
                let data = new FormData();
                data.append('message', this.form.message);
                data.append('chat_group_id', this.selectedGroup.id);

                let response = await axios.post(route('group.storeMessage'), data)
                this.messages.push(response.data)
                this.resetData()
                this.scrollToBottom()
                this.loading = false
            },
            async selectAttachment(e) {
                let file = e.target.files[0];
                let type = file.type;

                this.form.file = file
                this.form.file_type = type

                this.attachment.file = file
                if (type.split("/")[0] == 'image') {
                    this.attachment.previewFile = URL.createObjectURL(file)
                } else {
                    this.attachment.previewFile = this.fileImage
                }

                // File uploading
                let data = new FormData();
                data.append('file', this.form.file);
                data.append('file_type', this.form.file_type);

                try {
                    this.imgUploading = true;
                    await axios.post(route('file.upload'), data, {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    })
                    this.imgUploading = false;
                } catch (error) {
                    this.imgUploading = false;
                    alert(error.response.statusText);
                    this.resetData();
                }
            },
            openDrawer() {
                this.$refs.drawer.open();
            },
            scrollToBottom() {
                this.$nextTick(function () {
                    var container = this.$refs.msgContainer;
                    container.scrollTop = container.scrollHeight + 120;
                });
            },
            resetData() {
                this.form.reset()
                this.attachment.file = ''
                this.attachment.previewFile = ''
            },
            searchGroup() {
                this.filter.get(route('group.chat'))
            },
            async removeFile() {
                this.form.file = ''
                this.form.file_type = ''
                this.attachment.file = ''
                this.attachment.previewFile = ''

                try {
                    await axios.delete(route('remove.file.upload'))
                } catch (error) {
                    alert(error.response.statusText);
                }
            }
        },
        mounted() {
            Echo.private('chat')
                .listen('GroupChatMessage', (e) => {
                    if (this.selectedGroup.id == e.chatMessage.chat_group_id) {
                        this.messages.push(e.chatMessage)
                    }
                });
        }
    };
</script>

<style scoped>
    .scrollable {
        overflow: hidden;
        overflow-y: scroll;
        height: calc(100vh - 20px);
    }
</style>
