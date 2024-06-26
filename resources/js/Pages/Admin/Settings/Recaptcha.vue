<template>
    <AppLayout :title="__('Recaptcha Setting | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Settings')"/>
            <BreadcrumbLink :title=" __('Recaptcha Setting')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Recaptcha Setting') }}
                </div>
            </page-header>

            <SettingLayout>
                <div
                    class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                        <div>
                            <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                {{ __('Recaptcha Setting') }} (
                                <small>
                                    <a href="https://support.google.com/recaptcha" target="_blank">
                                        {{ __('Get Help') }}
                                    </a>
                                </small>)
                            </h2>
                        </div>
                        <div class="grid grid-cols-12 divide-y-0 divide-x  dark:divide-gray-600 gap-8">
                            <div class="col-span-12">
                                <form class="mt-2" @submit.prevent="submit()">
                                    <div
                                        class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 sm:gap-1 md:gap-4 w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                                        <div class="mb-3">
                                            <global-label for="recaptcha_key" value="Your Key" :required="false" />
                                            <global-input type="text" id="recaptcha_key" v-model="form.recaptcha_key"
                                                name="recaptcha_key"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Your Key')" :error="$page.props.errors.recaptcha_key" />
                                            <input-error :error="$page.props.errors.recaptcha_key" />
                                        </div>
                                        <div class="mb-3">
                                            <global-label for="recaptcha_secret" value="Your Secret"
                                                :required="false" />
                                            <global-input type="text" id="recaptcha_secret"
                                                v-model="form.recaptcha_secret" name="recaptcha_secret"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Your Secret')"
                                                :error="$page.props.errors.recaptcha_secret" />
                                            <input-error :error="$page.props.errors.recaptcha_secret" />
                                        </div>
                                        <div class="mb-3">
                                            <global-label for="status" value="Status" :required="false" />
                                            <div class="flex gap-2">
                                                <div
                                                    class="w-full rounded flex items-center rtl:pl-0 rtl:pr-4 pl-4 border border-gray-200 dark:border-gray-700">
                                                    <input value="off" id="status_off" v-model="form.status"
                                                        type="radio" name="status_off"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                    <global-label for="status_off"
                                                        class="py-3 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                                        value="Off" :required="false" />
                                                </div>
                                                <div
                                                    class="w-full rounded flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                                    <input value="on" id="status_on" type="radio" v-model="form.status"
                                                        name="status"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                    <global-label for="status_on"
                                                        class="py-3 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                                        value="On" :required="false" />
                                                </div>
                                            </div>
                                            <input-error :error="$page.props.errors.status" />
                                        </div>
                                        <div v-if="status" class="mb-1">
                                            <div class="rt-mb-15">
                                                <div class="g-custom-css">
                                                    <vue-recaptcha ref="recaptcha" @verify="verifyMethod"
                                                        :sitekey="site_key"></vue-recaptcha>
                                                </div>
                                                <input-error :error="$page.props.errors.recaptcha" />
                                            </div>
                                        </div>
                                    </div>
                                    <global-button :loading="form.processing" type="submit"
                                        class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 w-full mt-3 dark:focus:ring-blue-300">
                                        {{ __('Save') }}
                                    </global-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </SettingLayout>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingLayout from '@/Layouts/SettingLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { VueRecaptcha } from 'vue-recaptcha';
import { ArrowRightIcon } from "@heroicons/vue/24/outline";

export default {
    props: {
        site_key: String,
        secret: String,
        status: Boolean,
    },
    data() {
        return {
            form: useForm({
                recaptcha_key: this.site_key,
                recaptcha_secret: this.secret,
                status: this.status ? 'on' : 'off',
                recaptcha: false,
                _method: "PUT"
            })
        }
    },
    components: {
        AppLayout,
        SettingLayout,
        VueRecaptcha,
        ArrowRightIcon
    },
    methods: {
        verifyMethod() {
            this.form.recaptcha = true;
        },
        submit() {
            this.form.post(this.route('settings.recaptcha.update'), {
                preserveScroll: true,
                onFinish: visit => {
                    this.$refs.recaptcha.reset();
                },
            })
        }
    },
}
</script>
