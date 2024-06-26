<template>

    <Head :title="__('Subject List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Subjects')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Subjects') }}
                </div>
            </page-header>
            <div class="grid gap-6 grid-cols-1 md:grid-cols-4">
                <div class="col-span-1 md:col-span-3 auto-rows-min">
                    <div v-if="subjects.length > 0">
                        <div class="grid gap-6 grid-cols-1 md:grid-cols-3">
                            <div class="card bg-white rounded-lg dark:bg-gray-800 dark:text-gray-400"
                                v-for="(subject, index) in subjects" :key="index">
                                <div class="flex justify-between px-6 pt-6 pb-2.5">
                                    <h2 class="text-gray-900 dark:text-gray-400">{{ subject.name }}</h2>
                                    <div class="flex gap-2">
                                        <div class="text-blue-500 hover:text-blue-400">
                                            <Link :href="route('subject.show', subject.slug)">
                                                {{ __('View') }}
                                            </Link>
                                        </div>
                                        <form @submit.prevent="destroy(subject.id)">
                                            <button type="submit">
                                                <trash-icon classes="w-6 h-6 text-red-400" />
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <hr class="dark:border-gray-700" />
                                <div class="px-6 pt-4 pb-6 dark:text-gray-400">
                                    <h2 class="dark:text-gray-400">{{ __('Course') }}: {{ subject.course ? subject.course.name : '' }}
                                    </h2>
                                    <h2 class="dark:text-gray-400">{{ __('Session') }}: {{ subject.session }}</h2>
                                    <h2 v-if="subject.online_classes.length > 0"
                                        class="dark:text-gray-400 text-sm text-gray-500 mt-3">
                                        {{ __('Next Class') }}: {{ subject.online_classes[0].start_date_format }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text-center card bg-white dark:bg-gray-800 dark:text-white">
                        <div class="flex justify-center px-6 pt-6 pb-2.5">
                            <h2 class="text-gray-900 dark:text-gray-400"><NothingFound asShow="div" /></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import NothingFound from "@/Shared/NothingFound.vue"
export default {
    props: {
        subjects: Object,
    },
    data() {
        return {
        };
    },
    components: {
        AppLayout,
        NothingFound
    },
    methods: {
    },
};
</script>
