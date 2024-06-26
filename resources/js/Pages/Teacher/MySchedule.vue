<template>
    <AppLayout :title="__('MY Schedule')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('MY Schedule')"/>
        </Breadcrumb>

        <div >
            <page-header class="flex items-center justify-between">
                {{ __('MY Schedule') }}
            </page-header>
            <div class="mb-3">
                <form class="items-center grid grid-cols-1  gap-6" :class="teachers ? 'md:grid-cols-4': 'md:grid-cols-3'" @submit.prevent="filterData()">
                    <div class="mt-0.5 xl:col-span-1 md:col-span-2">
                        <global-label for="name" value="Select Course" :required="false" />
                        <Multiselect id="class" class="dark:text-gray-900" v-model="filter.course_id" :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false" :placeholder="__('Select Course')" :options="classes.map(item => ({ value: item.id, label: item.name }))" autocomplete="off" />
                    </div>
                    <div class="mt-0.5 xl:col-span-1 md:col-span-2">
                        <global-label for="name" value="Select Subject" :required="false" />
                        <Multiselect id="subject" class="dark:text-gray-900" v-model="filter.subject_id" :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false" :placeholder="__('Select Subject')" :options="filter_subjects.map(item => ({ value: item.id, label: item.name }))" autocomplete="off" />
                    </div>
                    <div v-if="teachers" class="mt-0.5 xl:col-span-1 md:col-span-2">
                        <global-label for="name" value="Select Teacher" :required="false" />
                        <Multiselect id="teacher" class="dark:text-gray-900" v-model="filter.teacher_id" :close-on-select="true" :can-clear="false" :searchable="true" :create-option="false" :placeholder="__('Select Teacher')" :options="teachers.map(item => ({ value: item.id, label: item.name }))" autocomplete="off" />
                    </div>
                    <div class="col-span-1 md:mt-5 xl:col-span-1 md:col-span-2 xl:flex xl:justify-end">
                        <global-button :loading="filter.processing" type="submit" theme="primary">
                            {{__('Search')}}
                        </global-button>
                    </div>
                </form>
            </div>
            <div class="col-span-2 bg-white overflow-x-auto rounded-lg dark:bg-gray-800 p-6">
                <FullCalendar :options="calendarOptions" class="min-w-[991px]" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from '@/Shared/Admin/Pagination.vue';
import ToolTip from '@/Shared/ToolTip.vue';
import { useForm } from '@inertiajs/inertia-vue3';

import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin, { Draggable } from "@fullcalendar/interaction";
import dayjs, { Dayjs } from 'dayjs';

import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';

export default {
    components: {
        AppLayout,
        ToolTip,
        Pagination,
        ToolTip,

        FullCalendar,
        Multiselect
    },
    props: {
        routines: Object,
        schedules:Array,
        classes:Array,
        teachers:Array,
        query:Object,
    },
    data() {
        return {

            filter: useForm({
                course_id: this.query.course_id ?? '',
                subject_id: this.query.subject_id ?? '',
                teacher_id: this.query.teacher_id ?? '',
            }),

            calendarOptions: {
                locale: this.$page.props.locale,
                plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                initialView: 'timeGridWeek',
                selectable: false,
                editable: false,
                height: 800,
                buttonText: {
                    prev: this.__('prev'),
                    next: this.__('next'),
                    today: this.__('today'),
                    month: this.__('month'),
                    week: this.__('week'),
                    day: this.__('day'),
                    list: this.__('list'),
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                // firstDay: this.$page.props.start_day_of_week,
                events: this.schedules,
                eventContent: function(arg) {
                    return {
                        html: arg.event.title.replace(/<br>/g, '<br>')
                    }
                },
            },
            subjects: [],
            filter_subjects: [],
        };
    },

    watch: {
        'form.class': {
            deep: true,
            handler(val) {
                this.loadSubjects('modal')
            },
        },
        'filter.course_id': {
            deep: true,
            handler(val) {
                this.loadSubjects('filter')
            },
        }
    },
    methods: {
        async loadSubjects(type){
            let course_id = type == 'modal' ? this.form.class:this.filter.course_id

            let response = await axios.get(route('fetch.subjects', course_id))

            if(type == 'modal'){
                // this.form.class = ''
                this.subjects = response.data
            }else{
                // this.filter.course_id = ''
                this.filter_subjects = response.data
            }
        },

        filterData() {
            this.filter.get(this.route('my.schedule'), {
                preserveScroll: true
            });
        }
    },
    mounted(){
        this.loadSubjects('filter')
    }
};
</script>

