<template>
    <AppLayout :title="__('General Settings | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Settings')" />
            <BreadcrumbLink :title=" __('Website')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Website') }}
                </div>
            </page-header>

            <SettingLayout>
                 <!-- Sliders -->
                 <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                    <div class="lg:col-span-2">
                        <div class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                        {{ __('Slider Gallery') }}
                                    </h2>
                                </div>
                                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                    <template v-if="sliders.length > 0">
                                        <div class="grid grid-cols-4 gap-3">
                                            <div v-for="slider in sliders" :key="slider.id" class="h-full relative bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                                <img class="rounded-lg" :src="slider.image" alt="" />
                                                <span :id="'delete'+slider.id" class="absolute inline-flex bg-gray-900 opacity-70 rounded-lg p-1 w-8 text-red-500 cursor-pointer top-0 right-0" @click.prevent="deleteImage(slider.id)">
                                                    <TrashIcon />
                                                </span>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <NothingFound asShow="div" />
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                        {{ update ? __("Update Social Media"): __("Create Slider Gallery") }}
                                    </h2>
                                </div>
                                <!-- Add Slider Gallery -->
                                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                    <form class="mt-2" @submit.prevent="saveSlideImage" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <global-label for="image" value="Image" :required="true" />
                                            <global-input type="file" id="image" name="image" class="mt-1 block w-full dark:bg-gray-700" @change="onFileChange" />
                                            <input-error :error="$page.props.errors.image" />
                                        </div>
                                        <global-button :loading="form.processing" type="submit" cssClass="mt-3" theme="primary">
                                            {{__('Add Image')}}
                                        </global-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
        <!-- Landing Video -->
        <div class="lg:col-span-2">
            <div class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                <div class="py-6 px-4 sm:p-6 lg:pb-8">
                    <div>
                        <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                            {{ __('Landing Video') }}
                        </h2>
                    </div>
                    <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                        <template v-if="landings.length > 0">
                            <div class="grid grid-cols-4 gap-3">
                                <div v-for="landing in landings" :key="landing.id" class="h-full relative bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <div class="rounded-lg p-4">
                                        <h3 class="text-sm font-medium dark:text-gray-400 leading-5 text-gray-900">
                                            {{ landing.title }}
                                        </h3>
                                        <p class="text-xs dark:text-gray-400 leading-4 text-gray-700">
                                            {{ landing.description }}
                                        </p>
                                        <iframe class="w-full rounded-lg mt-2" :src="getYouTubeEmbedUrl(landing.youtube_link)" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <span :id="'delete'+landing.id" class="absolute inline-flex bg-gray-900 opacity-70 rounded-lg p-1 w-8 text-red-500 cursor-pointer top-0 right-0" @click.prevent=" deleteContent(landing.id)">
                                        <TrashIcon />
                                    </span>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <NothingFound asShow="div" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Landing Video -->
        <div>
            <div class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                <div class="py-6 px-4 sm:p6 lg:pb-8">
                    <div>
                        <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                            {{ update ? __("Update Landing Video"): __("Create Landing Video") }}
                        </h2>
                    </div>
                    <form class="mt-2" @submit.prevent="saveLandingContent">
                        <div v-if="error" class="mb-3 text-red-500">
                            {{ error }}
                        </div>
                        <div class="mb-3">
                            <global-label for="title" value="Title" :required="true" />
                            <global-input type="text" id="title" name="title" v-model="form.title" class="mt-1 block w-full dark:bg-gray-700" :disabled="isDataExist" />
                            <input-error :error="$page.props.errors.title" />
                        </div>
                        <div class="mb-3">
                            <global-label for="description" value="Description" :required="true" />
                            <global-input type="text" id="description" name="description" v-model="form.description" class="mt-1 block w-full dark:bg-gray-700" :disabled="isDataExist" />
                            <input-error :error="$page.props.errors.description" />
                        </div>
                        <div class="mb-3">
                            <global-label for="youtubelink" value="YouTube Link" :required="true" />
                            <global-input type="text" id="youtubelink" name="youtubelink" v-model="form.youtubelink" class="mt-1 block w-full dark:bg-gray-700" :disabled="isDataExist" />
                            <input-error :error="$page.props.errors.youtubelink" />
                        </div>
                        <div class="mb-3">
                            <global-label for="thumbnail" value="Thumbnail" :required="true" />
                            <global-input type="file" id="thumbnail" name="thumbnail" class="mt-1 block w-full dark:bg-gray-700" @change="onFileChange" :disabled="isDataExist" />
                            <input-error :error="$page.props.errors.thumbnail" />
                        </div>
                        <global-button :loading="form.processing" type="submit" cssClass="mt-3" theme="primary" :disabled="isDataExist">
                            {{__('Add Content')}}
                        </global-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Documentation -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
        <div class="lg:col-span-2">
            <div class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                <div class="py-6 px-4 sm:p-6 lg:pb-8">
                    <div>
                        <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                            {{ __('Documentation') }}
                        </h2>
                    </div>
                    <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                        <template v-if="documentations.length > 0">
                            <div class="grid grid-cols-4 gap-3">
                                <div v-for="documentation in documentations" :key="documentation.id" class="h-full relative bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <div class="rounded-lg p-4">
                                        <h3 class="text-sm font-medium dark:text-gray-400 leading-5 text-gray-900">
                                            {{ documentation.title }}
                                        </h3>
                                        <p class="text-xs dark:text-gray-400 leading-4 text-gray-700">
                                            {{ documentation.description }}
                                        </p>
                                        <!-- Embed YouTube Video -->
                                        <iframe class="w-full rounded-lg mt-2" :src="getYouTubeEmbedUrl(documentation.video_link)" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <span :id="'delete'+documentation.id" class="absolute inline-flex bg-gray-900 opacity-70 rounded-lg p-1 w-8 text-red-500 cursor-pointer top-0 right-0" @click.prevent="deleteDocumentation(documentation.id)">
                                        <TrashIcon />
                                    </span>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <NothingFound asShow="div" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                <div class="py-6 px-4 sm:p6 lg:pb-8">
                    <div>
                        <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                            {{ update ? __("Update Social Media") : __("Create Documentation") }}
                        </h2>
                    </div>
                    <!-- Add Documentation -->
                    <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                        <form class="mt-2" @submit.prevent="saveDocumentation">
                            <div class="mb-3">
                                <global-label for="title" value="Title" :required="true" />
                                <global-input type="text" id="title" name="title" v-model="form.title" class="mt-1 block w-full dark:bg-gray-700" />
                                <input-error :error="$page.props.errors.title" />
                            </div>
                            <div class="mb-3">
                                <global-label for="description" value="Description" :required="true" />
                                <global-input type="text" id="description" name="description" v-model="form.description" class="mt-1 block w-full dark:bg-gray-700" />
                                <input-error :error="$page.props.errors.description" />
                            </div>
                            <div class="mb-3">
                                <global-label for="youtubelink" value="YouTube Link" :required="true" />
                                <global-input type="text" id="youtubelink" name="youtubelink" v-model="form.youtubelink" class="mt-1 block w-full dark:bg-gray-700" />
                                <input-error :error="$page.props.errors.youtubelink" />
                            </div>
                            <div class="mb-3">
                                <global-label for="thumbnail" value="thumbnail" :required="true" />
                                <global-input type="file" id="thumbnail" name="thumbnail" class="mt-1 block w-full dark:bg-gray-700" @change="onFileChange" />
                                <input-error :error="$page.props.errors.thumbnail" />
                            </div>
                            <global-button :loading="form.processing" type="submit" cssClass="mt-3" theme="primary">
                                {{ __('Add video') }}
                            </global-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


                <!-- Social Media  -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                    <div class="lg:col-span-2">
                        <div
                            class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                        {{__('Social Media Setting')}}
                                    </h2>
                                </div>
                                <div >
                                    <table-content @edit="edit" :socialLinks="socialLinks" />
                                    <div class="flex justify-center">
                                        <pagination class="mt-6" :links="socialLinks.links" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                                <div>
                                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                                        {{ update ? __("Update Social Media"): __("Create Social Media") }}
                                    </h2>
                                </div>
                                <!-- Social Media Settings -->
                                <div
                                    class="w-full bg-white rounded-lg dark:bg-gray-800 text-sm rtl:text-right text-left text-gray-500 dark:text-gray-400">
                                    <create-form v-if="!update" />
                                    <update-form :socialLink="socialLink" v-if="update" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </SettingLayout>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import SettingLayout from "@/Layouts/SettingLayout.vue";
import TableContent from "@/Shared/Admin/Setting/SocialLink/Table.vue";
import CreateForm from "@/Shared/Admin/Setting/SocialLink/CreateForm.vue";
import UpdateForm from "@/Shared/Admin/Setting/SocialLink/UpdateForm.vue";
import ToolTip from "@/Shared/ToolTip.vue";
import { TrashIcon } from "@heroicons/vue/24/outline";
import { useForm } from "@inertiajs/inertia-vue3";
import NothingFound from "@/Shared/NothingFound.vue";

export default {
    props: {
        sliders: {
            type: Array,
            required: true,
        },
        landings: {
            type: Array,
            required: true,
        },
        documentations: {
            type: Array,
            required: true,
        },
        setting: {
            type: Object,
            required: true,
        },
        isDataExist: {
            type: Boolean,
            required: true,
        },
        socialLinks: Array,
    },
    data() {
        return {
            form: useForm({
                image: null,
                youtubelink: "",
                title: "",
                description: "",
                thumbnail: "",
            }),
            update: false,
            socialLink: "",
        };
    },
    components: {
        AppLayout,
        SettingLayout,
        ToolTip,
        TrashIcon,
        TableContent,
        CreateForm,
        UpdateForm,
        NothingFound
    },
    methods: {
        onFileChange(e) {
            const file = e.target.files[0];
            this.form.image = file;
            this.previewImage = URL.createObjectURL(file);
        },
        deleteImage(id) {
            if (confirm("Are you sure?")) {
                this.$inertia.delete(this.route("settings.website.slider.delete", id));
            }
        },
        saveSlideImage() {
            this.form.post(this.route("settings.website.slider.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.image = null;
                    this.$refs.image.value = "";
                },
            });
        },
        saveSocialMedia() {
            this.socialForm.put(this.route("settings.website.social.update"), {
                preserveScroll: true,
            });
        },
        edit(socialLink) {
            this.update = true;
            this.socialLink = socialLink;
        },
        deleteContent(id) {
            if (confirm("Are you sure?")) {
                this.$inertia.delete(this.route("settings.website.landing.delete", id));
            }
        },
        saveLandingContent() {
            this.form.post(this.route("settings.website.landing.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.title = "";
                    this.form.description = "";
                    this.form.youtubelink = "";
                    this.form.thumbnail = null;
                },
            });
        },
        deleteDocumentation(id) {
            if (confirm("Are you sure?")) {
                this.$inertia.delete(this.route("settings.website.documentation.delete", id));
            }
        },
        saveDocumentation() {
            this.form.post(this.route("settings.website.documentation.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.title = "";
                    this.form.description = "";
                    this.form.youtubelink = "";
                    this.form.thumbnail = null;
                },
            });
        },
        getYouTubeEmbedUrl(link) {
            if (!link) return '';
            const videoId = link.split('v=')[1];
            const ampersandPosition = videoId ? videoId.indexOf('&') : -1;
            return ampersandPosition !== -1
                ? `https://www.youtube.com/embed/${videoId.substring(0, ampersandPosition)}`
                : `https://www.youtube.com/embed/${videoId}`;
        },
    },
};
</script>

