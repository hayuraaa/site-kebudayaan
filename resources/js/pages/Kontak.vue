<script setup>
import { ref } from 'vue';
import AppLayout from './Layout/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const showSuccess = ref(false);
const showError = ref(false);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
    website_source: 'kebudayaan',
});

const handleSubmit = () => {
    showSuccess.value = false;
    showError.value = false;

    form.post('/contact-forms/submit', {
        onSuccess: () => {
            form.reset();
            showSuccess.value = true;
            // Auto hide setelah 5 detik
            setTimeout(() => {
                showSuccess.value = false;
            }, 5000);
        },
        onError: () => {
            showError.value = true;
            setTimeout(() => {
                showError.value = false;
            }, 5000);
        },
        preserveScroll: true,
    });
};
</script>

<template>

    <Head title="Hubungi Kami" />
    <AppLayout>
        <!-- Hero Section -->
        <section class="relative py-20 bg-gradient-to-br from-slate-50 via-blue-50/50 to-cyan-50/50">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-5xl mx-auto text-center">

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-[#006699] to-[#0088cc] bg-clip-text text-transparent">
                            Hubungi Kami
                        </span>
                    </h1>

                    <p class="text-lg md:text-xl text-slate-600 leading-relaxed">
                        Kebudayaan Wikimedia Indonesia terbuka untuk bekerja sama dengan institusi yang ada di
                        Indonesia, baik dari pemerintah, swasta maupun institusi pribadi. Kami menyediakan sumber daya
                        manusia dan juga sumber daya teknis yang kami punya guna membantu institusi membuka koleksinya
                        untuk mendapatkan jangkauan yang lebih luas. <br>Hasil digitalisasi koleksi institusi akan
                        diunggah dalam bentuk berkas digital di Wikimedia Commons, artikel di Wikipedia, dokumen di
                        Wikisource, basis data di Wikidata dan menggunakan lisensi bebas Creative Commons.</br>
                    </p>
                </div>
            </div>
        </section>

        <!-- Bentuk Kerja Sama Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                            Bentuk Kerja Sama
                        </h2>
                        <p class="text-lg text-slate-600 max-w-3xl mx-auto">
                            Kami menawarkan berbagai bentuk kerja sama yang dapat disesuaikan dengan kebutuhan institusi
                            Anda
                        </p>
                    </div>

                    <!-- Collaboration Cards -->
                    <div class="grid md:grid-cols-3 gap-8">

                        <!-- Card 1: Digitalisasi Koleksi -->
                        <div
                            class="bg-gradient-to-br from-slate-50 to-blue-50/30 rounded-2xl p-8 border border-slate-200 hover:shadow-xl transition-shadow duration-300">
                            <div
                                class="bg-gradient-to-r from-[#006699] to-[#0088cc] w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                                <span class="text-3xl">📚</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4 leading-tight">
                                Kerja sama mendigitalisasikan koleksi dan membuka akses institusi Anda
                            </h3>
                            <p class="text-slate-600 leading-relaxed">
                                Wikimedia Indonesia menyediakan sumber daya manusia dan teknis untuk memindai dan
                                memfoto koleksi institusi dan membuka aksesnya untuk publik.
                            </p>
                        </div>

                        <!-- Card 2: Membuka Akses Koleksi -->
                        <div
                            class="bg-gradient-to-br from-slate-50 to-cyan-50/30 rounded-2xl p-8 border border-slate-200 hover:shadow-xl transition-shadow duration-300">
                            <div
                                class="bg-gradient-to-r from-[#006699] to-[#0088cc] w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                                <span class="text-3xl">🌐</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4 leading-tight">
                                Kerja sama membuka akses koleksi institusi Anda ke jangkauan yang lebih luas
                            </h3>
                            <p class="text-slate-600 leading-relaxed">
                                Wikimedia Indonesia memperkenalkan Wikimedia Commons tempat repositori foto, audio dan
                                video dengan lisensi terbuka dimana institusi Anda bebas untuk menempatkan koleksi.
                            </p>
                        </div>

                        <!-- Card 3: Pelatihan -->
                        <div
                            class="bg-gradient-to-br from-slate-50 to-blue-50/30 rounded-2xl p-8 border border-slate-200 hover:shadow-xl transition-shadow duration-300">
                            <div
                                class="bg-gradient-to-r from-[#006699] to-[#0088cc] w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                                <span class="text-3xl">🎓</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4 leading-tight">
                                Kerja sama pelatihan proyek Wikimedia dan pengenalan lisensi bebas Creative Commons dan
                                gerakan GLAM terbuka
                            </h3>
                            <p class="text-slate-600 leading-relaxed">
                                Wikimedia Indonesia memberikan kesempatan kepada komunitas dan lembaga budaya untuk
                                mengenal lebih jauh proyek Wikimedia Commons dan Wikisource, lisensi terbuka dan gerakan
                                GLAM terbuka melalui kegiatan pelatihan.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Success Message -->
        <div v-if="$page.props.flash?.success" class="container mx-auto px-6 lg:px-8 mt-8">
            <div class="max-w-7xl mx-auto">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 font-medium">{{ $page.props.flash.success }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-12 items-start">

                        <!-- Left Column - Text & Image -->
                        <div>
                            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                                Kirim Pesan
                            </h2>
                            <p class="text-slate-600 text-base leading-relaxed mb-8">
                                Anda dan institusi Anda tertarik bekerja sama? Tim Kebudayaan Wikimedia Indonesia
                                sangat terbuka dengan berbagai bentuk kolaborasi. Silahkan hubungi kami, baik berupa
                                pertanyaan atau sekadar menyapa.
                            </p>
                            <div class="relative rounded-2xl overflow-hidden shadow-xl">
                                <img src="/komunitas.jpg" alt="Hubungi Kami" class="w-full h-[500px] object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
                            </div>
                        </div>

                        <!-- Right Column - Contact Form -->
                        <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200">

                            <!-- Success Alert di dalam form -->
                            <div v-if="showSuccess"
                                class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg animate-pulse">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-green-800">Berhasil Terkirim! ✅</p>
                                        <p class="text-xs text-green-700 mt-1">Terima kasih, pesan Anda telah kami
                                            terima.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Error Alert -->
                            <div v-if="showError || $page.props.flash?.error"
                                class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-red-800">Gagal Terkirim! ❌</p>
                                        <p class="text-xs text-red-700 mt-1">{{ $page.props.flash?.error || 'Terjadi kesalahan, silakan coba lagi.' }}</p>
                                    </div>
                                </div>
                            </div>

                            <form @submit.prevent="handleSubmit" class="space-y-6">

                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" v-model="form.name" required
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition bg-white"
                                        :class="{ 'border-red-500': form.errors.name }"
                                        placeholder="Masukkan nama lengkap Anda" />
                                    <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}
                                    </p>
                                </div>

                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" v-model="form.email" required
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition bg-white"
                                        :class="{ 'border-red-500': form.errors.email }" placeholder="nama@email.com" />
                                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email
                                    }}</p>
                                </div>

                                <!-- Phone Field -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">
                                        Nomor Telepon <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="phone" v-model="form.phone" required
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition bg-white"
                                        :class="{ 'border-red-500': form.errors.phone }" placeholder="08xxxxxxxxxx" />
                                    <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone
                                    }}</p>
                                </div>

                                <!-- Subject Field -->
                                <div>
                                    <label for="subject" class="block text-sm font-medium text-slate-700 mb-2">
                                        Subjek <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="subject" v-model="form.subject" required
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition bg-white"
                                        :class="{ 'border-red-500': form.errors.subject }"
                                        placeholder="Topik pesan Anda" />
                                    <p v-if="form.errors.subject" class="mt-1 text-sm text-red-600">{{
                                        form.errors.subject }}</p>
                                </div>

                                <!-- Message Field -->
                                <div>
                                    <label for="message" class="block text-sm font-medium text-slate-700 mb-2">
                                        Pesan / Komentar <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="message" v-model="form.message" required rows="5"
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition resize-none bg-white"
                                        :class="{ 'border-red-500': form.errors.message }"
                                        placeholder="Tuliskan pesan atau komentar Anda di sini..."></textarea>
                                    <p v-if="form.errors.message" class="mt-1 text-sm text-red-600">{{
                                        form.errors.message }}</p>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button type="submit" :disabled="form.processing"
                                        class="w-full bg-gradient-to-r from-[#006699] to-[#0088cc] hover:shadow-lg text-white font-semibold py-3 px-6 rounded-lg transition duration-200 ease-in-out transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                        <span v-if="form.processing">Mengirim...</span>
                                        <span v-else>Kirim Pesan</span>
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Info Section -->
        <section class="py-16 bg-gradient-to-br from-slate-50 via-blue-50/50 to-cyan-50/50">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-2xl mx-auto">
                    <div class="bg-gradient-to-r from-[#006699] to-[#0088cc] rounded-2xl p-10 shadow-xl text-center">
                        <div class="text-6xl mb-4">✉️</div>
                        <h3 class="font-bold text-2xl text-white mb-3">Hubungi Kami</h3>
                        <a href="mailto:kebudayaan@wikimedia.or.id" 
                           class="text-xl text-white hover:text-blue-100 transition-colors duration-200 font-medium">
                            kebudayaan@wikimedia.or.id
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </AppLayout>
</template>

<style scoped>
/* Additional styles if needed */
</style>