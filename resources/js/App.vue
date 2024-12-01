<template>
  <div>
    <h1>Image Gallery</h1>
    <div v-if="images.length === 0">
      <p>No images to display</p>
    </div>
    <div v-else class="gallery">
      <div v-for="image in images" :key="image.id" class="image-container">
        <img :src="image.public_url" alt="Uploaded Image" />
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      images: [], // Stores the list of image objects fetched from the backend
    };
  },
  mounted() {
    this.fetchImages(); // Fetch images when the component is mounted
  },
  methods: {
    async fetchImages() {
      try {
        const response = await axios.get('/api/images'); // API endpoint to fetch images
        this.images = response.data.images; // Assign the response images to the local state
      } catch (error) {
        console.error('Failed to fetch images:', error); // Log any errors
      }
    },
  },
};
</script>

<style scoped>
.gallery {
  display: flex;
  flex-direction: row;
  gap: 16px;
  margin: auto;
  width: 80vw;
  flex-wrap: wrap;
}

.image-container img {
  width: 20vw; 
  height: auto;
  border: 1px solid #ccc;
  object-fit: cover;
  border-radius: 4px;
}

.image-container img:last-child {
  display: block;
  margin-top: 8px; 
}
</style>
