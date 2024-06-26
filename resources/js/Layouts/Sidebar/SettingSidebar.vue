<template>
    <aside class="pb-6 -mt-2 lg:col-span-2">
        <div class="flex gap-4 flex-wrap bg-white dark:bg-gray-600 rounded-md py-2 px-4  website_settings_section">
            <template v-for="(item, index) in items" :key="index">
                <Link preserveScroll :href="route(item.route)"
                    :class="[' px-3 rounded-lg py-2 flex gap-2 items-center text-sm font-medium  ', $page.component.includes(item.pageUrl) ? 'bg-blue-50 text-blue-500 dark:bg-gray-700 dark:text-gray-400' : 'text-gray-400']"
                    v-if="can(item.permission)">
                <component :is="item.icon" :class="['flex-shrink-0 w-6 h-6', $page.component == item.pageUrl ? '' : '']" />
                <div v-text="__(item.name)"></div>
                </Link>
            </template>
        </div>
    </aside>
</template>

<script>
import { BanknotesIcon, CloudArrowUpIcon, Cog6ToothIcon, CubeIcon, CurrencyDollarIcon,EnvelopeIcon, InboxIcon, LanguageIcon, LockClosedIcon, ShieldCheckIcon, GlobeAltIcon, NewspaperIcon } from "@heroicons/vue/24/outline";

export default {
    components: {
        Cog6ToothIcon,
        ShieldCheckIcon,
        LockClosedIcon,
        CurrencyDollarIcon,
        InboxIcon,
        BanknotesIcon,
        CloudArrowUpIcon,
        LanguageIcon,
        GlobeAltIcon,
        CubeIcon,
        EnvelopeIcon,
        NewspaperIcon
    },
    data() {
        return {
            items: [
                {
                    name: 'General',
                    icon: Cog6ToothIcon,
                    route: 'settings.general',
                    pageUrl: 'Admin/Settings/Index',
                    permission: 'settings',
                },
                {
                    name: 'Website',
                    icon: GlobeAltIcon,
                    route: 'settings.website',
                    pageUrl: 'Admin/Settings/Website',
                    permission: 'settings',
                },
                {
                    name: 'Currency',
                    icon: CurrencyDollarIcon,
                    route: 'settings.currency',
                    pageUrl: 'Admin/Settings/Currency',
                    permission: 'currency',
                },
                {
                    name: 'Roles',
                    icon: ShieldCheckIcon,
                    route: 'roles.index',
                    pageUrl: 'Admin/Settings/Role',
                    permission: 'roles.index',
                },
                {
                    name: 'Language',
                    icon: LanguageIcon,
                    route: 'languages.index',
                    pageUrl: 'Admin/Settings/Language',
                    permission: 'language',
                },
                {
                    name: 'Recaptcha',
                    icon: LockClosedIcon,
                    route: 'settings.recaptcha.index',
                    pageUrl: 'Admin/Settings/Recaptcha',
                    permission: 'settings',
                },
                {
                    name: 'SMTP',
                    icon: InboxIcon,
                    route: 'settings.smtp',
                    pageUrl: 'Admin/Settings/SMTP',
                    permission: 'settings',
                },
                {
                    name: 'SMS',
                    icon: EnvelopeIcon,
                    route: 'settings.sms',
                    pageUrl: 'Admin/Settings/Sms',
                    permission: 'settings',
                },
                {
                    name: 'Payment',
                    icon: BanknotesIcon,
                    route: 'settings.payment',
                    pageUrl: 'Admin/Settings/Payment',
                    permission: 'settings',
                },
                {
                    name: 'Upgrade',
                    icon: CloudArrowUpIcon,
                    route: 'settings.upgrade',
                    pageUrl: 'Admin/Settings/Upgrade',
                    permission: 'settings',
                },
                {
                    name: 'Other',
                    icon: CubeIcon,
                    route: 'settings.other',
                    pageUrl: 'Admin/Settings/Other',
                    permission: 'settings',
                },
                {
                    name: 'Cms',
                    icon: NewspaperIcon,
                    route: 'cms.index',
                    pageUrl: 'Admin/Settings/Cms/Index',
                    permission: 'settings',
                },
            ]
        }
    }
};
</script>
