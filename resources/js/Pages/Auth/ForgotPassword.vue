<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

defineProps({
    status: String,
    errors: Object,
});

const form = useForm({
    phone: '', 
});

const submit = () => {
    form.post(route('password.admin'), {
        onSuccess: () => {
        }
    });
};
const goBack = () => {
    Inertia.get(route('login'));
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
            {{ __('Forgot your password? No problem. Just let us know your phone number and we will send you a password reset link.') }}
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <JetValidationErrors class="mb-4" :errors="errors" />

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="phone" value="phone number" />
                <JetInput id="phone" v-model="form.phone" type="tel" class="mt-1 block w-full" required autofocus />
            </div>

            <div class="flex items-center justify-between mt-4">
                <JetButton @click="goBack" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Login') }}
                </JetButton>
                <JetButton :loading="form.processing" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Send Password Reset Link') }}
                </JetButton>
                
            </div>
        </form>
    </JetAuthenticationCard>
</template>

