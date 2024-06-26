<template>
    <AppLayout :title="__('Course List')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Course List')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __('Course List') }}
                </div>
            </page-header>
            <div class="mt-6">
                <template v-if="courses.length > 0">
                    <div class="mb-8 pb-8 border-b-2 border-gray-200 dark:border-gray-600"
                        v-for="(course, index) in courses" :key="index">
                        <single-course>
                            <template #name>
                                {{ course.course ? course.course.name : '-' }} #{{ index }}
                            </template>
                            <template #subject>
                                <Link :href="route('subject.show', subject.slug)" :data="{ tab: tab }"
                                    class="bg-white hover:bg-slate-300 dark:bg-gray-800 rounded-lg"
                                    v-for="subject in course.course.subjects" :key="subject.id">
                                <div class="flex justify-between px-6 pt-6">
                                    <h2 class="text-black text-base dark:text-gray-500 font-bold">
                                        {{ subject.name }}
                                    </h2>
                                </div>
                                <hr class="dark:border-gray-700" />
                                <div class="mt-7 ml-6 mr-6">
                                    <div @click="tabSet('students')"
                                        v-if="course.course && course.course.students.length > 0" class="flex -space-x-4">
                                        <img v-for="(student, i) in course.course.students" :key="i"
                                            class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                            :src="student.user.profile_photo_url" :alt="student.user.name">
                                        <span v-if="course.total_students - 7 >= 1"
                                            class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800">
                                            + {{ calculateStudent(course.total_students, 7) }}
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
                    <div class="text-center text-lg text-gray-400">
                        <NothingFound cssClass="text-center" asShow="div" />
                    </div>
                </template>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { UserIcon } from '@heroicons/vue/24/outline';
import NothingFound from "@/Shared/NothingFound.vue";
import SingleCourse from "../Teacher/SingleCourse.vue";

export default {
    components: {
        AppLayout,
        UserIcon,
        SingleCourse
    },
    props: {
        courses: Object
    },
    data() {
        return {


        };
    },
    methods: {
        calculateStudent(total_amount, amount) {
            return total_amount - amount;
        },
        tabSet() {
            this.tab = 'students';
        }
    },
};
</script>
