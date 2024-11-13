<template>

    <Head :title="__('Administration Class List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Administration Subject List')" />
        </Breadcrumb>

        <div class="my-6">
            <page-header >
                <div class="dark:text-gray-400">{{ __('Administration Subject') }}</div>
            </page-header>
            <div class="grid gap-6 md:grid-cols-6">
                <div class="grid gap-6 md:grid-cols-3 md:col-span-4 auto-rows-min">
                    <div class="p-6 dark:text-gray-400 bg-white dark:bg-gray-700 rounded-lg mb-2 md:col-span-3">
                        <div class="w-full">
                            <div class="my-2 flex items-center">
                                <div>
                                    <img class="w-24 h-24 object-cover rounded-lg" :src="Administration.profile_photo_url"
                                        alt="" />
                                </div>
                                <div class="ml-3">
                                    <h2 class="dark:text-gray-400 text-lg font-bold">
                                        {{ Administration.name }}
                                    </h2>
                                    <h2 class="dark:text-gray-400 text-sm text-gray-500">
                                        <span
                                            class="border-blue-100 border-2 w-full text-gray-600 px-4 text-xs font-semibold mr-2 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                            {{ Administration.role }}
                                        </span>
                                    </h2>
                                </div>
                            </div>
                            <h2 class="dark:text-gray-400" v-if="Administration.department">
                                {{ __('Department') }}: {{ Administration.department.name }}
                            </h2>
                            <h2 class="dark:text-gray-400">
                                {{ __('Phone') }}: {{ Administration.phone }}
                            </h2>
                            <h2 class="dark:text-gray-400">
                                {{ __('Address') }}: {{ Administration.address }}
                            </h2>
                        </div>
                    </div>
                    <div class="md:col-span-3 md:flex gap-2">
                        <div
                            class="w-full mt-1 md:mt-0 dark:bg-gray-800 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <div
                                class="p-4 text-gray-700 rounded font-bold bg-white dark:bg-gray-700 dark:text-gray-400">
                                {{ __('Administration Documents') }}
                            </div>
                            <global-table class="py-0 bg-white mt-1">
                                <template #head>
                                    <th class="py-5 px-6">
                                        {{ __('Title') }}
                                    </th>
                                    <th width="12%" class="py-5 px-5">
                                        {{ __('Action') }}
                                    </th>
                                </template>
                                <template #body>
                                    <template v-if="Administration.documents.length > 0">
                                        <template v-for="document in Administration.documents" :key="document.id">
                                            <tr
                                                class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="py-4 px-6">
                                                    {{ document.title }}
                                                </td>
                                                <td class="py-4 px-5">
                                                    <a :href="
                                                        document.file_url_format
                                                    " download>
                                                        {{ __('Download') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </template>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="2" class="text-center p-4">
                                                <NothingFound asShow="div" />
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </global-table>
                        </div>
                        <div
                            class="w-full mt-1 md:mt-0 dark:bg-gray-800 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <div
                                class="p-4 text-gray-700 rounded font-bold bg-white dark:bg-gray-700 dark:text-gray-400">
                                {{ __('Administration Academic Details') }}
                            </div>
                            <div class="bg-white mt-1 p-4 rounded-lg">
                                <div class="flex gap-2 items-center">
                                    <div class="font-bold text-base">
                                        {{ __('Highest Degree Name') }}:
                                    </div>
                                    <div>
                                        {{
                                        Administration.profile
                                        ? Administration.profile
                                        .highest_degree_name
                                        : ""
                                        }}
                                    </div>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <div class="font-bold text-base">
                                        {{ __('Institute Name') }}:
                                    </div>
                                    <div>
                                        {{
                                        Administration.profile
                                        ? Administration.profile.institute_name
                                        : ""
                                        }}
                                    </div>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <div class="font-bold text-base">
                                        {{ __('Passing Year') }}:
                                    </div>
                                    <div>
                                        {{
                                        Administration.profile
                                        ? Administration.profile.passing_year
                                        : ""
                                        }}
                                    </div>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <div class="font-bold text-base">
                                        {{ __('Religion') }}:
                                    </div>
                                    <div>
                                        {{
                                        Administration.profile
                                        ? Administration.profile.religion
                                        : ""
                                        }}
                                    </div>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <div class="font-bold text-base">
                                        {{ __('Nationality') }}:
                                    </div>
                                    <div class="capitalize">
                                        {{
                                        Administration.profile
                                        ? Administration.profile.nationality
                                        : ""
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <template v-if="Administration.subjects.length > 0">
                        <div class="card bg-white dark:bg-gray-700 rounded-lg dark:text-gray-400"
                            v-for="course in Administration.subjects" :key="course.id">
                            <div class="flex justify-between px-6 pt-6 pb-2.5">
                                <h2 class="text-[#000] dark:text-gray-400 m-0 font-medium">
                                    {{ course.subject.name }}
                                </h2>
                                <div class="flex gap-2">
                                    <button type="button" @click="destroy(course.id)" class="text-red-500">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                            <div class="border-t-2 dark:border-gray-600 px-6 pt-4 pb-6">
                                <h2 class="m-0 text-[#000] dark:text-gray-400 font-medium">
                                    {{ __('Course') }}:
                                    <span>
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                            {{
                                            course.subject.course
                                            ? course.subject.course.name
                                            : ""
                                            }}
                                        </span>
                                    </span>
                                </h2>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div
                            class="md:col-span-3 text-center bg-gray-50 dark:bg-gray-700 dark:text-gray-400 rounded-lg p-4">
                            <NothingFound asShow="div" />
                        </div>
                    </template>
                </div>
                <div class="md:col-span-2">
                    <div
                        class="w-full bg-white dark:bg-gray-800 rounded-lg text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <div
                            class="p-3 text-gray-700 rounded-t-lg font-bold bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <span> {{ __('Assign New Subject') }}</span>
                        </div>
                        <form @submit.prevent="submit">
                            <div class="w-full p-4 dark:bg-gray-800 dark:border-gray-700">
                                <div class="mb-2">
                                    <global-label for="role" value="Select Course" :required="true" />
                                    <Multiselect  v-model="course" :close-on-select="true" :searchable="true"
                                        :create-option="false" :placeholder="__('Select Course')" :options="
                                            courses.map((course) => ({
                                                value: course.id,
                                                label: course.name,
                                            }))
                                        " autocomplete="off" />
                                    <input-error :error="$page.props.errors.course" />
                                </div>
                                <div class="mb-2">
                                    <global-label for="role" value="Select Subject" :required="true" />
                                    <Multiselect  mode="multiple" v-model="form.subjects"
                                        :close-on-select="false" :searchable="true" :create-option="false"
                                        :placeholder="__('Select Subject')" :options="
                                            course_subjects.map((subject) => ({
                                                value: subject.id,
                                                label: subject.name,
                                            }))
                                        " autocomplete="off" />
                                    <input-error :error="$page.props.errors.subject" />
                                </div>
                            </div>
                            <global-button :loading="loading" type="submit" cssClass="ml-5 mb-6" theme="primary">
                                {{ __('Save') }}
                            </global-button>
                        </form>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import NothingFound from "@/Shared/NothingFound.vue";
    import Multiselect from "@vueform/multiselect";
    import "@vueform/multiselect/themes/default.css";

    export default {
        props: {
            Administration: Object,
            courses: Object,
        },
        components: {
            AppLayout,
            Multiselect,
            NothingFound
        },
        data() {
            return {
                loading: false,
                course_subjects: [],
                course: [],
                form: {
                    subjects: [],
                    Administration: this.Administration.id,
                    destroy: false,
                },
            };
        },
        watch: {
            course: {
                deep: true,
                handler(val, oldVal) {
                    this.getSubjects();
                },
            },
        },
        methods: {
            getSubjects() {
                let id = this.course;
                this.course_subjects = [];
                this.courses.forEach((course) => {
                    if (id == course.id) {
                        course.subjects.forEach((subject) => {
                            this.course_subjects.push(subject);
                        });
                    }
                });
            },
            submit() {
                this.loading = true;
                this.form.destroy = false;
                this.$inertia.post(
                    this.route("Administration.class.assign"),
                    this.form,
                    {
                        onSuccess: (page) => {
                            this.form.subjects = null;
                        },
                        onFinish: (visit) => {
                            this.loading = false;
                        },
                    }
                );
            },
            destroy(arg) {
                if (confirm("Are you sure ?")) {
                    this.form.destroy = true;
                    this.$inertia.post(
                        this.route("Administration.class.assign"),
                        { class: arg, destroy: true },
                        {
                            onSuccess: (page) => {
                                this.form.subjects = "";
                            },
                        }
                    );
                } else {
                    return false;
                }
            },
        },
    };
</script>
