<template>
    <AppLayout :title="__('User Create')">
        <Breadcrumb>
            <BreadcrumbLink :href="route('users.index')" title="Users"/>
            <BreadcrumbLink :title=" __('User Create')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __("Create User") }}
                <template #content>
                    <global-button :url="route('users.index')" type="link" theme="primary">
                        {{ __("All User") }}
                    </global-button>
                </template>
            </page-header>
            <div class="rounded-lg">
                <form class="mt-2" @submit.prevent="submit()" enctype="multipart/form-data">
                    <div :class="
                            form.user_type == 'Student'
                                ? 'grid sm:grid-cols-1 md:grid-cols-2'
                                : 'w-full md:w-1/2 mx-auto'
                        " class="sm:gap-1 md:gap-4">
                        <div
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="name" value="Name" :required="true" />
                                <global-input type="text" v-model="form.name" id="name" name="name"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter Name')" :error="$page.props.errors.name" />
                                <input-error :error="$page.props.errors.name" />
                            </div>
                            <div class="mb-3">
                                <global-label for="email" value="Email" :required="true" />
                                <global-input type="email" v-model="form.email" id="email" name="email"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter Email')" :error="$page.props.errors.email" />
                                <input-error :error="$page.props.errors.email" />
                            </div>
                            <div class="mb-3">
                                <global-label for="role" value="Role" :required="true" />
                                <a-select :disabled="teacher_create == 'Teacher'" :class="
                                        $page.props.errors.user_type
                                            ? 'border-custom '
                                            : ''
                                    " size="large" class="width-100" v-model:value="form.user_type"
                                    show-search :placeholder="__('Select a sections')" :options="options"
                                    :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur"
                                    @change="handleChange">
                                </a-select>
                                <input-error :error="$page.props.errors.user_type" />
                            </div>
                            <div v-if="form.user_type != 'Student'" class="mb-1">
                                <global-label for="password" value="Password" :required="false" />
                                <global-input type="password" v-model="form.password" id="password"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Password')" :error="$page.props.errors.password" />
                                <input-error :error="$page.props.errors.password" />
                            </div>
                        </div>
                        <div v-if="form.user_type == 'Student'"
                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="password" value="Password" :required="false" />
                                <global-input type="password" v-model="form.password" id="password"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Password')" :error="$page.props.errors.password" />
                                <input-error :error="$page.props.errors.password" />
                            </div>
                            <div v-if="form.user_type == 'Student'" class="mb-3">
                                <global-label for="plan" value="Select Plan" :required="true" />
                                <a-select :class="$page.props.errors.plan ? 'border-custom ' : ''" class="width-100"
                                    size="large" v-model:value="form.plan" show-search
                                    :placeholder="__('Select Plan')"
                                    :options="plans.map(item => ({ value: item.id, label: item.title }))"
                                    :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur">
                                </a-select>
                                <input-error :error="$page.props.errors.plan" />
                            </div>
                            <div v-if="form.user_type == 'Student'" class="mb-1">
                                <global-label for="parent" value="Select Parent" :required="true" />
                                <a-select :class="
                                        $page.props.errors.parent
                                            ? 'border-custom '
                                            : ''
                                    " class="width-100" size="large" v-model:value="form.parent" show-search
                                    :placeholder="__('Select Parent')" :options="
                                        parents.map(item => ({
                                            value: item.id,
                                            label: item.name
                                        }))
                                    " :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur">
                                </a-select>
                                <input-error :error="$page.props.errors.parent" />
                            </div>
                        </div>
                        <global-button :loading="form.processing" type="submit" cssClass="w-full mt-3" theme="primary">
                            {{ __("Submit") }}
                        </global-button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import { useForm } from "@inertiajs/inertia-vue3";

    export default {
        components: {
            AppLayout
        },
        props: {
            errors: Object,
            roles: Object,
            parents: Object,
            plans: Object
        },
        data() {
            return {
                teacher_create: "",
                options: [],
                form: useForm({
                    name: "",
                    email: "",
                    password: "",
                    password_confirmation: "",
                    user_type: "",
                    parent: null,
                    plan: null
                })
            };
        },
        created() {
            for (const [key, value] of Object.entries(this.roles)) {
                this.options.push({
                    value: value.name,
                    label: value.name
                });
            }
            this.form.user_type = this.options[0].value;
        },
        mounted() { },
        methods: {
            submit() {
                this.form.post(this.route("users.store"), this.form, {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.name = "";
                        this.form.email = "";
                        this.form.password = "";
                        this.form.password_confirmation = "";
                        this.form.user_type = "";
                    }
                });
            }
        }
    };
</script>
<style scoped>
    .border-custom {
        border-color: red;
        border-right-width: 1px !important;
    }
</style>
