<template>
    <AppLayout :title="__('Create Routine')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('routine.index')" title="Class Schedule" />
            <BreadcrumbLink title="Create Routine" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Create a New Schedule') }}
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
                                <Multiselect id="class" class="dark:text-gray-900" v-model="form.teacher"
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
                                    :options="courses.map(item => ({ value: item.id, label: item.name }))"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.class" />
                            </div>
                            <div class="mb-3">
                                <global-label for="subject" value="Select Subject" :required="true" />
                                <Multiselect id="subject" class="dark:text-gray-900"
                                    :class="$page.props.errors.subject ? 'border-custom ' : ''" v-model="form.subject"
                                    :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                    placeholder="Select a subject"
                                    :options="subjects_all.map(item => ({ value: item.id, label: item.name }))"
                                    autocomplete="off" />
                                <input-error :error="$page.props.errors.subject" />
                            </div>
                        </div>
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="activation" :value="__('Select Activation')" :required="true" />
                                <Multiselect id="activation" class="dark:text-gray-900" v-model="form.activation"
                                    :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                    :placeholder="__('Select Activation')" :options="activationOptions" autocomplete="off" />
                                <input-error :error="$page.props.errors.activation" />
                            </div>
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
                                    " name="time"
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

export default {
    components: {
        AppLayout,
        TeacherComponent,
        Student,
        Multiselect,
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
            activationOptions: [
                { value: 1, label: 'Weekday 1' },
                { value: 2, label: 'Weekday 2' }
                ],
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
                activation: this.routine ? this.routine.activation : null,
                weekday: this.routine ? this.routine.weekday : null,
                _method: this.routine ? "PUT" : "POST",
            }),
            subjects_all: [],
            teacher: [],
        };
    },
    watch: {
        "form.class": {
            deep: true,
            handler(val) {
                this.loadSubjects();
            },
        }
    },
    mounted(){
        if(this.routine){
            this.loadSubjects();
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
        async submit() {

            if (!this.form.activation) {
                alert('Please select activation!');
            }

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
                                'activation',
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
                            'activation',
                            'weekday'
                        )
                    },
                });
            }
        },
        async loadSubjects() {
            this.subjects_all = [];
            let course_id = this.form.class;

            let response = await axios.get(route("fetch.subjects", course_id));
            this.subjects_all = response.data;
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
