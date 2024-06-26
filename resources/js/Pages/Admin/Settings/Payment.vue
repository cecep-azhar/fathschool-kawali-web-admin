<template>
    <AppLayout :title="__('Payment Setting | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Settings')"/>
            <BreadcrumbLink :title=" __('Payment Setting')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Payment Setting') }}
                </div>
            </page-header>

            <SettingLayout>
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    <div>
                        <PaypalSetting :paypal="paypal" />
                    </div>
                    <div>
                        <StripeSetting :stripe="stripe" />
                    </div>

                    <div>
                        <RazorpaySetting :razorpay="razorpay" />
                    </div>
                    <div>
                        <FlutterwaveSetting :flutterwave="flutterwave" />
                    </div>
                    <div>
                        <MidtransSetting :midtrans="midtrans" />
                    </div>
                </div>
            </SettingLayout>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingLayout from '@/Layouts/SettingLayout.vue';
import PaypalSetting from '@/Shared/Admin/Setting/Payment/PaypalSetting.vue';
import StripeSetting from '@/Shared/Admin/Setting/Payment/StripeSetting.vue';
import RazorpaySetting from '@/Shared/Admin/Setting/Payment/RazorpaySetting.vue';
import FlutterwaveSetting from '@/Shared/Admin/Setting/Payment/FlutterwaveSetting.vue';
import MidtransSetting from '@/Shared/Admin/Setting/Payment/MidtransSetting.vue';
import { ArrowRightIcon } from "@heroicons/vue/24/outline";

export default {
    props: {
        paypal: Object,
        stripe: Object,
        razorpay: Object,
        flutterwave: Object,
        midtrans: Object,
    },
    components: {
        AppLayout,
        SettingLayout,
        PaypalSetting,
        StripeSetting,
        RazorpaySetting,
        FlutterwaveSetting,
        MidtransSetting,
        ArrowRightIcon
    },
    methods: {
    },
}
</script>
