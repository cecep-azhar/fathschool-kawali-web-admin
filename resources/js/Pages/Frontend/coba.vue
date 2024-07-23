<template>
    <div class="contact-page">
      <h1>Contact Us</h1>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="form.name" required>
        </div>
        <button type="submit">Submit</button>
      </form>
      
      <div v-if="submitted">
        <h2>Submitted Data:</h2>
        <p><strong>Name:</strong> {{ submittedData.name }}</p>
        <p><strong>Email:</strong> {{ submittedData.email }}</p>
        <p><strong>Message:</strong> {{ submittedData.message }}</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          message: ''
        },
        submitted: false,
        submittedData: {
          name: '',
          email: '',
          message: ''
        }
      };
    },
    methods: {
      async submitForm() {
        // Simpan data ke submittedData
        this.submittedData = { ...this.form };
        this.submitted = true;
  
        // Mengirim data ke server
        try {
          const response = await axios.post('/coba', this.form);
          console.log('Success:', response.data);
        } catch (error) {
          console.error('Error:', error);
        }
  
        // Reset form
        this.form.name = '';
        this.form.email = '';
        this.form.message = '';
      }
    }
  };
  </script>
  
  <style scoped>
  .contact-page {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
  }
  
  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  
  button {
    display: inline-block;
    padding: 10px 20px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  </style>
  