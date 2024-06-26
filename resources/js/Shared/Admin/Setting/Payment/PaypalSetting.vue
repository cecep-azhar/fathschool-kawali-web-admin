<template>
    <div class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
        <form class="mt-2" @submit.prevent="submit()">
            <div class="pt-6 px-4 sm:p-6 lg:pb-8">
                <div>
                    <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">{{ __('Paypal') }}</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="mb-3">
                            <global-label for="paypal_live_client_id" value="Paypal Client ID (Live)" />
                            <global-input type="text" v-model="form.paypal_live_client_id" id="paypal_live_client_id" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Client Id')" :error="$page.props.errors.name" />
                            <input-error :error="$page.props.errors.paypal_live_client_id" />
                        </div>
                        <div class="mb-3">
                            <global-label for="paypal_sandbox_client_id" value="Paypal Client ID (Sandbox)" />
                            <global-input type="text" v-model="form.paypal_sandbox_client_id" id="paypal_sandbox_client_id" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Client Id')" :error="$page.props.errors.name" />
                            <input-error :error="$page.props.errors.paypal_sandbox_client_id" />
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <global-label for="paypal_live_client_secret" value="Paypal Client Secret (Live)" />
                            <global-input type="text" v-model="form.paypal_live_client_secret" id="paypal_live_client_secret" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Client Secret')" :error="$page.props.errors.paypal_live_client_secret" />
                            <input-error :error="$page.props.errors.paypal_live_client_secret" />
                        </div>
                        <div class="mb-3">
                            <global-label for="paypal_sandbox_client_secret" value="Paypal Client Secret (Sandbox)" />
                            <global-input type="text" v-model="form.paypal_sandbox_client_secret" id="paypal_sandbox_client_secret"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Client Secret')" :error="$page.props.errors.paypal_sandbox_client_secret" />
                            <input-error :error="$page.props.errors.paypal_sandbox_client_secret" />
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <global-label for="paypal_mode" value="Paypal Mode" :required="true" />
                            <div class="flex gap-2">
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="live" checked id="paypal_mode_live" v-model="form.paypal_mode" type="radio"
                                        name="paypal_mode"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <global-label for="paypal_mode_live"
                                        class="py-2 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Live" :required="false" />
                                </div>
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="sandbox" id="paypal_mode_sandbox" type="radio" v-model="form.paypal_mode"
                                        name="paypal_mode"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <global-label for="paypal_mode_sandbox"
                                        class="py-2 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Sandbox" :required="false" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <global-label for="paypal_status" value="Status" :required="true" />
                            <div class="flex gap-2">
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="1" id="paypal_status_active" v-model="form.paypal_status" type="radio" name="paypal_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" :checked="form.paypal_status"/>
                                    <global-label for="paypal_status_active"
                                        class="py-2 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Active" :required="false" />
                                </div>
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="0" id="paypal_status_inactive" type="radio" v-model="form.paypal_status" name="paypal_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" :checked="!form.paypal_status"/>
                                    <global-label for="paypal_status_inactive"
                                        class="py-2 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Inactive" :required="false" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" border-gray-700">
                <div class="flex justify-end gap-4 px-4 sm:px-6">
                    <global-button type="submit" cssClass="w-full mt-3" theme="primary" id="paypalUpdate">
                        {{ __('Update') }}
                    </global-button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props:{
            paypal: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    paypal_live_client_id: this.paypal.paypal_live_client_id,
                    paypal_live_client_secret: this.paypal.paypal_live_client_secret,
                    paypal_sandbox_client_id: this.paypal.paypal_sandbox_client_id,
                    paypal_sandbox_client_secret: this.paypal.paypal_sandbox_client_secret,
                    paypal_mode: this.paypal.paypal_mode,
                    paypal_status: this.paypal.paypal_active ? true:false,
                    type: 'paypal'
                })
            }
        },
        methods: {
            submit() {
                this.form.put(this.route('settings.payment.update'), {
                    preserveScroll: true,
                })
            }
        },
    }
</script>
