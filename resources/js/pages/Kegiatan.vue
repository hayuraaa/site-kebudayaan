<script setup>
import AppLayout from './Layout/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Kegiatan" />
    <AppLayout>
        <!-- Hero Section -->
        <section class="relative py-20 bg-gradient-to-br from-slate-50 via-orange-50/50 to-amber-50/50">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="inline-block mb-6">
                        <span
                            class="text-sm font-semibold tracking-wider text-amber-700 uppercase px-4 py-2 bg-amber-100 rounded-full">
                            Program Kebudayaan Wikimedia Indonesia
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                            Kegiatan Kami
                        </span>
                    </h1>

                    <p class="text-lg md:text-xl text-slate-600 leading-relaxed">
                        Program Kebudayaan Wikimedia Indonesia memberikan dukungan terhadap upaya dokumentasi dan
                        pelestarian budaya Indonesia, termasuk bekerja sama dengan komunitas, institusi pemerintah, dan
                        lembaga budaya untuk berkontribusi pada penyebarluasan koleksi dan pengetahuan melalui
                        proyek-proyek Wikimedia.
                    </p>
                </div>
            </div>
        </section>

        <!-- Kegiatan Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-7xl mx-auto space-y-20">

                    <!-- Kopdar -->
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div class="order-2 lg:order-1">
                            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                                Kopdar
                            </h2>
                            <p class="text-slate-600 text-base leading-relaxed mb-6">
                                Kopdar atau kopi darat adalah kegiatan berkumpulnya para kontributor proyek Wikimedia
                                untuk menyunting bersama-sama, baik secara tatap muka, maupun daring. Kegiatan ini
                                diutamakan bagi kontributor yang telah aktif menyunting di proyek-proyek Wikimedia. Pada
                                kegiatan ini, selain peserta dapat menyunting bersama-sama, mereka juga dapat saling
                                berbagi pengetahuan dan pengalaman penyuntingan dengan peserta lainnya. Program
                                kebudayaan saat ini mendukung Kopdar pada proyek Wikisource dan Wikimedia Commons.
                            </p>
                            <a href="https://id.wikimedia.org/wiki/Kopdar"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white rounded-lg font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        <div class="order-1 lg:order-2">
                            <div class="relative rounded-2xl overflow-hidden shadow-xl">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Kopdar_WikiKamus_Madura.jpg"
                                    alt="Kopdar" class="w-full h-[400px] object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
                            </div>
                        </div>
                    </div>

                    <!-- WikiLatih -->
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <div class="relative rounded-2xl overflow-hidden shadow-xl">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/69/Wikilatih_Wikidata_Bersama_SKK_Ganto_UNP_di_Padang_%2818%29.jpg"
                                    alt="WikiLatih" class="w-full h-[400px] object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                                WikiLatih
                            </h2>
                            <p class="text-slate-600 text-base leading-relaxed mb-6">
                                WikiLatih adalah pelatihan yang diselenggarakan oleh komunitas atau sukarelawan
                                Wikimedia, ditujukan terutama bagi masyarakat umum yang belum pernah menyunting di
                                proyek-proyek mereka. Kami mendukung WikiLatih untuk proyek Wikisource dan Wikimedia
                                Commons. WikiLatih Wikisource berfokus pada pengenalan dan pengujian baca naskah-naskah
                                di Wikisource Indonesia serta proyek-proyek bahasa daerah seperti Jawa, Bali, Sunda, dan
                                Melayu. Sementara WikiLatih WikiCommons adalah pelatihan tentang cara mengunggah dan
                                berkontribusi di Wikimedia Commons, termasuk mempelajari dasar-dasar lisensi terbuka,
                                hak cipta, dan domain publik di Indonesia.
                            </p>
                            <a href="https://id.wikimedia.org/wiki/WikiLatih/Kebudayaan"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white rounded-lg font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Kompetisi Wikisource -->
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div class="order-2 lg:order-1">
                            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                                Kompetisi Wikisource
                            </h2>
                            <p class="text-slate-600 text-base leading-relaxed mb-6">
                                Kompetisi Wikisource merupakan kegiatan yang mendorong masyarakat untuk ikut serta
                                merawat dan membuka akses terhadap karya pengetahuan. Melalui platform Wikisource,
                                peserta diajak mengujibaca, memeriksa, dan memperbaiki teks dari naskah hasil
                                digitalisasi sehingga dapat dibaca dengan baik dan tersedia secara bebas. Lebih dari
                                sekadar lomba, kompetisi ini menjadi sarana belajar literasi digital sekaligus
                                kontribusi nyata dalam melestarikan warisan budaya dan ilmu untuk generasi mendatang.
                            </p>
                            <a href="https://id.wikimedia.org/wiki/Panduan_Penyelenggaraan_Kompetisi_Wikisource"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white rounded-lg font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        <div class="order-1 lg:order-2">
                            <div class="relative rounded-2xl overflow-hidden shadow-xl">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/Bali-lontar-Kemenuh-Tatenger_Lara_miwah_Pangusadan-02.jpg"
                                    alt="Kompetisi Wikisource" class="w-full h-[400px] object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Hibah GLAM Indonesia -->
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <div class="relative rounded-2xl overflow-hidden shadow-xl">
                                <img src="/hero_glam.png" alt="Hibah GLAM Indonesia"
                                    class="w-full h-[400px] object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                                Hibah GLAM Indonesia
                            </h2>
                            <p class="text-slate-600 text-base leading-relaxed mb-6">
                                Kebudayaan Wikimedia Indonesia memberikan dukungan pendanaan bagi para peneliti,
                                praktisi seni dan budaya, arsiparis dan komunitas yang bergerak di ranah galeri,
                                perpustakaan, arsip dan museum Indonesia. Kami mendukung proyek berskala kecil yang
                                mengeksplorasi kelindan antara pengetahuan dan budaya lokal dengan teknologi digital
                                untuk pelestarian dan akses yang lebih luas.
                            </p>
                            <a href="https://meta.wikimedia.org/wiki/Wikimedia_Indonesia/Hibah_GLAM_Indonesia"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white rounded-lg font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-amber-600 to-orange-600">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">
                        Tertarik Ikut Kegiatan Kami?
                    </h2>
                    <p class="text-lg md:text-xl mb-8 text-white/90">
                        Bergabunglah dengan komunitas Wikimedia Indonesia dan ikuti berbagai kegiatan menarik kami untuk
                        berkontribusi pada pelestarian budaya Indonesia.
                    </p>
                    <Link href="/kontak"
                        class="inline-block px-8 py-4 bg-white text-amber-600 rounded-xl font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300">
                    Hubungi Kami
                    </Link>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
/* Additional styles if needed */
</style>