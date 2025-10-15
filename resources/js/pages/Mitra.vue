<script setup>
import AppLayout from './Layout/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const sumatraPartners = [
  {
    name: 'Pusat Penelitian Kelapa Sawit, Medan',
    collection: 'Buku-buku tentang perkebunan dalam bahasa Belanda',
    href: 'https://commons.wikimedia.org/wiki/Category:Scanned_from_Perpustakaan_PPKS'
  },
  {
    name: 'Koleksi A. Damhoeri, Payakumbuh',
    collection: 'Karya tulisan sastrawan A. Damhoeri yang dibuka bebas.',
    href: 'https://commons.wikimedia.org/wiki/Category:Scanned_from_A._Damhoeri%27s_collection'
  },
  {
    name: 'Balai Bahasa Provinsi Sumatera Barat, Padang',
    collection: 'Buku-buku terbitan BBPSB dan literasi Minangkabau',
    href: 'https://commons.wikimedia.org/wiki/Category:Balai_Bahasa_Provinsi_Sumatera_Barat'
  },
  {
    name: 'Museum Uang Sumatera, Medan',
    collection: 'Uang kertas dan koin kerajaan, ORI dan ORIDA serta token perkebunan',
    href: 'https://commons.wikimedia.org/wiki/Commons:Museum_Uang_Sumatera'
  },
  {
    name: 'Kutub Chanah, Maninjau',
    collection: 'Koleksi buku dan catatan orang tua Buya HAMKA',
    href: '#'
  },
  {
    name: 'Pusat Dokumentasi dan Informasi Kebudayaan Minangkabau, Padang Panjang',
    collection: 'Majalah terbitan Sumatra Barat sebelum kemerdekaan',
    href: 'https://commons.wikimedia.org/wiki/Commons:Pusat_Dokumentasi_dan_Informasi_Kebudayaan_Minangkabau'
  },
  {
    name: 'Museum Daerah Deli Serdang, Deli Serdang',
    collection: 'Sejarah dan Budaya Kabupaten Deli Serdang',
    href: 'https://commons.wikimedia.org/wiki/Commons:Museum_Daerah_Deli_Serdang'
  }
];

const javaBaliNusaPartners = [
  {
    name: 'Perpustakaan Ajip Rosidi, Bandung',
    collection: 'Majalah berbahasa Sunda, Ensiklopedi dan naskah kuno',
    href: 'https://commons.wikimedia.org/wiki/Category:Scanned_from_Ajip_Rosidi_Library'
  },
  {
    name: 'Yayasan Sastra Lestari, Surakarta',
    collection: 'Majalah Kajawen yang beraksara jawa',
    href: 'https://commons.wikimedia.org/wiki/Category:Majalah_Kajawen'
  },
  {
    name: 'Indonesian Visual Art Archive, Yogyakarta',
    collection: 'Koleksi arsip artikel, video dan audio seni.',
    href: 'https://commons.wikimedia.org/wiki/Category:Indonesian_Visual_Art_Archive'
  },
  {
    name: 'History of Java Museum, Yogyakarta',
    collection: 'Koleksi seni dan budaya jawa',
    href: 'https://commons.wikimedia.org/wiki/Category:History_of_Java_Museum'
  },
  {
    name: 'Museum Tamansiswa Dewantara Kirti Griya, Yogyakarta',
    collection: 'Surat-surat Ki Hajar Dewantara, Buku dan dokumen lainnya',
    href: 'https://commons.wikimedia.org/wiki/Category:Dewantara_Kirti_Griya_Museum'
  },
  {
    name: 'Museum Daerah Dr. (H.C.) Oemboe Hina Kapita, Sumba',
    collection: 'Keramik pada zaman pra-sejarah',
    href: 'https://commons.wikimedia.org/wiki/Category:Images_from_Museum_Dr._%28H.C%29_Oemboe_Hina_Kapita'
  },
  {
    name: 'Museum Pasifika, Bali',
    collection: 'Koleksi lukisan Bali dan Internasional',
    href: 'https://commons.wikimedia.org/wiki/Category:Museum_Pasifika'
  },
  {
    name: 'Indonesian Heritage Museum, Jawa Timur',
    collection: 'Koleksi seni dan budaya Indonesia',
    href: 'https://commons.wikimedia.org/wiki/Category:Indonesian_Heritage_Museum'
  },
  {
    name: 'Dinas Penerangan TNI Angkatan Udara, Yogyakarta',
    collection: 'Foto-foto pesawat tempur dan Alutsisa TNI AU',
    href: 'https://commons.wikimedia.org/wiki/Category:Museum_Dirgantara_Mandala'
  },
  {
    name: 'Majalah Horison, Jakarta',
    collection: 'Majalah sastra Horison',
    href: 'https://commons.wikimedia.org/wiki/Category:Majalah_Horison'
  },
  {
    name: 'Indonesian Islamic Art Museum, Jawa Timur',
    collection: 'Koleksi seni Islam di Nusantara dan juga dunia',
    href: 'https://commons.wikimedia.org/wiki/Category:Indonesian_Islamic_Art_Museum'
  }
];

const netherlandsPartners = [
  {
    name: 'Netherlands Institute for Sound and Vision',
    collection: 'Film propaganda Jepang',
    href: 'https://commons.wikimedia.org/wiki/Category:Japanese_Propaganda_Films'
  },
  {
    name: 'Nationaal Museum van Wereldculturen',
    collection: 'Foto-foto dengan tajuk Indonesia pra- dan pascakemerdekaan',
    href: 'https://commons.wikimedia.org/wiki/Category:NMVW_files_Indonesian_Independence_2020-09'
  },
  {
    name: 'Koninklijk Instituut voor Taal-, Land- en Volkenkunde (KITLV)',
    collection: 'Indonesia pra-kemerdekaan Bukittinggi, Batavia dan Yogyakarta',
    href: 'https://commons.wikimedia.org/wiki/Category:Pictures_from_KITLV_requested_by_Wikimedia_Indonesia'
  }
];
</script>

<template>
  <Head title="Mitra Kami" />
  <AppLayout>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-slate-50 via-blue-50/50 to-cyan-50/50">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
          <div class="inline-block mb-6">
            <span class="text-sm font-semibold tracking-wider text-[#006699] uppercase px-4 py-2 bg-blue-100 rounded-full">
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
              Halaman ini berisi sebagian daftar kolaborasi antara lembaga budaya di Indonesia dengan Wikimedia Indonesia. Daftar ini dapat menjadi inspirasi bagi lembaga budaya untuk merancang inisiatif serupa sekaligus mendokumentasikan berbagai kolaborasi yang berhasil. Proyek-proyek tersebut juga berkontribusi dalam pengembangan konten di Wikimedia Commons, Wikipedia bahasa Indonesia, Wikidata, dan Wikisource.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Image Section -->
    <section class="py-12 bg-white">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
          <img 
            src="/mitra_kebudayaan.png" 
            alt="Mitra Kebudayaan" 
            class="w-full h-auto object-cover rounded-2xl shadow-lg"
          />
        </div>
      </div>
    </section>

    <!-- Sumatera Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
          <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-12">
            Sumatera
          </h2>
          
          <div class="grid md:grid-cols-2 gap-8">
            <div 
              v-for="(partner, index) in sumatraPartners" 
              :key="index"
              class="bg-slate-50 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 border border-slate-200"
            >
              <a 
                :href="partner.href"
                target="_blank"
                rel="noopener noreferrer"
                class="text-xl font-semibold text-[#006699] hover:text-[#0088cc] transition-colors mb-3 block"
              >
                {{ partner.name }}
              </a>
              <p class="text-slate-600 leading-relaxed">
                <span class="font-medium">Koleksi:</span> {{ partner.collection }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Jawa, Bali, dan Nusa Tenggara Section -->
    <section class="py-20 bg-gradient-to-b from-white to-slate-50">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
          <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-12">
            Jawa, Bali, dan Nusa Tenggara
          </h2>
          
          <div class="grid md:grid-cols-2 gap-8">
            <div 
              v-for="(partner, index) in javaBaliNusaPartners" 
              :key="index"
              class="bg-slate-50 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 border border-slate-200"
            >
              <a 
                :href="partner.href"
                target="_blank"
                rel="noopener noreferrer"
                class="text-xl font-semibold text-[#006699] hover:text-[#0088cc] transition-colors mb-3 block"
              >
                {{ partner.name }}
              </a>
              <p class="text-slate-600 leading-relaxed">
                <span class="font-medium">Koleksi:</span> {{ partner.collection }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Belanda Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
          <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-12">
            Belanda
          </h2>
          
          <div class="grid md:grid-cols-2 gap-8">
            <div 
              v-for="(partner, index) in netherlandsPartners" 
              :key="index"
              class="bg-slate-50 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 border border-slate-200"
            >
              <a 
                :href="partner.href"
                target="_blank"
                rel="noopener noreferrer"
                class="text-xl font-semibold text-[#006699] hover:text-[#0088cc] transition-colors mb-3 block"
              >
                {{ partner.name }}
              </a>
              <p class="text-slate-600 leading-relaxed">
                <span class="font-medium">Koleksi:</span> {{ partner.collection }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

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
          <a href="/kontak" class="inline-block px-8 py-4 bg-white text-[#006699] rounded-xl font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300">
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