<template>
  <div class="pictures">
    <Swiper
      :autoplay="{
        delay: 2500,
        disableOnInteraction: false
      }"
      :grabCursor="true"
      :modules="modules"
      class="mySwiper"
    >
      <Swiper-slide v-for="image in images" :key="image.id">
        <img :src="image.url" alt="Image" />
      </Swiper-slide>
    </Swiper>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay } from 'swiper/modules';
import axios from 'axios';
import 'swiper/css';

export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    return {
      modules: [Autoplay],
    };
  },
  data() {
    return {
      images: [],
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
        console.log(response);
        this.images = response.data.images.map((image) => ({
          id: image.id,
          url: image.image_url,
        }));
        console.log(this.images);
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
      });
    },
  },
};
</script>

<style>
.swiper {
  top: 10vh;
  width: 80%; /* Adjust the width as needed */
  height: 70vh; /* Ensure the swiper has a reasonable height */
  overflow: visible; /* Allow overflow so images aren't cut off */
  position: relative; /* Make sure swiper is positioned correctly */
  z-index: 1; /* Ensure swiper is in front */
}

.swiper-slide {
  display: flex; /* Make the slide a flex container to control content positioning */
  justify-content: center; /* Center the image inside the slide */
  align-items: center; /* Vertically center the image */
  width: 100%;
  height: 100%;
  position: relative; /* Ensure it's positioned correctly */
}

img {
  max-width: 100%; /* Ensure the image is responsive */
  height: auto; /* Maintain aspect ratio */
  object-fit: cover; /* Cover the container while maintaining aspect ratio */
}
</style>
