<template>
  <div class="gallery">
    <Snow />
    <h1>El Bodorrio de las Cuchis</h1>
    <div class="grid">
      <div v-for="image in images" :key="image.id" class="grid-item">
        <img :src="image.url" :alt="image.description" @click="handleClick(image)" />
      </div>
  </div>
  
  <div v-if="expandedImage" class="expanded-image" >
    <img :src="expandedImage.url" :alt="expandedImage.description" @click="expandedImage = null" />
  </div>
</div>
</template>

  <script>
  import Snow from './Snow.vue';
  import axios from 'axios';
  
  export default {
    name: 'Gallery',
    components: {
      Snow,
    },
    data() {
      return {
        images: [],
        expandedImage: null,
      };
    },
    mounted() {
      this.setupPusher();
      this.fetchImages();
     
    },
    methods: {
    async fetchImages() {
      try {
        const response = await axios.get('/api/images');
        this.images = response.data.images.map((image) => ({
          id: image.id,
          url: image.image_url,
        }));
      } catch (error) {
        console.error('Failed to fetch images:', error);
      }
    },
    setupPusher() {
      window.Echo.channel('image-channel').listen('ImageUploaded', (event) => {
        this.images.push({
          id: event.image_url,
          url: event.image_url,
        });

        this.images.reverse();
      });
    },

    handleClick(image) {
      this.expandedImage = image;
    }
  },
  };
  </script>
  
  <style scoped>


.gallery {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.grid {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); 
  grid-template-rows: auto;
  grid-gap: 70px;
  justify-items: center; 
}

.grid-item {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}


.grid-item:nth-child(odd) {
  transform: rotate(-5deg);
  margin-top: 20px; 
}

.grid-item:nth-child(even) {
  transform: rotate(5deg);
  margin-top: 10px; 
}

.grid-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); 
  transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
}


.grid-item:hover img {
  transform: scale(1.05); 
  filter: brightness(1.1); 
}


.grid-item:hover {
  transform: translateY(-10px);
}

h1 {
  text-align: center;
  font-family: 'Yuji Mai', cursive;
  font-size: 50px;
  margin-top: 20px;
  margin-bottom: 20px;
  color: rgb(250, 58, 116);
  border-radius: 20px;
}

  .expanded-image {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 100px;
    left:50;
    object-fit: cover;
  cursor: pointer;
}

.expanded-image img {
  max-width: 70vw;
}

@media (max-width: 480px) {
  .grid {
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: auto;
    grid-gap: 5px;
  }

  .grid-item {
    margin-top: 5px;
  }

  .grid-item:nth-child(odd) {
    transform: rotate(-2deg);
    margin-top: 5px;
  }

  .grid-item:nth-child(even) {
    transform: rotate(2deg);
    margin-top: 2px;
  }

  h1 {
    font-size: 30px;
  }
}



</style>