<template>
    <button @click="fetchImages" class="btn-galeria">Ver Galería</button>
    <div v-if="galeriaVisible" class="galeria-modal">
      <h2>Galería de Fotos</h2>
      <div class="galeria">
        <img v-for="foto in fotos" :src="foto.url" :alt="foto.alt" :key="foto.id">
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        images: []
      }
    },
   
    methods: {
      fetchImages() {
        const images = Array.from({ length: 20 }, (_, index) => ({
          id: index +1,
          url: `https://picsum.photos/300/200?random=${index}`
        }));
        this.images = images;
      }
    }
  }
  </script>
  
  <style>
.btn-galeria {
    top: 50vh;
  background-color: #fff;
  color: #333;
  border: none;
  padding: 10px 20px;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-galeria:hover {
  background-color: #ccc;
}

.galeria-modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.galeria {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.galeria img {
  width: 20%;
  margin: 10px;
}


</style>