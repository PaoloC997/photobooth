<template>
    <div>
      <h1>Image Gallery</h1>
      <div v-if="images.length === 0">
        <p>No images to display</p>
      </div>
      <div v-else class="gallery">
        <div v-for="image in images" :key="image.id" class="image-container">
          <img :src="image.file_url" :alt="`Image ${image.id}`" />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import Echo from "laravel-echo";
  import axios from "axios";
  
  export default {
    data() {
      return {
        images: [], // Stores the list of images
      };
    },
    mounted() {
      this.fetchExistingImages(); // Fetch all images on page load
  
      // Set up Pusher for real-time updates
      const echo = new Echo({
        broadcaster: "pusher",
        key: "your-pusher-key",
        cluster: "your-cluster",
        forceTLS: true,
      });
  
      // Listen for new images
      echo.channel("images").listen("ImageUploaded", (event) => {
        this.images.push({
          id: event.image_id,
          file_url: event.file_url,
        });
      });
    },
    methods: {
      async fetchExistingImages() {
        try {
          const response = await axios.get("/api/images"); // Replace with your API URL
          this.images = response.data;
        } catch (error) {
          console.error("Failed to fetch images:", error);
        }
      },
    },
  };
  </script>
  
  <style>
  .gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
  }
  .image-container img {
    width: 150px;
    height: auto;
    border: 1px solid #ccc;
  }
  </style>
  