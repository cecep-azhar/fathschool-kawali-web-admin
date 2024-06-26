<template>
    <AppLayout :title="__('Notice Board')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Notice Board')" />
        </Breadcrumb>

        <div >
            <page-header>
                {{ __('Notice Board') }}
            </page-header>
            <template v-if="notices.data.length > 0">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                    <Link :href="route('notice.board.details', noticee.slug)" v-for="noticee in notices.data"
                        :key="noticee.id"
                        class="bg-white mb-2 hover:cursor-pointer rounded-lg dark:bg-gray-800 dark:text-gray-400">
                    <div>
                        <img class="w-full h-[200px] object-cover rounded-t-lg" :src="noticee.attachment_url" alt="" />
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <p class="flex items-center gap-1.5 mb-0">
                                <CalendarIcon class="w-6 h-6 text-blue-500" />
                                <span>{{ formatTime(noticee.created_at,'','HH:mm') }}</span>
                                ds
                            </p>
                        </div>
                        <h2 class="text-2xl font-bold line-clamp-1 text-gray-900 dark:text-gray-400">
                            {{ noticee.title }}
                        </h2>
                        <div class="mt-4 mb-6 text-gray-900 dark:text-gray-500 line-clamp-3" v-html="noticee.description.substr(0, 300)">
                        </div>
                        <div class="flex gap-4 items-center">
                            <div :href="route('notice.board.details', noticee.slug)"
                                class="text-blue-500 inline-flex gap-1.5 items-center">
                                {{ __('Read Full Notice') }}
                                <ChevronDoubleRightIcon class="w-4 h-4" />
                            </div>
                            <div class="text-gray-900 dark:text-gray-500 inline-flex gap-1.5 items-center">
                                <ChatBubbleOvalLeftIcon class="w-4 h-4" />
                                {{ __('Comments') }} ({{ noticee.comments_count }})
                            </div>
                        </div>
                    </div>
                    </Link>
                </div>
            </template>
            <template v-else>
                <NothingFound asShow="div" />
            </template>
            <div class="flex justify-center">
                <pagination class="mt-6" :links="notices.links" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Admin/Pagination.vue";
import NothingFound from "@/Shared/NothingFound.vue";
import {
    ChatBubbleOvalLeftIcon,
    ChevronDoubleRightIcon,
    CalendarIcon,
} from "@heroicons/vue/24/outline";

export default {
    components: {
        AppLayout,
        Pagination,
        NothingFound,
        ChatBubbleOvalLeftIcon,
        ChevronDoubleRightIcon,
        CalendarIcon
    },
    props: {
        notices: Object
    },
    data() {

    },
};
</script>
