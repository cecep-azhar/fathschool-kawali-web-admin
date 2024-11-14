<template>
    <AppLayout :title="__('Administration Create')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Administration Create')" />
        </Breadcrumb>

        <div class="mx-auto pb-12">
            <div
                class="rounded-lg flex justify-between items-center mb-4 py-4 px-6 text-lg font-semibold rtl:text-right text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                <div class="dark:text-gray-400">
                    {{ __('administration Create') }}
                </div>
                <Link preserve-scroll :href="route('administrations.index')">
                <global-button :loading="false" type="button" theme="primary">
                    {{ __('All administrations') }}
                </global-button>
                </Link>
            </div>

            <!-- component -->
            <div class="w-full lg:w-1/2 mx-auto">
                <div class="flex items-center">
                    <div :class="wizard > 1 ? 'text-blue-600 ' : 'text-gray-500'" class="flex items-center relative">
                        <div :class="wizard > 1 ? 'border-blue-600' : 'border-white'"
                            class="rounded-full transition duration-500 ease-in-out h-11 w-11 py-2.5 border-2 ">
                            <CheckCircleIcon v-if="wizard > 1" width="100%" height="100%" class="w-full h-full" />
                            <CircleStackIcon v-else width="100%" height="100%" class="w-full h-full" />
                            <div
                                class="absolute whitespace-nowrap -top-3 -ml-0.5 w-full text-center mt-16 text-xs font-bold">
                                {{ __('Basic Information') }}
                            </div>
                        </div>
                    </div>
                    <div :class="wizard > 1 ? 'border-blue-600' : 'border-white'"
                        class="flex-auto border-t-4 transition duration-500 ease-in-out"></div>
                    <div :class="wizard > 2 ? 'text-blue-600 ' : 'text-gray-500'" class="flex items-center relative">
                        <div :class="wizard > 2 ? 'border-blue-600' : 'border-white'"
                            class="rounded-full transition duration-500 ease-in-out h-11 w-11 py-2.5 border-2">
                            <CheckCircleIcon v-if="wizard > 2" width="100%" height="100%" class="w-full h-full" />
                            <AcademicCapIcon v-else width="100%" height="100%" class="w-full h-full" />
                            <div class="absolute whitespace-nowrap -top-3 -ml-8 w-full text-center mt-16 text-xs font-bold">
                                {{ __('Academic Information') }}
                            </div>
                        </div>
                    </div>
                    <div :class="wizard > 2 ? 'border-blue-600' : 'border-white'"
                        class="flex-auto border-t-4 transition duration-500 ease-in-out"></div>
                    <div :class="wizard > 2 ? 'text-blue-600 ' : 'text-gray-500'" class="flex items-center relative">
                        <div :class="wizard > 2 ? 'border-blue-600' : 'border-white'"
                            class="rounded-full transition duration-500 ease-in-out h-11 w-11 py-2.5 border-2">
                            <BookOpenIcon width="100%" height="100%" class="w-full h-full" />
                            <div
                                class="absolute whitespace-nowrap -ml-10 -top-3 w-full text-center mt-16 text-xs font-bold">
                                {{ __('Course & Subject') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 mx-auto rounded-lg mt-12">
                <form class="mt-2" @submit.prevent="submit()" enctype="multipart/form-data">
                    <div class="grid sm:grid-cols-1 md:grid-cols-1 sm:gap-1 md:gap-4">
                        <!-- Step 1 content -->
                        <template v-if="wizard == 1">
                            <div
                                class="w-full bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
                                    <div class="mb-3">
                                        <global-label for="name" value="Name" :required="true" />
                                        <global-input type="text" v-model="form.name" id="name" name="name"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Name')" :error="validate_errors.name" />
                                        <input-error :error="validate_errors.name" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="email" value="Email" :required="true" />
                                        <global-input type="email" v-model="form.email" id="email" name="email"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Email')" :error="validate_errors.email" />
                                        <input-error :error="validate_errors.email" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
                                    <div class="mb-3">
                                        <global-label for="email" value="Date of Birth" :required="true" />
                                        <a-date-picker :format="getDateTimeFormat()" class="ant-datepicker-custom" v-model:value="date_of_birth_value" />
                                        <input-error :error="validate_errors.date_of_birth" />
                                    </div>
                                    <div class="mb-1">
                                        <global-label for="phone" value="Phone" :required="false" />
                                        <global-input type="number" v-model="form.phone" id="phone"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Phone')" :error="validate_errors.phone" />
                                        <input-error :error="validate_errors.phone" />
                                    </div>
                                </div>
                            </div>
                            <div
                                class="w-full bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">
                                <div class="mb-3">
                                    <global-label for="gender" value="Gender" :required="false" />
                                    <global-input type="text" v-model="form.gender" id="gender"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Gender')" :error="validate_errors.gender" />
                                    <input-error :error="validate_errors.gender" />
                                </div>
                                <div class="mb-1">
                                    <global-label for="address" value="Present Address" :required="false" />
                                    <global-textarea v-model="form.address" id="address"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Present Address')" :error="validate_errors.address" />
                                    <input-error :error="validate_errors.address" />
                                </div>
                            </div>
                        </template>
                        <!-- Step 1 content end  -->
                        <!-- Step 2 content -->
                        <template v-if="wizard == 2">
                            <div
                                class="w-full bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">
                                <div class="mb-3">
                                    <global-label for="highest_degree_name" value="Highest Degree Name" :required="true" />
                                    <global-input type="text" v-model="form.highest_degree_name" id="highest_degree_name"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Highest Degree Name')"
                                        :error="validate_errors.highest_degree_name" />
                                    <input-error :error="validate_errors.highest_degree_name" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="institute_name" value="Institute Name" :required="true" />
                                    <global-input type="text" v-model="form.institute_name" id="institute_name"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Institute Name')" :error="validate_errors.institute_name" />
                                    <input-error :error="validate_errors.institute_name" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="passing_year" value="Passing Year" :required="true" />
                                    <a-date-picker @change="getPassingYear" placeholder="Passing Year"
                                        class="ant-datepicker-custom"
                                        :format="getDateTimeFormat()" v-model:value="passing_year_value" picker="year" />
                                    <input-error :error="validate_errors.passing_year" />
                                </div>

                            </div>

                            <div
                                class="w-full bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">
                                <div class="mb-3">
                                    <global-label for="department" value="Department" :required="false" />
                                    <Multiselect id="department" v-model="form.department" :close-on-select="true"
                                        :can-clear="false" :searchable="true" :create-option="false"
                                        :placeholder="__('Select Department')" :options="departments.map(item => ({
                                            value: item.id,
                                            label: item.name,
                                        }))" autocomplete="off" />
                                    <input-error :error="validate_errors.department" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="religion" value="Religion" :required="false" />
                                    <global-input type="text" v-model="form.religion" id="religion"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="Religion" :error="validate_errors.religion" />
                                    <input-error :error="validate_errors.religion" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="nationality" value="Nationality" :required="false" />
                                    <Multiselect id="nationality" :close-on-select="true" :can-clear="false"
                                        :searchable="true" v-model="form.nationality" :create-option="false"
                                        :placeholder="__('Select Nationality')" :options="nationalities.map(item => ({
                                            label: item,
                                            value: item,
                                        }))" autocomplete="off" />
                                    <input-error :error="validate_errors.nationality" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="document" value="Document" :required="false" />
                                    <div v-for="(item, index) in document_size" :key="index"
                                        class="flex items-center gap-1 mb-2">
                                        <div class="w-full">
                                            <global-input type="text" v-model="form.document_titles[index]"
                                                :id="'title' + index"
                                                class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                placeholder="Document Title" :error="validate_errors.note" />
                                        </div>
                                        <div class="w-full">
                                            <input type="file" @change="picDocs"
                                                :class="validate_errors.document ? 'border-red-500 dark:border-red-500' : ''"
                                                :id="'document' + index" name="document" accept="image/*, pdf/*, doc/*"
                                                class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="" />
                                        </div>
                                        <div @click="addDocument(index)">
                                            <global-button :loading="loading" type="button" cssClass="font-bold"
                                                :theme="index == 0 ? 'primary' : 'danger'">
                                                <PlusCircleIcon v-if="index == 0" class="w-6 h-6" />
                                                <MinusCircleIcon v-else class="w-6 h-6" />
                                            </global-button>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-3 p-1" v-if="administration && administration.documents.length > 0">
                                        <div class="relative mt-2" v-for="(doc, index) in administration.documents" :key="doc.id">
                                            <a :href="doc.file_url_format" download>
                                                {{ __('Download Document') }} ({{ index + 1 }})
                                            </a>
                                            <button @click="removeDoc(doc.id)" type="button"
                                                class="absolute -top-4 bg-red-500 rounded-full -right-3">
                                                <trash-icon class="w-6 h-6 text-white p-0.5" />
                                            </button>
                                        </div>
                                    </div>
                                    <input-error :error="validate_errors.documents" />
                                </div>
                            </div>
                        </template>
                        <!-- Step 2 content end -->
                    </div>
                    <!-- Step 3 content end -->
                    <template v-if="wizard == 3">
                        <template v-if="$page.props.errors">
                            <div v-for="(error, index) in $page.props.errors" :key="index"
                                class="md:w-1/2 mx-auto p-4 mb-1 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <div class="ml-4">
                                    {{ error }}
                                </div>
                            </div>
                            <div class="mt-2"></div>
                        </template>
                        <div v-if="courses.length > 0"
                            class="w-full bg-white rounded-lg border border-white p-6 dark:bg-gray-800 dark:border-gray-700">
                            <global-label for="course" value="Select Subject" :required="true" />
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div v-for="course in courses" :key="course.id"
                                    class="bg-white dark:bg-gray-800 border dark:border-gray-500 p-4 rounded">
                                    <div class="font-bold capitalize text-base dark:text-gray-400">
                                        {{ course.name }}
                                    </div>
                                    <div class="grid grid-cols-2 gap-1">
                                        <label :for="'sub' + sub.slug" v-for="(sub, index) in course.subjects" :key="index"
                                            class="flex items-center pl-4 mt-1 border border-white rounded dark:border-gray-700">
                                            <input v-model="form.subjects" :id="'sub' + sub.slug" type="checkbox"
                                                :value="sub.id" name="sub"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label :for="'sub' + sub.slug"
                                                class="w-full py-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ sub.name }}
                                            </label>
                                        </label>
                                    </div>
                                </div>
                                <input-error :error="validate_errors.subjects" />
                            </div>
                        </div>
                        <div v-else class="p-4 text-center">
                            <NothingFound asShow="div" />
                        </div>
                    </template>
                    <div class="flex justify-end gap-2">
                        <button @click="wizardChange('prev')" v-if="wizard > 1"
                            class="text-pink-500 border border-pink-500 hover:bg-pink-500 hover:text-white active:bg-pink-600 font-bold w-1/4 mt-3 py-2 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                            type="button">
                            {{ __('Back') }}
                        </button>
                        <global-button @click="wizardChange('next')" v-if="wizard < 3" :loading="false" type="button"
                            cssClass="w-1/4 mt-3 py-1 font-bold" theme="primary">
                            {{ __('Next') }}
                        </global-button>
                        <global-button v-if="wizard == 3" :loading="form.processing" type="submit"
                            cssClass="w-1/4 mt-3 font-bold" theme="primary">
                            {{ __('Save') }}
                        </global-button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import { useForm } from "@inertiajs/inertia-vue3";
import dayjs from "dayjs";
import NothingFound from "@/Shared/NothingFound.vue";
import { PlusCircleIcon, MinusCircleIcon, CircleStackIcon, BookOpenIcon, TrashIcon, CheckCircleIcon, AcademicCapIcon, StopCircleIcon } from "@heroicons/vue/24/outline";

export default {
    components: {
        AppLayout,
        Multiselect,
        PlusCircleIcon,
        MinusCircleIcon,
        CheckCircleIcon,
        TrashIcon,
        AcademicCapIcon,
        CircleStackIcon,
        BookOpenIcon,
        NothingFound
    },
    props: {
        courses: Object,
        nationalities: Array,
        administration: Object,
        subjects: Array,
        departments: Object,
    },
    data() {
        return {
            wizard: 1,
            date_of_birth_value: this.administration ? this.administration.date_of_birth ? dayjs(this.administration.date_of_birth) : null : null,
            passing_year_value: this.administration ? this.administration.profile ? dayjs(this.administration.profile.passing_year) : null : null,
            validate_errors: {},
            document_size: [1],
            form: useForm({
                name: this.administration ? this.administration.name : "",
                email: this.administration ? this.administration.email : "",
                user_type: "Administration",
                phone: this.administration ? this.administration.phone : "",
                address: this.administration ? this.administration.address : "",
                gender: this.administration ? this.administration.gender : "",
                department: this.administration ? this.administration.department_id : "",
                date_of_birth: this.administration
                    ? this.administration.date_of_birth
                    : "",
                documents: [],
                document_titles: [],

                highest_degree_name: this.administration
                    ? this.administration.profile ? this.administration.profile.highest_degree_name : null
                    : null,
                institute_name: this.administration
                    ? this.administration.profile ? this.administration.profile.institute_name : null
                    : null,
                passing_year: this.administration
                    ? this.administration.profile ? this.administration.profile.passing_year : null
                    : null,
                religion: this.administration
                    ? this.administration.profile ? this.administration.profile.religion : null
                    : null,
                nationality: this.administration
                    ? this.administration.profile ? this.administration.profile.nationality : null
                    : null,
                subjects: this.subjects ? this.subjects : [],
                _method: this.administration ? "PUT" : "POST",
            }),
        };
    },
    watch: {
        date_of_birth_value: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal) {
                    this.form.date_of_birth =
                        dayjs(newVal).format("YYYY-MM-DD");
                } else {
                    this.form.date_of_birth = null;
                }
            },
        },
        passing_year_value: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal) {
                    this.form.passing_year =
                        dayjs(newVal).format("YYYY");
                } else {
                    this.form.passing_year = null;
                }
            },
        },
        wizard: {
            deep: true,
            handler(newVal, oldVal) {
                this.validate_errors = {};
            },
        },
    },
    methods: {
        removeDoc(id) {
            if (confirm('Are your sure ??')) {
                this.$inertia.post(
                    this.route("admin.doc.destroy", id),
                    {
                        preserveScroll: true,
                    }
                );
            }
        },
        picDocs(e) {
            this.form.documents.push(e.target.files[0]);
        },
        submit() {
            if (this.date_of_birth_value) {
                this.form.date_of_birth = dayjs(
                    this.date_of_birth_value
                ).format("DD-MM-YYYY");
            } else {
                this.form.date_of_birth = null;
            }

            if (this.administration) {
                this.form.post(
                    this.route("users.update", this.administration.id),
                    {
                        preserveScroll: true,
                    }
                );
            } else {
                this.form.post(this.route("users.store"), {
                    preserveScroll: true,
                    onSuccess: () => { },
                });
            }
        },
        wizardChange(arg) {
            if (arg == "next") {
                let validate = this.validationPart(this.wizard);
                if (!validate) {
                    this.validate_errors = {};
                    this.wizard = this.wizard + 1;
                }
            } else {
                this.wizard = this.wizard - 1;
            }
        },
        isValidEmail(email) {
            return /^[^@]+@\w+(\.\w+)+\w$/.test(email);
        },
        addDocument(index) {
            if (index == 0) {
                this.document_size.push(1);
            } else {
                this.document_size.splice(index, 1);
                this.form.document_titles.splice(index, 1);
                this.form.documents.splice(index, 1);
            }
        },
        validationPart(wizard) {
            let hasError = false;
            if (wizard == 1) {
                if (!this.form.name) {
                    Object.assign(this.validate_errors, {
                        name: "The name field is required",
                    });
                    hasError = true;
                }
                if (!this.form.email) {
                    Object.assign(this.validate_errors, {
                        email: "The email field is required",
                    });
                    hasError = true;
                }
                if (!this.isValidEmail(this.form.email)) {
                    Object.assign(this.validate_errors, {
                        email: "The email is invalid .",
                    });
                    hasError = true;
                }
                if (!this.form.date_of_birth) {
                    Object.assign(this.validate_errors, {
                        date_of_birth: "The date of birth field is required .",
                    });
                    hasError = true;
                }
            } else if (wizard == 2) {
                if (!this.form.highest_degree_name) {
                    Object.assign(this.validate_errors, {
                        highest_degree_name: "The highest degree name field is required .",
                    });
                    hasError = true;
                }
                if (!this.form.institute_name) {
                    Object.assign(this.validate_errors, {
                        institute_name: "The institute name field is required .",
                    });
                    hasError = true;
                }
                if (!this.form.passing_year) {
                    Object.assign(this.validate_errors, {
                        passing_year: "The passing year field is required .",
                    });
                    hasError = true;
                }
            } else {
                if (!this.selected_courses) {
                    Object.assign(this.validate_errors, {
                        course: "The course field is required .",
                    });
                    hasError = true;
                }
                if (!this.form.subjects) {
                    Object.assign(this.validate_errors, {
                        subjects: "The subjects field is required .",
                    });
                    hasError = true;
                }
            }
            return hasError;
        },
    },
};
</script>
<style>
.ant-upload-list-item-error,
.ant-upload-list-item-error .ant-upload-text-icon>.anticon,
.ant-upload-list-item-error .ant-upload-list-item-name {
    color: blue !important;
}

.ant-tooltip-placement-top,
.ant-tooltip-placement-topLeft,
.ant-tooltip-placement-topRight {
    padding-bottom: 25px;
    display: none !important;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}

.ant-datepicker-custom {
    display: block;
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.ant-datepicker-custom-border {
    border-color: red;
    border-right-width: 1px !important;
}

.ant-upload-list {
    width: 100%;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    color: rgba(0, 0, 0, 0.85);
    font-size: 14px;
    font-variant: tabular-nums;
    list-style: none;
    line-height: 1.5715;
}
</style>
