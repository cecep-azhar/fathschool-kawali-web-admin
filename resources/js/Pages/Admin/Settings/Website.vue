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
                                        {{ update ? __("Update Social Media") : __("Create Slider Gallery") }}
                                    </h2>
                                </div>
                                <!-- Add Slider Gallery -->
                                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                    <form class="mt-2" @submit.prevent="saveSlideImage" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <global-label for="image" value="Image" :required="true" />
                                            <global-input type="file" id="image" name="image" class="mt-1 block w-full dark:bg-gray-700" @change="onFileChange" ref="image" />
                                            <input-error :error="$page.props.errors.image" />
                                        </div>
                                        <!-- Notification for error -->
                                        <div v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</div>
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
        <!-- Landing Video Section -->
  <div class="lg:col-span-2">
    <div class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
      <div class="py-6 px-4 sm:p6 lg:pb-8">
        <div>
          <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
            {{ __('Landing Video') }}
          </h2>
        </div>
        <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
          <template v-if="landings.length > 0">
            <div class="grid grid-cols-4 gap-3" style="width:400%; height:auto">
              <div v-for="landing in landings" :key="landing.id" class="h-full relative bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="rounded-lg p-4">
                  <h3 class="text-sm font-medium dark:text-gray-400 leading-5 text-gray-900">
                    {{ landing.title }}
                  </h3>
                  <p class="text-xs dark:text-gray-400 leading-4 text-gray-700">
                    {{ landing.description }}
                  </p>
                  <div v-if="landing.youtube_link">
                    <iframe class="w-full rounded-lg mt-2" :src="getYouTubeEmbedUrl(landing.youtube_link)" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                  <div v-else-if="landing.thumbnail">
                    <img :src="landing.thumbnail" alt="Thumbnail" class="w-full rounded-lg mt-2"/>
                  </div>
                </div>
                <span :id="'delete'+landing.id" class="absolute inline-flex bg-gray-900 opacity-70 rounded-lg p-1 w-8 text-red-500 cursor-pointer top-0 right-0" @click.prevent="deleteContent(landing.id)">
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

  <!-- Add Landing Video Form -->
  <div>
    <div class="divide-y mt-5 divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
      <div class="py-6 px-4 sm:p6 lg:pb-8">
        <div>
          <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
            {{ update ? __('Update Landing Video') : __('Create Landing Video') }}
          </h2>
        </div>
        <form class="mt-2" @submit.prevent="saveLandingContent">
          <div class="mb-3">
            <global-label for="title" value="Title" :required="true" />
            <global-input type="text" id="title" name="title" v-model="form.title" class="mt-1 block w-full dark:bg-gray-700" :disabled="landings.length > 0" />
            <div v-if="errorTitle" class="text-red-500 mt-2">{{ errorTitle }}</div>
          </div>
          <div class="mb-3">
            <global-label for="description" value="Description" :required="true" />
            <global-input type="text" id="description" name="description" v-model="form.description" class="mt-1 block w-full dark:bg-gray-700" :disabled="landings.length > 0" />
            <div v-if="errorDescription" class="text-red-500 mt-2">{{ errorDescription }}</div>
          </div>
          <div class="mb-3">
            <global-label for="youtubelink" value="YouTube Link" :required="false" />
            <global-input type="text" id="youtubelink" name="youtubelink" v-model="form.youtubelink" class="mt-1 block w-full dark:bg-gray-700" :disabled="landings.length > 0" />
            <div v-if="errorYoutubeLink" class="text-red-500 mt-2">{{ errorYoutubeLink }}</div>
          </div>
          <global-button :loading="form.processing" type="submit" cssClass="mt-3" theme="primary" :disabled="landings.length > 0">
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
            <div class="py-6 px-4 sm:p-6 lg:pb-8">
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
            <input-error :error="errorTitle" />
        </div>
        <div class="mb-3">
            <global-label for="description" value="Description" :required="true" />
            <global-input type="text" id="description" name="description" v-model="form.description" class="mt-1 block w-full dark:bg-gray-700" />
            <input-error :error="errorDescription" />
        </div>
        <div class="mb-3">
            <global-label for="youtubelink" value="YouTube Link" :required="true" />
            <global-input type="text" id="youtubelink" name="youtubelink" v-model="form.youtubelink" class="mt-1 block w-full dark:bg-gray-700" />
            <input-error :error="errorYoutubeLink" />
        </div>
        <div class="mb-3">
            <div v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</div>
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
                thumbnail: null,
                processing: false,
            }),
            update: false,
            socialLink: "",
            errorTitle: '', // Error message for title
            errorDescription: '', // Error message for description
            errorYoutubeLink: '', // Error message for YouTube link
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
        onFileChange(event) {
            const file = event.target.files[0];
            const validFormats = ['image/png', 'image/jpeg'];

            if (file && !validFormats.includes(file.type)) {
                this.errorMessage = 'Gambar harus berformat png atau jpeg.';
                this.form.image = null;
                this.$refs.image.value = '';
            } else {
                this.errorMessage = '';
                this.form.image = file || null;
            }
        },
        deleteImage(id) {
            if (confirm("Are you sure?")) {
                this.$inertia.delete(this.route("settings.website.slider.delete", id));
            }
        },
        saveSlideImage() {
            if (!this.form.image) {
                this.errorMessage = 'Harap unggah gambar berformat png atau jpeg.';
                return;
            }

            this.form.post(this.route('settings.website.slider.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.image = null;
                    this.$refs.image.value = '';
                    this.errorMessage = '';
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
            // Reset error messages
            this.errorTitle = '';
            this.errorDescription = '';
            this.errorYoutubeLink = '';

            if (!this.form.title) {
                this.errorTitle = 'Harap masukkan judul.';
                return;
            }
            if (!this.form.description) {
                this.errorDescription = 'Harap masukkan deskripsi.';
                return;
            }
            if (!this.form.youtubelink) {
                this.errorYoutubeLink = 'Harap masukkan tautan YouTube.';
                return;
            }

            this.form.post(this.route("settings.website.landing.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.title = "";
                    this.form.description = "";
                    this.form.youtubelink = "";
                    this.form.thumbnail = null;
                    this.errorTitle = '';
                    this.errorDescription = '';
                    this.errorYoutubeLink = '';
                },
            });
        },
        deleteDocumentation(id) {
            if (confirm("Are you sure?")) {
                this.$inertia.delete(this.route("settings.website.documentation.delete", id));
            }
        },
        saveDocumentation() {
            // Reset error messages
            this.errorTitle = '';
            this.errorDescription = '';
            this.errorYoutubeLink = '';

            if (!this.form.title) {
                this.errorTitle = 'Harap masukkan judul.';
                return;
            }
            if (!this.form.description) {
                this.errorDescription = 'Harap masukkan deskripsi.';
                return;
            }
            if (!this.form.youtubelink) {
                this.errorYoutubeLink = 'Harap masukkan tautan YouTube.';
                return;
            }

            this.form.post(this.route("settings.website.documentation.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.title = "";
                    this.form.description = "";
                    this.form.youtubelink = "";
                    this.form.thumbnail = null;
                    this.$refs.thumbnail.value = '';
                    this.errorTitle = '';
                    this.errorDescription = '';
                    this.errorYoutubeLink = '';
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





