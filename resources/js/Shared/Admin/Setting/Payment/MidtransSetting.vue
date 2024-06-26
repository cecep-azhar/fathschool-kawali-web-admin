<template>
    <div class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
        <form class="mt-2" @submit.prevent="submit()">
            <div class="pt-6 px-4 sm:p-6 lg:pb-8">
                <div>
                    <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">{{ __('Midtrans') }}</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="mb-3">
                            <global-label for="midtrans_merchant_id" value="Midtrans Merchant ID" />
                            <global-input type="text" v-model="form.midtrans_merchant_id" id="midtrans_merchant_id" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Merchant ID')" :error="$page.props.errors.midtrans_merchant_id" />
                            <input-error :error="$page.props.errors.midtrans_merchant_id" />
                        </div>
                        <div class="mb-3">
                            <global-label for="midtrans_client_key" value="Midtrans Client Key" />
                            <global-input type="text" v-model="form.midtrans_client_key" id="midtrans_client_key" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Server Key')" :error="$page.props.errors.midtrans_client_key" />
                            <input-error :error="$page.props.errors.midtrans_client_key" />
                        </div>
                        <div class="mb-3">
                            <global-label for="midtrans_server_key" value="Midtrans Server Key" />
                            <global-input type="text" v-model="form.midtrans_server_key" id="midtrans_server_key" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Server Key')" :error="$page.props.errors.midtrans_server_key" />
                            <input-error :error="$page.props.errors.midtrans_server_key" />
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <global-label for="midtrans_live_mode" value="Midtrans Mode" :required="true" />
                            <div class="flex gap-2">
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="live" checked id="midtrans_live_mode_live" v-model="form.midtrans_live_mode" type="radio"
                                        name="midtrans_live_mode"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <global-label for="midtrans_live_mode_live"
                                        class="py-2 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Live" :required="false" />
                                </div>
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="sandbox" id="midtrans_live_mode_sandbox" type="radio" v-model="form.midtrans_live_mode"
                                        name="midtrans_live_mode"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <global-label for="midtrans_live_mode_sandbox"
                                        class="py-2 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Sandbox" :required="false" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <global-label for="midtrans_active" value="Status" :required="true" />
                            <div class="flex gap-2">
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="1" id="midtrans_active_active" v-model="form.midtrans_active" type="radio" name="midtrans_active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" :checked="form.midtrans_active"/>
                                    <global-label for="midtrans_active_active"
                                        class="py-2 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Active" :required="false" />
                                </div>
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="0" id="midtrans_active_inactive" type="radio" v-model="form.midtrans_active" name="midtrans_active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" :checked="!form.midtrans_active"/>
                                    <global-label for="midtrans_active_inactive"
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
                    <global-button type="submit" cssClass="w-full mt-3" theme="primary" id="midUpdate">
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
            midtrans: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    midtrans_merchant_id: this.midtrans.midtrans_merchant_id,
                    midtrans_client_key: this.midtrans.midtrans_client_key,
                    midtrans_server_key: this.midtrans.midtrans_server_key,
                    midtrans_live_mode: this.midtrans.midtrans_live_mode,
                    midtrans_active: this.midtrans.midtrans_active ? true:false,
                    type: 'midtrans'
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
