<template>
    <AppLayout :title="__('SMTP Settings | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Settings')"/>
            <BreadcrumbLink :title=" __('SMTP Settings')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('SMTP Settings') }}
                </div>
            </page-header>

            <SettingLayout>
                <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 ">
                        <div
                            class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">
                                        {{ __('SMTP Settings') }}
                                    </h2>
                                    <h5 class="dark:text-gray-400">
                                        {{ __("Your Application might show an error if you don't have setup SMTP") }}
                                    </h5>
                                    <p class="mb-4 dark:text-gray-400">
                                        {{ __('Setup SMTP to send all applications emails, such as') }}
                                        <strong>{{ __('Forget Password') }}</strong>,
                                        <strong>{{ __('User Verification') }}</strong>,
                                        <strong>{{ __('Invoice') }}</strong> &amp; {{ __('many more') }}.
                                        <a href="https://www.gmass.co/smtp-test" target="_blank">
                                            {{ __('Test your SMTP credentials here') }}
                                        </a>
                                    </p>
                                </div>
                                <div >
                                    <form class="mt-2" @submit.prevent="submit()">
                                        <div
                                            class="grid grid-cols-1 xl:grid-cols-2 gap-3 w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                                            <div class="mb-3">
                                                <global-label for="driver" :value="__('Mail Driver')" :required="true" />
                                                <global-input v-model="form.driver" disabled type="text" id="driver"
                                                    name="driver"
                                                    class="mt-1 disabled:opacity-60 disabled:bg-gray-200 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" :error="$page.props.errors.driver" />
                                                <input-error :error="$page.props.errors.driver" />
                                            </div>
                                            <div class="mb-3">
                                                <global-label for="mail_host" value="Mail Host" :required="true" />
                                                <global-input v-model="form.mail_host" type="text" id="mail_host"
                                                    name="mail_host"
                                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Mail Host')" :error="$page.props.errors.mail_host" />
                                                <input-error :error="$page.props.errors.mail_host" />
                                            </div>
                                            <div class="mb-3">
                                                <global-label for="mail_port" value="Mail Port" :required="true" />
                                                <global-input v-model="form.mail_port" type="number" id="mail_port"
                                                    name="mail_port"
                                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Mail Port')" :error="$page.props.errors.mail_port" />
                                                <input-error :error="$page.props.errors.mail_port" />
                                                <span class="text-red-500">{{ __('Mail Port') }}: 25, 2525, 465, 587</span>
                                            </div>
                                            <div class="mb-3">
                                                <global-label for="mail_username" value="Mail Username"
                                                    :required="true" />
                                                <global-input v-model="form.mail_username" type="text"
                                                    id="mail_username" name="mail_username"
                                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Mail Username')"
                                                    :error="$page.props.errors.mail_username" />
                                                <input-error :error="$page.props.errors.mail_username" />
                                            </div>
                                            <div class="mb-3">
                                                <global-label for="mail_password" value="Mail Password"
                                                    :required="true" />
                                                <global-input v-model="form.mail_password" type="text"
                                                    id="mail_password" name="mail_password"
                                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Mail Password')"
                                                    :error="$page.props.errors.mail_password" />
                                                <input-error :error="$page.props.errors.mail_password" />
                                            </div>
                                            <div class="mb-3">
                                                <global-label for="mail_encryption" value="Mail Encryption"
                                                    :required="true" />
                                                <div class="flex gap-2">
                                                    <div
                                                        class="w-full rounded flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                                        <input value="tls" id="mail_encryption_tls" v-model="form.mail_encryption"
                                                            type="radio" name="mail_encryption"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                        <global-label for="mail_encryption_tls"
                                                            class="py-3 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                                            value="TLS" :required="false" />
                                                    </div>
                                                    <div
                                                        class="w-full rounded flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                                        <input value="ssl" id="mail_encryption_ssl" type="radio"
                                                            v-model="form.mail_encryption" name="mail_encryption"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                        <global-label for="mail_encryption_ssl"
                                                            class="py-3 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                                            value="SSL" :required="false" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <global-label for="mail_from_address" value="Mail From Address"
                                                    :required="true" />
                                                <global-input v-model="form.mail_from_address" type="email"
                                                    id="mail_from_address" name="mail_from_address"
                                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Mail From Address')"
                                                    :error="$page.props.errors.mail_from_address" />
                                                <input-error :error="$page.props.errors.mail_from_address" />
                                            </div>
                                            <div class="mb-3">
                                                <global-label for="mail_from_name" value="Mail From Name"
                                                    :required="true" />
                                                <global-input v-model="form.mail_from_name" type="text"
                                                    id="mail_from_name" name="mail_from_name"
                                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Mail From Name')"
                                                    :error="$page.props.errors.mail_from_name" />
                                                <input-error :error="$page.props.errors.mail_from_name" />
                                            </div>
                                        </div>
                                        <div class="col-span-1 lg:col-span-2 xl:col-span-3">
                                            <global-button :loading="form.processing" type="submit"
                                                class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 w-full mt-3 dark:focus:ring-blue-300">
                                                Submit
                                            </global-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">
                                        {{ __('Send Test Mail') }}
                                    </h2>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        {{ __("Sending test emails can help verify that there are no issues with an email before launch your website") }}.
                                    </p>
                                </div>

                                <div >
                                    <form class="mt-2" @submit.prevent="testMail()">
                                        <div
                                            class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                                            <div class="mb-3">
                                                <global-label for="test_email" value="Email Address" :required="true" />
                                                <global-input v-model="sendTestMail.email" type="email" id="test_email"
                                                    name="test_email"
                                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Your Email')" :error="$page.props.errors.email" />
                                                <input-error :error="$page.props.errors.email" />
                                            </div>
                                        </div>
                                        <div class="col-span-1 lg:col-span-2 xl:col-span-3">
                                            <global-button :loading="sendTestMail.processing" type="submit"
                                                class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 w-full mt-3 dark:focus:ring-blue-300">
                                                {{ __('Send') }}
                                            </global-button>
                                        </div>
                                    </form>
                                </div>
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
import { ArrowRightIcon } from "@heroicons/vue/24/outline";

export default {
    props: {
        host: String,
        port: Number,
        encryption: String,
        username: String,
        password: String,
        address: String,
        name: String,
    },
    components: {
        AppLayout,
        SettingLayout,
        ArrowRightIcon
    },
    data() {
        return {
            form: useForm({
                driver: 'smtp',
                mail_host: this.host,
                mail_port: this.port,
                mail_username: this.username,
                mail_password: this.password,
                mail_encryption: this.encryption,
                mail_from_address: this.address,
                mail_from_name: this.name,
                _method: 'PUT'
            }),
            sendTestMail: useForm({
                email: ''
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('settings.smtp.update'), {
                preserveScroll: true
            })
        },
        testMail() {
            this.sendTestMail.post(this.route('settings.email.test'), {
                preserveScroll: true
            })
        }
    },
}
</script>
