<template>
    <div class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
        <div class="mb-3">
            <global-label for="roll" :value="__('Roll No')" :required="false" />
            <global-input @keyup="studentDataPush" type="text" v-model="form.roll_no" id="roll" name="roll"
                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                :placeholder="__('Enter Roll Number')" :error="$page.props.errors.roll_no" />
            <input-error :error="$page.props.errors.roll_no" />
        </div>
        <div class="mb-3">
            <global-label for="session" :value="__('Session')" :required="false" />
            <global-input @keyup="studentDataPush" type="text" v-model="form.session" id="session" name="session"
                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                placeholder="2021-2022" :error="$page.props.errors.session" />
            <input-error :error="$page.props.errors.session" />
        </div>
        <div class="mb-1">
            <global-label for="class" :value="__('Select Course')" :required="true" />
            <a-select :class="$page.props.errors.class ? 'border-custom ' : ''" size="large"
                class="width-100" v-model:value="form.class" show-search :placeholder="__('Select Course')" :options="options"
                :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur" @change="studentDataPush">
            </a-select>
            <input-error :error="$page.props.errors.class" />
        </div>
    </div>
    <div class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
        <div class="mb-3">
            <global-label for="department" :value="__('Select Department')" :required="true" />
            <a-select :class="$page.props.errors.department ? 'border-custom ' : ''" size="large"
                class="width-100" v-model:value="form.department" show-search :placeholder="__('Select Department')" :options="options2"
                :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur" @change="studentDataPush">
            </a-select>
            <input-error :error="$page.props.errors.department" />
        </div>
        <div class="mb-3">
            <global-label for="plan" :value="__('Select Plan')" :required="true" />
            <a-select :class="$page.props.errors.plan ? 'border-custom ' : ''" size="large" class="width-100"
                v-model:value="form.plan" show-search :placeholder="__('Select Plan')"
                :options="plans.map(item => ({ value: item.id, label: item.title }))" :filter-option="filterOption"
                @focus="handleFocus" @blur="handleBlur" @change="studentDataPush">
            </a-select>
            <input-error :error="$page.props.errors.plan" />
        </div>
        <div class="mb-1">
            <global-label for="parent" :value="__('Select Parent')" :required="true" />
            <a-select :class="$page.props.errors.parent ? 'border-custom ' : ''" size="large"
                class="width-100" v-model:value="form.parent" show-search :placeholder="__('Select Parent')" :options="options3"
                :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur" @change="studentDataPush">
            </a-select>
            <div class="w-full flex">
                <button @click="visible = true" type="button"
                    class="focus:outline-none text-blue-500 hover:text-blue-400 ml-auto">
                    {{ __('Add New Parent') }}
                </button>
            </div>
            <input-error :error="$page.props.errors.parent" />
        </div>
    </div>
    <a-modal v-model:visible="visible" :title="__('Add Parent')" @ok="hide">
        <template #footer>
            <a-button key="back" @click="hide">{{ __('Close') }}</a-button>
        </template>
        <div class="dark:bg-gray-800 rounded-lg dark:text-gray-400">
            <div class="rounded-lg">
                <form  @submit.prevent="submit()">
                    <div
                        class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                        <div class="mb-3">
                            <global-label for="name" :value="__('Name')" :required="true" />
                            <global-input type="text" v-model="createParent.name" id="name" name="name"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Name')" :error="errors && errors.name ? errors.name[0] : ''" />
                            <input-error :error="errors && errors.name ? errors.name[0] : ''" />
                        </div>
                        <div class="mb-3">
                            <global-label for="email" :value="__('Email')" :required="true" />
                            <global-input type="email" v-model="createParent.email" id="email" name="email"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Email')" :error="errors && errors.email ? errors.email[0] : ''" />
                            <input-error :error="errors && errors.email ? errors.email[0] : ''" />
                        </div>
                        <div class="mb-3">
                            <global-label for="password" :value="__('Password')" :required="true" />
                            <global-input type="password" v-model="createParent.password" id="password"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Password')" :error="errors && errors.password ? errors.password[0] : ''" />
                            <input-error :error="errors && errors.password ? errors.password[0] : ''" />
                        </div>
                    </div>
                    <global-button :loading="createParent.processing" type="submit" cssClass="w-full mt-3"
                        theme="primary">
                        {{ __('Add') }}
                    </global-button>
                </form>
            </div>
        </div>
    </a-modal>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import axios from 'axios';
export default {
    props: {
        departments: Object,
        classes: Object,
        parents: Object,
        user: Object,
        plans: Object
    },
    inheritAttrs: false,
    data() {
        return {
            visible: false,
            options: [],
            options2: [],
            options3: [],
            form: {
                department: this.user ? this.user.department_id : '',
                roll_no: this.user ? this.user.profile.roll_no : '',
                class: this.user ? this.user.profile.course_id : '',
                parent: this.user ? this.user.profile.parent_id : '',
                session: this.user ? this.user.profile.session : '',
                plan: this.user ? this.user.profile.plan_id : '',
            },
            createParent: useForm({
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                user_type: "Parent",
            }),
            errors: null
        }
    },
    created() {
        // for class
        for (const [key, value] of Object.entries(this.classes)) {
            this.options.push({
                value: value.id,
                label: value.name,
            });
        }
        if (!this.user) {
            this.form.class = null;
        }
        // for department
        for (const [key, value] of Object.entries(this.departments)) {
            this.options2.push({
                value: value.id,
                label: value.name,
            });
        }
        if (!this.user) {
            this.form.department = null;
        }
        // for parent
        for (const [key, value] of Object.entries(this.parents)) {
            this.options3.push({
                value: value.id,
                label: value.name,
            });
        }
        if (!this.user) {
            this.form.parent = null;
        }
    },
    methods: {
        studentDataPush(e) {
            this.$emit('student-form', this.form);
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },
        hide() {
            this.visible = false;
        },
        submit() {
            axios.post(this.route("parent.store"), this.createParent)
                .then((res) => {
                    this.createParent.name = "";
                    this.createParent.email = "";
                    this.createParent.password = "";
                    this.createParent.password_confirmation = "";
                    this.$toast.open({
                        message: "Parent Added Successful .",
                        type: "success",
                    });
                    this.fetchParent();
                    this.hide();
                })
                .catch((e) => {
                    this.errors = e.response.data.errors;
                    setTimeout(() => {
                        this.errors = null
                    }, 5000);
                })
        },
        fetchParent() {
            axios.post(this.route("admin.parent.index"))
                .then((res) => {
                    if (res.data.data) {
                        // for parent
                        for (const [key, value] of Object.entries(res.data.data)) {
                            this.options3.push({
                                value: value.id,
                                label: value.name,
                            });
                        }
                    }
                })
                .catch((e) => {
                    this.$toast.open({
                        message: "Parent Fetch Failed .",
                        type: "Error",
                    });
                })
        }
    }
}
</script>

<style>

</style>
