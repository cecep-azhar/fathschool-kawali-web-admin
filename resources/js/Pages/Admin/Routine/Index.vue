<template>
    <AppLayout :title="__('Class Schedule')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Class Schedule')" />
        </Breadcrumb>

        <div>
            <page-header class="flex items-center justify-between">
                {{ __('Class Schedule') }}

                <template #content>
                    <global-button :loading="false" type="link" :url="route('routine.create')" theme="primary">
                        {{ __('Add New') }}
                    </global-button>
                </template>
            </page-header>

            <div
                class="rounded-lg mb-4 py-4 px-6 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                <h1 class="text-lg dark:text-white">{{ __('Filter By') }}</h1>
                <form class="grid items-end grid-cols-1 xl:grid-cols-4 gap-[18px]" @submit.prevent="filterData()">
                    <div class="mt-0.5">
                        <global-label for="name" value="Select Course" :required="false" />
                        <Multiselect id="class" class="dark:text-gray-900" v-model="filter.course_id"
                            :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                            :placeholder="__('Select Course')"
                            :options="classes.map(item => ({ value: item.id, label: item.name }))" autocomplete="off" />
                    </div>
                    <div class="mt-0.5">
                        <global-label for="name" value="Select Subject" :required="false" />
                        <Multiselect id="subject" class="dark:text-gray-900" v-model="filter.subject_id"
                            :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                            :placeholder="__('Select Subject')"
                            :options="filter_subjects.map(item => ({ value: item.id, label: item.name }))"
                            autocomplete="off" />
                    </div>
                    <div class="mt-0.5">
                        <global-label for="name" value="Select Teacher" :required="false" />
                        <Multiselect id="teacher" class="dark:text-gray-900" v-model="filter.teacher_id"
                            :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                            :placeholder="__('Select Teacher')"
                            :options="teachers.map(item => ({ value: item.id, label: item.name }))" autocomplete="off" />
                    </div>
                    <div>
                        <global-button :loading="filter.processing" type="submit" theme="primary">
                            {{ __('Apply Filter') }}
                        </global-button>
                    </div>
                </form>
            </div>
            <div class="col-span-2 bg-white overflow-x-auto rounded-lg dark:bg-gray-800 p-6">
                <FullCalendar :options="calendarOptions" class="min-w-[991px]" />
            </div>
        </div>

        <!-- Create Schedule Modal  -->
        <a-modal v-model:visible="modal_show" :title="this.form.id
            ? 'Update Routine Schedule'
            : 'Create Routine Schedule'
            " @ok="modal_show = false">
            <template #footer>
                <a-button key="back" @click="modal_show = false">Close</a-button>
            </template>
            <div class="p-6 dark:text-gray-400">
                <div class="w-full">
                    <div class="w-full p-4 dark:bg-gray-800 dark:border-gray-700 rounded-lg">
                        <div class="mb-3">
                            <global-label for="class" value="Select Weekdays" />
                            <input :value="form.weekname" type="text"
                                class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class="mb-3">
                            <global-label for="class" value="Schedule Time" />
                            <input :value="form.start_time + ' - ' + form.end_time" type="text"
                                class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div class="mb-3">
                            <global-label for="teacher" value="Teacher" :required="true" />
                            <Multiselect id="teacher" class="dark:text-gray-900" v-model="form.teacher"
                                :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                :placeholder="__('Select Teacher')"
                                :options="teachers.map(item => ({ value: item.id, label: item.name }))"
                                autocomplete="off" />
                            <input-error :error="$page.props.errors.teacher" />
                        </div>
                        <div class="mb-3">
                            <global-label for="class" value="Class" :required="true" />
                            <Multiselect id="class" class="dark:text-gray-900" v-model="form.class" :close-on-select="true"
                                :can-clear="false" :searchable="true" :create-option="false"
                                :placeholder="__('Select Course')"
                                :options="classes.map(item => ({ value: item.id, label: item.name }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.class" />
                        </div>
                        <div class="mb-3">
                            <global-label for="subject" value="Subject" :required="true" />
                            <Multiselect id="subject" class="dark:text-gray-900" v-model="form.subject"
                                :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false"
                                :placeholder="__('Select Subject')"
                                :options="subjects.map(item => ({ value: item.id, label: item.name }))"
                                autocomplete="off" />
                            <input-error :error="$page.props.errors.subject" />
                        </div>
                        <div class="flex justify-between gap-4">
                            <global-button v-if="form.id" :loading="loading" type="button" @click.prevent="deleteData"
                                class="text-white bg-red-500 dark:bg-red-500  hover:bg-red-500 active:bg-red-600 dark:active:bg-red-600 focus:border-red-600 dark:focus:border-red-600 focus:ring focus:ring-red-300 w-full mt-3 dark:focus:ring-red-300">
                                {{ __('Delete') }}
                            </global-button>
                            <global-button :loading="loading" type="button" @click.prevent="saveData"
                                class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 w-full mt-3 dark:focus:ring-blue-300">
                                {{ __('Save') }}
                            </global-button>
                        </div>
                    </div>
                </div>
            </div>
        </a-modal>

        <custom-modal :show="eventDetailModal" @close="eventDetailModal = false">
            <template #title>
                <div class="text-left">
                </div>
            </template>
            <template #icon>
                <div @click="eventEdit()" class="cursor-pointer">
                    <PencilSquareIcon class="w-6 h-6 text-blue-500" />
                </div>
                <div @click="eventDeleteModalOpen()" class="cursor-pointer">
                    <TrashIcon class="w-6 h-6 text-pink-500" />
                </div>
            </template>
            <template #content>
                <!-- Content -->
                <div v-html="showEvent?.title" class="font-bold mb-2">
                </div>
            </template>
        </custom-modal>
        <!-- Delete confirm modal  -->
        <custom-modal :show="eventDeleteModal" @close="eventDeleteModal = false">
            <template #title>
                <div class="text-left">
                    {{ __('Delete event') }}
                </div>
            </template>
            <template #content>
                <!-- Content -->
                <div class="font-bold mb-2 mt-8">

                    <div class="flex items-center mb-2">
                        <input v-model="eventDeleteForm.event" name="event" id="only_me" type="radio" value="only_me"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="only_me" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            This event
                        </label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input v-model="eventDeleteForm.event" name="event" id="all_events" type="radio" value="all_events"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="all_events" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            This and following events
                        </label>
                    </div>

                </div>
            </template>
            <template #footer>
                <global-button @click="eventDelete()" :loading="eventDeleteForm.processing" type="button" class="mr-2">
                    {{ __('Delete') }}
                </global-button>
            </template>
        </custom-modal>
        <!-- Drug confirm modal  -->
        <custom-modal :show="eventDrugModal" @close="eventDrugModal = false">
            <template #title>
                <div class="text-left">
                    {{ __('Drag event') }}
                </div>
            </template>
            <template #content>
                <!-- Content -->
                <div class="font-bold mb-2 mt-8">

                    <div class="flex items-center mb-2">
                        <input v-model="form.event" name="event" id="only_m1e" type="radio" value="only_me"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="only_m1e" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            This event
                        </label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input v-model="form.event" name="event" id="all_events1" type="radio" value="all_events"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="all_events1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            This and following events
                        </label>
                    </div>

                </div>
            </template>
            <template #footer>
                <global-button @click="eventDroppedUpdate()" :loading="eventDeleteForm.processing" type="button"
                    class="mr-2">
                    {{ __('Update') }}
                </global-button>
            </template>
        </custom-modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { PencilSquareIcon, TrashIcon, EyeIcon } from "@heroicons/vue/24/outline";
import Pagination from '@/Shared/Admin/Pagination.vue';
import ToolTip from '@/Shared/ToolTip.vue';
import { useForm } from '@inertiajs/inertia-vue3';

import "@fullcalendar/core/vdom";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin, { Draggable } from "@fullcalendar/interaction";

import dayjs, { Dayjs } from "dayjs";

import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import CustomModal from '@/Shared/Modal.vue'

export default {
    components: {
        AppLayout,
        ToolTip,
        Pagination,
        TrashIcon,
        PencilSquareIcon,
        EyeIcon,
        ToolTip,
        CustomModal,
        FullCalendar,
        Multiselect,
    },
    props: {
        routines: Object,
        schedules: Array,
        classes: Array,
        teachers: Array,
        query: Object,
    },
    data() {
        return {
            modal_show: false,
            loading: false,
            eventDetailModal: false,
            eventDeleteModal: false,
            eventDrugModal: false,
            filter: useForm({
                course_id: this.query.course_id ?? "",
                subject_id: this.query.subject_id ?? "",
                teacher_id: this.query.teacher_id ?? "",
            }),

            calendarOptions: {
                locale: this.$page.props.locale,
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    listPlugin,
                    interactionPlugin
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    prev: this.__('prev'),
                    next: this.__('next'),
                    today: this.__('today'),
                    month: this.__('month'),
                    week: this.__('week'),
                    day: this.__('day'),
                    list: this.__('list'),
                },
                // firstDay: this.$page.props.start_day_of_week,
                height: 800,
                selectable: true,
                editable: true,
                initialView: 'timeGridWeek',
                events: this.schedules,
                eventContent: function (arg) {
                    return {
                        html: arg.event.title.replace(/<br>/g, '<br>')
                    }
                },
                dateClick: this.dateClick,
                eventClick: this.eventClick,
                select: this.selectEvent,
                eventDrop: this.eventDropped,
                eventResize: this.eventResized,
            },

            form: this.$inertia.form({
                id: "",
                weekname: "",
                weekday: "",
                start_time: "",
                end_time: "",
                class: "",
                teacher: "",
                subject: "",
                type: "",
                event: "only_me"
            }),
            subjects: [],
            filter_subjects: [],
            showEvent: null,
            draggedEvent: null,
            eventDeleteForm: useForm({
                id: null,
                event: 'only_me',
            })
        };
    },

    watch: {
        notices: {
            deep: true,
            handler(val, oldVal) {
                this.notices.forEach((element) => {
                    if (this.notice.id == element.id) {
                        this.notice = element;
                    }
                });
            },
        },
        "form.class": {
            deep: true,
            handler(val) {
                this.loadSubjects("modal");
            },
        },
        "filter.course_id": {
            deep: true,
            handler(val) {
                this.loadSubjects("filter");
            },
        },
        eventDrugModal: {
            deep: true,
            handler(val) {
                if (!val) {
                    if (this.draggedEvent != null) {
                        this.draggedEvent.revert();
                    }
                    // this.calendarOptions.events = this.schedules;
                };
            },
        }
    },
    methods: {
        async refreshSchedule() {
            let response = await axios.get(route("routine.refresh"));
            this.schedules = response.data;
            this.calendarOptions.events = response.data;
        },

        async selectEvent(event) {
            this.loading = false;
            this.form.reset();

            let startTime = event.startStr;
            let endTime = event.endStr;

            this.form.weekday = dayjs(startTime).format("d");
            this.form.weekname = dayjs(startTime).format("dddd");
            this.form.start_time = dayjs(startTime).format("HH:mm:ss");
            this.form.end_time = dayjs(endTime).format("HH:mm:ss");
            this.form.type = "api";

            // check weekend
            let isWeekend = await axios.post(
                route("checkweekend", this.form.weekday)
            );
            if (isWeekend.data) {
                alert("You cannot create a routine on a weekend day.");
                return;
            }

            this.loading = false;
            this.modal_show = true;
        },
        async eventDropped(arg) {
            if (arg.event.extendedProps.is_recurring) {
                this.draggedEvent = arg;
                this.eventDrugModal = true;
            } else {
                this.form.event = 'all_events';
                this.draggedEvent = arg;
                this.eventDroppedUpdate()
            }
        },
        async eventDroppedUpdate() {
            let arg = this.draggedEvent;

            let event = arg.event;
            let startTime = event.startStr;
            let endTime = event.endStr;

            // fetch routine details
            let response = await axios.get(
                route("routine.details", event.id)
            );

            this.form.id = event.id;
            this.form.weekday = dayjs(startTime).format("d");
            this.form.start_time = dayjs(startTime).format("HH:mm:ss");
            this.form.end_time = dayjs(endTime).format("HH:mm:ss");
            this.form.class = response.data.course_id;
            this.form.teacher = response.data.teacher_id;
            this.form.subject = response.data.subject_id;
            this.form.type = "api";
            this.updateData();
            this.draggedEvent = null;
            this.eventDrugModal = false;
        },
        async eventResized(arg) {

            if (arg.event.extendedProps.is_recurring) {
                this.draggedEvent = arg;
                this.eventDrugModal = true;
            } else {
                this.form.event = 'all_events';
                this.draggedEvent = arg;
                this.eventDroppedUpdate()
            }
        },
        async updateData() {
            let response = await axios.put(
                route("routine.update", this.form.id),
                this.form
            );
            this.form.reset();
        },

        async saveData() {
            this.loading = true;

            if (this.form.id) {
                this.form.put(
                    this.route("routine.update", this.form.id),
                    {
                        preserveScroll: true,
                        onSuccess: () => {
                            this.loading = false;
                            this.modal_show = false;
                            this.form.reset();
                            // this.refreshSchedule()
                            window.location.reload();
                        },
                        onError: () => {
                            this.loading = false;
                        },
                    }
                );
            } else {
                this.form.post(this.route("routine.store"), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.loading = false;
                        this.modal_show = false;
                        this.form.reset();
                        // this.refreshSchedule()
                        window.location.reload();
                    },
                    onError: () => {
                        this.loading = false;
                    },
                });
            }
        },
        async eventClick(arg) {
            this.showEvent = arg.event._def;
            console.log(arg.event._def);
            this.eventDetailModal = true;
        },
        eventEdit() {
            this.$inertia.get(this.route('routine.edit', this.showEvent.publicId));
        },
        eventDeleteModalOpen() {
            if (this.showEvent.extendedProps.is_recurring) {
                this.eventDeleteForm.id = this.showEvent.publicId;
                this.eventDeleteModal = true;
            } else {
                this.eventDeleteForm.id = this.showEvent.publicId;
                this.eventDeleteForm.event = 'all_events';
                this.eventDelete()
            }

        },
        eventDelete() {
            if (confirm('Are you sure ?') == true) {
                this.eventDeleteForm.post(this.route("routine.delete"), {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.calendarOptions.events = this.schedules;
                        this.eventDeleteForm.reset();
                        this.eventDeleteModal = false;
                        this.eventDetailModal = false;
                    },
                });
            }
            return false;
        },
        filterData() {
            this.filter.get(this.route("routine.index"), {
                preserveScroll: true,
            });
        },
        async loadSubjects(type) {
            let course_id =
                type == "modal" ? this.form.class : this.filter.course_id;

            let response = await axios.get(route("fetch.subjects", course_id));

            if (type == "modal") {
                this.subjects = [];
                // this.form.class = ''
                this.subjects = response.data;
            } else {
                this.filter_subjects = [];
                // this.filter.course_id = ''
                this.filter_subjects = response.data;
            }
        },
        filterData() {
            this.filter.get(this.route("routine.index"), {
                preserveScroll: true,
            });
        },
    },
    mounted() {
        this.loadSubjects("filter");
    },
};
</script>
