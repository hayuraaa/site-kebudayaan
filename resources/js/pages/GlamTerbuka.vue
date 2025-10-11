<script setup>
import { ref, onMounted, computed, watch } from 'vue';
import AppLayout from './Layout/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    glamLocations: Array,
    totalLocations: Number,
    error: String
});

const mapContainer = ref(null);
const currentView = ref('map');
const itemsPerPage = 30;
const currentPage = ref(1);
let map = null;

// Computed properties untuk pagination
const paginatedTableData = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.glamLocations.slice(start, end);
});

const paginatedGridData = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.glamLocations.slice(start, end);
});

const totalPages = computed(() => {
    return Math.ceil(props.glamLocations.length / itemsPerPage);
});

const hasMorePages = computed(() => {
    return currentPage.value < totalPages.value;
});

const hasPreviousPages = computed(() => {
    return currentPage.value > 1;
});

// Reset page ketika view berubah
watch(currentView, () => {
    currentPage.value = 1;
});

const loadMore = () => {
    if (hasMorePages.value) {
        currentPage.value++;
        scrollToTop();
    }
};

const loadPrevious = () => {
    if (hasPreviousPages.value) {
        currentPage.value--;
        scrollToTop();
    }
};

const goToPage = (page) => {
    currentPage.value = page;
    scrollToTop();
};

const scrollToTop = () => {
    const container = document.querySelector('.overflow-y-auto');
    if (container) {
        container.scrollTo({ top: 0, behavior: 'smooth' });
    }
};

// Generate page numbers untuk pagination
const pageNumbers = computed(() => {
    const pages = [];
    const total = totalPages.value;
    const current = currentPage.value;
    
    if (total <= 7) {
        // Jika total halaman <= 7, tampilkan semua
        for (let i = 1; i <= total; i++) {
            pages.push(i);
        }
    } else {
        // Selalu tampilkan halaman 1
        pages.push(1);
        
        if (current > 3) {
            pages.push('...');
        }
        
        // Tampilkan halaman di sekitar current page
        for (let i = Math.max(2, current - 1); i <= Math.min(total - 1, current + 1); i++) {
            pages.push(i);
        }
        
        if (current < total - 2) {
            pages.push('...');
        }
        
        // Selalu tampilkan halaman terakhir
        pages.push(total);
    }
    
    return pages;
});

const setView = (view) => {
    currentView.value = view;
    if (view === 'map' && !map) {
        setTimeout(initMap, 100);
    }
};

onMounted(() => {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
    document.head.appendChild(link);

    const clusterCSS = document.createElement('link');
    clusterCSS.rel = 'stylesheet';
    clusterCSS.href = 'https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css';
    document.head.appendChild(clusterCSS);

    const clusterDefaultCSS = document.createElement('link');
    clusterDefaultCSS.rel = 'stylesheet';
    clusterDefaultCSS.href = 'https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css';
    document.head.appendChild(clusterDefaultCSS);

    const script = document.createElement('script');
    script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
    script.onload = () => {
        const clusterScript = document.createElement('script');
        clusterScript.src = 'https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js';
        clusterScript.onload = initMap;
        document.head.appendChild(clusterScript);
    };
    document.head.appendChild(script);
});

const initMap = () => {
    if (!mapContainer.value || map) return;

    map = L.map(mapContainer.value, {
        minZoom: 5,
        maxZoom: 18
    }).setView([-2.5, 118], 5);

    const indonesiaBounds = [[-11, 95], [6, 141]];
    map.setMaxBounds(indonesiaBounds);
    map.on('drag', function () {
        map.panInsideBounds(indonesiaBounds, { animate: false });
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 18
    }).addTo(map);

    const markers = L.markerClusterGroup({
        chunkedLoading: true,
        chunkInterval: 200,
        chunkDelay: 50,
        maxClusterRadius: 80,
        spiderfyOnMaxZoom: true,
        showCoverageOnHover: false,
        zoomToBoundsOnClick: true
    });

    props.glamLocations.forEach(location => {
        const marker = L.marker([location.lat, location.lng]);

        let popupContent = `<div class="p-2"><h3 class="font-bold text-lg mb-2">${location.name}</h3>`;

        if (location.img) {
            popupContent += `<img src="${location.img}" alt="${location.name}" class="w-full h-32 object-cover rounded mb-2" />`;
        }

        if (location.wp) {
            popupContent += `<a href="${location.wp}" target="_blank" class="text-blue-600 hover:underline text-sm block mb-1">Wikipedia →</a>`;
        }

        if (location.wd) {
            popupContent += `<a href="https://www.wikidata.org/wiki/${location.wd}" target="_blank" class="text-amber-600 hover:underline text-sm block">Wikidata (${location.wd}) →</a>`;
        }

        popupContent += `</div>`;
        marker.bindPopup(popupContent);
        markers.addLayer(marker);
    });

    map.addLayer(markers);
    console.log(`✅ Loaded ${props.glamLocations.length} markers with clustering`);
};

const groupedLocations = props.glamLocations.reduce((acc, location) => {
    const words = location.name.split(' ');
    const province = words[words.length - 1] || 'Lainnya';
    if (!acc[province]) {
        acc[province] = [];
    }
    acc[province].push(location);
    return acc;
}, {});
</script>

<template>
    <Head title="GLAM Terbuka" />
    <AppLayout>
        <section class="relative py-20 bg-gradient-to-br from-slate-50 via-orange-50/50 to-amber-50/50">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="inline-block mb-6">
                        <span class="text-sm font-semibold tracking-wider text-amber-700 uppercase px-4 py-2 bg-amber-100 rounded-full">
                            Galleries, Libraries, Archives and Museums
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                            GLAM Terbuka
                        </span>
                    </h1>

                    <p class="text-lg md:text-xl text-slate-600 leading-relaxed mb-8">
                        GLAM adalah singkatan dari <strong>Galleries, Libraries, Archives and Museums</strong>
                        (Galeri, Perpustakaan, Arsip dan Museum). Program GLAM Terbuka mendorong institusi budaya
                        untuk berbagi koleksi digital mereka secara terbuka dengan dunia melalui proyek-proyek Wikimedia.
                    </p>

                    <div class="flex flex-wrap justify-center gap-8 pt-6">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-amber-600">{{ totalLocations }}+</div>
                            <div class="text-sm text-slate-600 mt-1">Lokasi GLAM</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 bg-white">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                            Peta Jejaring GLAM di Indonesia
                        </h2>
                        <p class="text-lg text-slate-600">
                            Jelajahi {{ totalLocations }} lokasi institusi budaya di seluruh Indonesia yang terdaftar di Wikidata
                        </p>
                    </div>

                    <div v-if="error" class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ error }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-200">
                        <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                <button @click="setView('map')" :class="[
                                    'px-4 py-2 rounded-lg font-medium transition-all duration-200',
                                    currentView === 'map' ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100'
                                ]">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                        Peta
                                    </span>
                                </button>

                                <button @click="setView('table')" :class="[
                                    'px-4 py-2 rounded-lg font-medium transition-all duration-200',
                                    currentView === 'table' ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100'
                                ]">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        Tabel
                                    </span>
                                </button>

                                <button @click="setView('grid')" :class="[
                                    'px-4 py-2 rounded-lg font-medium transition-all duration-200',
                                    currentView === 'grid' ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100'
                                ]">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                                        </svg>
                                        Grid
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div v-show="currentView === 'map'" ref="mapContainer" class="w-full h-[600px] relative z-10"></div>

                        <!-- Table View with Lazy Loading -->
                        <div v-show="currentView === 'table'" class="overflow-x-auto max-h-[600px] overflow-y-auto">
                            <table class="w-full">
                                <thead class="bg-slate-100 sticky top-0 z-10">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Koordinat</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Link</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-200">
                                    <tr v-for="(location, index) in paginatedTableData" :key="index" class="hover:bg-slate-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                            {{ (currentPage - 1) * itemsPerPage + index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-900">{{ location.name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                            {{ location.lat.toFixed(4) }}, {{ location.lng.toFixed(4) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex gap-2">
                                                <a v-if="location.wp" :href="location.wp" target="_blank" class="text-blue-600 hover:underline">Wikipedia</a>
                                                <a v-if="location.wd" :href="`https://www.wikidata.org/wiki/${location.wd}`" target="_blank" class="text-amber-600 hover:underline">Wikidata</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <!-- Pagination for Table -->
                            <div class="p-6 border-t border-slate-200">
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <div class="text-sm text-slate-600">
                                        Menampilkan <span class="font-semibold">{{ (currentPage - 1) * itemsPerPage + 1 }}</span> 
                                        sampai <span class="font-semibold">{{ Math.min(currentPage * itemsPerPage, totalLocations) }}</span> 
                                        dari <span class="font-semibold">{{ totalLocations }}</span> lokasi
                                    </div>
                                    
                                    <div class="flex items-center gap-2">
                                        <button 
                                            @click="loadPrevious" 
                                            :disabled="!hasPreviousPages"
                                            :class="[
                                                'px-4 py-2 rounded-lg font-medium transition-colors',
                                                hasPreviousPages 
                                                    ? 'bg-white border border-slate-300 text-slate-700 hover:bg-slate-50' 
                                                    : 'bg-slate-100 text-slate-400 cursor-not-allowed'
                                            ]">
                                            ← Sebelumnya
                                        </button>
                                        
                                        <div class="flex items-center gap-1">
                                            <button
                                                v-for="(page, index) in pageNumbers"
                                                :key="index"
                                                @click="page !== '...' ? goToPage(page) : null"
                                                :class="[
                                                    'min-w-[40px] h-[40px] rounded-lg font-medium transition-colors',
                                                    page === currentPage 
                                                        ? 'bg-amber-600 text-white' 
                                                        : page === '...'
                                                        ? 'cursor-default text-slate-400'
                                                        : 'bg-white border border-slate-300 text-slate-700 hover:bg-slate-50'
                                                ]">
                                                {{ page }}
                                            </button>
                                        </div>
                                        
                                        <button 
                                            @click="loadMore" 
                                            :disabled="!hasMorePages"
                                            :class="[
                                                'px-4 py-2 rounded-lg font-medium transition-colors',
                                                hasMorePages 
                                                    ? 'bg-white border border-slate-300 text-slate-700 hover:bg-slate-50' 
                                                    : 'bg-slate-100 text-slate-400 cursor-not-allowed'
                                            ]">
                                            Selanjutnya →
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Grid View with Lazy Loading -->
                        <div v-show="currentView === 'grid'" class="max-h-[600px] overflow-y-auto">
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <div v-for="(location, index) in paginatedGridData" :key="index" class="bg-white border border-slate-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                                        <div v-if="location.img" class="h-48 overflow-hidden">
                                            <img :src="location.img" :alt="location.name" class="w-full h-full object-cover" loading="lazy" />
                                        </div>
                                        <div v-else class="h-48 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-semibold text-slate-900 mb-2 line-clamp-2">{{ location.name }}</h3>
                                            <p class="text-xs text-slate-500 mb-3">
                                                {{ location.lat.toFixed(4) }}, {{ location.lng.toFixed(4) }}
                                            </p>
                                            <div class="flex gap-2">
                                                <a v-if="location.wp" :href="location.wp" target="_blank" class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200">
                                                    Wikipedia
                                                </a>
                                                <a v-if="location.wd" :href="`https://www.wikidata.org/wiki/${location.wd}`" target="_blank" class="text-xs px-3 py-1 bg-amber-100 text-amber-700 rounded-full hover:bg-amber-200">
                                                    Wikidata
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Pagination for Grid -->
                            <div class="p-6 border-t border-slate-200">
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <div class="text-sm text-slate-600">
                                        Menampilkan <span class="font-semibold">{{ (currentPage - 1) * itemsPerPage + 1 }}</span> 
                                        sampai <span class="font-semibold">{{ Math.min(currentPage * itemsPerPage, totalLocations) }}</span> 
                                        dari <span class="font-semibold">{{ totalLocations }}</span> lokasi
                                    </div>
                                    
                                    <div class="flex items-center gap-2">
                                        <button 
                                            @click="loadPrevious" 
                                            :disabled="!hasPreviousPages"
                                            :class="[
                                                'px-4 py-2 rounded-lg font-medium transition-colors',
                                                hasPreviousPages 
                                                    ? 'bg-white border border-slate-300 text-slate-700 hover:bg-slate-50' 
                                                    : 'bg-slate-100 text-slate-400 cursor-not-allowed'
                                            ]">
                                            ← Sebelumnya
                                        </button>
                                        
                                        <div class="flex items-center gap-1">
                                            <button
                                                v-for="(page, index) in pageNumbers"
                                                :key="index"
                                                @click="page !== '...' ? goToPage(page) : null"
                                                :class="[
                                                    'min-w-[40px] h-[40px] rounded-lg font-medium transition-colors',
                                                    page === currentPage 
                                                        ? 'bg-amber-600 text-white' 
                                                        : page === '...'
                                                        ? 'cursor-default text-slate-400'
                                                        : 'bg-white border border-slate-300 text-slate-700 hover:bg-slate-50'
                                                ]">
                                                {{ page }}
                                            </button>
                                        </div>
                                        
                                        <button 
                                            @click="loadMore" 
                                            :disabled="!hasMorePages"
                                            :class="[
                                                'px-4 py-2 rounded-lg font-medium transition-colors',
                                                hasMorePages 
                                                    ? 'bg-white border border-slate-300 text-slate-700 hover:bg-slate-50' 
                                                    : 'bg-slate-100 text-slate-400 cursor-not-allowed'
                                            ]">
                                            Selanjutnya →
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tree View (unchanged, already efficient) -->
                    </div>

                    <div class="mt-8 grid md:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl">
                            <div class="text-3xl mb-2">🏛️</div>
                            <h3 class="font-bold text-lg text-slate-900 mb-2">Museum</h3>
                            <p class="text-slate-600 text-sm">Institusi yang mengoleksi dan memamerkan artefak budaya dan sejarah</p>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl">
                            <div class="text-3xl mb-2">📚</div>
                            <h3 class="font-bold text-lg text-slate-900 mb-2">Perpustakaan</h3>
                            <p class="text-slate-600 text-sm">Pusat sumber pengetahuan dan informasi untuk masyarakat</p>
                        </div>

                        <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-xl">
                            <div class="text-3xl mb-2">🎨</div>
                            <h3 class="font-bold text-lg text-slate-900 mb-2">Galeri & Arsip</h3>
                            <p class="text-slate-600 text-sm">Tempat penyimpanan dan pameran karya seni serta dokumen bersejarah</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-gradient-to-b from-white to-slate-50">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-6xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-12">
                        <div>
                            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                                Mengapa GLAM Terbuka Penting?
                            </h2>
                            <div class="space-y-4 text-slate-600 text-base leading-relaxed">
                                <p>
                                    Inisiatif GLAM Terbuka (Galeri, Perpustakaan, Arsip dan Museum) bersama dengan
                                    Wikimedia dan proyeknya membantu institusi membagikan sumber-dayanya kepada dunia
                                    melalui kerja sama yang berdampak luas bersama-sama dengan relawan yang
                                    berpengalaman. Ini merupakan kesempatan bagi institusi GLAM untuk menghadirkan
                                    koleksi-koleksi GLAM kepada pengunjung baru lewat platform Wikipedia, Wikimedia
                                    Commons, Wikidata dan Wikisource.
                                </p>
                                <p>
                                    Wikipedia memiliki statistik jutaan kunjungan halaman setiap hari, memiliki lebih
                                    dari 350 bahasa, dan memiliki lebih dari 65 juta halaman artikel. Konten tersebut
                                    dibuat dan dijaga oleh ribuan sukarelawan "Wikipediawan" yang berdedikasi di seluruh
                                    dunia. Semua orang dari peneliti akademis hingga peneliti silsilah keluarga amatir
                                    bahkan hingga siswa-siswa muda menggunakan Wikipedia untuk mencari informasi dan
                                    sumber lain. Hingga 2025, Wikipedia diproyeksikan telah melayani 1 miliar orang
                                    dengan lebih dari 65 juta artikelnya dan begitu juga proyek Wikimedia lainnya.
                                </p>
                            </div>
                        </div>

                        <div class="lg:pt-[4.5rem]">
                            <div class="space-y-4 text-slate-600 text-base leading-relaxed">
                                <p>
                                    Komunitas Wikimedia sangat ingin membantu institusi GLAM Anda dalam mengembangkan
                                    artikel mengenai koleksi Anda. Seorang Wikimedian in Residence diperbantukan kepada
                                    sebuah institusi GLAM untuk merencanakan dan berkoordinasi bagaimana institusi GLAM
                                    tersebut dapat meningkatkan keterpaparannya di Wikipedia dan proyek lainnya.
                                    Aktivitas yang dilakukan oleh Wikimedian in Residence ini sangat luas dan beragam,
                                    dan dapat berdampak langsung pada pengembangan konten bersama-sama dengan kurator,
                                    koordinasi mengenai donasi gambar dan multimedia lain, melaksanakan kunjungan/acara,
                                    dan melaksanakan tantangan dan kompetisi yang mempromosikan pengembangan artikel.
                                </p>
                                <p>
                                    Kerjasama yang saling menguntungkan ini memfasilitasi pembagian sumber daya antara
                                    GLAM dan Wikimedia sebagai bagian dari kolaborasi berkelanjutan jangka panjang.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-gradient-to-r from-amber-600 to-orange-600">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">
                        Bergabunglah dengan Gerakan GLAM Terbuka
                    </h2>
                    <p class="text-lg md:text-xl mb-8 text-white/90">
                        Apakah institusi Anda ingin membagikan koleksi digital secara terbuka?
                        Mari berkolaborasi untuk memperkaya pengetahaan Indonesia di dunia digital.
                    </p>
                    <a href="/kontak" class="inline-block px-8 py-4 bg-white text-amber-600 rounded-xl font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
:deep(.leaflet-popup-content-wrapper) {
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

:deep(.leaflet-popup-content) {
    margin: 0;
    min-width: 200px;
}
</style>