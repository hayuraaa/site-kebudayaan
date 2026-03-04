<script setup>
import AppLayout from './Layout/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    regions: {
        type: Array,
        default: () => []
    }
});
</script>

<template>
    <Head title="Mitra Kami" />
    <AppLayout>
        <!-- Hero Section -->
        <section class="relative py-20 bg-gradient-to-br from-slate-50 via-blue-50/50 to-cyan-50/50">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="inline-block mb-6">
                        <span
                            class="text-sm font-semibold tracking-wider text-[#006699] uppercase px-4 py-2 bg-blue-100 rounded-full">
                            Kolaborasi GLAM
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-[#006699] to-[#0088cc] bg-clip-text text-transparent">
                            Mitra Kami
                        </span>
                    </h1>

                    <div class="space-y-4 text-lg md:text-xl text-slate-600 leading-relaxed">
                        <p>
                            Halaman ini berisi sebagian daftar kolaborasi antara lembaga budaya di Indonesia dengan
                            Wikimedia Indonesia. Daftar ini dapat menjadi inspirasi bagi lembaga budaya untuk merancang
                            inisiatif serupa sekaligus mendokumentasikan berbagai kolaborasi yang berhasil. Proyek-proyek
                            tersebut juga berkontribusi dalam pengembangan konten di Wikimedia Commons, Wikipedia bahasa
                            Indonesia, Wikidata, dan Wikisource.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Image Section -->
        <section class="py-12 bg-white">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-6xl mx-auto">
                    <img src="/mitra_kebudayaan.png" alt="Mitra Kebudayaan"
                        class="w-full h-auto object-cover rounded-2xl shadow-lg" />
                </div>
            </div>
        </section>

        <!-- Dynamic Regions -->
        <template v-if="regions && regions.length > 0">
            <section v-for="(region, index) in regions" :key="region.id"
                :class="index % 2 === 0 ? 'py-20 bg-white' : 'py-20 bg-gradient-to-b from-white to-slate-50'">
                <div class="container mx-auto px-6 lg:px-8">
                    <div class="max-w-6xl mx-auto">
                        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-12">
                            {{ region.name }}
                        </h2>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div v-for="item in region.items" :key="item.id"
                                class="bg-slate-50 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 border border-slate-200">
                                <a v-if="item.url" :href="item.url" target="_blank" rel="noopener noreferrer"
                                    class="text-xl font-semibold text-[#006699] hover:text-[#0088cc] transition-colors mb-3 block">
                                    {{ item.name }}
                                </a>
                                <span v-else class="text-xl font-semibold text-slate-700 mb-3 block">
                                    {{ item.name }}
                                </span>
                                <p class="text-slate-600 leading-relaxed">
                                    <span class="font-medium">Koleksi:</span> {{ item.collection }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>

        <!-- Empty State -->
        <section v-else class="py-20 bg-white">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-3xl mx-auto text-center">
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Belum Ada Data Mitra</h3>
                    <p class="text-slate-600">Data mitra akan segera tersedia.</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-[#006699] to-[#0088cc]">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">
                        Mari Bekerja Sama
                    </h2>
                    <p class="text-lg md:text-xl mb-8 text-white/90">
                        Apakah institusi Anda ingin membagikan koleksi digital secara terbuka?
                        Mari berkolaborasi untuk memperkaya pengetahaan Indonesia di dunia digital.
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

<style scoped>
/* Additional styles if needed */
</style>