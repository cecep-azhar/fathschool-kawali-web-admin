<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetButton from '@/Jetstream/Button.vue';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>

    <Head title="Email Verification" />

    <JetAuthenticationCard>
        <template #logo>
            <Link class="flex-none text-xl font-semibold dark:text-white" :href="route('dashboard')" aria-label="Brand">
            <app-logo class="block h-1/2 w-auto" />
            </Link>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Before continuing could you verify your email address by clicking on the link we just emailed to you If you didnt receive the email we will gladly send you another') }}
        </div>

        <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided in your profile settings') }}
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <global-button :loading="form.processing" type="submit" cssClass="ml-4" theme="primary">
                    {{ __('Resend Verification Email') }}
                </global-button>

                <div>
                    <Link preserve-scroll :href="route('profile.show')"
                        class="underline text-sm text-gray-600 hover:text-gray-900">
                        {{ __('Edit Profile') }}
                    </Link>

                    <Link preserve-scroll :href="route('logout')" method="post" as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                    {{ __('Logout') }}
                    </Link>
                </div>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
