<template>
    <div
        class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
        <form class="mt-2" @submit.prevent="submit()">
            <div class="pt-6 px-4 sm:p-6 lg:pb-8">
                <div>
                    <h2 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-400">{{ __('Twilio') }}</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="mb-3">
                            <global-label for="twilio_sid" :value="__('Twilio SID')" />
                            <global-input type="text" v-model="form.twilio_sid" id="twilio_sid"
                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                :placeholder="__('Enter SId')" :error="$page.props.errors.name" />
                            <input-error :error="$page.props.errors.twilio_sid" />
                        </div>
                        <div>
                            <div class="mb-3">
                                <global-label for="twilio_from" :value="__('Twilio Number')" />
                                <global-input type="text" v-model="form.twilio_from" id="twilio_from"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('+18149073389')" :error="$page.props.errors.twilio_from" />
                                <input-error :error="$page.props.errors.twilio_from" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <div class="mb-3">
                                <global-label for="twilio_token" :value="__('Twilio Token')" />
                                <global-input type="text" v-model="form.twilio_token" id="twilio_token"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter Twilio Token')" :error="$page.props.errors.twilio_token" />
                                <input-error :error="$page.props.errors.twilio_token" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <global-label for="twilio_status" :value="__('Status')" :required="true" />
                            <div class="flex gap-2">
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="1" id="twilio_status_active" v-model="form.twilio_status" type="radio"
                                        name="twilio_status"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                        :checked="form.twilio_status" />
                                    <global-label for="twilio_status_active"
                                        class="py-2 mt-1 ml-2 rtl:ml-0 rtl:mr-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"
                                        value="Active" :required="false" />
                                </div>
                                <div
                                    class="w-full rounded-lg flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="0" id="twilio_status_inactive" type="radio" v-model="form.twilio_status"
                                        name="twilio_status"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                        :checked="!form.twilio_status" />
                                    <global-label for="twilio_status_inactive"
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
                    <global-button type="submit" cssClass="w-full mt-3" theme="primary" id="twilioUpdate">
                        {{ __('Update') }}
                    </global-button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        twilio: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                twilio_sid: this.twilio.twilio_sid,
                twilio_token: this.twilio.twilio_token,
                twilio_from: this.twilio.twilio_from,
                twilio_status: this.twilio.twilio_active ? true : false,
                type: 'twilio'
            })
        }
    },
    methods: {
        submit() {
            console.log(this.form.twilio_from);
            this.form.put(this.route('settings.sms.update'), {
                preserveScroll: true,
            })
        }
    },
}
</script>
