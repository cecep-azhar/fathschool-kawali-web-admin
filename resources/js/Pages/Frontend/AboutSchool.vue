<template>
  <Head title="AboutSchool" />
  <FrontendLayout>
    <section class="about-school">
      <div class="container">

        <h2>Tentang Sekolah</h2>
        <p>
          SMKN 1 Kawali merupakan sebuah SMK Negeri di kawasan Ciamis Utara yang mulai berdiri tahun 2004. yang awalnya memiliki 
          1 Kompetensi Keahlian yaitu Teknik Mesin Otomotif(TMO) sekrang sudah berkembang menjadi 7 Kompetensi Keahlian 
          yaitu: Teknik Kendaraan Ringan Otomotif (TKRO), Teknik Komputer dan Jaringan (TKJ), Rekayasa Perangkat Lunak (RPL), 
          Desain Pemodelan dan Informasi Bangunan (DPIB), Otomatisasi dan Tata Kelola Perkantoran (OTKP), Akuntansi Keuangan da 
          Lembaga (AKL), dan Seni Karawitan Sunda (SKS), dengan jumlah siswa yang awalnya hanya 18 siswa sekarang sudah mencapai 
          1600 lebih Siswa dan Siswi SMKN 1 Kawali yang merupakan Siswa dan Siswi yang berada di Ciamis Utara bahkan dari Luar Provinsi 
          Jawa Barat.
        </p>

        <div class="cards">
          <div class="card">
            <img src="/images/logokawali.jpg" alt="Mission">
            <h3 style="margin-left: 25px;">Misi SMKN 1 Kawali</h3>
            <p>
              Meningkatkan kerjasama kemitraan, penyerapan lulusan dengan IDUKA, perguruan tinggi, 
              dan lembaga pemerintahan serta membangun jiwa wirausaha yang tangguh dan mandiri.
            </p>
            <p>
              Meningkatkan kualitas SDM, menyediakan sarana dan prasarana yang berkualitas, dan 
              menyajikan proses pembelajaran bermutu, menuju link and match dengan IDUKA.
            </p>
          </div>

          <div class="card">
            <img src="/images/logokawali.jpg" alt="Vision">
            <h3 style="margin-left: 25px;">Visi SMKN 1 Kawali</h3>
            <p>
              Terwujudnya lulusan yang berakhlak mulia, unggul, profesional, mandiri dan berdaya saing global pada tahun 2026
            </p>
          </div>
        </div>

        <div class="extra-info">
          <h3>Kenapa SMKN 1 KAWALI Menjadi Unggulan?</h3>
          <p>
            SMKN 1 KAWALI bertujuan membentuk siswa-siswa unggul dan berkarakter, serta siap bekerja maupun berwirausaha. 
            Sekolah ini telah meraih nilai unggul sebagai pilihan sekolah kejuruan, didukung oleh fasilitas pembelajaran 
            yang memadai dan terhubung dengan berbagai badan industri untuk menyesuaikan proses pembelajaran dengan dunia kerja.
          </p>
        </div>
        <h2 style="margin-top: 50px;">Sejarah Perkembangan SMKN 1 Kawali</h2>
        <div class="events">
          <div class="event" v-for="item in items" :key="item.id">
            <div class="event-icon">
              <img :src="item.icon" alt="Event Icon">
            </div>
            <div class="event-date">{{ item.date }}</div>
            <div class="event-description">{{ item.description }}</div>
          </div>
        </div>
        <div class="extra-info">
          <h3>Bagaimana Aplikasi Pembelajaran dan Absensi Guru dan Murid Kami Mengubah Pengalaman Pendidikan?</h3>
          <p>
            Dengan aplikasi sekolah yang dikembangkan, kami menciptakan kemudahan bagi murid untuk melakukan absensi secara digital, 
            sementara guru dapat melakukan check-in dan check-out selama sesi pembelajaran. Selain itu, terdapat fitur display board yang
             memungkinkan petinggi sekolah untuk memantau kegiatan secara langsung, memberikan transparansi dan efisiensi dalam manajemen sekolah.
          </p>
        </div>
      </div>
    </section>
  </FrontendLayout>
</template>

<script>
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
export default {
  props: {
    notices: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      items: [
        { id: 1, date: '1 Oktober 2004', description: 'Pembukaan SMK', icon: '/images/flag.png' },
        { id: 2, date: '12 Oktober 2009', description: 'Pembukaan Jurusan RPL', icon: '/images/monitor.png' },
        { id: 3, date: '12 Oktober 2015', description: 'Pembukaan Jurusan AKL', icon: '/images/payment.png' },
        { id: 4, date: '13 Oktober 2003', description: 'Pembukaan Jurusan TKJ', icon: '/images/piston.png' },
        { id: 5, date: '16 Oktober 2017', description: 'Pembukaan Jurusan SKS', icon: '/images/angklung.png' },
        { id: 6, date: '30 Desember 2003', description: 'Pembukaan Jurusan TKJ', icon: '/images/transmitter.png' },
        { id: 7, date: '14 Oktober 2013', description: 'Pembukaan Jurusan OTKP', icon: '/images/desktop.png' },
        { id: 8, date: '12 Oktober 2015', description: 'Pembukaan Jurusan DPIB', icon: '/images/design.png' }
      ]
    }
  },
  components: {
    FrontendLayout,
  }
}
</script>

<style scoped>
.about-school {
  padding: 50px 20px;
  background-color: #f7f7f7;
  text-align: center;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

h2 {
  font-size: 2.5em;
  margin-bottom: 20px;
  color: #333;
}

p {
  font-size: 1.1em;
  color: #666;
  line-height: 1.6;
  margin-bottom: 40px;
}

.events {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  margin-bottom: 40px;
}

.event {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 150px;
}

.event-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 80px;
  height: 80px;
  background-color: #3498db;
  border-radius: 50%;
}

.event-icon img {
  width: 50%;
  height: 50%;
}

.event-date {
  margin-top: 10px;
  font-weight: bold;
}

.event-description {
  margin-top: 5px;
  color: #555;
}

.cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

.card {
  background: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  margin: 20px;
  padding: 20px;
  max-width: 300px;
  text-align: left;
}

.card img {
  width: 100%;
  border-radius: 10px 10px 0 0;
}

.card h3 {
  margin-top: 15px;
  font-size: 1.5em;
  color: #3498db;
}

.card p {
  font-size: 1em;
  color: #666;
  margin: 10px 0;
}

.card ul {
  list-style-type: none;
  padding: 0;
}

.card ul li {
  font-size: 1em;
  color: #666;
  margin: 5px 0;
}

.extra-info {
  margin-top: 40px;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.extra-info h3 {
  font-size: 2em;
  color: #3498db;
  margin-bottom: 20px;
}

.extra-info p {
  font-size: 1.1em;
  color: #666;
  line-height: 1.6;
}
</style>
