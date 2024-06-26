<template>
    <Head :title="__('My Courses')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('My Courses')" />
        </Breadcrumb>

        <div class="my-2">
            <page-header>
                {{ __('My Courses') }}
            </page-header>
            <template v-if="Object.keys(subjects).length > 0">
                <div class="mb-8 pb-8 border-b-2 border-gray-200 dark:border-gray-600" v-for="(item, index) in subjects"
                    :key="index">
                    <single-course>
                        <template #name>
                            {{ item[0].subject.course.name }} #{{ index }}
                        </template>
                        <template #subject>
                            <Link :href="route('subject.details', subject.subject.slug)" :data="{ tab: tab }"
                                class="bg-white hover:bg-slate-300 dark:bg-gray-800 rounded-lg" v-for="subject in item"
                                :key="subject.id">
                            <div class="flex justify-between px-6 pt-6">
                                <h2 class="text-black text-base dark:text-gray-500 font-bold">
                                    {{ subject.subject ? subject.subject.name : '' }}
                                </h2>
                            </div>
                            <hr class="dark:border-gray-700" />
                            <div class="mt-7 ml-6 mr-6">
                                <div @click="tabSet('students')"
                                    v-if="subject.subject && subject.subject.course && subject.subject.course.students.length > 0"
                                    class="flex -space-x-4">
                                    <img v-for="(student, i) in subject.subject.course.students" :key="i"
                                        class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                        :src="student.user.profile_photo_url" :alt="student.user.name">
                                    <span v-if="subject.total_students - 7 >= 1"
                                        class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800">
                                        + {{ calStudent(subject?.total_students, 7) }}
                                    </span>
                                </div>
                                <div class="mb-6"></div>
                            </div>
                            </Link>
                        </template>
                    </single-course>
                </div>
            </template>
            <template v-else>
                <div class="col-span-3 rounded-lg dark:text-gray-400 dark:bg-gray-800 text-center bg-gray-50 p-4">
                    {{ __("You don't have any subject") }}
                </div>
            </template>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ChevronDownIcon, UserIcon } from '@heroicons/vue/24/outline'
import SingleCourse from "./SingleCourse.vue";
export default {
    props: {
        subjects: Object,
    },
    components: {
        AppLayout,
        UserIcon,
        SingleCourse,
        ChevronDownIcon,
    },
    data() {
        return {
            tab: ''
        }
    },
    methods: {
        calStudent(total_amount, amount) {
            return total_amount - amount;
        },
        tabSet() {
            this.tab = 'students';
        }
    }
};
</script>
