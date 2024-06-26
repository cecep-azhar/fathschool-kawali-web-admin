<template>
    <AppLayout :title="__('Profile')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Profile')"/>
        </Breadcrumb>

        <div >
            <page-header>
                {{ __('Profile') }}
            </page-header>
            <div class="bg-white rounded-lg">
                <div class="flex flex-col h-full">
                    <!-- Card top -->
                    <div class="flex-grow p-5">
                        <div class="flex justify-between items-start">
                            <div class="flex gap-6 mb-2">
                                <img class="rounded-lg" :src="$page.props.auth.profile_photo_url" width="96" height="96"
                                    :alt="$page.props.auth.name" />
                                <div class="mt-1 pr-1">
                                    <div class="inline-flex text-gray-800 hover:text-gray-900">
                                        <h2 class="text-xl leading-snug justify-center font-semibold">
                                            {{ $page.props.auth.name }}
                                        </h2>
                                    </div>
                                    <div class="flex items-center">
                                        {{ $page.props.auth.role }}
                                    </div>
                                </div>
                            </div>
                            <div class="relative inline-flex flex-shrink-0" x-data="{ open: false }">
                                <Link :href="route('profile')">
                                <global-button :loading="false" type="button" theme="primary">
                                    {{ __('Edit Profile') }}
                                </global-button>
                                </Link>
                            </div>
                        </div>
                        <!-- Bio -->
                        <div class="flex font-semibold">
                            <div>{{ __('Phone Number') }} : </div>
                            <div class="ml-2">
                                {{ $page.props.auth.phone }}
                            </div>
                        </div>
                        <div class="flex font-semibold">
                            <div>{{ __('Email Address') }} : </div>
                            <div class="ml-2">
                                {{ $page.props.auth.email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dark:text-gray-400 text-lg p-2">
                {{ __('Child') }}
            </div>
            <div class="grid grid-cols-4 gap-2 col-span-2">
                <template v-for="child in kids" :key="child.id">
                    <single-child-card :child="child">
                        <div class="text-gray-500 dark:text-gray-400">
                            {{ __('Course') }} : {{ child.class && child.class.name }}
                        </div>
                        <div class="text-gray-500 dark:text-gray-400">
                            {{ __('Total Class') }} : {{ child.attendances_count }}
                        </div>
                        <div class="text-gray-500 dark:text-gray-400">
                            {{ __('Present Class') }} : {{ child.present_classes }}
                        </div>
                        <div class="text-gray-500 dark:text-gray-400">
                            {{ __('Late Class') }} : {{ child.late_classes }}
                        </div>
                        <div class="text-gray-500 dark:text-gray-400">
                           {{ __(' Absent Class') }} : {{ child.absent_classes }}
                        </div>
                    </single-child-card>
                </template>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import SingleChildCard from './SingleChildCard.vue';

export default {
    components: {
        AppLayout,
        SingleChildCard,
    },
    props: {
        teachers: Object,
        kids: Object
    },
    data() {
        return {
        };
    },
    methods: {
    },
};
</script>
