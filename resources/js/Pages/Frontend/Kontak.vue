<template>
    <Head title="Contact" />
    <FrontendLayout>
      <section class="contact">
        <div class="container">
          <h2>Kontak</h2>
          <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami menggunakan formulir di bawah ini.</p>
  
          <form @submit.prevent="submitForm">
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" id="name" v-model="form.name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" v-model="form.email" required>
            </div>
            <div class="form-group">
              <label for="message">Pesan</label>
              <textarea id="message" v-model="form.message" required></textarea>
            </div>
            <button type="submit">Kirim Pesan</button>
          </form>
  
          <div class="contact-info">
            <h3>Alamat</h3>
            <p>Jl.Talagasari, No.35 Kawalimukti, Kawali Kabupaten Ciamis Jawa Barat 46252</p>
  
            <h3>Email</h3>
            <p>smkn1kawali@gmail.com</p>
  
            <h3>Telepon</h3>
            <p>(0265) 791 727-Central Office</p>
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
    components: {
      FrontendLayout,
    },
    data() {
      return {
        form: {
          name: '',
          email: '',
          message: ''
        }
      };
    },
    methods: {
      submitForm() {
        // Handle form submission, e.g., send data to server
        console.log('Form submitted:', this.form);
        alert('Thank you for your message. We will get back to you soon.');
        this.form.name = '';
        this.form.email = '';
        this.form.message = '';
      }
    }
  }
  </script>
  
  <style scoped>
  .contact {
    padding: 50px 20px;
    background-color: #f7f7f7;
    text-align: center;
  }
  
  .container {
    max-width: 800px;
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
    margin-bottom: 20px;
  }
  
  form {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
    color: #3498db;
  }
  
  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
  }
  
  button {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  button:hover {
    background-color: #2980b9;
  }
  
  .contact-info {
    text-align: left;
  }
  
  .contact-info h3 {
    font-size: 1.5em;
    color: #3498db;
    margin-top: 20px;
  }
  
  .contact-info p {
    font-size: 1em;
    color: #666;
    line-height: 1.6;
  }
  </style>
  