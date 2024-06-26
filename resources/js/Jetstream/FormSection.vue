<script setup>
import { computed, useSlots } from 'vue';
import JetSectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
    <div >
        <div class="items-center px-12">
            <form @submit.prevent="$emit('submitted')">
                <div  :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'">
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form" />
                    </div>
                </div>

                <div v-if="hasActions"
                    class="mt-2">
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>
