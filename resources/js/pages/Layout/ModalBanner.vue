<script setup>
import { ref, onMounted, watch } from 'vue';

const props = defineProps({
    banners: Array,
    dashboardUrl: {
        type: String,
        default: 'http://dashboard.wikimedia.or.id' // URL dashboard dari env
    }
});

const showModal = ref(false);
const currentBannerIndex = ref(0);
const activeBanners = ref([]);

// Fungsi untuk mendapatkan URL gambar lengkap
const getImageUrl = (imagePath) => {
    if (!imagePath) return '';
    
    // Jika path sudah lengkap (http/https), gunakan langsung
    if (imagePath.startsWith('http')) {
        return imagePath;
    }
    
    // Jika path relatif, gabungkan dengan dashboard URL
    return `${props.dashboardUrl}/storage/${imagePath}`;
};

const checkAndShowBanners = () => {
    if (!props.banners || props.banners.length === 0) return;
    
    // Filter banner yang perlu ditampilkan
    activeBanners.value = props.banners.filter(banner => {
        const bannerData = sessionStorage.getItem(`banner_${banner.id}_data`);
        
        if (bannerData) {
            const { closedAt } = JSON.parse(bannerData);
            const now = new Date().getTime();
            const oneMinute = 60 * 1000;
            
            return now - closedAt >= oneMinute;
        }
        
        return true;
    });
    
    // Tampilkan modal jika ada banner aktif
    if (activeBanners.value.length > 0) {
        setTimeout(() => {
            showModal.value = true;
        }, 1000);
    }
};

onMounted(() => {
    checkAndShowBanners();
});

watch(() => props.banners, () => {
    checkAndShowBanners();
}, { immediate: true, deep: true });

const closeModal = () => {
    if (activeBanners.value.length > 0) {
        const currentBanner = activeBanners.value[currentBannerIndex.value];
        
        const bannerData = {
            closedAt: new Date().getTime()
        };
        sessionStorage.setItem(`banner_${currentBanner.id}_data`, JSON.stringify(bannerData));
    }
    
    showModal.value = false;
    currentBannerIndex.value = 0;
};

const nextBanner = () => {
    if (currentBannerIndex.value < activeBanners.value.length - 1) {
        currentBannerIndex.value++;
    }
};

const prevBanner = () => {
    if (currentBannerIndex.value > 0) {
        currentBannerIndex.value--;
    }
};

const goToBanner = (index) => {
    currentBannerIndex.value = index;
};
</script>

<template>
    <Transition name="fade">
        <div v-if="showModal && activeBanners.length > 0" 
            class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
            @click.self="closeModal">
            
            <div class="relative bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Close Button -->
                <button @click="closeModal"
                    class="absolute top-3 right-3 z-10 p-2 bg-white hover:bg-gray-100 rounded-full shadow-md transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Navigation Arrows -->
                <template v-if="activeBanners.length > 1">
                    <button v-if="currentBannerIndex > 0"
                        @click="prevBanner"
                        class="absolute left-3 top-1/2 -translate-y-1/2 z-10 p-2 bg-white/90 hover:bg-white rounded-full shadow-md transition-colors">
                        <svg class="w-6 h-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <button v-if="currentBannerIndex < activeBanners.length - 1"
                        @click="nextBanner"
                        class="absolute right-3 top-1/2 -translate-y-1/2 z-10 p-2 bg-white/90 hover:bg-white rounded-full shadow-md transition-colors">
                        <svg class="w-6 h-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </template>

                <!-- Banner Content -->
                <TransitionGroup name="slide-fade">
                    <div v-for="(banner, index) in activeBanners" 
                        :key="banner.id"
                        v-show="currentBannerIndex === index">
                        
                        <!-- Banner Image dengan URL lengkap -->
                        <div v-if="banner.gambar" class="w-full">
                            <img 
                                :src="getImageUrl(banner.gambar)" 
                                :alt="banner.judul" 
                                class="w-full h-auto rounded-t-lg object-cover"
                                @error="(e) => e.target.style.display = 'none'">
                        </div>

                        <!-- Banner Content -->
                        <div class="p-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                                {{ banner.judul }}
                            </h2>

                            <div class="text-gray-700 text-base leading-relaxed">
                                <span v-if="banner.deskripsi">{{ banner.deskripsi }} </span>
                                <a v-if="banner.url_pranala"
                                    :href="banner.url_pranala"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-blue-600 hover:text-blue-700 underline font-medium">
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </TransitionGroup>

                <!-- Dots Indicator -->
                <div v-if="activeBanners.length > 1" class="flex justify-center gap-2 pb-6">
                    <button
                        v-for="(banner, index) in activeBanners"
                        :key="`dot-${banner.id}`"
                        @click="goToBanner(index)"
                        :class="[
                            'w-2 h-2 rounded-full transition-all duration-300',
                            currentBannerIndex === index 
                                ? 'bg-blue-600 w-8' 
                                : 'bg-gray-300 hover:bg-gray-400'
                        ]"
                        :aria-label="`Go to banner ${index + 1}`">
                    </button>
                </div>

                <!-- Counter -->
                <div v-if="activeBanners.length > 1" 
                    class="absolute top-3 left-3 bg-black/60 text-white text-sm px-3 py-1 rounded-full">
                    {{ currentBannerIndex + 1 }} / {{ activeBanners.length }}
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
/* Fade transition */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Slide fade transition */
.slide-fade-enter-active {
    transition: all 0.3s ease;
}

.slide-fade-leave-active {
    transition: all 0.3s ease;
    position: absolute;
    width: 100%;
}

.slide-fade-enter-from {
    transform: translateX(30px);
    opacity: 0;
}

.slide-fade-leave-to {
    transform: translateX(-30px);
    opacity: 0;
}

/* Scrollbar */
.overflow-y-auto::-webkit-scrollbar {
    width: 8px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>