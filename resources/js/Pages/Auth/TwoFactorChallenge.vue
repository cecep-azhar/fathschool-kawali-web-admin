<script setup>
import { nextTick, ref } from 'vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

const recovery = ref(false);

const form = useForm({
    code: '',
    recovery_code: '',
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = '';
    } else {
        codeInput.value.focus();
        form.recovery_code = '';
    }
};

const submit = () => {
    form.post(route('two-factor.login'));
};
</script>

<template>

    <Head :title="__('Two-factor Confirmation')" />

    <JetAuthenticationCard>
        <template #logo>
            <Link class="flex-none text-xl font-semibold dark:text-white" :href="route('dashboard')" aria-label="Brand">
            <app-logo class="block h-1/2 w-auto" />
            </Link>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            <template v-if="!recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application') }}.
            </template>

            <template v-else>
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes') }}
            </template>
        </div>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div v-if="!recovery">
                <JetLabel for="code" value="Code" />
                <JetInput id="code" ref="codeInput" v-model="form.code" type="text" inputmode="numeric"
                    class="mt-1 block w-full" autofocus autocomplete="one-time-code" />
            </div>

            <div v-else>
                <JetLabel for="recovery_code" value="Recovery Code" />
                <JetInput id="recovery_code" ref="recoveryCodeInput" v-model="form.recovery_code" type="text"
                    class="mt-1 block w-full" autocomplete="one-time-code" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                    @click.prevent="toggleRecovery">
                    <template v-if="!recovery">
                        {{ __('Use a recovery code') }}
                    </template>

                    <template v-else>
                        {{ __('Use an authentication code') }}
                    </template>
                </button>

                <global-button :loading="form.processing" type="submit"
                    cssClass="ml-4" theme="primary">
                    {{ __('Login') }}
                </global-button>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
