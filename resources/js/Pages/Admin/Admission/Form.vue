<template>
    <AppLayout :title="__('Student Admission')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Student Admission')" />
        </Breadcrumb>

        <div class="mx-auto pb-12">
            <div
                class="rounded-lg flex justify-between items-center mb-4 py-4 px-6 text-lg font-semibold rtl:text-right text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                <div class="dark:text-gray-400">
                    {{ __('Student Admission') }}
                </div>
                <Link preserve-scroll :href="route('student.admission.all')">
                <global-button :loading="false" type="button" theme="primary">
                    {{ __('All Student') }}
                </global-button>
                </Link>
            </div>

            <!-- component -->
            <div class="w-full xl:w-1/2 mx-auto">
                <div class="flex items-center">
                    <div :class="wizard > 1 ? 'text-blue-600 ' : 'text-gray-500'" class="flex items-center relative">
                        <div :class="wizard > 1 ? 'border-blue-600' : 'border-white'"
                            class="rounded-full transition duration-500 ease-in-out h-11 w-11 py-2.5 border-2 ">
                            <CheckCircleIcon v-if="wizard > 1" width="100%" height="100%" class="w-full h-full" />
                            <UserCircleIcon v-else width="100%" height="100%" class="w-full h-full" />
                            <div
                                class="absolute sm:whitespace-nowrap -top-3 -ml-0.5 w-full text-center mt-16 text-xs font-bold">
                                {{ __('Student Information') }}
                            </div>
                        </div>
                    </div>
                    <div :class="wizard > 1 ? 'border-blue-600' : 'border-white'"
                        class="flex-auto border-t-4 transition duration-500 ease-in-out"></div>
                    <div :class="wizard > 2 ? 'text-blue-600 ' : 'text-gray-500'" class="flex items-center relative">
                        <div :class="wizard > 2 ? 'border-blue-600' : 'border-white'"
                            class="rounded-full transition duration-500 ease-in-out h-11 w-11 py-2.5 border-2">
                            <CheckCircleIcon v-if="wizard > 2" width="100%" height="100%" class="w-full h-full" />
                            <UsersIcon v-else width="100%" height="100%" class="w-full h-full" />
                            <div
                                class="absolute sm:whitespace-nowrap -top-3 -ml-8 w-full text-center mt-16 text-xs font-bold">
                                {{ __('Parent Information') }}
                            </div>
                        </div>
                    </div>
                    <div :class="wizard > 2 ? 'border-blue-600' : 'border-white'"
                        class="flex-auto border-t-4 transition duration-500 ease-in-out"></div>
                    <div :class="wizard > 2 ? 'text-blue-600 ' : 'text-gray-500'" class="flex items-center relative">
                        <div :class="wizard > 2 ? 'border-blue-600' : 'border-white'"
                            class="rounded-full transition duration-500 ease-in-out h-11 w-11 py-2.5 border-2">
                            <BanknotesIcon width="100%" height="100%" class="w-full h-full" />
                            <div
                                class="absolute sm:whitespace-nowrap -ml-10 -top-3 w-full text-center mt-16 text-xs font-bold">
                                {{ __('Course & Plan') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full xl:w-1/2 mx-auto rounded-lg mt-12">
                <form class="mt-2" @submit.prevent="submit()" enctype="multipart/form-data">
                    <div class="grid sm:grid-cols-1 md:grid-cols-1 sm:gap-1 md:gap-4">
                        <!-- Step 1 content -->
                        <template v-if="wizard == 1">
                            <div class="bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div class="mb-3">
                                        <global-label for="name" value="Name" :required="true" />
                                        <global-input type="text" v-model="form.name" id="name" name="name"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 testName"
                                            :placeholder="__('Enter Name')" :error="errors_get.name" />
                                        <input-error :error="errors_get.name" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="email" value="Email" :required="true" />
                                        <global-input type="email" v-model="form.email" id="email" name="email"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Email')" :error="errors_get.email" />
                                        <input-error :error="errors_get.email" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div class="mb-3">
                                        <global-label for="email" :value="__('Date of Birth')" :required="true" />
                                        <a-date-picker class="ant-datepicker-custom"
                                            :format="getDateTimeFormat()"
                                            v-model:value="date_of_birth_value" />
                                        <input-error :error="errors_get.date_of_birth" />
                                    </div>
                                    <div class="mb-1">
                                        <global-label for="phone" value="Phone" :required="false" />
                                        <global-input type="number" v-model="form.phone" id="phone"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Phone')" :error="errors_get.phone" />
                                        <input-error :error="errors_get.phone" />
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">

                                <div class="mb-3">
                                    <global-label for="gender" value="Gender" :required="false" />
                                    <global-input type="text" v-model="form.gender" id="gender"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Gender')" :error="errors_get.gender" />
                                    <input-error :error="errors_get.gender" />
                                </div>
                                <div class="mb-1 w-full">
                                    <global-label for="dropzone-file" value="Avatar" :required="false" />
                                    <a-upload :max-count="1" accept="image/*" v-model:file-list="avatar_value" action=""
                                        list-type="picture">
                                        <a-button>
                                            <upload-outlined></upload-outlined>
                                            {{ __('Select Avatar') }}
                                        </a-button>
                                    </a-upload>
                                    <div v-if="admission && !form.avatar" class="mt-2">
                                        <img class="w-12 h-12" :src="admission.profile_photo_url" alt="">
                                    </div>
                                    <input-error :error="errors_get.avatar" />
                                </div>
                            </div>
                        </template>
                        <!-- Step 1 content end  -->

                        <!-- Step 2 content -->
                        <template v-if="wizard == 2">
                            <div>
                                <div
                                    class="w-full bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="mb-1">
                                        <global-label for="parent" value="Select Parents" :required="true" />
                                        <Multiselect id="parent" :close-on-select="true" :can-clear="true"
                                            :searchable="true" v-model="form.parents" mode="tags" :create-option="false"
                                            :placeholder="__('Select Parents')" :options="options3.map(parent => ({
                                                value: parent.id,
                                                label: parent.name,
                                            }))" autocomplete="off" />

                                        <!-- <a-select :class="errors_get.parent ? 'border-custom ' : ''" size="large"
                                            class="width-100" v-model:value="form.parent" show-search
                                            :placeholder="__('Select Parent')" :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur"
                                            @change="studentDataPush">
                                        </a-select> -->


                                        <div class="w-full flex">
                                            <button @click="visible = true" type="button"
                                                class="focus:outline-none text-blue-500 hover:text-blue-400 ml-auto">
                                                {{ __('Add New Parent') }}
                                            </button>
                                        </div>
                                        <input-error :error="errors_get.parents" />
                                    </div>
                                </div>
                                <template v-if="selected_parents.length > 0">
                                    <template v-for="(parent, index) in selected_parents" :key="index">
                                        <div
                                            class="w-full mt-1 bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">
                                            <div class="mb-1 py-1" :class="index != 0 ? 'mt-2' : ''">
                                                <div class="flex items-center gap-6">
                                                    <div class="ml-4">
                                                        <img class="rounded-lg h-16 w-16" :src="parent.profile_photo_url"
                                                            :alt="parent.name" />
                                                    </div>
                                                    <div
                                                        class="w-full gap-6 md:flex items-center justify-between mr-12 mt-1 pr-1">
                                                        <div>
                                                            <div
                                                                class="text-xl text-gray-800 dark:text-gray-400 hover:text-gray-900">
                                                                {{ parent.name }}
                                                            </div>
                                                            <div class="flex items-center dark:text-gray-400">
                                                                {{ parent.email }}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="flex font-semibold dark:text-gray-400">
                                                                <div>{{ __('Phone Number') }} : </div>
                                                                <div class="ml-2">
                                                                    {{ parent.phone }}
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="flex font-semibold dark:text-gray-400 whitespace-nowrap">
                                                                <div>{{ __('Address') }} : </div>
                                                                <div class="ml-2">
                                                                    {{ parent.address }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </template>
                            </div>
                            <div
                                class="w-full bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">
                                <div class="mb-3">
                                    <global-label for="blood_group" value="Blood Group" :required="false" />
                                    <Multiselect id="blood_group" :close-on-select="true" :can-clear="false"
                                        :searchable="true" v-model="form.blood_group" :create-option="false"
                                        :placeholder="__('Blood Group')" :options="[
                                            { value: 'A+', label: 'A+' },
                                            { value: 'A-', label: 'A-' },
                                            { value: 'B+', label: 'B+' },
                                            { value: 'B-', label: 'B-' },
                                            { value: 'O+', label: 'O+' },
                                            { value: 'O-', label: 'O-' },
                                            { value: 'AB+', label: 'AB+' },
                                            { value: 'AB-', label: 'AB-' },
                                        ]" autocomplete="off" />
                                    <input-error :error="$page.props.errors.blood_group" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="physical_disability" value="Physical Disability" :required="false" />
                                    <global-input id="physical_disability" v-model="form.physical_disability" type="text"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Physical Disability')"
                                        :error="$page.props.errors.physical_disability" />
                                    <input-error :error="$page.props.errors.physical_disability" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="religion" value="Religion" :required="false" />
                                    <global-input id="religion" v-model="form.religion" type="text"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Religion')" :error="$page.props.errors.religion" />
                                    <input-error :error="$page.props.errors.religion" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="previous_school_name" value="Previous School Name"
                                        :required="false" />
                                    <global-input id="previous_school_name" v-model="form.previous_school_name" type="text"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Previous School Name')"
                                        :error="$page.props.errors.previous_school_name" />
                                    <input-error :error="$page.props.errors.previous_school_name" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="previous_school_year_of_exist" value="Previous School Year Of Exist"
                                        :required="false" />
                                    <global-input id="previous_school_year_of_exist"
                                        v-model="form.previous_school_year_of_exist" type="text"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Previous School Year Of Exist')"
                                        :error="$page.props.errors.previous_school_year_of_exist" />
                                    <input-error :error="$page.props.errors.previous_school_year_of_exist" />
                                </div>
                                <div class="mb-3">
                                    <global-label for="document" value="Document" :required="false" />
                                    <div v-for="(item, index) in document_size" :key="index"
                                        class="flex items-center gap-3 mb-2">
                                        <div class="w-full">
                                            <global-input type="text" v-model="form.document_titles[index]"
                                                :id="'title' + index"
                                                class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Document Title')" :error="$page.props.errors.note" />
                                        </div>
                                        <div class="w-full">
                                            <input type="file" @change="picDocs"
                                                :class="$page.props.errors.document ? 'border-red-500 dark:border-red-500' : ''"
                                                :id="'document' + index" name="document"
                                                accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"
                                                class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="" />
                                        </div>
                                        <div @click="addDocument(index)">
                                            <global-button :loading="loading" type="button" cssClass="font-bold"
                                                :theme="index == 0 ? 'primary' : 'danger'">
                                                <PlusCircleIcon v-if="index == 0" class="w-6 h-6" />
                                                <MinusCircleIcon v-else class="w-6 h-6" />
                                            </global-button>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-3 p-1"
                                        v-if="admission && admission.documents.length > 0">
                                        <div class="relative mt-2" v-for="(doc, index) in admission.documents"
                                            :key="doc.id">
                                            <a :href="doc.file_url_format" download>
                                                {{ __('Download Document') }} ({{ index + 1 }})
                                            </a>
                                            <button @click="removeDoc(doc.id)" type="button"
                                                class="absolute -top-4 bg-red-500 rounded-full -right-3">
                                                <trash-icon class="w-6 h-6 text-white p-0.5" />
                                            </button>
                                        </div>
                                    </div>
                                    <input-error :error="$page.props.errors.document" />
                                </div>
                                <div class="mb-1">
                                    <global-label for="note" value="Note" :required="false" />
                                    <global-textarea v-model="form.note" id="note"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        placeholder="Note" :error="$page.props.errors.note" />
                                    <input-error :error="$page.props.errors.note" />
                                </div>
                            </div>
                        </template>
                        <!-- Step 2 content end -->
                    </div>

                    <!-- Step 3 content end -->
                    <template v-if="wizard == 3">
                        <template v-if="$page.props.errors">
                            <div v-for="(error, index) in $page.props.errors" :key="index"
                                class="md:w-1/2 mx-auto p-4 mb-1 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <div class="ml-4">
                                    {{ error }}
                                </div>
                            </div>
                            <div class="mt-2"></div>
                        </template>
                        <div
                            class="col-span-1 md:col-span-3 bg-white dark:text-gray-400 dark:bg-gray-800 mt-4 mb-4 px-6 rounded-md py-3 text-lg font-bold">
                            {{ __('Select Course') }}
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 object-cover gap-4">
                            <label :for="'course' + index" v-for="(course, index) in courses" :key="index"
                                :class="form.courses === course.id ? 'border-l-4 border-blue-500' : 'border-l-4 border-white'"
                                class="bg-white dark:bg-gray-800 cursor-pointer shadow rounded-lg p-6 pb-4 relative z-30">
                                <div class="flex justify-between items-center mb-4">
                                    <h5 class="text-2xl mb-0 font-medium text-gray-700 dark:text-gray-400">
                                        {{ course.name }}
                                    </h5>
                                    <div class="">
                                        <input :checked="form.courses === course.id"
                                            @change="getPlan($event, course.id)"
                                            class="rounded-full border border-gray-400 p-2 w-6 h-6" type="radio"
                                            :id="'course' + index" name="courses" />
                                    </div>
                                </div>
                                <!-- List -->
                                <ul role="list" class="space-y-3 my-2">
                                    <li class="font-bold ">
                                        {{ course.subjects.length }} Subjects
                                    </li>
                                    <li v-for="subject in course.subjects" :key="subject.id"
                                        class="flex space-x-2 items-center">
                                        <!-- Icon -->
                                        <BookOpenIcon class="flex-shrink-0 w-6 h-6 text-blue-600 dark:text-blue-500" />
                                        <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">
                                            {{ subject.name }}
                                        </span>
                                    </li>
                                </ul>
                            </label>
                            <input-error :error="$page.props.errors.course" />
                        </div>
                        <template v-if="courses_plans.length > 0">
                            <div
                                class="col-span-1c md:col-span-3 bg-white dark:text-gray-400 dark:bg-gray-800 mt-4 mb-4 px-6 rounded-md py-3 text-lg font-bold">
                                {{ __('Select Plan') }}
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 object-cover gap-4">
                                <label :for="'plan' + index" v-for="(plan, index) in courses_plans" :key="index"
                                    :class="form.plan == plan.id ? 'border-l-4 border-blue-500' : 'border-l-4 border-white'"
                                    class="bg-white dark:bg-gray-800 cursor-pointer shadow rounded-lg p-6 relative z-30">
                                    <div class="flex justify-between items-center mb-4">
                                        <h5 class="mb-0 text-2xl font-medium text-gray-700 dark:text-gray-400">
                                            {{ plan.title }}
                                        </h5>

                                        <div class="">
                                            <input v-model="form.plan" :value="plan.id" :checked="form.plan == plan.id"
                                                class="rounded-full border border-gray-400 p-2 w-6 h-6" type="radio"
                                                :id="'plan' + index" name="plan" />
                                        </div>
                                    </div>
                                    <div class="flex items-baseline text-gray-900 dark:text-white">
                                        <span class="text-lg font-semibold">
                                            {{ app_currency.symbol ?? '' }}
                                        </span>
                                        <span class="text-xl font-extrabold tracking-tight">
                                            {{ plan.price }}
                                        </span>
                                        <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">
                                            /month
                                        </span>
                                    </div>
                                    <div class="text-sm mt-1 text-gray-400">
                                        {{ plan.description }}
                                    </div>
                                    <ul role="list" class="space-y-5 my-4">
                                        <li class="font-bold dark:text-gray-400">
                                            {{ __('Benefits') }}
                                        </li>
                                        <li v-for="benefit in plan.benefits" :key="benefit.id"
                                            class="flex items-center space-x-2">
                                            <CheckCircleIcon
                                                class="flex-shrink-0 w-6 h-6 text-blue-600 dark:text-blue-500" />
                                            <span
                                                class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">
                                                {{ benefit.title }}
                                            </span>
                                        </li>
                                    </ul>
                                </label>
                                <input-error :error="$page.props.errors.course" />
                            </div>
                        </template>
                    </template>
                    <div class="flex justify-end gap-2">
                        <button @click="wizardChange('prev')" v-if="wizard > 1"
                            class="text-pink-500 border border-pink-500 hover:bg-pink-500 hover:text-white active:bg-pink-600 font-bold w-1/4 mt-3 py-2 rounded outline-none focus:outline-none ease-linear transition-all duration-150"
                            type="button">
                            {{ __('Back') }}
                        </button>
                        <global-button @click="wizardChange('next')" v-if="wizard < 3" :loading="false" type="button"
                            cssClass="w-1/4 mt-3 py-1 font-bold" theme="primary">
                            {{ __('Next') }}
                        </global-button>
                        <global-button v-if="wizard == 3" :loading="form.processing" type="submit"
                            cssClass="w-1/4 mt-3 font-bold" theme="primary">
                            {{ __('Save') }}
                        </global-button>
                    </div>
                </form>
            </div>
        </div>
        <!-- add parent modal  -->
        <a-modal v-model:visible="visible" title="Add Parent" @ok="hide">
            <template #footer>
                <a-button key="back" @click="hide">
                    {{ __('Close') }}
                </a-button>
            </template>
            <div class="dark:bg-gray-800 rounded-lg dark:text-gray-400">
                <div class="rounded-lg">
                    <form @submit.prevent="storeParent()">
                        <div
                            class="w-full bg-white rounded-lg border border-white p-4 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-3">
                                <global-label for="name" value="Name" :required="true" />
                                <global-input type="text" v-model="createParent.name" id="name" name="name"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter Name')"
                                    :error="errors_get && errors_get.name ? errors_get.name[0] : ''" />
                                <input-error :error="errors_get && errors_get.name ? errors_get.name[0] : ''" />
                            </div>
                            <div class="mb-3">
                                <global-label for="email" value="Email" :required="true" />
                                <global-input type="email" v-model="createParent.email" id="email" name="email"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Enter Email')"
                                    :error="errors_get && errors_get.email ? errors_get.email[0] : ''" />
                                <input-error :error="errors_get && errors_get.email ? errors_get.email[0] : ''" />
                            </div>
                            <div class="mb-3">
                                <global-label for="password" value="Password" :required="true" />
                                <global-input type="password" v-model="createParent.password" id="password"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                    :placeholder="__('Password')"
                                    :error="errors_get && errors_get.password ? errors_get.password[0] : ''" />
                                <input-error :error="errors_get && errors_get.password ? errors_get.password[0] : ''" />
                            </div>
                        </div>
                        <global-button :loading="createParent.processing" type="submit" cssClass="w-full mt-3"
                            theme="primary">
                            {{ __('Add Parent') }}
                        </global-button>
                    </form>
                </div>
            </div>
        </a-modal>
        <!-- add parent modal  -->
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';
import { useForm } from '@inertiajs/inertia-vue3';
import dayjs from "dayjs";
import { PlusCircleIcon, TrashIcon, MinusCircleIcon, CheckCircleIcon, BanknotesIcon, UserCircleIcon, UsersIcon, BookOpenIcon } from '@heroicons/vue/24/outline'

export default {
    components: {
        AppLayout,
        Multiselect,
        PlusCircleIcon,
        CheckCircleIcon,
        BookOpenIcon,
        UserCircleIcon,
        UsersIcon,
        BanknotesIcon,
        TrashIcon,
        MinusCircleIcon
    },
    props: {
        parents: Object,
        courses: Object,
        admission: Object,
        plans: Object,
        app_currency: Object,
        user_courses: Array,
        admission_parents: Array,
    },
    data() {
        return {
            wizard: 1,
            visible: false,
            date_of_birth_value: this.admission ? this.admission.date_of_birth ? dayjs(this.admission.date_of_birth) : null : null,
            errors_get: {},
            avatar_value: null,
            document_size: [1],
            selected_parents: [],
            options3: this.parents,
            courses_plans: [],
            form: useForm({
                admission: true,
                name: this.admission ? this.admission.name : '',
                email: this.admission ? this.admission.email : '',
                user_type: "Student",
                avatar: null,
                phone: this.admission ? this.admission.phone : '',
                address: this.admission ? this.admission.address : '',
                parents: this.admission_parents ?? [],
                // note: this.admission ? this.admission.profile.note : '',
                // blood_group: this.admission ? this.admission.profile.blood_group : '',
                // physical_disability: this.admission ? this.admission.profile.physical_disability : '',
                // religion: this.admission ? this.admission.profile.religion : '',
                // previous_school_name: this.admission ? this.admission.profile.previous_school_name : '',
                // previous_school_year_of_exist: this.admission ? this.admission.profile.previous_school_year_of_exist : '',
                courses: this.user_courses ?? [],
                // plan: this.admission ? this.admission.profile.plan_id : '',
                gender: this.admission ? this.admission.gender : '',
                date_of_birth: this.admission ? this.admission.date_of_birth : '',
                documents: [],
                document_titles: [],
                _method: this.admission ? 'PUT' : 'POST',
            }),
            createParent: {
                name: '',
                email: '',
                password: '',
                user_type: 'Parent'
            }
        };
    },
    watch: {
        'form.courses': {
            handler(val, oldVal) {
                this.courses_plans = [];
                val.forEach(id => {
                    this.courses.forEach(course => {
                        if (course.id == id) {
                            course.plans.forEach(plan => {
                                this.courses_plans.push(plan)
                            });
                        }
                    });
                });
            },
            deep: true,
            immediate: true,
        },
        'form.parents': {
            handler(val, oldVal) {
                this.selectedParent();
            },
            deep: true,
            immediate: true,
        },
        date_of_birth_value: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal) {
                    this.form.date_of_birth = dayjs(newVal).format('YYYY-MM-DD');
                } else {
                    this.form.date_of_birth = null;
                }
            },
        },
        avatar_value: {
            deep: true,
            handler(newVal, oldVal) {
                if (newVal.length > 0) {
                    this.form.avatar = newVal[0].originFileObj;
                } else {
                    this.form.avatar = null;
                }
            },
        },

    },
    methods: {
        removeDoc(id) {
            if (confirm('Are your sure ??')) {
                this.$inertia.post(
                    this.route("admin.doc.destroy", id),
                    {
                        preserveScroll: true,
                    }
                );
            }
        },
        selectedParent(parent) {
            this.selected_parents = []; //first empty selected parent var

            this.form.parents.forEach(parent => {
                this.parents.forEach(get_parent => {
                    if (get_parent.id == parent) {
                        this.selected_parents.push(get_parent);
                    }
                });
            });

        },
        picDocs(e) {
            this.form.documents.push(e.target.files[0]);
        },
        submit() {
            if (this.date_of_birth_value) {
                this.form.date_of_birth = dayjs(this.date_of_birth_value).format('DD-MM-YYYY')
            } else {
                this.form.date_of_birth = null
            }

            if (this.admission) {
                this.form.post(this.route("users.update", this.admission.id), {
                    preserveScroll: true,
                });
            } else {
                this.form.post(this.route("users.store"), {
                    preserveScroll: true,
                    onSuccess: () => {
                    },
                });
            }
        },
        getPlan(event, course) {
            if (event.target.checked) {
                if (!this.form.courses.includes(course)) {
                    this.form.courses.push(course);
                }
            } else {
                let arr = this.form.courses;
                arr.splice(arr.indexOf(course), 1);
                this.form.courses = arr;
            }
        },
        wizardChange(arg) {
            if (arg == 'next') {
                let validate = this.validationPart(this.wizard);
                if (!validate) {
                    this.wizard = this.wizard + 1;
                }
            } else {
                this.wizard = this.wizard - 1;
            }
        },
        isValidEmail(email) {
            return /^[^@]+@\w+(\.\w+)+\w$/.test(email);
        },
        addDocument(index) {
            if (index == 0) {
                this.document_size.push(1);
            } else {
                this.document_size.splice(index, 1)
                this.form.document_titles.splice(index, 1)
                this.form.documents.splice(index, 1)
            }
        },
        validationPart(wizard) {
            let hasError = false;
            if (wizard == 1) {
                if (!this.form.name) {
                    Object.assign(this.errors_get, {
                        name: 'The name field is required'
                    });
                    hasError = true;
                }
                if (!this.form.email) {
                    Object.assign(this.errors_get, {
                        email: 'The email field is required'
                    });
                    hasError = true;
                }
                if (!this.isValidEmail(this.form.email)) {
                    Object.assign(this.errors_get, {
                        email: 'The email is invalid .'
                    });
                    hasError = true;
                }
                if (!this.form.date_of_birth) {
                    Object.assign(this.errors_get, {
                        date_of_birth: 'The date of birth field is required .'
                    });
                    hasError = true;
                }
                // if (!this.admission && !this.form.avatar) {
                //     Object.assign(this.errors_get, {
                //         avatar: 'The avatar field is required .'
                //     });
                //     hasError = true;
                // }
            } else if (wizard == 2) {
                if (!this.form.parents.length > 0) {
                    Object.assign(this.errors_get, {
                        parents: 'The parents field is required .'
                    });
                    hasError = true;
                }
            } else {
                if (!this.form.plan) {
                    Object.assign(this.errors_get, {
                        plan: 'The plan field is required .'
                    });
                    hasError = true;
                }
            }
            return hasError;
        },
        hide() {
            this.visible = false;
        },
        storeParent() {
            axios.post(this.route("parent.store"), this.createParent)
                .then((res) => {
                    this.createParent.name = "";
                    this.createParent.email = "";
                    this.createParent.password = "";
                    this.$toast.open({
                        message: "Parent Added Successful .",
                        type: "success",
                    });
                    this.fetchParent();
                    this.hide();
                })
                .catch((e) => {
                    if (!e.response) {
                        this.fetchParent();
                        this.hide();
                    }
                    if (e.response) {
                        this.errors_get = e.response.data.errors;
                    }
                    setTimeout(() => {
                        this.errors_get = null
                    }, 5000);
                })
        },
        fetchParent() {
            axios.post(this.route("admin.parent.index"))
                .then((res) => {
                    if (res.data.data) {
                        this.options3 = res.data.data;
                    }
                })
                .catch((e) => {
                    this.$toast.open({
                        message: "Parent Fetch Failed .",
                        type: "Error",
                    });
                })
        },
    },
};
</script>
<style>
.ant-tooltip-content {
    display: none !important;
}

.ant-tooltip .ant-tooltip-placement-top {
    display: none !important;
}

.ant-upload-list-picture .ant-upload-list-item-error,
.ant-upload-list-picture-card .ant-upload-list-item-error {
    border-color: green;
}

.ant-upload-list-item-error,
.ant-upload-list-item-error .ant-upload-text-icon>.anticon,
.ant-upload-list-item-error .ant-upload-list-item-name {
    color: green;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}

.ant-datepicker-custom {
    display: block;
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.ant-datepicker-custom-border {
    border-color: red;
    border-right-width: 1px !important;
}

.ant-upload-list {
    width: 100%;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    color: rgba(0, 0, 0, 0.85);
    font-size: 14px;
    font-variant: tabular-nums;
    list-style: none;
    line-height: 1.5715;
}
</style>
