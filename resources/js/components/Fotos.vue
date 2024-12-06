<template>
    <div class="fotos">
      <h1>Fotos</h1>
      <div class="fotos-container">
        <img v-for="image in images" :key="image.id" :src="image.url" alt="">
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Fotos',
    data() {
      return {
        images: []
      }
    },
    mounted() {
      this.images = this.$parent.images;
    },
    fetchImages() {
        const images = Array.from({ length: 10 }, (_, index) => ({
          id: index + 1,
          url: `https://picsum.photos/300/200?random=${index}`
        }));
        this.images = images;
      },
  }
  </script>
  
  <style scoped>
  .fotos {
    text-align: center;
  }
  
  .fotos-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .fotos-container img {
    width: 200px;
    height: 150px;
    margin: 10px;
  }
  </style>