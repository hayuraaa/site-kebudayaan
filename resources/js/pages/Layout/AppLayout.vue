<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Menu, X, ChevronDown } from 'lucide-vue-next';
import ScrollToTop from './ScrollToTop.vue';

const mobileMenuOpen = ref(false);
const MenuOpen = ref(false);
const page = usePage();

const navigation = [
  { name: 'Beranda', href: '/' },
  { name: 'GLAM Terbuka', href: '/glam-terbuka' },
  { name: 'Mitra', href: '/mitra' },
  { name: 'Media', href: '/media' },
  { name: 'Kegiatan', href: '/kegiatan' },
  { name: 'Kebijakan Ruang Ramah', href: '/kebijakan-ruang-ramah' },
  { name: 'Kontak', href: '/kontak' },
];

const isActive = (href) => {
  return page.url === href || page.url.startsWith(href + '/');
};

const isSubmenuActive = (submenu) => {
  return submenu.some(item => isActive(item.href));
};
</script>

<template>
  <div class="min-h-screen bg-white">
    <!-- Header/Navbar -->
    <header class="sticky top-0 z-50 w-full border-b border-gray-200 bg-white/80 backdrop-blur-md shadow-sm">
      <nav class="container mx-auto px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
          <!-- Logo -->
          <Link href="/" class="flex items-center">
          <img src="https://upload.wikimedia.org/wikipedia/commons/8/8d/Logo_Kebudayaan_WMID.svg"
            alt="Kebudayaan Wikimedia Indonesia" class="h-12 md:h-16 w-auto" />
          </Link>

          <!-- Desktop Navigation - Aligned Right -->
          <div class="hidden md:flex items-center space-x-1">
            <template v-for="item in navigation" :key="item.name">
              <!-- Menu with Dropdown -->
              <div v-if="item.hasDropdown" class="relative group">
                <button :class="[
                  'relative px-6 py-2.5 text-sm font-medium transition-all duration-200 flex items-center gap-1',
                  isSubmenuActive(item.submenu)
                    ? 'text-[#006699]'
                    : 'text-black hover:text-[#006699]'
                ]">
                  {{ item.name }}
                  <ChevronDown class="w-4 h-4" />
                  <span v-if="isSubmenuActive(item.submenu)"
                    class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#006699] rounded-full"></span>
                </button>

                <!-- Dropdown Menu -->
                <div
                  class="absolute left-0 mt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                  <div class="bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                    <Link v-for="subitem in item.submenu" :key="subitem.name" :href="subitem.href" :class="[
                      'block px-4 py-2.5 text-sm transition-colors',
                      isActive(subitem.href)
                        ? 'text-[#006699] bg-blue-50'
                        : 'text-gray-700 hover:text-[#006699] hover:bg-gray-50'
                    ]">
                    {{ subitem.name }}
                    </Link>
                  </div>
                </div>
              </div>

              <!-- Regular Menu Item -->
              <Link v-else :href="item.href" :class="[
                'relative px-6 py-2.5 text-sm font-medium transition-all duration-200',
                isActive(item.href)
                  ? 'text-[#006699]'
                  : 'text-black hover:text-[#006699]'
              ]">
              {{ item.name }}
              <span v-if="isActive(item.href)"
                class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#006699] rounded-full"></span>
              </Link>
            </template>
          </div>

          <!-- Mobile menu button -->
          <button @click="mobileMenuOpen = !mobileMenuOpen"
            class="md:hidden p-2 rounded-lg hover:bg-gray-100 text-black transition-colors">
            <Menu v-if="!mobileMenuOpen" class="h-6 w-6" />
            <X v-else class="h-6 w-6" />
          </button>
        </div>

        <!-- Mobile Navigation -->
        <div v-if="mobileMenuOpen" class="md:hidden py-4 border-t border-gray-200">
          <div class="flex flex-col space-y-2">
            <template v-for="item in navigation" :key="item.name">
              <!-- Mobile Dropdown Menu -->
              <div v-if="item.hasDropdown">
                <button @click="programMenuOpen = !programMenuOpen" :class="[
                  'w-full text-left relative px-3 py-2 text-sm font-medium transition-all flex items-center justify-between',
                  isSubmenuActive(item.submenu)
                    ? 'text-[#006699] pl-6'
                    : 'text-black hover:text-[#006699] hover:pl-6'
                ]">
                  <span v-if="isSubmenuActive(item.submenu)"
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#006699] rounded-r-full"></span>
                  {{ item.name }}
                  <ChevronDown :class="['w-4 h-4 transition-transform', programMenuOpen ? 'rotate-180' : '']" />
                </button>

                <!-- Mobile Submenu -->
                <div v-if="programMenuOpen" class="pl-6 mt-2 space-y-2">
                  <Link v-for="subitem in item.submenu" :key="subitem.name" :href="subitem.href" :class="[
                    'block px-3 py-2 text-sm transition-all',
                    isActive(subitem.href)
                      ? 'text-[#006699] font-medium'
                      : 'text-gray-600 hover:text-[#006699]'
                  ]" @click="mobileMenuOpen = false">
                  {{ subitem.name }}
                  </Link>
                </div>
              </div>

              <!-- Regular Mobile Menu Item -->
              <Link v-else :href="item.href" :class="[
                'relative px-3 py-2 text-sm font-medium transition-all',
                isActive(item.href)
                  ? 'text-[#006699] pl-6'
                  : 'text-black hover:text-[#006699] hover:pl-6'
              ]" @click="mobileMenuOpen = false">
              <span v-if="isActive(item.href)"
                class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-[#006699] rounded-r-full"></span>
              {{ item.name }}
              </Link>
            </template>
          </div>
        </div>
      </nav>
    </header>

    <!-- Main Content -->
    <main>
      <slot />
    </main>

    <!-- Footer -->
    <!-- Footer -->
    <footer class="bg-gray-100 border-t border-gray-200 py-16 mt-10">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">
          <!-- Logo dan Deskripsi - 5 kolom -->
          <div class="col-span-12 md:col-span-5">
            <!-- Container untuk kedua logo -->
            <div class="flex items-center gap-4 mb-6">
              <img src="https://upload.wikimedia.org/wikipedia/commons/8/8d/Logo_Kebudayaan_WMID.svg"
                alt="Kebudayaan Wikimedia Indonesia" class="h-24 w-auto" />
              <a href="https://wikimedia.or.id" target="_blank" rel="noopener noreferrer"
                class="transition-transform hover:scale-105">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Wikimedia-logo-id.svg"
                  alt="Wikimedia Indonesia" class="h-20 w-auto" />
              </a>
            </div>

            <p class="text-gray-700 leading-relaxed">
              Program Kebudayaan <a href="https://wikimedia.or.id" target="_blank"
                class="text-blue-600 hover:underline">Wikimedia Indonesia</a> mendukung upaya dokumentasi dan
              pelestarian budaya Indonesia melalui proyek Wikimedia.
            </p>

            <!-- Social Media Icons -->
            <div class="flex gap-4 mt-6">
              <a href="https://x.com/Kebudayaan_wmid"
                class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-gray-700 text-white flex items-center justify-center transition-colors"
                aria-label="Twitter/X">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                </svg>
              </a>
              <a href="https://www.instagram.com/kebudayaan_wmid/"
                class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-gray-700 text-white flex items-center justify-center transition-colors"
                aria-label="Instagram">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                </svg>
              </a>
              <a href="https://www.youtube.com/c/WikimediaIndonesia"
                class="w-10 h-10 rounded-lg bg-gray-800 hover:bg-gray-700 text-white flex items-center justify-center transition-colors"
                aria-label="YouTube">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                </svg>
              </a>
            </div>
          </div>

          <!-- Site Menu - 3 kolom -->
          <div class="col-span-12 md:col-span-3">
            <h4 class="font-semibold mb-4 text-gray-900">Menu</h4>
            <ul class="space-y-2.5">
              <li>
                <Link href="/glam-terbuka" class="text-gray-700 hover:text-gray-900 transition-colors">
                GLAM Terbuka
                </Link>
              </li>
              <li>
                <Link href="/mitra" class="text-gray-700 hover:text-gray-900 transition-colors">
                Mitra
                </Link>
              </li>
              <li>
                <Link href="/media" class="text-gray-700 hover:text-gray-900 transition-colors">
                Media
                </Link>
              </li>
              <li>
                <Link href="/kebijakan-ruang-ramah" class="text-gray-700 hover:text-gray-900 transition-colors">
                Kebijakan Ruang Ramah
                </Link>
              </li>
              <li>
                <Link href="/kontak" class="text-gray-700 hover:text-gray-900 transition-colors">
                Kontak
                </Link>
              </li>
            </ul>
          </div>

          <!-- Alamat - 4 kolom -->
          <div class="col-span-12 md:col-span-4">
            <h4 class="font-semibold mb-4 text-gray-900">Alamat</h4>
            <div class="text-gray-700 space-y-1 leading-relaxed">
              <p class="font-medium">Wikimedia Indonesia</p>
              <p class="mt-3">TCC Batavia Tower One, Lt. 6</p>
              <p>Jalan K.H. Mas Mansyur No. 12</p>
              <p>Karet Tengsin, Tanah Abang</p>
              <p>Jakarta Pusat 10220</p>
              <p>Indonesia</p>
            </div>
          </div>
        </div>

        <!-- Copyright -->
        <div class="pt-8 border-t border-gray-300 text-center text-sm text-gray-600">
          <p>Lisensi dalam situs ini termasuk tulisan dan gambar merupakan CC-BY-SA 4.0, kecuali dinyatakan berbeda.
          </p>
        </div>
        <ScrollToTop />
      </div>
    </footer>
  </div>
</template>

<style scoped>
/* Tambahan styling jika diperlukan */
</style>