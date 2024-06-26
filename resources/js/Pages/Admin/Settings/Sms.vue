<template>
    <AppLayout :title="__('SMS Gateway | Settings')">
        <Breadcrumb>
            <BreadcrumbLink title="Settings"/>
            <BreadcrumbLink title="Payment Setting"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('SMS Setting') }}
                </div>
            </page-header>

            <SettingLayout>
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    <div>
                        <TwilioSetting :twilio="twilio" />
                    </div>
                </div>
            </SettingLayout>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingLayout from '@/Layouts/SettingLayout.vue';
import { ArrowRightIcon } from "@heroicons/vue/24/outline";
import TwilioSetting from '@/Shared/Admin/Setting/Sms/Twilio.vue';

export default {
    props: {
        twilio: Object,
    },
    components: {
        AppLayout,
        SettingLayout,
        ArrowRightIcon,
        TwilioSetting
    },
    methods: {
    },
}
</script>
