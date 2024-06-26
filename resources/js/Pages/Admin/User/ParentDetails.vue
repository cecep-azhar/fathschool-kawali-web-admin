<template>
    <AppLayout :title="__('Parent Details')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Parent Details')" />
        </Breadcrumb>

        <div class="my-2">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __('Parent Details') }}
                </div>
            </page-header>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="bg-white rounded-md dark:bg-gray-800">
                        <div class="px-4 text-lg font-bold dark:text-gray-400">
                            <div class="mb-3 pt-3">
                                {{ __('Parent Information') }}
                            </div>
                        </div>
                        <hr class="border-gray-100 dark:border-gray-500">
                        <div class="px-6 rounded-lg flex">
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg flex">
                                <div>
                                    <img width="110" height="110" class="rounded" :src="user.profile_photo_url"
                                        :alt="user.name">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-0 gap-x-12 ml-8">
                                    <div class="col-span-1 md:col-span-2 dark:text-gray-400 text-2xl font-bold">
                                        {{ user.name }}
                                    </div>
                                    <div>
                                        <span class="font-semibold text-md dark:text-gray-400">{{ __('Email') }} :
                                        </span>
                                        <span class="text-sm font-normal dark:text-gray-400">
                                            {{ user.email }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mt-2">
                        <div class="rounded-lg dark:bg-gray-800 dark:text-gray-400">
                            <div class="bg-white dark:bg-gray-700 mb-2 p-4 rounded text-lg font-bold dark:text-gray-400">
                                <div class="">
                                    {{ __('Childrens') }}
                                </div>
                            </div>
                            <template v-if="childrens.length > 0">
                                <template v-for="(child, index) in childrens" :key="child.id">
                                    <Link as="div" :href="route('student.show', child.id)"
                                        class="w-full cursor-pointer mt-1 bg-white rounded-lg border border-gray-500 p-4 dark:bg-gray-800 dark:border-gray-700">
                                        <div class="mb-1 py-1" :class="index != 0 ? 'mt-2' : ''">
                                            <div class="flex items-center gap-6">
                                                <div class="ml-4">
                                                    <img class="rounded-lg" :src="child.profile_photo_url" width="96"
                                                        height="96" :alt="child.name" />
                                                </div>
                                                <div
                                                    class="w-full gap-6 md:flex items-center justify-between mr-12 mt-1 pr-1">
                                                    <div>
                                                        <div
                                                            class="text-xl text-gray-800 dark:text-gray-400 hover:text-gray-900">
                                                            {{ child.name }}
                                                        </div>
                                                        <div class="flex items-center dark:text-gray-400">
                                                            {{ child.email }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="flex font-semibold dark:text-gray-400">
                                                            <div>{{ __('Phone Number') }} : </div>
                                                            <div class="ml-2">
                                                                {{ child.phone }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="flex font-semibold dark:text-gray-400 whitespace-nowrap">
                                                            <div>{{ __('Address') }} : </div>
                                                            <div class="ml-2">
                                                                {{ child.address }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </Link>
                                </template>
                            </template>
                            <template v-else>
                                <NothingFound asShow="div" cssClass="text-center" />
                            </template>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout
    },
    props: {
        childrens: Object,
        user: Object,
    },
    data() {
        return {
        };
    },
    methods: {
    },
};
</script>

<style lang="scss" scoped>
</style>
