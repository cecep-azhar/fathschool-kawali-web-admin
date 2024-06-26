<template>
    <AppLayout :title="__('Student Promotion')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Student Promotion')" />
        </Breadcrumb>

        <div class="my-2">
            <page-header >
                <div class="dark:text-gray-400 font-semibold">
                    {{ __('Student Promotion') }}
                </div>
            </page-header>
            <form class="mt-2" @submit.prevent="submit()">
                <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
                    <div
                        class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                        <div class="text-gray-900 dark:text-gray-400 text-lg font-bold mb-2">
                            {{ __('Promotion From') }}
                        </div>
                        <div class="mb-3">
                            <global-label for="class" value="Select Course" :required="false" />
                            <Multiselect id="from_course" :close-on-select="true" :can-clear="false"
                                :searchable="true" v-model="form.from_course" :create-option="false"
                                :placeholder="__('From Course')" :options="from_courses.map(item => ({
                                    value: item.id, label: item.name
                                }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.from_course" />
                        </div>
                    </div>
                    <div
                        class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                        <div class="text-gray-900 dark:text-gray-400 text-lg font-bold mb-2">
                            {{ __('Promoting To') }}
                        </div>
                        <div class="mb-3">
                            <global-label for="class" value="Select Course" :required="true" />
                            <Multiselect id="to_course" :close-on-select="true" :can-clear="false"
                                :searchable="true" v-model="form.to_course" :create-option="false"
                                :placeholder="__('To Course')" :options="to_courses.map(item => ({
                                    value: item.id, label: item.name
                                }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.to_course" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <global-table>
            <template #head>
                <th class="py-4 px-5">{{ __('Student') }}</th>
                <th class="py-4 px-5">{{ __('Parent') }}</th>
                <th class="py-4 px-5">{{ __('Date of Birth') }}</th>
                <th class="py-4 px-5">{{ __('Current Result') }}</th>
                <th class="py-4 px-5">{{ __('Next Course Status') }}</th>
            </template>
            <template #body>
                <template v-if="students && students.length">
                    <tr v-for="(student, index) in students" :key="index" class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-5 whitespace-nowrap">
                            <Link :href="route('student.show', student.user.username)">
                                {{ student?.user?.name }} <span v-if="student?.user?.profile?.student_id">({{ student.user.profile.student_id }})</span>
                            </Link>
                        </td>
                        <td class="py-4 px-5">
                            <span v-for="parent in student.user.parents" :key="parent.id" class="block">
                                <span class="whitespace-nowrap">{{ parent.name }}</span> ({{ parent.phone }})
                            </span>
                        </td>
                        <td class="py-4 px-5 whitespace-nowrap">
                            {{ student?.user?.date_of_birth ? formatTime(student.user.date_of_birth):'' }}
                        </td>
                        <td class="py-4 px-5">
                            <div class="flex items-center mb-4 gap-3">
                                <div class="flex gap-1 items-center">
                                    <input v-model="form.is_passed[index]" :checked="student.is_passed" value="1" :id="'result_pass_'+index" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label :for="'result_pass_'+index" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Pass') }}</label>
                                </div>

                                <div class="flex gap-1 items-center">
                                    <input v-model="form.is_passed[index]" :checked="!student.is_passed" value="0" :id="'result_fail'+index" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label :for="'result_fail'+index" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Fail') }}</label>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <div class="flex items-center mb-4 gap-3">
                                <div class="flex gap-1 items-center">
                                    <input v-model="form.next_course_status[index]" checked value="0" :id="'session_continue'+index" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label :for="'session_continue'+index" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Continue') }}</label>
                                </div>

                                <div class="flex gap-1 items-center">
                                    <input v-model="form.next_course_status[index]" value="1" :id="'session_leave'+index" type="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label :for="'session_leave'+index" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Leave') }}</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr>
                        <td colspan="20" class="text-center p-4">
                            <NothingFound asShow="div" />
                        </td>
                    </tr>
                </template>
            </template>
        </global-table>
        <global-button v-if="students && students.length" :loading="loading" type="button" cssClass="mt-3 w-full" theme="primary" @click="promoteStudent">
            {{ __('Promote') }}
        </global-button>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import NothingFound from "@/Shared/NothingFound.vue";
    import Multiselect from '@vueform/multiselect'
    import '@vueform/multiselect/themes/default.css';

    export default {
        components: {
            AppLayout,
            NothingFound,
            Multiselect,
        },
        props: {
            errors: Object,
            classes: Object,
        },
        data() {
            return {
                loading: false,
                old_data: {
                    id: null,
                    course: null,
                },
                form: {
                    from_course:'',
                    to_course:'',
                    is_passed:[],
                    next_course_status:[],
                },

                from_courses: this.classes,
                to_courses: [],
                students: [],
                promote_data: [],
            };
        },
        watch: {
            'form.from_course': {
                deep: true,
                async handler(val) {
                    this.to_courses = []
                    this.form.to_course = null;
                    this.to_courses = this.classes.filter((item) => {
                        return item.id != val;
                    });

                    if (this.form.to_course && val == this.form.to_course) {
                        this.form.to_course = null;
                        alert("You can't promote to same course");
                    }

                    if (val) {
                        let response = await axios.get(route('fetch.students', val))
                        this.students = response.data
                    }
                },
            },
            'form.to_course': {
                deep: true,
                handler(val) {
                    if (this.form.from_course && val == this.form.from_course) {
                        this.form.to_course = null;
                        alert("You can't promote to same course");
                    }
                },
            },
        },
        methods: {
            promoteStudent() {
                if (!this.form.from_course) {
                    alert("Please select from course");
                    return;
                }
                if (!this.form.to_course) {
                    alert("Please select promote to course");
                    return;
                }

                this.loading = true;

                // format promotion data
                const data = this.students.map((student, index) => {
                    return {
                        user_id: student.user_id,
                        is_passed: this.form.is_passed[index] ? 1:0,
                        next_course_status: this.form.next_course_status[index] ? 1:0,
                        from_course_id: this.form.from_course,
                        to_course_id: this.form.to_course,
                    };
                });

                this.$inertia.post(this.route("student.promotion.update"),{data: data},{
                        preserveScroll: true,
                        onSuccess: (page) => {
                           this.loading = false;

                           setTimeout(() => {
                                window.location.reload();
                           }, 1000);
                        },
                    }
                );
            },
        },
    };
</script>

<style lang="scss" scoped></style>
