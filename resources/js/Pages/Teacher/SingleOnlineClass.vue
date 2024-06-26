<template>
    <div class="bg-white cursor-pointer dark:bg-gray-800 p-6 rounded-md">
        <span>
            <div class="text-xl dark:text-gray-400">
                {{ item.topic }}
            </div>
            <div class="flex items-center mt-4 dark:text-gray-400">
                <div>
                    <BookOpenIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-500  ml-2">
                    {{ __('Course') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400  ml-2">
                    {{ item.course ? item.course.name : '' }}
                </div>
            </div>
            <div class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <DocumentIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-500  ml-2">
                    {{ __('Subject') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400  ml-2">
                    {{ item.subject ? item.subject.name : '' }}
                </div>
            </div>
            <div class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <UserIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-500  ml-2">
                    {{ __('Teacher') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400  ml-2">
                    {{ item.teacher ? item.teacher.name : '' }}
                </div>
            </div>
            <div class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <CalendarDaysIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-500  ml-2">
                    {{ __('Start Date') }}:
                </div>
                <div class="text-gray-900 dark:text-gray-400  ml-2">
                    {{ item.start_date_format }}
                </div>
            </div>
            <div class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <CheckBadgeIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-500  ml-2">
                    {{ __('Status') }}:
                </div>
                <div class="capitalize ml-2">
                    {{ item.status }}
                </div>
            </div>
            <div class="flex items-center mt-2 dark:text-gray-400">
                <div>
                    <LinkIcon class="w-6 h-6" />
                </div>
                <div class="text-gray-500  ml-2">
                    {{ __('Link') }}:
                </div>
                <a :href="$page.props.auth.role == 'Teacher' ? item.start_url : item.join_url"
                    class="text-blue-500 truncate dark:text-gray-400  ml-2" target="_blank">
                    {{ $page.props.auth.role == 'Teacher' ? item.start_url : item.join_url }}
                </a>
            </div>
            <div @click="full_description(item.id)" class="flex mt-2 dark:text-gray-400">
                <div>
                    <EyeIcon class="w-6 h-6" />
                </div>
                <div class="ml-2 text-gray-500" :class="full_des == item.id ? '' : 'line-clamp-2'">
                    {{ __('Description') }}:
                    <span class="text-gray-900 dark:text-gray-400">
                        {{ item.description }}
                    </span>
                </div>
            </div>
        </span>
        <div class="mt-6 flex items-center justify-between">
            <div>
                <template v-if="item.status == 'completed'">
                    <button type="button" disabled class="bg-blue-500 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-blue-600 text-white px-4 py-2 rounded ">
                        {{ __('Completed') }}
                    </button>
                </template>
                <template v-else>
                    <a :href="$page.props.auth.role == 'Teacher' ? item.start_url : item.join_url" target="_blank"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded ">
                        {{ $page.props.auth.role == 'Teacher' ? __('Start Class') : __('Join Class') }}
                    </a>
                </template>
            </div>
            <template v-if="action == 'not-show'"></template>
            <template v-else>
                <div class="flex items-center gap-1">
                    <button type="button" @click="edit(item)" class="w-6 h-6 text-gray-500" :id="item ? 'editOnlineClass' + item.id : ''">
                        <PencilSquareIcon />
                    </button>
                    <button type="button" @click="destroy(item.id)" class="w-6 h-6 text-gray-500" :id="item ? 'deleteOnlineClass' + item.id : ''">
                        <TrashIcon />
                    </button>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import {
    BookOpenIcon,
    DocumentIcon,
    UserIcon,
    CalendarDaysIcon,
    CheckCircleIcon,
    HashtagIcon,
    PencilSquareIcon,
    TrashIcon,
    LinkIcon,
    EyeIcon,
    CheckBadgeIcon
} from "@heroicons/vue/24/outline";

export default {
    props: ['item', 'editFunction', 'action'],
    data() {
        return {
            full_des: '',
        }
    },
    methods: {
        full_description(id) {
            this.full_des = id;
        },
        edit: function (arg) {
            this.editFunction(arg);
        },
        destroy: function (id) {
            if (confirm('Are you sure ?')) {
                this.$inertia.delete(this.route('online.class.destroy', id), {
                    preserveScroll: true,
                });
            }
        },
    },
    components: {
        BookOpenIcon,
        CheckBadgeIcon,
        PencilSquareIcon,
        TrashIcon,
        DocumentIcon,
        UserIcon,
        CalendarDaysIcon,
        CheckCircleIcon,
        HashtagIcon,
        EyeIcon,
        LinkIcon
    },
};
</script>

<style lang="scss" scoped>
</style>
