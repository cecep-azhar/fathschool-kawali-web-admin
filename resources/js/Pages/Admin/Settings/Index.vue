<template>
    <AppLayout :title="__('General Settings | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Settings')" />
            <BreadcrumbLink :title="__('General Settings')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                <div class="dark:text-gray-400">
                    {{ __('General Settings') }}
                </div>
            </page-header>

            <SettingLayout>
                <!-- Basic Settings  -->
                <div
                    class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                        <div>
                            <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                {{ __('Basic Setting') }}
                            </h2>
                        </div>
                        <form class="mt-2" @submit.prevent="submit()" enctype="multipart/form-data">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                    <div class="mb-3 grid grid-cols-1 xl:grid-cols-2 gap-3">
                                        <div class="mb-3">
                                            <global-label for="name" :value="__('School Name')" :required="true" />
                                            <global-input type="text" v-model="form.app_name" id="name" name="name"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Enter School Name')" :error="$page.props.errors.name" />
                                            <input-error :error="$page.props.errors.app_name" />
                                        </div>
                                        <div class="mb-3">
                                            <global-label for="code" :value="__('School Code')" :required="false" />
                                            <global-input type="text" v-model="form.school_code" id="code"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Enter School Code')"
                                                :error="$page.props.errors.school_code" />
                                            <input-error :error="$page.props.errors.school_code" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="logo_type_text" :value="__('Website Logo Type')"
                                            :required="true" />
                                        <div class="flex flex-col sm:flex-row gap-2 mt-1">
                                            <div
                                                class="w-full rounded flex items-center rtl:pl-0 rtl:pr-4 pl-4 border border-gray-200 dark:border-gray-700">
                                                <input value="text" id="logo_type_text" v-model="form.logo_type"
                                                    type="radio" name="logo_type"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                <global-label for="logo_type_text"
                                                    class="py-2 ml-2 rtl:ml-0 rtl:mr-2 w-full mt-1 text-sm font-medium text-gray-900 dark:text-gray-400"
                                                    :value="__('Text ( App Name )')" :required="false" />
                                            </div>
                                            <div
                                                class="w-full rounded flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                                <input value="image" id="logo_type_image" type="radio"
                                                    v-model="form.logo_type" name="logo_type"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                                <global-label for="logo_type_image"
                                                    class="py-2 ml-2 rtl:ml-0 rtl:mr-2 w-full mt-1 text-sm font-medium text-gray-900 dark:text-gray-400"
                                                    :value="__('Image ( Logo )')" :required="false" />
                                            </div>
                                        </div>
                                        <input-error :error="$page.props.errors.logo_type" />
                                    </div>
                                    <div v-if="form.logo_type == 'text'" class="mb-3">
                                        <global-label for="text_logo_name" value="Name ( Text Logo )" :required="true" />
                                        <global-input type="text" v-model="form.text_logo_name" id="text_logo_name"
                                            name="text_logo_name"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Text Logo Name')"
                                            :error="$page.props.errors.text_logo_name" />
                                        <input-error :error="$page.props.errors.text_logo_name" />
                                    </div>
                                    <div class="mb-3 grid grid-cols-1 xl:grid-cols-3 gap-3">
                                        <div>
                                            <global-label for="dark_logo_preview" class="mb-1" value="Dark Theme Logo"
                                                :required="true" />
                                            <div class="rounded-md border-2 border-dashed dark:border-gray-600">
                                                <template v-if="dark_logo_preview">
                                                    <div class="flex justify-center items-center relative">
                                                        <div class="p-4">
                                                            <img class="w-48 h-48 object-contain" :src="dark_logo_preview"
                                                                alt="">
                                                        </div>
                                                        <button @click="removeImage('dark_logo_preview')" type="button"
                                                            class="absolute top-2 rtl:right-auto rtl:left-2 right-2 rounded-full p-1 group">
                                                            <trash-icon class="w-4 h-4 text-red-500 hover:text-red-400" />
                                                            <tool-tip class="text-lg" :text="__('Remove image')" />
                                                        </button>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="py-12 px-6  flex flex-col items-center">
                                                        <!-- <PhotoIcon /> -->
                                                        <p
                                                            class="text-md dark:text-gray-400 font-bold text-center text-gray-700">
                                                            {{ __('Click the button below to select the file') }}.
                                                        </p>
                                                        <p class="mb-1 animate-bounce text-gray-700 text-xl">
                                                            ⇓
                                                        </p>
                                                        <label
                                                            class="bg-white dark:bg-gray-400 cursor-pointer px-4 h-9 inline-flex items-center rounded border border-gray-300 shadow-sm text-sm font-medium text-gray-700 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                            {{ __('Select files') }}
                                                            <input type="file" accept="image/*" name="file"
                                                                @change="change($event, 'dark')" class="sr-only">
                                                        </label>
                                                        <p class="text-xs dark:text-gray-400 text-gray-600 mt-4">
                                                            {{ __('Maximum upload file size') }}: 512MB.
                                                        </p>
                                                    </div>
                                                </template>
                                            </div>
                                            <input-error :error="$page.props.errors.dark_logo" />
                                        </div>
                                        <div>
                                            <global-label for="light_logo_preview" class="mb-1" value="Light Theme Logo"
                                                :required="true" />
                                            <div class="rounded-md border-2 border-dashed dark:border-gray-600">
                                                <template v-if="light_logo_preview">
                                                    <div class="flex justify-center items-center relative">
                                                        <div class="p-4">
                                                            <img class="w-48 h-48 object-contain" :src="light_logo_preview"
                                                                alt="">
                                                        </div>
                                                        <button @click="removeImage('light_logo_preview')" type="button"
                                                            class="absolute top-2 right-2 rtl:right-auto rtl:left-2 rounded-full p-1 group">
                                                            <trash-icon class="w-4 h-4 text-red-500 hover:text-red-400" />
                                                            <tool-tip class="text-lg" :text="__('Remove image')" />
                                                        </button>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="py-12 px-6  flex flex-col items-center ">
                                                        <!-- <PhotoIcon /> -->
                                                        <p
                                                            class="text-md dark:text-gray-400 font-bold text-center text-gray-700">
                                                            {{ __('Click the button below to select the file') }}.
                                                        </p>
                                                        <p class="mb-1 animate-bounce text-gray-700 text-xl">
                                                            ⇓
                                                        </p>
                                                        <label
                                                            class="bg-white px-4 dark:bg-gray-400 cursor-pointer h-9 inline-flex items-center rounded border border-gray-300 shadow-sm text-sm font-medium text-gray-700 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                            {{ __('Select files') }}
                                                            <input type="file" accept="image/*" name="file"
                                                                @change="change($event, 'light')" class="sr-only">
                                                        </label>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-4">
                                                            {{ __('Maximum upload file size') }}: 512MB.
                                                        </p>
                                                    </div>
                                                </template>
                                            </div>
                                            <input-error :error="$page.props.errors.light_logo" />
                                        </div>
                                        <div>
                                            <global-label for="favicon" class="mb-1" value="Favicon" :required="true" />
                                            <div class="rounded-md border-2 border-dashed dark:border-gray-600">
                                                <template v-if="favicon_preview">
                                                    <div class="flex justify-center items-center relative">
                                                        <div class="p-4">
                                                            <img class="w-48 h-48 object-contain" :src="favicon_preview"
                                                                alt="">
                                                        </div>
                                                        <button @click="removeImage('favicon_preview')" type="button"
                                                            class="absolute top-2 right-2 rtl:right-auto rtl:left-2 rounded-full p-1 group">
                                                            <trash-icon class="w-4 h-4 text-red-500 hover:text-red-400" />
                                                            <tool-tip class="text-lg" :text="__('Remove image')" />
                                                        </button>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="py-12 px-6  flex flex-col items-center ">
                                                        <!-- <PhotoIcon /> -->
                                                        <p
                                                            class="text-md font-bold dark:text-gray-400 text-center text-gray-700">
                                                            {{ __('Click the button below to select the file') }}.
                                                        </p>
                                                        <p class="mb-1 animate-bounce text-gray-700 text-xl">
                                                            ⇓
                                                        </p>
                                                        <label
                                                            class="bg-white px-4 h-9 inline-flex items-center rounded border border-gray-300 shadow-sm text-sm dark:bg-gray-400 cursor-pointer font-medium text-gray-700 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                            {{ __('Select files') }}
                                                            <input type="file" accept="image/*" name="file"
                                                                @change="change($event, 'favicon')" class="sr-only">
                                                        </label>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-4">
                                                            {{ __('Maximum upload file size') }}: 512MB.
                                                        </p>
                                                    </div>
                                                </template>
                                            </div>
                                            <input-error :error="$page.props.errors.favicon" />
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                    <div class="mb-3 grid grid-cols-12 gap-3">
                                        <div class="col-span-6">
                                            <global-label for="principal" :value="__('Principal Name')" :required="true" />
                                            <global-input type="text" v-model="form.principal_name" id="principal"
                                                name="principal_name"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Administrator Email')"
                                                :error="$page.props.errors.principal_name" />
                                            <input-error :error="$page.props.errors.principal_name" />
                                        </div>
                                        <div class="col-span-6">
                                            <global-label for="email" value="Administrator Email" :required="true" />
                                            <global-input type="text" v-model="form.app_email" id="email" name="app_email"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Administrator Email')"
                                                :error="$page.props.errors.app_email" />
                                            <input-error :error="$page.props.errors.app_email" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="phone" value="Administrator Phone Number" :required="false" />
                                        <global-input type="text" v-model="form.app_phone" id="phone" name="app_phone"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Administrator Phone Number')"
                                            :error="$page.props.errors.app_phone" />
                                        <input-error :error="$page.props.errors.app_phone" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="address" value="School Address" :required="false" />
                                        <global-textarea type="text" v-model="form.app_address" id="address"
                                            name="app_address"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('School Address')" :error="$page.props.errors.app_address" />
                                        <input-error :error="$page.props.errors.app_address" />
                                    </div>
                                    <div class="mb-3">
                                        <div class="flex items-center">
                                            <global-label for="description" value="Short Description About Your School"
                                                :required="false" />
                                            <!-- Dark style tooltip -->
                                            <div class="hs-tooltip inline-block">
                                                <button type="button">
                                                    <ExclamationTriangleIcon
                                                        class="text-red-400 w-4 h-4 ml-2 rtl:ml-0 rtl:mr-2" />
                                                    <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-2 px-4 bg-gray-900 text-sm font-medium text-white rounded-md shadow-sm dark:bg-slate-700"
                                                        role="tooltip">
                                                        {{ __('This description will be displayed on the homepage of the school') }}.
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <global-textarea type="text" rows="4" v-model="form.app_description"
                                            id="description" name="app_description"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Short Description About Your School')"
                                            :error="$page.props.errors.app_description" />
                                        <input-error :error="$page.props.errors.app_description" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class=" border-gray-700 mb-1">
                        <div class="flex justify-end py-4 gap-4 px-4 sm:px-6">
                            <global-button :loading="form.processing" @click="submit()" type="button" cssClass="w-full mt-3"
                                theme="primary">
                                {{ __('Save Changes') }}
                            </global-button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <!-- System Settings  -->
                    <SystemSetting :timezones="timezones" :system="system" :languages="languages" :currencies="currencies"
                        :setting="setting" />

                    <!-- School Schedule  -->
                    <ScheduleSetting :working_days="working_days" />
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6 mt-6">
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                    <div>
                        <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                        {{ __('Location & Time Settings') }}
                        </h2>
                    </div>
                    <form class="mt-2" @submit.prevent="submitLocationSettings()" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <global-label for="radius" :value="__('Radius')" :required="true" />
                            <global-input type="text" v-model="form.radius" id="radius" name="radius"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Enter Radius')" :error="$page.props.errors.radius" />
                            <input-error :error="$page.props.errors.radius" />
                        </div>
                        <div class="mb-3">
                            <global-label for="latitude" :value="__('Latitude')" :required="true" />
                            <global-input type="text" v-model="form.latitude" id="latitude" name="latitude"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Enter Latitude')" :error="$page.props.errors.latitude" />
                            <input-error :error="$page.props.errors.latitude" />
                        </div>
                        <div class="mb-3">
                            <global-label for="longtitude" :value="__('longtitude')" :required="true" />
                            <global-input type="text" v-model="form.longtitude" id="longtitude" name="longtitude"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Enter longtitude')" :error="$page.props.errors.longtitude" />
                            <input-error :error="$page.props.errors.longtitude" />
                        </div>
                        <div class="mb-3">
                            <global-label for="time_in" :value="__('Time In')" :required="true" />
                            <global-input type="time" v-model="form.time_in" id="time_in" name="time_in"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Enter Time In')" :error="$page.props.errors.time_in" />
                            <input-error :error="$page.props.errors.time_in" />
                        </div>
                        <div class="mb-3">
                            <global-label for="time_out" :value="__('Time Out')" :required="true" />
                            <global-input type="time" v-model="form.time_out" id="time_out" name="time_out"
                                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Enter Time Out')" :error="$page.props.errors.time_out" />
                            <input-error :error="$page.props.errors.time_out" />
                        </div>
                        </div>
                        <div class="border-gray-700 mb-1">
                            <div class="flex justify-end py-4 gap-4 px-4 sm:px-6">
                                    <global-button :loading="form.processing" @click="submitLocationSettings()" type="button" cssClass="w-full mt-3"
                                        theme="primary">
                                        {{ __('Save Changes') }}
                                    </global-button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <!--Mobile Setting-->
                <div class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6 mt-6">
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                        <div>
                            <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                {{ __('Mobile Setting') }}
                            </h2>
                        </div>
                        <form class="mt-2" @submit.prevent="submitMobileSettings()" enctype="multipart/form-data">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div>
                                    <div class="mb-3">
                                        <global-label for="description_apps" :value="__('Description Apps')" :required="false" />
                                        <global-textarea type="text" v-model="form.description_apps" id="description_apps"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Description Apps')" :error="$page.props.errors.description_apps" />
                                        <input-error :error="$page.props.errors.description_apps" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="features_apps" :value="__('Features Apps')" :required="false" />
                                        <global-textarea type="text" v-model="form.features_apps" id="features_apps"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Features Apps')" :error="$page.props.errors.features_apps" />
                                        <input-error :error="$page.props.errors.features_apps" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="advantages_apps" :value="__('Advantages Apps')" :required="false" />
                                        <global-textarea type="text" v-model="form.advantages_apps" id="advantages_apps"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Advantages Apps')" :error="$page.props.errors.advantages_apps" />
                                        <input-error :error="$page.props.errors.advantages_apps" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="conclusion_apps" :value="__('Conclusion Apps')" :required="false" />
                                        <global-textarea type="text" v-model="form.conclusion_apps" id="conclusion_apps"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Conclusion Apps')":error="$page.props.errors.conclusion_apps" />
                                        <input-error :error="$page.props.errors.conclusion_apps" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="fathforce_phone_number" :value="__('Fathforce Phone Number')" :required="false" />
                                        <global-input type="text" v-model="form.fathforce_phone_number" id="fathforce_phone_number"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Fathforce Phone Number')" :error="$page.props.errors.fathforce_phone_number" />
                                        <input-error :error="$page.props.errors.fathforce_phone_number" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="fathforce_browser_link" :value="__('Fathforce Browser Link')" :required="false" />
                                        <global-input type="text" v-model="form.fathforce_browser_link" id="fathforce_browser_link"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Fathforce Browser Link')" :error="$page.props.errors.fathforce_browser_link" />
                                        <input-error :error="$page.props.errors.fathforce_browser_link" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="fathforce_email" :value="__('Fathforce Email')" :required="false" />
                                        <global-input type="email" v-model="form.fathforce_email" id="fathforce_email"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Fathforce Email')" :error="$page.props.errors.fathforce_email" />
                                        <input-error :error="$page.props.errors.fathforce_email" />
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-3 grid grid-cols-1 xl:grid-cols-3 gap-3">
                                        <div>
                                            <global-label for="logo_fathschool" class="mb-1" value="Logo Fathschool" :required="true" />
                                            <div class="rounded-md border-2 border-dashed dark:border-gray-600">
                                                <template v-if="logo_fathschool_preview">
                                                    <div class="flex justify-center items-center relative">
                                                        <div class="p-4">
                                                            <img class="w-48 h-48 object-contain" :src="logo_fathschool_preview" alt="">
                                                        </div>
                                                        <button @click="removeImage('logo_fathschool_preview')" type="button" class="absolute top-2 right-2 rtl:right-auto rtl:left-2 rounded-full p-1 group">
                                                            <trash-icon class="w-4 h-4 text-red-500 hover:text-red-400" />
                                                            <tool-tip class="text-lg" :text="__('Remove image')" />
                                                        </button>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="py-12 px-6  flex flex-col items-center">
                                                        <p class="text-md dark:text-gray-400 font-bold text-center text-gray-700">
                                                            {{ __('Click the button below to select the file') }}.
                                                        </p>
                                                        <p class="mb-1 animate-bounce text-gray-700 text-xl">
                                                            ⇓
                                                        </p>
                                                        <label class="bg-white dark:bg-gray-400 cursor-pointer px-4 h-9 inline-flex items-center rounded border border-gray-300 shadow-sm text-sm font-medium text-gray-700 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                            {{ __('Select files') }}
                                                            <input type="file" accept="image/*" name="file" @change="change($event, 'logo_fathschool')" class="sr-only">
                                                        </label>
                                                        <p class="text-xs dark:text-gray-400 text-gray-600 mt-4">
                                                            {{ __('Maximum upload file size') }}: 512MB.
                                                        </p>
                                                    </div>
                                                </template>
                                            </div>
                                            <input-error :error="$page.props.errors.logo_fathschool" />
                                        </div>
                                        <div>
                                            <global-label for="logo_fathforce" class="mb-1" value="Logo Fathforce" :required="true" />
                                            <div class="rounded-md border-2 border-dashed dark:border-gray-600">
                                                <template v-if="logo_fathforce_preview">
                                                    <div class="flex justify-center items-center relative">
                                                        <div class="p-4">
                                                            <img class="w-48 h-48 object-contain" :src="logo_fathforce_preview" alt="">
                                                        </div>
                                                        <button @click="removeImage('logo_fathforce_preview')" type="button" class="absolute top-2 right-2 rtl:right-auto rtl:left-2 rounded-full p-1 group">
                                                            <trash-icon class="w-4 h-4 text-red-500 hover:text-red-400" />
                                                            <tool-tip class="text-lg" :text="__('Remove image')" />
                                                        </button>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="py-12 px-6  flex flex-col items-center ">
                                                        <p class="text-md dark:text-gray-400 font-bold text-center text-gray-700">
                                                            {{ __('Click the button below to select the file') }}.
                                                        </p>
                                                        <p class="mb-1 animate-bounce text-gray-700 text-xl">
                                                            ⇓
                                                        </p>
                                                        <label class="bg-white px-4 dark:bg-gray-400 cursor-pointer h-9 inline-flex items-center rounded border border-gray-300 shadow-sm text-sm font-medium text-gray-700 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                            {{ __('Select files') }}
                                                            <input type="file" accept="image/*" name="file" @change="change($event, 'logo_fathforce')" class="sr-only">
                                                        </label>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-4">
                                                            {{ __('Maximum upload file size') }}: 512MB.
                                                        </p>
                                                    </div>
                                                </template>
                                            </div>
                                            <input-error :error="$page.props.errors.logo_fathforce" />
                                        </div>
                                        <div>
                                            <global-label for="logo_school" class="mb-1" value="Logo School" :required="true" />
                                            <div class="rounded-md border-2 border-dashed dark:border-gray-600">
                                                <template v-if="logo_school_preview">
                                                    <div class="flex justify-center items-center relative">
                                                        <div class="p-4">
                                                            <img class="w-48 h-48 object-contain" :src="logo_school_preview" alt="">
                                                        </div>
                                                        <button @click="removeImage('logo_school_preview')" type="button" class="absolute top-2 right-2 rtl:right-auto rtl:left-2 rounded-full p-1 group">
                                                            <trash-icon class="w-4 h-4 text-red-500 hover:text-red-400" />
                                                            <tool-tip class="text-lg" :text="__('Remove image')" />
                                                        </button>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="py-12 px-6  flex flex-col items-center ">
                                                        <p class="text-md dark:text-gray-400 font-bold text-center text-gray-700">
                                                            {{ __('Click the button below to select the file') }}.
                                                        </p>
                                                        <p class="mb-1 animate-bounce text-gray-700 text-xl">
                                                            ⇓
                                                        </p>
                                                        <label class="bg-white px-4 dark:bg-gray-400 cursor-pointer h-9 inline-flex items-center rounded border border-gray-300 shadow-sm text-sm font-medium text-gray-700 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                            {{ __('Select files') }}
                                                            <input type="file" accept="image/*" name="file" @change="change($event, 'logo_school')" class="sr-only">
                                                        </label>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-4">
                                                            {{ __('Maximum upload file size') }}: 512MB.
                                                        </p>
                                                    </div>
                                                </template>
                                            </div>
                                            <input-error :error="$page.props.errors.logo_school" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="app_version_student" :value="__('Version Apps Student')" :required="false" />
                                        <global-input type="text" v-model="form.app_version_student" id="app_version_student"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Version Apps Student')" :error="$page.props.errors.app_version_student" />
                                        <input-error :error="$page.props.errors.app_version_student" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="app_version_teacher" :value="__('Version Apps Teacher')" :required="false" />
                                        <global-input type="text" v-model="form.app_version_teacher" id="app_version_teacher"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Version Apps Teacher')" :error="$page.props.errors.app_version_teacher" />
                                        <input-error :error="$page.props.errors.app_version_teacher" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="production_version_teacher" :value="__('Production Status Teacher')" :required="true" />
                                        <select v-model="form.production_version_teacher" id="production_version_teacher" name="production_version_teacher"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                                            <option value="Alpha">{{ __('Alpha') }}</option>
                                            <option value="Beta">{{ __('Beta') }}</option>
                                            <option value="Production">{{ __('Production') }}</option>
                                            <option value="Maintenance">{{ __('Maintenance') }}</option>
                                        </select>
                                        <input-error :error="$page.props.errors.production_version_teacher" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="production_version_student" :value="__('Production Status Student')" :required="true" />
                                        <select v-model="form.production_version_student" id="production_version_student" name="production_version_student"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                                            <option value="Alpha">{{ __('Alpha') }}</option>
                                            <option value="Beta">{{ __('Beta') }}</option>
                                            <option value="Production">{{ __('Production') }}</option>
                                            <option value="Maintenance">{{ __('Maintenance') }}</option>
                                        </select>
                                        <input-error :error="$page.props.errors.production_version_student" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="google_play_link_student" :value="__('Link Google Play Student')" :required="true" />
                                        <global-input type="text" v-model="form.google_play_link_student" id="google_play_link_student" name="google_play_link_student"
                                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                            :placeholder="__('Enter Google Play Link Student')" :error="$page.props.errors.google_play_link_student" />
                                        <input-error :error="$page.props.errors.google_play_link_student" />
                                    </div>
                                    <div class="mb-3">
                                        <global-label for="google_play_link_teacher" :value="__('Link Google Play Teacher')" :required="true" />
                                        <global-input type="text" v-model="form.google_play_link_teacher" id="google_play_link_teacher" name="google_play_link_teacher"
                                                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                    :placeholder="__('Enter Google Play Link Teacher')" :error="$page.props.errors.google_play_link_teacher" />
                                        <input-error :error="$page.props.errors.google_play_link_teacher" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <global-button :loading="form.processing" @click="submitMobileSettings()" type="button" cssClass="w-full mt-3" theme="primary">
                                    {{ __('Save Changes') }}
                                </global-button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6 mt-6">
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                        <div>
                            <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                {{ __('Weekday') }}
                            </h2>
                        </div>
                        <form class="mt-2" @submit.prevent="submitWeekdaySettings()" enctype="multipart/form-data">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="mb-3">
                                        <global-label for="status" :value="__('Weekday Schedule')" :required="true" />
                                        <select v-model="form.status" id="status" name="status"
                                                class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                                            <option value="1">{{ __('Weekday 1') }}</option>
                                            <option value="2">{{ __('Weekday 2') }}</option>
                                        </select>
                                        <input-error :error="$page.props.errors.status" />
                                    </div>
                                </div>
                                <div class="border-gray-700 mb-1">
                                    <div class="flex justify-end py-4 gap-4 px-4 sm:px-6">
                                        <global-button :loading="form.processing" @click="submitWeekdaySettings()" type="button" cssClass="w-full mt-3"
                                            theme="primary">
                                            {{ __('Save Changes') }}
                                        </global-button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </SettingLayout>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingLayout from '@/Layouts/SettingLayout.vue';
import SystemSetting from '@/Shared/Admin/Setting/General/System.vue'
import ScheduleSetting from '@/Shared/Admin/Setting/General/Schedule.vue'
import ToolTip from '@/Shared/ToolTip.vue';;
import { useForm } from '@inertiajs/inertia-vue3';

import { TrashIcon, ArrowRightIcon, PhotoIcon, ExclamationTriangleIcon } from "@heroicons/vue/24/outline";

export default {
    props: {
        timezones: {
            type: Array,
            required: true
        },
        languages: {
            type: Array,
            required: true
        },
        currencies: {
            type: Array,
            required: true
        },
        system: {
            type: Object,
            required: true
        },
        working_days: {
            type: Object,
            required: true
        },
        setting: {
            type: Object,
            required: true
        },
        mobile_setting: {
            type: Object,
            required: true
        },
    },
    data() {
        return {
            dark_logo_preview: this.setting.dark_logo_url,
            light_logo_preview: this.setting.light_logo_url,
            favicon_preview: this.setting.favicon_icon_url,
            logo_fathschool_preview: this.mobile_setting.logo_fathschool_url,
            logo_fathforce_preview: this.mobile_setting.logo_fathforce_url,
            logo_school_preview: this.mobile_setting.logo_school_url,
            form: useForm({
                // Ambil data dari this.setting
                logo_type: this.setting.app_logo_type,
                app_name: this.setting.app_name,
                school_code: this.setting.school_code,
                text_logo_name: this.setting.text_logo_name,
                dark_logo: '',
                light_logo: '',
                favicon: '',
                logo_fathschool: '',
                logo_fathforce: '',
                logo_school: '',
                app_email: this.setting.app_email,
                app_phone: this.setting.app_phone,
                principal_name: this.setting.principal_name,
                app_address: this.setting.app_address,
                radius: this.setting.radius,
                latitude: this.setting.latitude,
                longtitude: this.setting.longtitude,
                time_in: this.setting.time_in,
                time_out: this.setting.time_out,
                production_status: this.setting.production_status,
                mobile_version: this.setting.mobile_version,
                link_google_play: this.setting.link_google_play,
                status: this.setting.status,
                // Ambil data dari this.mobile_setting
                app_description: this.mobile_setting.app_description,
                description_apps: this.mobile_setting.description_apps,
                features_apps: this.mobile_setting.features_apps,
                advantages_apps: this.mobile_setting.advantages_apps,
                conclusion_apps: this.mobile_setting.conclusion_apps,
                fathforce_phone_number: this.mobile_setting.fathforce_phone_number,
                fathforce_browser_link: this.mobile_setting.fathforce_browser_link,
                fathforce_email: this.mobile_setting.fathforce_email,
                google_play_link_student: this.mobile_setting.google_play_link_student,
                google_play_link_teacher: this.mobile_setting.google_play_link_teacher,
                production_version_teacher: this.mobile_setting.production_version_teacher,
                production_version_student: this.mobile_setting.production_version_student,
                app_version_student: this.mobile_setting.app_version_student,
                app_version_teacher: this.mobile_setting.app_version_teacher,
                _method: 'PUT'
            })

        }
    },
    components: {
        AppLayout,
        SettingLayout,
        SystemSetting,
        ScheduleSetting,
        PhotoIcon,
        ToolTip,
        TrashIcon,
        ArrowRightIcon,
        ExclamationTriangleIcon
    },
    methods: {
    change(e, arg) {
        let selectedFile = e.target.files[0];
        const maxSize = 1 * 1024 * 1024; // 1 MB in bytes

        if (selectedFile.size > maxSize) {
            alert('Ukuran gambar maksimal 1 MB.');
            e.target.value = null; // Menghapus file yang dipilih
            return;
        }

        if (arg == 'dark') {
            this.form.dark_logo = selectedFile;
        } else if (arg == 'light') {
            this.form.light_logo = selectedFile;
        } else if (arg == 'favicon') {
            this.form.favicon = selectedFile;
        } else if (arg == 'logo_fathforce') {
            this.form.logo_fathforce = selectedFile;
        } else if (arg == 'logo_fathschool') {
            this.form.logo_fathschool = selectedFile;
        } else if (arg == 'logo_school') {
            this.form.logo_school = selectedFile;
        }

        let reader = new FileReader();

        reader.onload = (event) => {
            if (arg == 'dark') {
                this.dark_logo_preview = event.target.result;
            } else if (arg == 'light') {
                this.light_logo_preview = event.target.result;
            } else if (arg == 'favicon') {
                this.favicon_preview = event.target.result;
            } else if (arg == 'logo_fathforce') {
                this.logo_fathforce_preview = event.target.result;
            } else if (arg == 'logo_fathschool') {
                this.logo_fathschool_preview = event.target.result;
            } else if (arg == 'logo_school') {
                this.logo_school_preview = event.target.result;
            }
        };

        reader.readAsDataURL(selectedFile);
    },
    removeImage(arg) {
        if (arg == 'dark_logo_preview') {
            this.dark_logo_preview = '';
            this.form.dark_logo = null;
        } else if (arg == 'light_logo_preview') {
            this.light_logo_preview = '';
            this.form.light_logo = null;
        } else if (arg == 'favicon_preview') {
            this.favicon_preview = '';
            this.form.favicon = null;
        } else if (arg == 'logo_fathforce_preview') {
            this.logo_fathforce_preview = '';
            this.form.logo_fathforce = null;
        } else if (arg == 'logo_fathschool_preview') {
            this.logo_fathschool_preview = '';
            this.form.logo_fathschool = null;
        }
        else if (arg == 'logo_school_preview') {
            this.logo_school_preview = '';
            this.form.logo_school = null;
        }
    },
    submit() {
        this.form.post(this.route('settings.update'), {
            preserveScroll: true,
        });
    },
    submitMobileSettings() {
        this.form.post(this.route('settings.updateMobile'), {
            preserveScroll: true,
        });
    },
    submitWeekdaySettings() {
        this.form.post(this.route('settings.updateWeekday'), {
            preserveScroll: true,
        });
    },
    submitLocationSettings() {
        this.form.post(this.route('settings.locationTime'), {
            preserveScroll: true,
        });
    }
}

}
</script>
