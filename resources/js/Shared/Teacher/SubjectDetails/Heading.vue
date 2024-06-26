<template>
    <nav class="flex items-center md:mt-0 space-x-2">
        <div
            class="flex flex-wrap bg-gray-200/50 hover:bg-gray-200 rounded-lg transition py-1 px-2 dark:bg-gray-700 dark:hover:bg-gray-700/70">
            <Link
            :href="$page.props.auth.role == 'Teacher' ? route('subject.details', course.slug) : route('subject.show', course.slug)"
            :data="{ tab: 'details' }"
            :class="request_data.tab == 'details' || !request_data.tab ? 'bg-white dark:bg-gray-500': ''"
            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold">
                {{ __('Details') }}
            </Link>

            <Link
            :href="$page.props.auth.role == 'Teacher' ? route('subject.details', course.slug) : route('subject.show', course.slug)"
            :data="{ tab: 'schedule' }"
            :class="request_data.tab == 'schedule' ? 'bg-white dark:bg-gray-500': ''"
            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold">
                {{ __('Course Schedule') }}
            </Link>

            <Link
            :href="$page.props.auth.role == 'Teacher' ? route('subject.details', course.slug) : route('subject.show', course.slug)"
            :data="{ tab: 'students' }"
            :class="request_data.tab == 'students' ? 'bg-white dark:bg-gray-500': ''"
            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold">
                {{ __('Student List') }}
            </Link>

            <Link
            :href="$page.props.auth.role == 'Teacher' ? route('subject.details', course.slug) : route('subject.show', course.slug)"
            :data="{ tab: 'assignments' }"
            :class="request_data.tab == 'assignments' ? 'bg-white dark:bg-gray-500': ''"
            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold">
                {{ __('Assignments') }}
            </Link>

            <Link
            :href="$page.props.auth.role == 'Teacher' ? route('subject.details', course.slug) : route('subject.show', course.slug)"
            :data="{ tab: 'online-class' }"
            :class="request_data.tab == 'online-class' ? 'bg-white dark:bg-gray-500': ''"
            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold">
                {{ __('Online Class') }}
            </Link>

            <Link
            :href="$page.props.auth.role == 'Teacher' ? route('subject.details', course.slug) : route('subject.show', course.slug)"
            :data="{ tab: 'syllabus' }"
            :class="request_data.tab == 'syllabus' ? 'bg-white dark:bg-gray-500': ''"
            class="cursor-pointer text-gray-700 whitespace-nowrap text-xs hover:text-gray-700 rounded-md py-2 px-3 dark:text-gray-400 dark:hover:text-gray-300 font-bold">
                {{ __('Syllabus') }}
            </Link>
        </div>
    </nav>
</template>

<script>

export default {
    props: {
        course: Object,
        request_data: Object
    },
    components: {},
    data() {
        return {

        }
    },
    methods: {

    }
};
</script>
<style scoped>
</style>
