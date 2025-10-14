<script setup>
import AppLayout from './Layout/AppLayout.vue';
import ModalBanner from './Layout/ModalBanner.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  banners: Array,
  sliders: Array,
});

const scrollToNextSection = () => {
  const proyekSection = document.querySelector('#proyek-section');
  if (proyekSection) {
    proyekSection.scrollIntoView({ behavior: 'smooth' });
  }
};

// Fungsi untuk mendapatkan URL gambar lengkap (sama seperti ModalBanner)
const getImageUrl = (imagePath) => {
  if (!imagePath) return '';

  if (imagePath.startsWith('http')) {
    return imagePath;
  }

  return `http://dashboard.wikimedia.or.id/storage/${imagePath}`;
};

// Fungsi untuk mendapatkan slider random atau default image
const heroImage = computed(() => {
  if (props.sliders && props.sliders.length > 0) {
    const randomIndex = Math.floor(Math.random() * props.sliders.length);
    return getImageUrl(props.sliders[randomIndex].gambar);
  }
  return '/hero_glam.png';
});
</script>

<template>
  <ModalBanner v-if="banners && banners.length > 0" :banners="banners" />
  <AppLayout>
    <!-- Hero Section -->
    <section class="relative min-h-[85vh] flex items-center overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50/50 to-cyan-50/50" />

      <div class="container mx-auto px-6 lg:px-8 py-20 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          <!-- Left: Visual -->
          <div
            class="relative lg:h-[550px] h-[400px] rounded-3xl overflow-hidden shadow-2xl animate-fade-in order-2 lg:order-1">
            <img :src="heroImage" alt="Kebudayaan Indonesia" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent" />
          </div>

          <!-- Right: Content -->
          <div class="space-y-6 animate-fade-in-delay order-1 lg:order-2">
            <div class="inline-block">
              <span
                class="text-sm font-semibold tracking-wider text-[#006699] uppercase px-4 py-2 bg-blue-100 rounded-full">
                Kebudayaan Wikimedia Indonesia
              </span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 leading-tight">
              Memperkenalkan
              <span class="block mt-2 bg-gradient-to-r from-[#006699] to-[#0088cc] bg-clip-text text-transparent">
                Pusparagam Budaya Indonesia ke Dunia
              </span>
            </h1>

            <div class="flex flex-wrap gap-4 pt-2">
              <button @click="scrollToNextSection"
                class="px-8 py-3.5 bg-gradient-to-r from-[#006699] to-[#0088cc] text-white rounded-xl font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300">
                Selengkapnya
              </button>
              <Link href="/kontak"
                class="px-8 py-3.5 border-2 border-[#006699] text-[#006699] rounded-xl font-semibold hover:bg-[#006699] hover:text-white transition-all duration-300">
              Hubungi Kami
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Tentang Program Section -->
    <section class="py-20 lg:py-28 bg-white">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
          <!-- Section Title -->
          <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 leading-tight">
              <a href="https://wikimedia.or.id" target="_blank" 
                class="text-[#006699] hover:text-[#0088cc] transition-colors duration-300">
                Wikimedia Indonesia
              </a> 
              dengan proyeknya Wikipedia, Wikimedia Commons, Wikisource, Wikidata dan Lisensi Bebas Creative Commons
            </h2>
          </div>

          <!-- Description Paragraphs -->
          <div class="space-y-6 text-slate-600 text-base md:text-lg leading-relaxed">
            <p>
              Program Kebudayaan Wikimedia Indonesia memberikan dukungan terhadap upaya dokumentasi dan pelestarian
              budaya Indonesia termasuk bekerja sama dengan komunitas, institusi pemerintah, dan lembaga budaya dalam
              menyediakan akses terbuka pada warisan budaya Indonesia. Akses terbuka pada warisan budaya memungkinkan
              setiap orang di seluruh dunia untuk menemukan, menggunakan kembali, dan memaknai warisan budaya yang
              mereka miliki sebagai bagian dari identitas kultural.
            </p>
            <p>
              Melalui proyek-proyek Wikimedia yang tersedia dalam berbagai bahasa, Wikimedia Indonesia membantu
              institusi membagikan sumber-dayanya kepada dunia melalui kerja sama yang berdampak luas bersama dengan
              relawan yang berpengalaman. Ini merupakan kesempatan bagi institusi budaya untuk menghadirkan pusparagam
              budaya Indonesia kepada pengunjung baru lewat platform Wikipedia, Wiktionary, Wikimedia Commons, Wikidata
              dan Wikisource.
            </p>
            <p>
              Kerjasama yang saling menguntungkan ini memfasilitasi pembagian sumber daya antara lembaga budaya dan
              Wikimedia sebagai bagian dari kolaborasi berkelanjutan jangka panjang.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Aktivitas Section -->
    <section class="py-20 lg:py-28 bg-gradient-to-b from-white to-slate-50">
      <div class="container mx-auto px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
            Aktivitas Kami
          </h2>
          <p class="text-lg md:text-xl text-slate-600 leading-relaxed">
            Berbagai kegiatan yang kami lakukan bertujuan untuk mendukung penyebaran pengetahuan bebas melalui
            pelatihan, pertemuan komunitas, dan kerja sama dengan berbagai pihak.
          </p>
        </div>

        <!-- Activities Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
          <!-- WikiLatih -->
          <div
            class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="relative overflow-hidden h-64">
              <img src="/wikilatih.jpg" alt="WikiLatih"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-slate-900 mb-3">WikiLatih</h3>
              <p class="text-slate-600 leading-relaxed">
                WikiLatih ada sebagai program pelatihan penyuntingan dasar di Projek Wikimedia bahasa Indonesia.
              </p>
            </div>
          </div>

          <!-- Kopdar -->
          <div
            class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="relative overflow-hidden h-64">
              <img src="/kopdar.jpg" alt="Kopdar"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-slate-900 mb-3">Kopdar</h3>
              <p class="text-slate-600 leading-relaxed">
                Kami mendukung komunitas-komunitas Wikimedia di Indonesia menyelenggarakan kegiatan berkumpul untuk
                menyunting bersama dalam agenda Kopdar.
              </p>
            </div>
          </div>

          <!-- Digitalisasi -->
          <div
            class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="relative overflow-hidden h-64">
              <img src="/digitalisasi.jpg" alt="Digitalisasi"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
              <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
            </div>
            <div class="p-6">
              <h3 class="text-2xl font-bold text-slate-900 mb-3">Digitalisasi</h3>
              <p class="text-slate-600 leading-relaxed">
                Kami bekerja bersama komunitas-komunitas Wikimedia di Indonesia untuk membangun lingkungan digital.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Quote Section -->
    <section class="relative py-20 md:py-28 overflow-hidden">
      <!-- Background Image -->
      <div class="absolute inset-0">
        <img src="/bg-2.png" alt="Background Quote" class="w-full h-full object-cover" />
        <!-- Overlay -->
        <div class="absolute inset-0 bg-white/80"></div>
      </div>

      <!-- Quote Content -->
      <div class="relative z-10 max-w-5xl mx-auto px-6 md:px-8 text-center -mt-8 md:-mt-12">
        <div class="mb-6">
          <span class="text-6xl md:text-7xl text-black-400">❝</span>
        </div>
        <blockquote class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 italic leading-relaxed">
          Bayangkan suatu dunia tempat setiap manusia bisa berbagi beragam pengetahuan secara bebas
        </blockquote>
      </div>
    </section>

    <!-- Proyek Section -->
    <section id="proyek-section" class="py-20 lg:py-28 bg-white">
      <div class="container mx-auto px-6 lg:px-8">
        <!-- Section Title -->
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
            Proyek yang Digunakan
          </h2>
          <p class="text-lg md:text-xl text-slate-600 max-w-3xl mx-auto">
            Platform-platform Wikimedia yang kami gunakan untuk mendokumentasikan dan melestarikan budaya Indonesia
          </p>
        </div>

        <!-- Project Logos -->
        <div class="max-w-5xl mx-auto">
          <div class="relative">
            <!-- Decorative Background -->
            <div
              class="absolute inset-0 bg-gradient-to-br from-blue-100/50 to-cyan-100/50 rounded-3xl transform rotate-2">
            </div>

            <!-- Logos Container -->
            <div class="relative bg-white rounded-3xl shadow-2xl p-8 md:p-12 lg:p-16">
              <div class="grid grid-cols-5 gap-6 md:gap-8">
                <!-- Logo 1 - Wikipedia -->
                <a href="https://id.wikipedia.org" target="_blank" rel="noopener noreferrer"
                  class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 hover:shadow-md transition-all duration-300 group cursor-pointer">
                  <div class="w-16 h-16 md:w-20 md:h-20 flex items-center justify-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f6/Wikipedia-logo-v2-wordmark.svg"
                      alt="Wikipedia" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300" />
                  </div>
                </a>

                <!-- Logo 2 - Wiktionary -->
                <a href="https://id.wiktionary.org" target="_blank" rel="noopener noreferrer"
                  class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 hover:shadow-md transition-all duration-300 group cursor-pointer">
                  <div class="w-16 h-16 md:w-20 md:h-20 flex items-center justify-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/7f/Wiktionary-logo-id.svg"
                      alt="Wiktionary" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300" />
                  </div>
                </a>

                <!-- Logo 3 - Commons -->
                <a href="https://commons.wikimedia.org" target="_blank" rel="noopener noreferrer"
                  class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 hover:shadow-md transition-all duration-300 group cursor-pointer">
                  <div class="w-20 h-16 md:w-24 md:h-20 flex items-center justify-center">
                    <img
                      src="https://upload.wikimedia.org/wikipedia/commons/9/94/Wikimedia_Commons_logo_Spanish_horizontal_in_colour.svg"
                      alt="Wikimedia Commons" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300" />
                  </div>
                </a>

                <!-- Logo 4 - Wikidata -->
                <a href="https://www.wikidata.org" target="_blank" rel="noopener noreferrer"
                  class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 hover:shadow-md transition-all duration-300 group cursor-pointer">
                  <div class="w-16 h-16 md:w-20 md:h-20 flex items-center justify-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/da/Wikidata-Archi38.svg" alt="Wikidata"
                      class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300" />
                  </div>
                </a>

                <!-- Logo 5 - Wikisource -->
                <a href="https://id.wikisource.org" target="_blank" rel="noopener noreferrer"
                  class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 hover:shadow-md transition-all duration-300 group cursor-pointer">
                  <div class="w-16 h-16 md:w-20 md:h-20 flex items-center justify-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/0d/Wikisource-logo-id.svg"
                      alt="Wikisource" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300" />
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </AppLayout>
</template>

<style scoped>
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(30px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fadeIn 0.8s ease-out;
}

.animate-fade-in-delay {
  animation: fadeIn 0.8s ease-out 0.3s both;
}
</style>