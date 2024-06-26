<template>
    <div class="dark:text-gray-400 px-6 py-4 rounded-lg bg-white dark:bg-gray-800 font-semibold text-base mb-5">
        {{ __('Student List') }}
    </div>

    <div class="overflow-x-auto relative rounded-lg">
        <global-table>
            <template #head>
                <th class="py-4 px-5 whitespace-nowrap">{{ __('Student Name') }}</th>
                <th class="py-4 px-5 whitespace-nowrap">{{ __('Student ID') }}</th>
                <template v-if="$page.props.auth.role == 'Teacher'">
                    <th class="py-4 px-5 whitespace-nowrap">{{ __('Phone Number') }}</th>
                </template>
                <th class="py-4 px-5 whitespace-nowrap">{{ __('Date of Birth') }}</th>
                <th class="py-4 px-5 whitespace-nowrap" v-if="$page.props.auth.role == 'Teacher'">{{ __('Action') }}</th>
            </template>
            <template #body>
                <template v-if="students.data.length > 0">
                    <tr v-for="student in students.data" :key="student.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-5">
                            <span class="flex items-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <td-user-show :image="student.user.profile_photo_url" :name="student.user.name"
                                    :email="student.user.email" />
                            </span>
                        </td>
                        <td class="py-4 px-5 whitespace-nowrap flex">
                            {{ student?.user?.profile?.student_id ?? '' }}
                            <template v-if="student?.user?.profile?.student_id ?? false">
                                <CopyText :text="student.user.profile.student_id"/>
                            </template>
                        </td>
                        <template v-if="$page.props.auth.role == 'Teacher'">
                            <td class="py-4 px-5">
                                <a v-if="student.user.phone" :href="'tel:' + student.user.phone"
                                    class="flex gap-2 items-center mb-0">
                                    <PhoneIcon class="w-6 h-6" />
                                    {{ student.user.phone }}
                                </a>
                            </td>
                        </template>
                        <td class="py-4 px-5">
                            <p v-if="student.user.date_of_birth" class="flex gap-2 items-center mb-0 whitespace-nowrap">
                                <CalendarIcon class="w-6 h-6" />
                                {{ formatTime(student.user.date_of_birth) ?? '-' }}
                            </p>
                            <template v-else>-</template>
                        </td>
                        <td class="py-4 px-5" v-if="$page.props.auth.role == 'Teacher'">
                            <Link preserve-scroll
                                :href="route('student.show', student.user.username)"
                                class="group relative">
                                <eye-icon class="w-6 h-6 text-pink-400 hover:text-pink-300" />
                                <tool-tip :text="__('View')" />
                            </Link>
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr>
                        <td colspan="5">
                            <div class="text-center p-4">
                                {{ __('No student') }}
                            </div>
                        </td>
                    </tr>
                </template>
            </template>
        </global-table>
        <div class="flex justify-center col-span-3">
            <pagination class="mt-6" :links="students.links" />
        </div>
    </div>
</template>

<script>
import Pagination from "@/Shared/Admin/Pagination.vue";
import TdUserShow from "@/Shared/TdUserShow.vue";
import CopyText from "@/Shared/CopyText.vue";

import {
    CalendarIcon,
    EnvelopeIcon,
    EyeIcon,
    PhoneIcon
} from "@heroicons/vue/24/outline";

export default {
    props: {
        students: Object,
    },
    components: {
        Pagination,
        TdUserShow,
        CalendarIcon,
        EnvelopeIcon,
        EyeIcon,
        PhoneIcon,
        CopyText,
    },
    data() {
        return {
        }
    },
    methods: {
        async copyURL(mytext) {
            try {
                await navigator.clipboard.writeText(mytext);
                alert('Copied');
            } catch($e) {
                alert('Cannot copy');
            }
        }
    }
};
</script>
<style scoped>
</style>
