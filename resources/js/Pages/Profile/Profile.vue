<template>
    <AppLayout :title="__('Profile')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Profile')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __('Profile') }}
                </div>
            </page-header>
            <div class="overflow-x-auto sm:rounded-lg">
                <form class="mt-2" @submit.prevent="submit()" enctype="multipart/form-data">
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="name" value="Name" :required="false" />
                                <global-input type="text" v-model="form.name" id="name" name="name"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter Name')" :error="$page.props.errors.name" />
                                <input-error :error="$page.props.errors.name" />
                            </div>
                            <div class="mb-3">
                                <global-label for="email" value="Email" :required="false" />
                                <global-input type="email" v-model="form.email" id="email" name="email"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter Email')" :error="$page.props.errors.email" />
                                <input-error :error="$page.props.errors.email" />
                            </div>
                        </div>
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <div class="mb-1 w-full">
                                    <global-label for="dropzone-file" value="Avatar" :required="false" />
                                    <a-upload accept="image/*" :max-count="1" v-model:file-list="avatar_value" action=""
                                        list-type="picture">
                                        <a-button>
                                            <upload-outlined></upload-outlined>
                                            {{ __('Select Avatar') }}
                                        </a-button>
                                    </a-upload>
                                    <div v-if="image_preview && !form.avatar" class="mt-2">
                                        <img class="w-12 h-12" :src="image_preview" alt="">
                                    </div>
                                    <input-error :error="$page.props.errors.avatar" />
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="phone" value="Phone" :required="false" />
                                <global-input type="number" v-model="form.phone" id="phone"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Phone')" :error="$page.props.errors.phone" />
                                <input-error :error="$page.props.errors.phone" />
                            </div>
                            <div class="mb-1">
                                <global-label for="address" value="Address" :required="false" />
                                <textarea v-model="form.address" name="" :placeholder="__('Address')" id="address" :class="errors.address
                                    ? 'border-red-500 dark:border-red-500'
                                    : ''
                                "
                                    class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                <input-error :error="$page.props.errors.address" />
                            </div>
                        </div>
                        <teacher-component v-if="user.role == 'Teacher'" :user="user" :departments="departments"
                            @child-form="getChildData" />
                        <student @student-form="getStudentData" v-if="user.role == 'Student'" :departments="departments"
                            :user="user" :classes="classes" :parents="[]" />
                        <div>
                            <div
                                class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">

                                <div class="mb-3">
                                    <div class="flex justify-between">
                                        <global-label for="password" value="Password" :required="false" />
                                        <div class="inline-flex">
                                            <div class="flex items-center h-5">
                                                <input v-model="form.password_update" id="password_update"
                                                    aria-describedby="helper-checkbox-text" type="checkbox" value=""
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <global-label for="password_update" value="Password Update"
                                                    :required="false" />
                                            </div>
                                        </div>
                                    </div>
                                    <template v-if="form.password_update">
                                        <global-input type="password" v-model="form.password" id="password"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Password')" :error="$page.props.errors.password" />
                                        <input-error :error="$page.props.errors.password" />
                                    </template>
                                </div>
                                <template v-if="form.password_update">
                                    <div class="mb-3">
                                        <global-label for="password_confirmation" value="Confirm Password"
                                            :required="false" />
                                        <global-input type="password" v-model="form.password_confirmation"
                                            id="password_confirmation"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Confirm Password')"
                                            :error="$page.props.errors.password_confirmation" />
                                        <input-error :error="$page.props.errors.password_confirmation" />
                                    </div>
                                    <div class="mb-1">
                                        <global-label for="current_password" value="Current Password" :required="false" />
                                        <global-input type="password" v-model="form.current_password" id="current_password"
                                            name="current_password"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Current Password')"
                                            :error="$page.props.errors.current_password" />

                                        <input-error :error="$page.props.errors.current_password" />
                                    </div>
                                </template>
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
import TeacherComponent from './Teacher.vue';
import Student from './Student.vue';
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AppLayout,
        TeacherComponent,
        Student,
    },
    props: {
        errors: Object,
        departments: Object,
        classes: Object,
        user: Object
    },
    data() {
        return {
            image_preview: this.user.profile_photo_url,
            avatar_value: null,
            form: useForm({
                name: this.user.name,
                email: this.user.email,
                password: "",
                password_update: false,
                password_confirmation: "",
                current_password: "",
                avatar: "",
                phone: this.user.phone,
                address: this.user.address,
                department: this.user.department_id, // teacher
                roll_no: this.user.profile ? this.user.profile.roll_no : '', // student
                class: this.user.profile ? this.user.profile.course_id : '',
                session: this.user.profile ? this.user.profile.session : '',
                blood_group: this.user.profile ? this.user.profile.blood_group : '',
                physical_disability: this.user.profile ? this.user.profile.physical_disability : '',
                religion: this.user.profile ? this.user.profile.religion : '',
                previous_school_name: this.user.profile ? this.user.profile.previous_school_name : '',
                previous_school_year_of_exist: this.user.profile ? this.user.profile.previous_school_year_of_exist : '',
                _method: 'PUT'
            }),
        };
    },
    watch: {
        avatar_value: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal.length > 0) {
                    this.form.avatar = newVal[0].originFileObj;
                } else {
                    this.form.avatar = null;
                }
            },
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("profile.update", this.user.id), {
                preserveScroll: true
            });
        },
        browse() {
            this.$refs.picker.click();
        },
        change(e) {
            this.form.avatar = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.form.avatar);

            reader.onload = (e) => {
                this.image_preview = e.target.result;
            };
        },
        getChildData(form) {
            this.form.department = form.department;
        },
        getStudentData(form) {
            this.form.department = form.department;
            this.form.roll_no = form.roll_no;
            this.form.class = form.class;
            this.form.session = form.session;
            this.form.blood_group = form.blood_group;
            this.form.physical_disability = form.physical_disability;
            this.form.religion = form.religion;
            this.form.previous_school_name = form.previous_school_name;
            this.form.previous_school_year_of_exist = form.previous_school_year_of_exist;
        },
    },
};
</script>
<style>
.ant-tooltip-content {
    display: none !important;
}

.ant-tooltip .ant-tooltip-placement-top {
    display: none !important;
}

.ant-upload-list-picture .ant-upload-list-item-error,
.ant-upload-list-picture-card .ant-upload-list-item-error {
    border-color: green;
}

.ant-upload-list-item-error,
.ant-upload-list-item-error .ant-upload-text-icon>.anticon,
.ant-upload-list-item-error .ant-upload-list-item-name {
    color: green;
}
</style>
