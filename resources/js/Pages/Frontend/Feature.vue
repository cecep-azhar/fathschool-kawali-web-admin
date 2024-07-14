// resources/js/views/Features.vue
<template>
     <Head title="Feature" />
     <FrontendLayout>
  <section class="features">
    <div class="container">
      <h2>Fitur </h2>
      <div class="feature-cards">
        <div class="feature-card">
          <h3>Login</h3>
          <p>
            Pengguna perlu memasukkan email dan password yang sudah didaftarkan oleh admin website.
          </p>
        </div>
        <div class="feature-card">
          <h3>Absensi</h3>
          <p>
            Pendaftaran,Datang dan Pulang dari lokasi menggunakan Geolocation ditambah face recognition.
            Untuk Masuk dan Keluar Kelas, Pengguna diharuskan scan qr di kelas yang akan diisi oleh pengguna
          </p>
        </div>
        <div class="feature-card">
          <h3>pengenalan Wajah</h3>
          <p>
            Fitur pengenalan wajah untuk aplikasi sekolah memiliki berbagai kegunaan yang sangat bermanfaat, 
            salah satunya adalah untuk keperluan absensi siswa. Dengan menggunakan teknologi ini, proses pencatatan 
            kehadiran menjadi lebih cepat, akurat, dan efisien.
          </p>
        </div>
        <div class="feature-card">
          <h3>Riwayat Kehadiran</h3>
          <p>
            Fitur ini memungkinkan penyimpanan dan penelusuran data kehadiran secara lengkap dan terperinci,
             mencakup tanggal, waktu masuk, dan waktu keluar setiap siswa.
          </p>
        </div>
        <div class="feature-card">
          <h3>Jurnal</h3>
          <p>
            Fitur ini memungkinkan guru untuk mencatat dan mengupdate perkembangan akademik siswa secara teratur, 
            mencakup catatan mengenai tugas, hasil ujian, proyek, dan aktivitas lainnya.
          </p>
        </div>
        <div class="feature-card">
          <h3>Logout</h3>
          <p>
            Pengguna dapat melakukan logout untuk keluar dari akun yang pengguna gunakan sebelumnya
          </p>
        </div>
      </div>
    </div>
  </section>
</FrontendLayout>
</template>

<script>
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
export default {
    props:{
        notices: {
            type: Array,
            default: () => []
        }
    },
    components: {
        FrontendLayout,
    }
}
</script>

<style scoped>
.features {
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

.feature-cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

.feature-card {
  background: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  margin: 20px;
  padding: 20px;
  max-width: 300px;
  text-align: left;
}

.feature-card img {
  width: 100%;
  border-radius: 10px 10px 0 0;
}

.feature-card h3 {
  margin-top: 15px;
  font-size: 1.5em;
  color: #3498db;
}

.feature-card p {
  font-size: 1em;
  color: #666;
  margin: 10px 0;
}
</style>
