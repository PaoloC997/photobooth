<template>
  <div>
    <h1>Image Gallery</h1>
    <div v-if="images.length === 0">
      <p>No images to display</p>
    </div>
    <div v-else class="gallery">
      <div v-for="image in images" :key="image.id" class="image-container">
        <img :src="'data:' + image.mime_type + ';base64,' + image.content" alt="Uploaded Image" />
      
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      images: [], // Array to store images
    };
  },
  mounted() {
    // Fetch the images when the component is mounted
    this.fetchExistingImages();
  },
  methods: {
    // Fetch images from the backend
    async fetchExistingImages() {
      try {
        const response = await axios.get('/api/images'); // Make a GET request to the images API
        this.images = response.data.images; // Store the fetched images in the images array
        console.log(response.data.images); 
        // Convert image URLs to base64 in the frontend
        this.convertImagesToBase64();
      } catch (error) {
        console.error('Failed to fetch images:', error); // Log any error encountered during fetch
      }
    },
    async convertImagesToBase64() {
      for (let image of this.images) {
        // Create a new Image object
        const img = new Image();
        img.src = image.image_url;

        // Wait for the image to load
        await new Promise((resolve) => {
          img.onload = resolve;
        });

        // Convert image to base64
        const base64 = await this.convertToBase64(img);

        // Store the base64 string in the image object
        image.base64 = base64;
      }
    },
    convertToBase64(img) {
      return new Promise((resolve) => {
        // Create a canvas element to draw the image
        const canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0);

        // Convert the canvas content to base64
        const base64 = canvas.toDataURL(img.src);
        resolve(base64.split(',')[1]); // Remove the prefix (`data:image/*;base64,`)
      });
    },
  },
};
</script>

<style scoped>
.gallery {
  display: flex;
  flex-direction: row;
  gap: 16px;
  margin:auto;
  width:80vw;
  flex-wrap: wrap;
}

.image-container img {
  width: 20vw; /* Adjust size as needed */
  height: auto;
  border: 1px solid #ccc;
  object-fit: cover;
}



.image-container img:last-child {
  display: block;
  margin-top: 8px; /* Space between images */
}
</style>
