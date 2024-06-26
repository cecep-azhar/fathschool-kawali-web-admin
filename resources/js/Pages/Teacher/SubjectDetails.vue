<template>
    <Head :title="course.name" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="course.name" />
        </Breadcrumb>

        <div class="my-2">
            <page-header class="flex-wrap">
                {{ course.name }}
                <template #content>
                    <heading :course="course" :request_data="request_data" />
                </template>
            </page-header>
            <div >
                <div >
                    <!-- Subject details  -->
                    <div v-if="request_data.tab == 'details' || !request_data.tab" >
                        <details-component :course="course" :next_course="next_course" :subject_teachers="subject_teachers"
                            :upcoming_assignments="upcoming_assignments" :upcoming_classes="upcoming_classes" />
                    </div>

                    <!-- Subject schedule  -->
                    <div v-if="request_data.tab == 'schedule'" >
                        <schedule-component :schedules="schedules" />
                    </div>

                    <!-- Subject students  -->
                    <div v-if="request_data.tab == 'students'" >
                        <students-component :students="students" />
                    </div>

                    <!-- Subject assignment  -->
                    <div v-if="request_data.tab == 'assignments'" >
                        <assignments-component :assignments="assignments" />
                    </div>

                    <!-- online class  -->
                    <template v-if="request_data.tab == 'online-class'">
                        <online-class-component :online_classes="online_classes" :request_data="request_data"
                            :course="course" :subjects="subjects" />
                    </template>

                    <!-- Syllabus  -->
                    <template v-if="request_data.tab == 'syllabus'">
                        <syllabus-component :syllabuses="syllabuses" />
                    </template>
                </div>
                <br>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Heading from "@/Shared/Teacher/SubjectDetails/Heading.vue";
import DetailsComponent from "@/Shared/Teacher/SubjectDetails/Details.vue";
import ScheduleComponent from "@/Shared/Teacher/SubjectDetails/Schedule.vue";
import StudentsComponent from "@/Shared/Teacher/SubjectDetails/Student.vue";
import AssignmentsComponent from "@/Shared/Teacher/SubjectDetails/Assignments.vue";
import OnlineClassComponent from "@/Shared/Teacher/SubjectDetails/OnlineClass.vue";
import SyllabusComponent from "@/Shared/Teacher/SubjectDetails/Syllabus.vue";

export default {
    data() {
        return {
        };
    },
    props: {
        course: Object,
        assignments: Object,
        students: Object,
        request_data: Object,
        online_classes: Object,
        next_course: Object,
        subjects: Object,
        schedules: Object,
        syllabuses: Object,
        subject_teachers: Array,
        upcoming_assignments: Object,
        upcoming_classes: Object
    },
    components: {
        AppLayout,
        Heading,
        DetailsComponent,
        ScheduleComponent,
        StudentsComponent,
        AssignmentsComponent,
        OnlineClassComponent,
        SyllabusComponent
    },
    methods: {
    },
};
</script>
