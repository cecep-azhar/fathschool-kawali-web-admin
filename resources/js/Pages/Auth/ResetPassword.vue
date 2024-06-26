<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <Head title="Reset Password" />

    <JetAuthenticationCard>
        <template #logo>
            <Link class="flex-none text-xl font-semibold dark:text-white" :href="route('dashboard')" aria-label="Brand">
            <app-logo class="block h-1/2 w-auto" />
            </Link>
        </template>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="hidden">
                <JetLabel for="email" :value="__('Email')" />
                <JetInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus />
            </div>

            <div class="mt-4">
                <JetLabel for="password" :value="__('Password')" />
                <JetInput placeholder="Password" id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <JetLabel for="password_confirmation" :value="__('Confirm Password')" />
                <JetInput placeholder="Password Confirmation" id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="mt-1 block w-full" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <global-button :loading="form.processing" type="submit"
                    cssClass="ml-4" theme="primary">
                    {{ __('Reset Password') }}
                </global-button>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
