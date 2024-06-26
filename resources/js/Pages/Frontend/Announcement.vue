<template>
    <Head title="Announcement" />
    <FrontendLayout>
        <div class="bg-white pt-16 pb-20 lg:pt-24 lg:pb-28">
            <div class="relative mx-auto max-w-lg lg:max-w-7xl px-4 sm:px-6 lg:px-8 divide-y-2 divide-gray-200">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('Recent Announcements') }}</h2>
                    <p class="mt-3 text-xl text-gray-500 sm:mt-4">{{ __('Here are the most recent announcements You can get up-to-date information about school events and notices') }}</p>
                </div>
                <div class="mt-12 grid gap-16 pt-12 lg:grid-cols-3 lg:gap-x-5 lg:gap-y-12">
                    <div v-for="notice in notices" :key="notice.id">
                        <Link :href="route('announcement.details', notice.slug)" class="mt-4 block">
                            <p class="text-xl font-semibold text-gray-900">{{ notice.title }}</p>
                            <p class="mt-3 text-base text-gray-500 line-clamp-3" v-html="notice.description.substring(0,200)+'..'"></p>
                        </Link>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                            <Link :href="route('announcement.details', notice.slug)">
                                <span class="sr-only">{{ notice.user.name }}</span>
                                <img class="h-10 w-10 rounded-full" :src="notice.user.profile_photo_url" alt="" />
                            </Link>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 mb-0">
                                    <Link :href="route('announcement.details', notice.slug)">{{ notice.user.name }}</Link>
                                </p>
                                <div class="flex text-sm text-gray-500">
                                    <span aria-hidden="true">&middot;</span>
                                    <span>{{ notice.time }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </FrontendLayout>
</template>

<script>
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

export default {
    props:{
        notices: {
            type: Array,
            default: () => []
        }
    },
    components: {
        FrontendLayout,
    }
}
</script>
