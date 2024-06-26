<template>
    <div class="overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
        <form class="mt-2" @submit.prevent="submit()">
            <div class="pt-6 px-4 sm:p-6 lg:pb-8">
                <div>
                    <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">{{ __('Razorpay') }}</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="mb-3">
                            <global-label for="razorpay_key" value="Razorpay Key" />
                            <global-input type="text" v-model="form.razorpay_key" id="razorpay_key" class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter client key')" :error="$page.props.errors.name" />
                            <input-error :error="$page.props.errors.razorpay_key" />
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <global-label for="razorpay_secret" value="Razorpay Secret" />
                            <global-input type="text" v-model="form.razorpay_secret" id="razorpay_secret"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter Client Secret')" :error="$page.props.errors.razorpay_secret" />
                            <input-error :error="$page.props.errors.razorpay_secret" />
                        </div>
                    </div>
                    <div>
                        <div class="mb-3">
                            <global-label for="razorpay_active" value="Status" :required="true" />
                            <div class="flex gap-2">
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="1" id="razorpay_status_active" v-model="form.razorpay_active" type="radio" name="razorpay_active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" :checked="form.razorpay_active"/>
                                    <global-label for="razorpay_status_active"
                                        class="py-2 mt-1  ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Active" :required="false" />
                                </div>
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="0" id="razorpay_status_inactive" type="radio" v-model="form.razorpay_active" name="razorpay_active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" :checked="!form.razorpay_active"/>
                                    <global-label for="razorpay_status_inactive"
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
                    <global-button type="submit" cssClass="w-full mt-3" theme="primary" id="razorUpdate">
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
            razorpay: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    razorpay_key: this.razorpay.razorpay_key,
                    razorpay_secret: this.razorpay.razorpay_secret,
                    razorpay_active: this.razorpay.razorpay_active ? true:false,
                    type: 'razorpay'
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
