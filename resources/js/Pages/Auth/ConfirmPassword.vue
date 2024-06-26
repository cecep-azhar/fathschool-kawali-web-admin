<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>

    <Head title="Secure Area" />

    <JetAuthenticationCard>
        <template #logo>
            <Link class="flex-none text-xl font-semibold dark:text-white" :href="route('dashboard')" aria-label="Brand">
            <app-logo class="block h-1/2 w-auto" />
            </Link>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing') }}
        </div>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="password" value="Password" />
                <JetInput id="password" ref="passwordInput" v-model="form.password" type="password"
                    class="mt-1 block w-full" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <global-button :loading="form.processing" type="submit"
                    cssClass="ml-4" theme="primary">
                    {{ __('Confirm') }}
                </global-button>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
