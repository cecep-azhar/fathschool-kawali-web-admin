<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>

    <Head :title="__('Forgot Password')" />

    <JetAuthenticationCard>
        <template #logo>
            <Link class="flex-none text-xl font-semibold dark:text-white" :href="route('dashboard')" aria-label="Brand">
            <app-logo class="block h-1/2 w-auto" />
            </Link>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password No problem Just let us know your email address and we will email you a password reset link that will allow you to choose a new one') }}
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="email" value="Email" />
                <JetInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <global-button :loading="form.processing" type="submit" theme="primary">
                    {{ __('Email Password Reset Link') }}
                </global-button>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
