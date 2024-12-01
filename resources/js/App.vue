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
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

export default {
  data() {
    return {
      images: [], 
    };
  },
  mounted() {
    this.fetchImages(); 
    this.setupPusher(); 
  },
  methods: {
    
    async fetchImages() {
      try {
        const response = await axios.get('/api/images'); 
        this.images = response.data.images; 
      } catch (error) {
        console.error('Failed to fetch images:', error); 
      }
    },

   
    setupPusher() {
      window.Echo = new Echo({
        broadcaster: 'pusher',
        key: 'b471ce9eebea71720e2b',
        cluster: 'eu',
        forceTLS: true
      });

      
      window.Echo.channel('image-channel')
        .listen('ImageUploaded', (event) => {
         
          this.images.push({
            id: event.image_url, 
            public_url: event.image_url, 
          });
        });
    }
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
