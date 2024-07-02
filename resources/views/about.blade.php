@extends('template')
 
@section('css')
<style>

</style>
@stop

@section('content')
<!-- Hero -->

<section class="bg-hero">
        <div class="bg-overlay">
            <div class="spacer-header"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h1 style="text-shadow: 2px 2px 4px #010351;" class="text-white">Tentang </h1>
                    </div>
                </div>
            </div>
            <div class="spacer"></div>
        </div>
    </section>

    <!-- Konten -->
    <section class="bg-dark text-light">
        <div class="container py-5">
            <h3 class="text-heading">
                Selamat Datang di Aplikasi Klasifikasi Ikan: "Fishiden"
            </h3>
            <p>
                Terima kasih telah memilih Fishiden sebagai panduan interaktif Anda untuk mengenal lebih dekat ikan yang
                sering ditemukan di lingkungan sekitar. Aplikasi ini didesain dengan tujuan utama untuk memberikan
                edukasi seputar dunia ikan dan membantu Anda mengidentifikasi berbagai jenis ikan dengan mudah.
            </p>

            <hr>

            <div class="row g-3 mt-4">
                <div class="col-12 col-md-4">
                    <div class="bg-glass rounded-3 p-3">
                        <h4 class="text-heading">Tujuan Utama:</h4>
                        <span>Mengedukasi dan Mengidentifikasi</span>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="hstack gap-2 align-items-start">
                        <div class="d-block">
                            <div style="height: 16px; width: 16px; border-radius: 50%;" class="bg-secondary"></div>
                        </div>
                        <p>
                            Mengedukasi. Kami percaya bahwa pengetahuan adalah kunci untuk melindungi dan merawat
                            lingkungan kita. Oleh karena itu, Fishiden hadir untuk memberikan informasi yang mendalam
                            tentang kehidupan ikan, habitat mereka, dan peran penting mereka dalam ekosistem. Kami
                            berharap aplikasi ini dapat menjadi sumber pengetahuan yang bermanfaat bagi pengguna dari
                            berbagai lapisan masyarakat.
                        </p>
                    </div>
                    <div class="hstack gap-2 align-items-start">
                        <div class="d-block">
                            <div style="height: 16px; width: 16px; border-radius: 50%;" class="bg-secondary"></div>
                        </div>
                        <p>
                            Mengidentifikasi. Aplikasi ini memanfaatkan teknologi canggih dalam klasifikasi ikan,
                            memungkinkan Anda dengan mudah mengidentifikasi jenis-jenis ikan yang sering Anda temui di
                            sekitar Anda. Pengguna dapat memanfaatkan fitur pencarian berbasis gambar atau deskripsi
                            untuk mengenali ikan-ikan tersebut secara akurat.
                        </p>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row g-3 mt-4">
                <div class="col-12 col-md-4">
                    <div class="bg-glass rounded-3 p-3">
                        <h4 class="text-heading mb-0">Keunikan Aplikasi Kami</h4>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="hstack gap-2 align-items-start">
                        <div class="d-block">
                            <div style="height: 16px; width: 16px; border-radius: 50%;" class="bg-secondary"></div>
                        </div>
                        <p>
                            Teknologi Klasifikasi Canggih. Kami menggunakan AI dalam klasifikasi gambar untuk memastikan
                            akurasi identifikasi ikan. Dengan ini, pengguna dapat belajar lebih banyak tentang ikan yang
                            mereka temui dengan mudah
                        </p>
                    </div>
                    <div class="hstack gap-2 align-items-start">
                        <div class="d-block">
                            <div style="height: 16px; width: 16px; border-radius: 50%;" class="bg-secondary"></div>
                        </div>
                        <p>
                            Interaktivitas dan Penggunaan yang Mudah. Kami memprioritaskan antarmuka yang ramah pengguna
                            sehingga pengalaman belajar Anda akan menyenangkan. Dengan navigasi yang intuitif, Anda
                            dapat menjelajahi konten edukatif kami dengan lancar.
                        </p>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row g-3 mt-4">
                <div class="col-12 col-md-4">
                    <div class="bg-glass rounded-3 p-3">
                        <h4 class="text-heading mb-0">Bagaimana Anda Dapat Berkontribusi</h4>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="hstack gap-2 align-items-start">
                        <div class="d-block">
                            <div style="height: 16px; width: 16px; border-radius: 50%;" class="bg-secondary"></div>
                        </div>
                        <p>
                            Laporkan Observasi: Jika Anda menemukan ikan yang menarik atau tidak biasa, laporkan observasi Anda melalui fitur pengaduan kami. Ini dapat membantu ilmuwan dan peneliti dalam pemahaman lebih lanjut tentang populasi ikan.
                        </p>
                    </div>
                    <div class="hstack gap-2 align-items-start">
                        <div class="d-block">
                            <div style="height: 16px; width: 16px; border-radius: 50%;" class="bg-secondary"></div>
                        </div>
                        <p>
                            Bagikan Pengetahuan Anda: Jangan ragu untuk berbagi pengetahuan dan pengalaman Anda tentang ikan di komunitas kami. Forum diskusi kami adalah tempat yang ideal untuk bertukar informasi dan memperluas wawasan bersama.
                        </p>
                    </div>
                    <div class="hstack gap-2 align-items-start">
                        <div class="d-block">
                            <div style="height: 16px; width: 16px; border-radius: 50%;" class="bg-secondary"></div>
                        </div>
                        <p>
                            Dengan antusiasme dan partisipasi Anda, Fishiden akan terus berkembang untuk menjadi alat yang lebih efektif dalam edukasi dan penelitian mengenai kehidupan ikan. Mari bersama-sama menjaga keberagaman dan keberlanjutan lingkungan perairan kita.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
<script>
    $(document).ready(function () {

    });
</script>
@stop