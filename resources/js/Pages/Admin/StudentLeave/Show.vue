<template>
    <div class="p-6 dark:text-gray-400">
        <div class="w-full">
            <div class="my-2 flex items-center">
                <div>
                    <img
                        class="w-24 h-24 object-cover rounded-lg"
                        :src="leave.user.profile_photo_url"
                        alt=""
                    />
                </div>
                <div class="ml-3">
                    <h2 class="dark:text-gray-400 text-lg font-bold mb-0">
                        {{ leave.user.name }}
                    </h2>
                    <h2 class="dark:text-gray-400 text-sm text-gray-500 mb-0">
                        <span
                            class="border-blue-100 border-2 w-full text-gray-600 px-4 text-xs font-semibold mr-2 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800"
                        >
                            {{ leave.user.role }}
                        </span>
                    </h2>
                </div>
            </div>
            <h2 class="dark:text-gray-400">
                {{ __("Date") }}: {{ formatTime(leave.start, "") }} -
                {{ formatTime(leave.end, "") }}
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __("Days") }}: {{ leave.days }}
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __("Status") }}:
                <span
                    :class="
                        leave.status == 'pending'
                            ? 'bg-purple-100 text-purple-800 dark:bg-purple-200 dark:text-purple-900 dark:opacity-60'
                            : '' || leave.status == 'accepted'
                            ? 'bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 dark:opacity-60'
                            : '' || leave.status == 'rejected'
                            ? 'bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900 dark:opacity-60'
                            : ''
                    "
                    class="capitalize text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                >
                    {{ leave.status }}
                </span>
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __("Description") }}: {{ leave.description }}
            </h2>
            <h2 class="dark:text-gray-400">
                {{ __("Image") }}:
                <img
                    :src="getImageUrl(leave.image)"
                    alt="Leave Image"
                    class="w-150 h-150 object-cover border-gray-300 rounded-lg mt-2"
                />
            </h2>

            <h2 v-if="leave.status == 'rejected'" class="dark:text-gray-400">
                {{ __("Cause") }}: {{ leave.rejected_cause ?? "-" }}
            </h2>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        leave: Object,
    },
    methods: {
        getImageUrl(image) {
            if (!image) {
                return "http://fathschool-kawali-web-admin.test/images/default.png"; // Gambar default jika tidak ada
            }
            if (image.startsWith("http")) {
                return image; // Jika sudah URL lengkap, langsung digunakan
            }
            return `http://fathschool-kawali-web-admin.test/storage/leaves/${image}`; // Tambahkan path storage jika hanya nama file
        },
    },
};
</script>

<style></style>
