<template>
    <div class="overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
        <form class="mt-2" @submit.prevent="submit()">
            <div class="pt-6 px-4 sm:p-6 lg:pb-8">
                <div>
                    <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">{{ __('Flutterwave') }}</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="mb-3">
                            <global-label for="flw_public_key" value="Flutterwave Key" />
                            <global-input type="text" v-model="form.flw_public_key" id="flw_public_key" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter client key')" :error="$page.props.errors.name" />
                            <input-error :error="$page.props.errors.flw_public_key" />
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <global-label for="flw_secret" value="Flutterwave Secret" />
                            <global-input type="text" v-model="form.flw_secret" id="flw_secret"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Client Secret')" :error="$page.props.errors.flw_secret" />
                            <input-error :error="$page.props.errors.flw_secret" />
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <global-label for="flw_secret_hash" value="Flutterwave Secret" />
                            <global-input type="text" v-model="form.flw_secret_hash" id="flw_secret_hash"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Client Secret')" :error="$page.props.errors.flw_secret_hash" />
                            <input-error :error="$page.props.errors.flw_secret_hash" />
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <global-label for="flw_active" value="Status" :required="true" />
                            <div class="flex gap-2">
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="1" id="flutterwave_status_active" v-model="form.flw_active" type="radio" name="flw_active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" :checked="form.flw_active"/>
                                    <global-label for="flutterwave_status_active"
                                        class="py-2 mt-1  ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Active" :required="false" />
                                </div>
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="0" id="flutterwave_status_inactive" type="radio" v-model="form.flw_active" name="flw_active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" :checked="!form.flw_active"/>
                                    <global-label for="flutterwave_status_inactive"
                                        class="py-2 mt-1 ml-2  rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Inactive" :required="false" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" border-gray-700">
                <div class="flex justify-end gap-4 px-4 sm:px-6">
                    <global-button type="submit" cssClass="w-full mt-3" theme="primary" id="flwUpdate">
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
            flutterwave: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    flw_public_key: this.flutterwave.flw_public_key,
                    flw_secret: this.flutterwave.flw_secret,
                    flw_secret_hash: this.flutterwave.flw_secret_hash,
                    flw_active: this.flutterwave.flw_active ? true:false,
                    type: 'flutterwave'
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
