<template>
    <AppLayout :title="__('Meeting')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Meeting')" />
        </Breadcrumb>

        <div >
            <page-header>
                {{ __('All Meeting') }}
                <badge>
                    {{ meetings.total }}
                </badge>
                <template #content>
                    <global-button v-if="can('meeting.create')" :loading="false" @click="create()" type="button" theme="primary">
                        {{ __('Add Meeting') }}
                    </global-button>
                </template>
            </page-header>
            <global-table>
                <template #head>
                    <th class="py-4 px-5 whitespace-nowrap">
                        {{ __('Topic') }}
                    </th>
                    <th class="py-4 px-5 whitespace-nowrap">
                        {{ __('Host Email') }}
                    </th>
                    <th class="py-4 px-5 whitespace-nowrap">
                        {{ __('Start Date') }}
                    </th>
                    <th class="py-4 px-5 whitespace-nowrap">
                        {{ __('Password') }}
                    </th>
                    <th class="py-4 px-5 whitespace-nowrap">
                        {{ __('Status') }}
                    </th>
                    <th width="10%" class="py-4 px-5 whitespace-nowrap">
                        {{ __('Action') }}
                    </th>
                </template>
                <template #body>
                    <template v-if="meetings.data.length > 0">
                        <template v-for="meeting in meetings.data" :key="meeting.id">
                            <tr class="border-t dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <div class="text-base">
                                        {{ meeting.topic }}
                                    </div>
                                    <div class="text-sm">
                                        # {{ meeting.meeting_id }}
                                    </div>
                                </td>
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <div>{{ meeting.host_email }}</div>
                                    <a :href="meeting.meeting_start_url" target="__blank"
                                        class="inline-block mt-2 bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-1 rounded dark:bg-gray-700 dark:text-gray-400">
                                        {{ __('Start Meeting') }}
                                    </a>
                                </td>
                                <td class="py-4 px-5 whitespace-nowrap">
                                    {{ formatTime(meeting.start_time,'','HH:mm') }}
                                </td>
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <div>{{ meeting.password }}</div>
                                    <a :href="meeting.meeting_join_url" target="__blank"
                                        class="inline-block mt-2 bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-1 rounded dark:bg-gray-700 dark:text-gray-400">
                                        {{ __('Join Meeting') }}
                                    </a>
                                </td>
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <div class="text-xs font-semibold mr-2 px-2.5 py-1 rounded dark:bg-gray-700 capitalize dark:text-gray-400" :class="meeting.status == 'Expired' ? 'text-red-500' : ''">
                                       {{ meeting.status }}
                                    </div>
                                </td>
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="show(meeting)" class="group relative" :id="'viewMeeting' + meeting.id">
                                            <eye-icon class="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                            <tool-tip :text="__('View')" />
                                        </button>
                                        <button v-if="can('meeting.update')" type="button" @click="edit(meeting)" class="group relative" :id="'editMeeting' + meeting.id">
                                            <PencilSquareIcon class="text-blue-400 w-6 h-6 hover:text-blue-300" />
                                            <tool-tip :text="__('Edit')" />
                                        </button>
                                        <button v-if="can('meeting.destroy')" type="button" @click="destroy(meeting.id)" class="group relative" :id="'deleteMeeting' + meeting.id">
                                            <trash-icon class="w-6 h-6 text-red-400 hover:text-red-300" />
                                            <tool-tip :text="__('Delete')" />
                                        </button>
                                    </div>
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
                <pagination class="mt-6" :links="meetings.links" />
            </div>
        </div>
        <a-modal v-model:visible="visible_show" :title="show_meeting && show_meeting.title" @ok="hide">
            <template #footer>
                <a-button key="back" @click="hide">{{ __('Close') }}</a-button>
            </template>
            <show-modal :meeting="show_meeting" />
        </a-modal>
        <create-update-form ref="createUpdate" :users="users" :roles="roles" :meeting="edit_meeting" />
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import ToolTip from "@/Shared/ToolTip.vue";
    import { PencilSquareIcon, TrashIcon, EyeIcon } from "@heroicons/vue/24/outline";
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import ShowModal from "./Show.vue";
    import CreateUpdateForm from './Form.vue';
    import NothingFound from "@/Shared/NothingFound.vue";

    export default {
        components: {
            AppLayout,
            ToolTip,
            TrashIcon,
            PencilSquareIcon,
            Pagination,
            EyeIcon,
            ShowModal,
            CreateUpdateForm,
            NothingFound
        },
        props: {
            meetings: Object,
            users: Object,
            roles: Object
        },
        data() {
            return {
                visible_show: false,
                show_meeting: "",
                edit_meeting: "",
            };
        },
        methods: {
            destroy(id) {
                if (confirm("Are you sure ?")) {
                    this.$inertia.delete(this.route("meeting.destroy", id));
                } else {
                    return false;
                }
            },
            show(meeting) {
                this.show_meeting = meeting;
                this.visible_show = true;
            },
            hide() {
                this.visible_show = false;
            },
            create() {
                this.$refs.createUpdate.showModal()
            },
            edit(arg) {
                this.edit_meeting = arg;
                this.$refs.createUpdate.showModal()
            }
        },
    };
</script>

<style lang="scss" scoped>

</style>
