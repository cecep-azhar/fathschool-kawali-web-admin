<template>
    <AppLayout :title="__('User Edit')">

    <Breadcrumb>
        <BreadcrumbLink :href="route('users.index')" title="Users"/>
        <BreadcrumbLink :title=" __('User Edit')"/>
    </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('User Edit') }}
                <template #content>
                    <global-button preserve-scroll type="link" :url="route('users.index')" theme="primary">
                       {{ __('All User') }}
                    </global-button>
                </template>
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
                            <div class="mb-1">
                                <global-label for="role" value="Select User Type" :required="false" />
                                <a-select disabled :class="$page.props.errors.user_type ? 'border-custom ' : ''"
                                    size="large" class="width-100" v-model:value="form.user_type" show-search
                                    :placeholder="__('Select a sections')" :options="options" :filter-option="filterOption"
                                    @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                                </a-select>
                                <input-error :error="$page.props.errors.user_type" />
                            </div>
                        </div>
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="dropzone-file" value="Avatar" :required="false" />
                                <div class="w-full grid items-center gap-2"
                                    :class="image_preview ? 'grid-cols-2' : 'grid-cols-1'">
                                    <img v-if="image_preview" class="w-48 h-48 rounded-full" :src="image_preview"
                                        alt="">
                                    <div @click="browse"
                                        class="w-full cursor-pointer h-48 border-2 border-gray-300 bg-white opacity-80 flex flex-col dark:bg-gray-800 dark:border-gray-600 justify-center items-center pt-5 pb-6">
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">
                                                {{ __('Click to upload') }}
                                            </span>
                                            {{ __('or drag and drop') }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            SVG, PNG, JPG or GIF
                                        </p>
                                    </div>
                                    <input name="image" type="file" class="hidden" ref="picker" @change="change" />
                                </div>
                                <input-error :error="$page.props.errors.avatar" />
                            </div>
                        </div>
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="password" value="Password" :required="false" />
                                <global-input type="password" v-model="form.password" id="password"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Password')" :error="$page.props.errors.password" />
                                <input-error :error="$page.props.errors.password" />
                            </div>
                            <div class="mb-1">
                                <global-label for="password_confirmation" value="Confirm Password" :required="false" />
                                <global-input type="password" v-model="form.password_confirmation"
                                    id="password_confirmation" name="password_confirmation"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Confirm Password')" :error="$page.props.errors.password_confirmation" />
                                <input-error :error="$page.props.errors.password_confirmation" />
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
                                <textarea v-model="form.address" name="" :placeholder="__('Address')" id="address" :class="
                                    errors.address
                                        ? 'border-red-500 dark:border-red-500'
                                        : ''
                                "
                                    class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                <input-error :error="$page.props.errors.address" />
                            </div>
                        </div>
                        <teacher-component v-if="user_type == 'Teacher'" :user="user" :departments="departments" @child-form="getChildData" />
                        <student @student-form="getStudentData" v-if="user_type == 'Student'" :departments="departments"
                            :user="user" :classes="classes" :parents="parents" :plans="plans" />
                    </div>
                    <global-button :loading="loading" type="submit" cssClass="w-full mt-3" theme="primary">
                        {{ __('Save') }}
                    </global-button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import TeacherComponent from '@/Shared/Admin/User/Teacher.vue';
import Student from '@/Shared/Admin/User/Student.vue';

export default {
    components: {
        AppLayout,
        TeacherComponent,
        Student,
    },
    props: {
        errors: Object,
        roles: Object,
        departments: Object,
        parents: Object,
        classes: Object,
        user: Object,
        plans: Object
    },
    data() {
        return {
            loading: false,
            image_preview: this.user.profile_photo_url,
            user_type: this.user.role,
            options: [],
            form: {
                name: this.user.name,
                email: this.user.email,
                password: "",
                password_confirmation: "",
                user_type: this.user.role,
                avatar: "",
                phone: this.user.phone,
                address: this.user.address,
                department: this.user.department_id, // teacher
                roll_no: this.user.profile ? this.user.profile.roll_no : '', // student
                class: this.user.profile ? this.user.profile.course_id : '',
                parent: this.user.profile ? this.user.profile.parent_id : '',
                session: this.user.profile ? this.user.profile.session : '',
                plan: this.user.profile ? this.user.profile.plan_id : '',
                _method: 'PUT',
                teacher_edit: false
            },
        };
    },
    mounted() {
        if (window.location.search.substring(1)) {
            this.form.teacher_edit = true;
        }
    },
    watch: {
        form: {
            deep: true,
            handler(val, oldVal) {
                this.roleGet(val.user_type);
            },
        },
    },
    created() {
        for (const [key, value] of Object.entries(this.roles)) {
            this.options.push({
                value: value.name,
                label: value.name,
            });
        }
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(this.route("users.update", this.user.id), this.form, {
                preserveScroll: true,
                onFinish: visit => { this.loading = false },
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
        roleGet(e) {
            this.user_type = e;
        },
        getChildData(form) {
            this.form.department = form.department;
        },
        getStudentData(form) {
            this.form.department = form.department;
            this.form.roll_no = form.roll_no;
            this.form.class = form.class;
            this.form.parent = form.parent;
            this.form.session = form.session;
            this.form.plan = form.plan;
        }
    },
};
</script>
<style scoped>
.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}
</style>
