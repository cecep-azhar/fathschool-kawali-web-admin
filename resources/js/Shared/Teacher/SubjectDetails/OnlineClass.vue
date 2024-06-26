<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 col-span-3">
        <div class="flex justify-between items-center text-center">
            <div class="text-lg font-bold dark:text-gray-400">
                {{ __('Classes') }}
            </div>
            <global-button v-if="can('teacher.online.class.create')" :loading="false" type="button" @click="showModal"
                theme="primary">
                {{ __('Create a new class') }}
            </global-button>
        </div>
        <div class="flex flex-wrap gap-6 mt-1 dark:text-gray-400">
            <Link preserve-scroll @click="filter = 'online_class'" :href="$page.props.auth.role == 'Teacher' ? route('subject.details', course.slug) : route('subject.show', course.slug)
            " :data="{ status: 'all', tab: 'online-class' }" type="button"
                :class="request_data && request_data.status == 'all' ? 'border-b-2 dark:border-gray-600' : '' || route().params.status ? '' : 'border-b-2 dark:border-gray-600'"
                class="font-semibold text-md">
            {{ __('All') }}
            </Link>
            <Link preserve-scroll @click="filter = 'online_class'" :href="$page.props.auth.role == 'Teacher' ? route('subject.details', course.slug) : route('subject.show', course.slug)
            " :data="{ status: 'upcoming', tab: 'online-class' }" type="button"
                :class="request_data && request_data.status == 'upcoming' ? 'border-b-2 dark:border-gray-600' : ''"
                class="font-semibold text-md">
            {{ __('Upcoming') }}
            </Link>
            <Link preserve-scroll @click="filter = 'online_class'" :href="$page.props.auth.role == 'Teacher' ? route('subject.details', course.slug) : route('subject.show', course.slug)
            " :data="{ status: 'completed', tab: 'online-class' }" type="button"
                :class="request_data && request_data.status == 'completed' ? 'border-b-2 dark:border-gray-600' : ''"
                class="font-semibold text-md">
            {{ __('Completed') }}
            </Link>
        </div>
    </div>
    <template v-if="online_classes.data.length > 0">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 2xl:grid-cols-4 gap-3 mt-5">
            <div v-for="online_class in online_classes.data" :key="online_class.id"
                class="bg-white  rounded-lg dark:bg-gray-800">
                <single-online-class :item="online_class" :action="$page.props.auth.role == 'Teacher' ? '' : 'not-show'" :editFunction="edit" />
            </div>
        </div>
    </template>
    <template v-else>
        <NothingFound asShow="div" cssClass="mt-4 text-center" />
    </template>
    <div class="flex justify-center col-span-3">
        <pagination class="mt-6" :links="online_classes.links" />
    </div>
    <br>
    <br>
    <!-- online class create modal  -->
    <online-class :course="course" :subjects="subjects" :edit_item="edit_item" ref="online_class_form" />
</template>

<script>
    import Pagination from "@/Shared/Admin/Pagination.vue";
    import {
        CalendarIcon,
    } from "@heroicons/vue/24/outline";
    import SingleOnlineClass from './../../../Pages/Teacher/SingleOnlineClass.vue'
    import OnlineClass from "./../../../Pages/Teacher/OnlineClass.vue";
    import NothingFound from "@/Shared/NothingFound.vue";
    export default {
        props: {
            online_classes: Object,
            request_data: Object,
            course: Object,
            subjects: Object
        },
        components: {
            Pagination,
            SingleOnlineClass,
            OnlineClass,
            NothingFound
        },
        data() {
            return {
                edit_item: null
            }
        },
        methods: {
            showModal() {
                this.$refs.online_class_form.showModal();
            },
            edit(arg) {
                this.edit_item = arg;
                this.$refs.online_class_form.showModal();
            },
        }
    };
</script>
<style scoped>
</style>
