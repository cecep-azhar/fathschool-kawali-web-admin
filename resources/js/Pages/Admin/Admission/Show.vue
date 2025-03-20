<template>
    <AppLayout :title="__('Admission Details')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Admission Details')" />
            <BreadcrumbLink :title="__('Admission Details')" />
        </Breadcrumb>

        <div class="my-2">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ admission.name }} {{ __("Details") }}
                </div>
                <template #content>
                    <div class="flex items-center gap-2">
                        <global-button
                            preserve-scroll
                            :loading="false"
                            :url="
                                route(
                                    'student.admission.request.accept',
                                    admission.id
                                )
                            "
                            type="link"
                            theme="primary"
                        >
                            {{ __("Accept Request") }}
                        </global-button>
                        <global-button
                            :loading="false"
                            preserve-scroll
                            type="button"
                            @click.prevent="destroyAdmission(admission.id)"
                            theme="danger"
                        >
                            {{ __("Reject Request") }}
                        </global-button>
                    </div>
                </template>
            </page-header>
            <div>
                <div
                    class="flex flex-col gap-6 lg:items-start lg:flex-row mb-6"
                >
                    <div
                        class="lg:w-1/2 w-full bg-white dark:bg-gray-800 rounded-lg p-6"
                    >
                        <div
                            class="flex gap-4 items-center pb-4 border-b-2 dark:border-gray-600"
                        >
                            <img
                                :src="admission.profile_image_url"
                                alt=""
                                class="w-20 h-20 rounded-full object-cover"
                            />
                            <div>
                                <h2 class="mb-2 text-lg dark:text-gray-400">
                                    {{ admission.name }}
                                </h2>
                                <p
                                    class="mb-2 text-sm flex gap-1 items-center dark:text-gray-400"
                                >
                                    <EnvelopeIcon class="w-6 h-6" />
                                    {{ admission.email }}
                                </p>
                                <p
                                    class="mb-0 text-sm flex gap-1 items-center dark:text-gray-400"
                                >
                                    <PhoneIcon class="w-6 h-6" />
                                    {{ admission.phone }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pt-4">
                            <div class="flex gap-2">
                                <div>
                                    <Square3Stack3DIcon
                                        class="w-6 h-6 text-blue-600"
                                    />
                                </div>
                                <div class="flex flex-wrap gap-1">
                                    <h4
                                        class="text-gray-900 dark:text-gray-500 mb-1"
                                    >
                                        {{ __("Date of Birth") }}:
                                    </h4>
                                    <h3
                                        class="text-gray-600 dark:text-gray-400 mb-0"
                                    >
                                        {{ admission.date_of_birth ?? "-" }}
                                    </h3>
                                </div>
                            </div>
                            <div class="flex gap-2 col-span-2">
                                <div>
                                    <BookOpenIcon
                                        class="w-6 h-6 text-blue-600"
                                    />
                                </div>
                                <div class="flex flex-wrap gap-1">
                                    <h4
                                        class="text-gray-900 dark:text-gray-500 mb-1"
                                    >
                                        {{ __("Course") }}:
                                    </h4>
                                    <h3
                                        class="text-gray-600 dark:text-gray-400 mb-0"
                                    >
                                        <template v-if="courses.length > 0">
                                            <template
                                                v-for="(
                                                    course, index
                                                ) in courses"
                                                :key="index"
                                            >
                                                {{ course.name }}
                                                <template
                                                    v-if="
                                                        index !=
                                                        courses.length - 1
                                                    "
                                                    >,</template
                                                >
                                            </template>
                                        </template>
                                        <template v-else>-</template>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="lg:w-1/2 w-full bg-white dark:bg-gray-800 rounded-lg"
                    >
                        <div class="text-xl dark:text-gray-400 p-6">
                            {{ __("Student Documents") }}
                        </div>
                        <hr class="dark:border-gray-600" />
                        <ul class="flex flex-col gap-4 mb-0">
                            <template v-if="documents.length > 0">
                                <li
                                    v-for="(document, index) in documents"
                                    :key="index"
                                    class="flex justify-between items-center p-6"
                                >
                                    <div>
                                        <div
                                            class="text-base flex gap-1.5 items-center mb-0 dark:text-gray-400"
                                        >
                                            <DocumentTextIcon class="w-6 h-6" />
                                            {{ document.title }}
                                        </div>
                                    </div>
                                    <a
                                        :href="document.url"
                                        target="_blank"
                                        download=""
                                    >
                                        <FolderArrowDownIcon
                                            class="w-8 h-8 text-blue-600"
                                        />
                                    </a>
                                </li>
                            </template>
                            <template v-else>
                                <li class="flex justify-center items-center">
                                    <NothingFound
                                        asShow="div"
                                        cssClass="text-center"
                                    />
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                <div
                    class="bg-white rounded-lg dark:bg-gray-800 dark:text-gray-400 mb-3"
                >
                    <div class="px-4 text-lg font-bold dark:text-gray-400">
                        <div class="mb-3 pt-3">
                            {{ __("Additional Information") }}
                        </div>
                    </div>
                    <hr class="border-gray-100 dark:border-gray-600" />
                    <div
                        class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 p-6"
                    >
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Gender") }} : {{ admission.gender }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Address") }} : {{ admission.address }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("National Identification Number") }} :
                                {{ admission.national_identification_number }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Blood Group") }} :
                                {{ admission.blood_group }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Physical Disability") }} :
                                {{ admission.physical_disability }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Previous School Name") }} :
                                {{ admission.previous_school_name }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Previous School Year Of Exist") }} :
                                {{ admission.previous_school_year_of_exist }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Religion") }} : {{ admission.religion }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Bank Name") }} :
                                {{ admission.bank_name }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Bank Account Number") }} :
                                {{ admission.bank_account_number }}
                            </div>
                        </div>
                        <div class="py-4 px-6 bg-white dark:bg-gray-900">
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                {{ __("Note") }} : {{ admission.note }}
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-lg dark:bg-gray-800 dark:text-gray-400"
                >
                    <div class="px-4 text-lg font-bold dark:text-gray-400">
                        <div class="mb-3 pt-3">
                            {{ __("Parent") }}
                        </div>
                    </div>
                    <hr class="border-gray-100 dark:border-gray-600" />
                    <div
                        class="grid lg:grid-cols-2 sm:grid-cols-2 grid-cols-1 p-6"
                    >
                        <div
                            class="py-4 px-6 bg-white dark:bg-gray-700 rounded-lg"
                        >
                            <div
                                class="flex items-center gap-2 border dark:border-gray-600 p-3"
                            >
                                <div>
                                    <img
                                        width="100"
                                        height="100"
                                        class="rounded"
                                        :src="
                                            admission.parent_profile_image_url
                                        "
                                    />
                                </div>
                                <div>
                                    <div
                                        class="text-2xl font-bold dark:text-gray-400"
                                    >
                                        {{ admission.guardian_name }}
                                    </div>
                                    <div
                                        class="mt-2 font-semibold dark:text-gray-400"
                                    >
                                        <div class="flex">
                                            <span>{{ __("Email") }}:</span>
                                            <span class="ml-2 capitalize">
                                                {{ admission.guardian_email }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import {
    FolderArrowDownIcon,
    Square3Stack3DIcon,
    BookOpenIcon,
} from "@heroicons/vue/24/outline";

export default {
    components: {
        AppLayout,
        FolderArrowDownIcon,
        Square3Stack3DIcon,
        BookOpenIcon,
    },
    props: {
        documents: Object,
        courses: Object,
        admission: Object,
    },
    data() {},
    methods: {
        destroyAdmission(id) {
            if (confirm("Are you sure to reject the request?")) {
                this.$inertia.delete(
                    this.route("student.admission.request.reject", id)
                );
            } else {
                return false;
            }
        },
    },
};
</script>

<style lang="scss" scoped></style>
