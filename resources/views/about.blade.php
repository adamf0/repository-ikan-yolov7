@extends('template')
 
@section('css')
<style>
/*page 2*/
*{
    --primary: #136c72;
}
.grid{
    display: grid;
    grid-template-columns: repeat(2, minmax(10vmax, 1fr));
    grid-gap: 50px;
    padding: 10px;
}
.box{
    background: var(--primary);
    padding: min(8vmax, 80px) 0;
    font-size: 22px;
    color: white;
    opacity: .8;
    border-radius: 10px;
}
.box--icon{
    font-size: 54px;
    margin-bottom: 20px;
}

.section2{
    /* padding: 50px 0; */
    text-align: left;
}

.content__section--grid{
    display: grid;
    grid-template-columns: 1fr;
    grid-row-gap: 10px;

    & .panel{
        height: 15vmax;
        background: var(--primary);
        opacity: .7;
        display: flex;
        justify-content: center;
        align-items: center;
        
        & h3{
            font-size: 1.7rem;
            color: white;
        }
    }
    & .panel__content{
        & p{
            font-size: .9rem;
            color: #3b3b3b;
        }
    }
}

.panel__content{
    :where(h3,h4){
        color: var(--primary);
        font-weight: bold;
    }
    :where(h4){
        margin-top: 20px;
    }
    :where(ol:last-child){
        margin-bottom: 20px;
    }
    :where(li){
        margin-left: 50px;
        text-align: justify;
        font-size: .9rem;
    }
}
/*end page 2*/
</style>
@stop

@section('content')
<section class="section2">
        <div class="content__section--grid">
            <div class="panel">
                <h3>About</h3>
            </div>
            <div class="container panel__content">
                <h3>Selamat Datang di Aplikasi Klasifikasi Ikan: "Fishiden"</h3>
                <p>Terima kasih telah memilih Fishiden sebagai panduan interaktif Anda untuk mengenal lebih dekat ikan yang sering ditemukan di lingkungan sekitar. Aplikasi ini didesain dengan tujuan utama untuk memberikan edukasi seputar dunia ikan dan membantu Anda mengidentifikasi berbagai jenis ikan dengan mudah.</p>
                
                <h4>Tujuan Utama: Mengedukasi dan Mengidentifikasi</h4>
                <ol>
                    <li>Mengedukasi. Kami percaya bahwa pengetahuan adalah kunci untuk melindungi dan merawat lingkungan kita. Oleh karena itu, Fishiden hadir untuk memberikan informasi yang mendalam tentang kehidupan ikan, habitat mereka, dan peran penting mereka dalam ekosistem. Kami berharap aplikasi ini dapat menjadi sumber pengetahuan yang bermanfaat bagi pengguna dari berbagai lapisan masyarakat.</li>
                    <li>Mengidentifikasi. Aplikasi ini memanfaatkan teknologi canggih dalam klasifikasi ikan, memungkinkan Anda dengan mudah mengidentifikasi jenis-jenis ikan yang sering Anda temui di sekitar Anda. Pengguna dapat memanfaatkan fitur pencarian berbasis gambar atau deskripsi untuk mengenali ikan-ikan tersebut secara akurat.</li>
                </ol> 
                
                <h4>Keunikan Aplikasi Kami</h4>
                <ol>
                    <li>Teknologi Klasifikasi Canggih. Kami menggunakan AI dalam klasifikasi gambar untuk memastikan akurasi identifikasi ikan. Dengan ini, pengguna dapat belajar lebih banyak tentang ikan yang mereka temui dengan mudah</li>
                    <li>Interaktivitas dan Penggunaan yang Mudah. Kami memprioritaskan antarmuka yang ramah pengguna sehingga pengalaman belajar Anda akan menyenangkan. Dengan navigasi yang intuitif, Anda dapat menjelajahi konten edukatif kami dengan lancar.</li>
                </ol>

                <h4>Bagaimana Anda Dapat Berkontribusi</h4>
                <ol>
                    <li>Laporkan Observasi: Jika Anda menemukan ikan yang menarik atau tidak biasa, laporkan observasi Anda melalui fitur pengaduan kami. Ini dapat membantu ilmuwan dan peneliti dalam pemahaman lebih lanjut tentang populasi ikan.</li>
                    <li>Bagikan Pengetahuan Anda: Jangan ragu untuk berbagi pengetahuan dan pengalaman Anda tentang ikan di komunitas kami. Forum diskusi kami adalah tempat yang ideal untuk bertukar informasi dan memperluas wawasan bersama.</li>
                    <li>Dengan antusiasme dan partisipasi Anda, Fishiden akan terus berkembang untuk menjadi alat yang lebih efektif dalam edukasi dan penelitian mengenai kehidupan ikan. Mari bersama-sama menjaga keberagaman dan keberlanjutan lingkungan perairan kita.</li>
                </ol>
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