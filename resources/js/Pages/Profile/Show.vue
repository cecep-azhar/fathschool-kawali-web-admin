<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import JetSectionBorder from '@/Jetstream/SectionBorder.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Profile">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Profile')"/>
        </Breadcrumb>

        <div class="py-5 mx-auto pb-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Name / Email / Photo  -->
                <div class="bg-white p-4 rounded-lg dark:bg-gray-800">
                    <div class="md:col-span-1 flex justify-between">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-400">
                                Profile Information
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Update your account's profile information and email address.
                            </p>
                        </div>
                    </div>
                    <UpdateProfileInformationForm :user="$page.props.user" />
                </div>
                <!-- Password  -->
                <div class="bg-white p-4 rounded-lg dark:bg-gray-800">
                    <div class="md:col-span-1 flex justify-between">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-400">
                                Password Change
                            </h3>
                        </div>
                    </div>
                    <div v-if="$page.props.jetstream.canUpdatePassword">
                        <UpdatePasswordForm class="mt-10 sm:mt-0" />
                    </div>
                </div>
                <!-- Two Factor Authentication  -->
                <div class="bg-white p-4 rounded-lg dark:bg-gray-800">
                    <div class="md:col-span-1 flex justify-between">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-400">
                                Two Factor Authentication
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Add additional security to your account using two factor authentication.
                            </p>
                        </div>
                    </div>
                    <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                        <TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication"
                            class="mt-10 sm:mt-0" />
                    </div>
                </div>
                <!-- Sessions  -->
                <div class="bg-white p-4 rounded-lg dark:bg-gray-800">
                    <div class="md:col-span-1 flex justify-between">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-400">
                                Browser Sessions
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Manage and log out your active sessions on other browsers and devices.
                            </p>
                        </div>
                    </div>
                    <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />
                </div>
                <!-- Account Delete  -->
                <div class="bg-white p-4 rounded-lg dark:bg-gray-800">
                    <div class="md:col-span-1 flex justify-between">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-400">
                                Delete Account
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Permanently delete your account.
                            </p>
                        </div>
                    </div>
                    <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                        <DeleteUserForm class="mt-10 sm:mt-0" />
                    </template>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
