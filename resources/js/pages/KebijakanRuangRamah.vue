<script setup>
import AppLayout from './Layout/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Kebijakan Ruang Ramah" />
  <AppLayout>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-slate-50 via-orange-50/50 to-amber-50/50">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
          <div class="inline-block mb-6">
            <span class="text-sm font-semibold tracking-wider text-amber-700 uppercase px-4 py-2 bg-amber-100 rounded-full">
              Komunitas Wikimedia Indonesia
            </span>
          </div>
          
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-6 leading-tight">
            <span class="bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
              Kebijakan Ruang Ramah
            </span>
          </h1>
          
          <p class="text-lg md:text-xl text-slate-600 leading-relaxed">
            Komunitas Wikimedia berdedikasi untuk memberikan pengalaman yang ramah bagi semua orang, tanpa memandang jenis kelamin, orientasi seksual, identitas gender atau ekspresi, disabilitas, penampilan, ras, agama, atau pilihan lisensi bebas (dan tidak terbatas pada aspek-aspek tersebut).
          </p>
        </div>
      </div>
    </section>

    <!-- Content Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
          <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Column - Text Content -->
            <div>
              <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                Panduan Pertemuan Komunitas
              </h2>
              <div class="space-y-4 text-slate-600 text-base leading-relaxed">
                <p>
                  Kebijakan ruang ramah acara adalah panduan pertemuan komunitas Wikimedia untuk mendorong terciptanya pengalaman yang positif dan membangun bagi seluruh peserta. Komunitas Wikimedia berdedikasi untuk memberikan pengalaman yang ramah bagi semua orang, tanpa memandang jenis kelamin, orientasi seksual, identitas gender atau ekspresi, disabilitas, penampilan, ras, agama, atau pilihan lisensi bebas (dan tidak terbatas pada aspek-aspek tersebut).
                </p>
                <p>
                  Kami tidak memberikan toleransi atas pelecehan yang terjadi di acara yang diselenggarakan oleh Wikimedia Indonesia. Siapa pun yang melanggar peraturan ini dapat diminta untuk meninggalkan acara tersebut.
                </p>
              </div>
            </div>

            <!-- Right Column - Image -->
            <div>
              <div class="relative rounded-2xl overflow-hidden shadow-xl">
                <img 
                  src="/Untitled2.png" 
                  alt="Kebijakan Ruang Ramah" 
                  class="w-full h-[400px] object-cover"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Definisi Pelecehan Section -->
    <section class="py-20 bg-gradient-to-b from-white to-slate-50">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
          <div class="bg-gradient-to-r from-amber-600 to-orange-600 rounded-3xl p-8 md:p-12 shadow-xl">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
              Definisi Pelecehan
            </h2>
            
            <p class="text-white text-lg mb-6">
              Yang termasuk kategori pelecehan, sebagai berikut:
            </p>

            <ul class="space-y-4 text-white text-base md:text-lg">
              <li class="flex items-start gap-3">
                <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="leading-relaxed">
                  Komentar verbal yang menyinggung hal-hal yang berhubungan dengan gender, orientasi seksual, identitas gender atau ekspresi, disabilitas, penampilan fisik, ukuran tubuh, ras, suku, afiliasi politik, atau agama;
                </span>
              </li>
              <li class="flex items-start gap-3">
                <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="leading-relaxed">
                  Intimidasi yang disengaja, menguntit, mengikuti orang lain tanpa seizinnya, pelecehan melalui foto atau rekaman, mengganggu pembicaraan atau acara lainnya;
                </span>
              </li>
              <li class="flex items-start gap-3">
                <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="leading-relaxed">
                  Menampilkan konten-konten seksual yang tidak kontekstual, melakukan kontak fisik yang tidak sesuai pada tempatnya, dan menyoroti aktivitas seksual yang tidak diinginkan;
                </span>
              </li>
              <li class="flex items-start gap-3">
                <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="leading-relaxed">
                  Perilaku lainnya yang tidak secara eksplisit dibahas di atas, tetapi dapat ditafsirkan sebagai bentuk tindakan yang tidak disukai dan tidak masuk akal.
                </span>
              </li>
            </ul>

            <p class="text-white text-lg mt-8 font-semibold">
              Peserta yang diminta untuk menghentikan perilaku tersebut diharapkan dapat mematuhinya.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Konten yang Berpotensi Menyinggung Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
          <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Column - Image -->
            <div class="flex justify-center">
              <img 
                src="/Untitled.png" 
                alt="Konten yang berpotensi menyinggung" 
                class="w-full max-w-md h-auto"
              />
            </div>

            <!-- Right Column - Text Content -->
            <div>
              <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                Konten yang Berpotensi Menyinggung
              </h2>
              <div class="space-y-4 text-slate-600 text-base leading-relaxed">
                <p>
                  Gambar dan media lain yang mungkin menyinggung, menyusahkan, atau mengganggu orang lain tidak boleh ditampilkan dalam konferensi dan acara, kecuali saat konten tersebut terkait langsung dengan topik yang berhubungan dengan Wikimedia. Selain itu, peserta harus diberi informasi dengan jelas sebelum konten ditampilkan.
                </p>
                <p>
                  Beberapa contoh konten semacam itu mencakup gambar yang menunjukkan ketelanjangan, konten seksual, kekerasan, atau gambar medis. Perhatian yang sama juga harus dilakukan ketika menggambarkan orang pribumi yang telah meninggal, tidak hanya dengan citra, tetapi juga dalam rekaman teks atau audio, yang harus dihindari jika memungkinkan.
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Tindakan Pencegahan Section -->
    <section class="py-20 bg-gradient-to-b from-white to-slate-50">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
          <div class="bg-gradient-to-r from-amber-600 to-orange-600 rounded-3xl p-8 md:p-12 shadow-xl">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
              Tindakan Pencegahan
            </h2>
            
            <div class="space-y-6 text-white text-base md:text-lg leading-relaxed">
              <p>
                Acara komunitas Wikimedia dikelola oleh sukarelawan dan/atau staf Wikimedia Indonesia, penyelenggara acara juga mengharapkan bantuan dan dukungan dari semua peserta dalam mempertahankan kebijakan ruang ramah acara ini. Jika Anda mengalami pelecehan, melihat orang lain mengalami pelecehan, atau memiliki masalah lain, segera hubungi panitia.
              </p>

              <p>
                Jika panitia khawatir akan perilaku seseorang atau menerima keluhan dari peserta, panitia akan mengambil tindakan yang sesuai dengan situasi pada saat itu. Tindakan tersebut dapat berupa peringatan secara personal maupun meminta orang yang bersangkutan untuk meninggalkan tempat acara. Panitia dengan senang hati membantu peserta untuk menghubungi pihak keamanan tempat acara atau penegak hukum setempat, memberikan pendampingan, atau membantu orang-orang yang mengalami pelecehan agar merasa aman selama acara berlangsung.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

  </AppLayout>
</template>

<style scoped>
/* Additional styles if needed */
</style>