<template>
    <div class="flex justify-between px-6 pt-6 pb-2.5">
        <h2 class="text-gray-900 dark:text-gray-400">{{ subject.name }}</h2>
        <div class="flex gap-2">
            <div>
                <button  @click="edit(subject)" :id="'editSubject' + subject.id">
                    <PencilSquareIcon class="w-6 h-6 text-blue-400" />
                </button>
            </div>
            <form @submit.prevent="destroy(subject.id)">
                <button type="submit" :id="'deleteSubject' + subject.id">
                    <trash-icon class="w-6 h-6 text-red-400" />
                </button>
            </form>
        </div>
    </div>
    <hr class="dark:border-gray-700" />
    <div class="px-6 pt-4 pb-6 dark:text-gray-400">
        <h2 class="dark:text-gray-400">
            {{ __('Course') }}:
            <span>
                {{ subject.course ? subject.course.name : '' }}
            </span>
        </h2>


        <p>{{ __('Created At') }}: {{ formatTime(subject.created_at) }}</p>
        <div class="w-full h-2" :style="`background-color: ${subject.color}`"></div>
    </div>
</template>

<script>
import { PencilSquareIcon, TrashIcon, EyeIcon } from '@heroicons/vue/24/outline'

export default {
    components: { PencilSquareIcon, EyeIcon, TrashIcon },
    props: {
        subject: Object
    },
    data() {
        return {
            visible: false,
            show_subject: ''
        }
    },
    methods: {
        destroy(id) {
            if (confirm("Are you sure ?")) {
                this.$inertia.delete(this.route('subjects.destroy', id))
            } else {
                return false;
            }
        },
        edit(subject) {
            this.$emit('edit', subject)
        },
        show(subject) {
            this.show_subject = subject;
            this.visible = true;
        },
        hide(e) {
            this.visible = false;
        },
    }
}
</script>
