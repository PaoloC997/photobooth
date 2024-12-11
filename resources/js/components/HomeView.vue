<template>
    <swiper
      :effect="'Autoplay'"
      :grabCursor="true"
      :autoplay="{
        delay: 2500,
        disableOnInteraction: false,
      }"
      :loop="enableLoop"
      :loopAdditionalSlides="2"
      :slidesPerView="1"
      :spaceBetween="10"
      :modules="modules"
      class="mySwiper"
    >
      <swiper-slide class='swiper-element' v-for="image in images" :key="image.id">
        <img class="film-frame" :src="image.url" alt="Image" />
      </swiper-slide>
    </swiper>
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
  computed: {
    enableLoop() {
      setTimeout(()=>{
        return true
      }, 1000)
    },
  },
  mounted() {
    this.fetchImages();
  },
  methods: {
    async fetchImages() {
      try {
        const response = await axios.get('/api/images');
        console.log(response);
        this.images = response.data.images.map((image) => ({
          id: image.url,
          url: image.image_url,
        }));
      } catch (error) {
        console.error('Failed to fetch images:', error);
      }
    },
    
  },
};
</script>
<style>
.swiper {
  width: 25vw;
  height: 29vh;
  overflow: visible;
  position: relative;
  right: 50vw;
}

.swiper-slide {
  width: 100%;
  height: 100%;
}

.swiper-element img {
  width: 100%;
  height: auto;
  margin-left: 2rem;
  border: 8px solid black; 
  border-radius: 10px; 
  box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3); 
  object-fit: cover; 
  position: relative;
}

.swiper-element:nth-child(odd) {
  transform: rotate(-3deg);
  margin-top: 20px; 
}

.swiper-element:nth-child(even) {
  transform: rotate(3deg);
  margin-top: 10px; 
}

.swiper-element img::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle, rgba(0, 0, 0, 0.2) 30%, transparent 70%);
  border-radius: 10px;
  pointer-events: none; 
}

@media (max-width: 480px) {
  .swiper {
    width: 100vw;
    height: 50vh;
    overflow: visible;
    left: 5vw;
  }
}

</style>