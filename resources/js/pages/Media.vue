<script setup>
import AppLayout from './Layout/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    medialist: {
        type: Array,
        required: true
    }
});

const getMediaTypeLabel = (type) => {
    const labels = {
        'wikimedia_commons': 'PDF',
        'youtube': 'Video',
    };
    return labels[type] || type;
};

const getYoutubeEmbedUrl = (url) => {
    if (!url) return '';
    const match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/);
    return match ? `https://www.youtube.com/embed/${match[1]}` : url;
};

const getPdfEmbedUrl = (url) => {
    if (!url) return '';
    return `https://docs.google.com/viewer?url=${encodeURIComponent(url)}&embedded=true`;
};
</script>

<template>
    <Head title="Media" />
    <AppLayout>
        <!-- Hero Section -->
        <section class="relative py-20 bg-gradient-to-br from-slate-50 via-blue-50/50 to-cyan-50/50">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-[#006699] to-[#0088cc] bg-clip-text text-transparent">
                            Media & Materi
                        </span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-600 leading-relaxed">
                        Koleksi panduan, tutorial, dan materi pembelajaran untuk mendukung kontribusi Anda di
                        proyek-proyek Wikimedia Indonesia.
                    </p>
                </div>
            </div>
        </section>

        <!-- Media Grid Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-8">
                        <div v-for="media in medialist" :key="media.id"
                            class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl transition-all duration-300">

                            <!-- Preview Section -->
                            <div class="relative overflow-hidden">

                                <!-- PDF Preview -->
                                <div v-if="media.jenis_media === 'wikimedia_commons'" class="h-[500px] bg-white">
                                    <iframe
                                        :src="getPdfEmbedUrl(media.url_media)"
                                        class="w-full h-full"
                                        frameborder="0"
                                        loading="lazy">
                                    </iframe>
                                </div>

                                <!-- YouTube Preview -->
                                <div v-else-if="media.jenis_media === 'youtube'" class="h-[500px] bg-black">
                                    <iframe
                                        :src="getYoutubeEmbedUrl(media.url_media)"
                                        class="w-full h-full"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        loading="lazy">
                                    </iframe>
                                </div>

                                <!-- Media Type Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-[#006699] text-xs font-semibold rounded-full uppercase">
                                        {{ getMediaTypeLabel(media.jenis_media) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-[#006699] transition-colors">
                                    {{ media.judul }}
                                </h3>
                                <p v-if="media.keterangan" class="text-slate-600 text-base leading-relaxed mb-6">
                                    {{ media.keterangan }}
                                </p>
                                <a :href="media.url_media" target="_blank"
                                    class="w-full px-6 py-3 bg-gradient-to-r from-[#006699] to-[#0088cc] text-white rounded-lg font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                                    <span>Buka Media</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div v-if="!medialist || medialist.length === 0" class="text-center py-20">
                        <div class="text-[#006699] mb-4">
                            <svg class="w-20 h-20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">Belum Ada Media</h3>
                        <p class="text-slate-600">Media dan materi pembelajaran akan segera ditambahkan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- GLAM Video Section -->
        <section class="py-20 bg-gradient-to-b from-white to-slate-50">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-5xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                            Tonton Juga Video Kegiatan
                            <span class="block mt-2 bg-gradient-to-r from-[#006699] to-[#0088cc] bg-clip-text text-transparent">
                                GLAM Indonesia
                            </span>
                        </h2>
                        <p class="text-lg md:text-xl text-slate-600 leading-relaxed">
                            Saksikan dokumentasi kegiatan dan kolaborasi kami di playlist berikut
                        </p>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-100/50 to-orange-100/50 rounded-3xl transform rotate-1"></div>
                        <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden p-4 md:p-6">
                            <div class="relative pt-[56.25%]">
                                <iframe
                                    src="https://www.youtube.com/embed/qI5UgPKnfhM"
                                    class="absolute inset-0 w-full h-full rounded-xl"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-8">
                        <a href="https://www.youtube.com/@WikimediaIndonesia" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#006699] to-[#0088cc] text-white rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                            </svg>
                            <span>Lihat Playlist Lengkap</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-[#006699] to-[#0088cc]">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">
                        Butuh Bantuan atau Materi Tambahan?
                    </h2>
                    <p class="text-lg md:text-xl mb-8 text-white/90">
                        Hubungi kami untuk mendapatkan panduan lebih lanjut atau request materi pembelajaran khusus.
                    </p>
                    <a href="/kontak"
                        class="inline-block px-8 py-4 bg-white text-[#006699] rounded-xl font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

    </AppLayout>
</template>