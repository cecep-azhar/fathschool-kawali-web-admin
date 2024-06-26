<template>
    <AppLayout :title="__(routine ? 'Update routine' : 'Create Routine')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('routine.index')" title="Class Schedule" />
            <BreadcrumbLink :title="routine ? __('Update Routine') : __('Create Routine')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __(routine ? 'Update Routine' : 'Create a New Schedule') }}
                <template #content>
                    <Link preserve-scroll :href="route('routine.index')">
                    <global-button :loading="false" type="button" theme="primary">
                        {{ __('Back To List') }}
                    </global-button>
                    </Link>
                </template>
            </page-header>
            <div class="rounded-lg">
                <form class="mt-2" @submit.prevent="submit()">
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="teacher" value="Select Teacher" :required="true" />
                                <Multiselect id="teacher" class="dark:text-gray-900" v-model="form.teacher"
                                    :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                    placeholder="Select a teacher"
                                    :options="teachers.map(item => ({ value: item.id, label: item.name }))"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.teacher" />
                            </div>
                            <div class="mb-3">
                                <global-label for="class" value="Select Course" :required="true" />
                                <Multiselect id="class" class="dark:text-gray-900"
                                    :class="$page.props.errors.class ? 'border-custom ' : ''" v-model="form.class"
                                    :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                    placeholder="Select a course"
                                    :options="courses_all.map(item => ({ value: item.id, label: item.name }))"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.class" />
                            </div>
                            <div class="mb-3">
                                <global-label for="subject" value="Select Subject" :required="true" />
                                <Multiselect id="subject" class="dark:text-gray-900"
                                    :class="$page.props.errors.subject ? 'border-custom ' : ''" v-model="form.subject"
                                    :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                    placeholder="Select a subject"
                                    :options="subjects_all.map(item => ({ value: item.subject_id, label: item.name }))"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.subject" />
                            </div>
                        </div>
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="weekday" :value="__('Select Weekdays')" :required="true" />
                                <Multiselect id="weekday" class="dark:text-gray-900" v-model="form.weekday"
                                    :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                    :placeholder="__('Select Weekdays')" :options="options3" autocomplete="off" />
                                <input-error :error="$page.props.errors.weekday" />
                            </div>
                            <div class="mb-3">
                                <global-label for="time" :value="__('Schedule Time')" :required="true" />
                                <a-range-picker picker="time" style="" :class="$page.props.errors.time
                                    ? 'border-custom'
                                    : ''
                                    " name="time" id="testTime"
                                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                                    :disabled-date="disabledDate" :placeholder="['Start Time', 'End Time']"
                                    :disabled-time="disabledRangeTime" v-model:value="form.time" format="HH:mm" />
                                <input-error :error="$page.props.errors.time" />
                            </div>
                        </div>
                    </div>
                    <global-button :loading="form.processing" type="submit" cssClass="w-full mt-3" theme="primary">
                        {{ __('Save') }}
                    </global-button>
                </form>
            </div>
        </div>
        <!-- Drug confirm modal  -->
        <custom-modal :show="eventEditModal" @close="eventEditModal = false">
            <template #title>
                <div class="text-left">
                    {{ __('Edit event') }}
                </div>
            </template>
            <template #content>
                <!-- Content -->
                <div class="font-bold mb-2 mt-8">

                    <div class="flex items-center mb-2">
                        <input v-model="form.event" name="event" id="only_m1e" type="radio" value="only_me"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="only_m1e" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            This event
                        </label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input v-model="form.event" name="event" id="all_events1" type="radio" value="all_events"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="all_events1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            This and following events
                        </label>
                    </div>

                </div>
            </template>
            <template #footer>
                <global-button :loading="form.processing" @click="submitForm()" class="mr-2">
                    {{ __('Update') }}
                </global-button>
            </template>
        </custom-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import TeacherComponent from "@/Shared/Admin/User/Teacher.vue";
import Student from "@/Shared/Admin/User/Student.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import dayjs, { Dayjs } from "dayjs";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import CustomModal from '@/Shared/Modal.vue'

export default {
    components: {
        AppLayout,
        TeacherComponent,
        Student,
        Multiselect,
        CustomModal
    },
    props: {
        routine: Object,
        errors: Object,
        teachers: Object,
        courses: Object,
        subjects: Object,
        workdays: Object,
    },
    data() {
        return {
            options3: [],
            form: useForm({
                teacher: this.routine ? this.routine.teacher_id : null,
                class: this.routine ? this.routine.course_id : null,
                subject: this.routine ? this.routine.subject_id : null,
                time: [
                    this.routine
                        ? dayjs(this.routine.start_time, "HH:mm")
                        : null,
                    this.routine ? dayjs(this.routine.end_time, "HH:mm") : null,
                ],
                start_time: null,
                end_time: null,
                event: 'only_me',
                weekday: this.routine ? this.routine.weekday : null,
                _method: this.routine ? "PUT" : "POST",
            }),
            subjects_all: [],
            courses_all: [],
            teacher: [],
            eventEditModal: false,
        };
    },
    watch: {
        "form.class": {
            deep: true,
            handler(val) {
                this.loadSubjects();
            },
        },
        "form.teacher": {
            deep: true,
            handler(val, old) {
                this.form.class = '';
                const teacher = this.teachers.find(t => t.id === val);
                this.loadTeacherWiseCourses(teacher?.courses);
            },
        },

    },
    mounted() {
        if (this.routine) {
            this.loadSubjects();
        }

        if (this.routine) {
            const teacher = this.teachers.find(t => t.id === this.routine.teacher_id);
            this.loadTeacherWiseCourses(teacher?.courses);
        }
    },
    created() {
        // for workdays
        for (const [key, value] of Object.entries(this.workdays)) {
            this.options3.push({
                value: key,
                label: value,
            });
        }
    },
    methods: {
        submitData() {
            //
        },
        async submit() {
            // check weekend
            if (!this.form.weekday) {
                alert('Please select weekday!');
            }

            let isWeekend = await axios.post(
                route("checkweekend", this.form.weekday)
            );
            if (isWeekend.data) {
                alert("You cannot create a routine on a weekend day.");
                return;
            }

            if (this.routine && this.routine.is_recurring) {
                this.eventEditModal = true;
            } else {
                this.submitForm();
            }
        },
        submitForm() {
            this.form.start_time = dayjs(this.form.time[0]).format("H:m");
            this.form.end_time = dayjs(this.form.time[1]).format("H:m");
            if (this.routine) {
                this.form.post(
                    this.route("routine.update", this.routine.id),
                    {
                        preserveScroll: true,
                        onSuccess: () => {
                            this.form.reset(
                                'teacher',
                                'class',
                                'subject',
                                'time',
                                'start_time',
                                'end_time',
                                'weekday',
                            )
                        },
                    }
                );
            } else {
                this.form.post(this.route("routine.store"), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset(
                            'teacher',
                            'class',
                            'subject',
                            'time',
                            'start_time',
                            'end_time',
                            'weekday'
                        )
                    },
                });
            }
        },
        async loadSubjects() {
            this.subjects_all = [];
            let course_id = this.form.class;
            let teacher_id = this.form.teacher;

            this.subjects.forEach(subject => {

                if (subject.course_id == course_id && subject.teacher_id == teacher_id) {
                    this.subjects_all.push(subject);
                }
            });

            if (this.routine) {
                this.subject = this.routine.subject_id;
            }
        },
        async loadTeacherWiseCourses(courses) {

            this.courses_all = this.courses.filter(t => courses.includes(t.id));

        },
        async loadTeacher() {
            let subject_id = this.form.subject;

            let response = await axios.get(route("fetch.teachers", subject_id));

            if (response.data) {
                this.teacher.id = response.data.teacher.id;
                this.teacher.name = response.data.teacher.name;
            } else {
                this.errors.teacher = "No Teacher is assigned for this course.";
            }
        },
    },
};
</script>
<style scoped>
.custom-input {
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}
</style>
