<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6">
        <div class="text-black dark:text-gray-400 font-bold text-2xl mb-2">
            {{ course.name }}
        </div>
        <div class="text-black font-normal text-sm mt-1 dark:text-gray-400 mb-3 flex gap-2 flex-wrap items-center">
            <div class="flex items-center gap-1">
                <div>
                    <BookOpenIcon class="w-6 h-6" />
                </div>
                <div>{{ __('Course') }}:</div>
                <div>{{ course.course ? course.course.name : "" }}</div>
            </div>
            <div class="flex items-center gap-1">
                <div>
                    <UserCircleIcon class="w-6 h-6" />
                </div>
                <div>{{ __('Teacher') }}:</div>
                <div class="text-gray-500 flex flex-wrap gap-2" v-for="(teacher, index) in subject_teachers" :key="index">
                    {{ teacher }}
                    <template v-if="subject_teachers.length != index + 1">,</template>
                </div>
            </div>
        </div>
    </div>
    <!-- upcoming assignment  -->
    <div>
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 mt-5">
            <div class="flex justify-between">
                <div class="text-black dark:text-gray-400 font-bold text-2xl">
                    {{ __('Upcoming Assignment') }}
                </div>
            </div>
        </div>
        <template v-if="upcoming_assignments.length > 0">
            <div class="mt-2 grid md:grid-cols-2 grid-cols-1 2xl:grid-cols-4 gap-3">
                <div v-for="assignment in upcoming_assignments" :key="assignment.id">
                    <single-assignment :assignment="assignment" view="detail" />
                </div>
            </div>
        </template>
        <template v-else>
            <div class="mt-2">
                <NothingFound asShow="div" cssClass="text-center" />
            </div>
        </template>
    </div>
    <!-- upcoming class  -->
    <div>
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 mt-5">
            <div class="flex justify-between">
                <div class="text-black dark:text-gray-400 font-bold text-2xl">
                    {{ __('Upcoming Classes') }}
                </div>
            </div>
        </div>
        <template v-if="upcoming_classes.length > 0">
            <div class="mt-2 grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-3">
                <div v-for="upcoming_class in upcoming_classes" :key="upcoming_class.id">
                    <single-online-class :item="upcoming_class" action="not-show" />
                </div>
            </div>
        </template>
        <template v-else>
            <div class="mt-2">
                <NothingFound asShow="div" cssClass="text-center" />
            </div>
        </template>
    </div>
</template>

<script>
import {
    BookOpenIcon,
    UserCircleIcon
} from '@heroicons/vue/24/outline';
import SingleAssignment from '../../../Pages/Student/SingleAssignment.vue';
import SingleOnlineClass from '../../../Pages/Teacher/SingleOnlineClass.vue';

export default {
    props: {
        course: Object,
        upcoming_classes: Object,
        subject_teachers: Array,
        upcoming_assignments: Object
    },
    components: {
        BookOpenIcon,
        UserCircleIcon,
        SingleAssignment,
        SingleOnlineClass
    },
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
