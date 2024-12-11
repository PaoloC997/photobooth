<template>
  <div class="snow-container"  ref = "snowContainer">
    <div class="snow" ref="snow"></div>
  </div>
</template>

<script>
export default {
  name: 'Snow',
  data() {
    return {
      i: 0,
      intervalId: null
    };
  },
  mounted() {
    this.createSnowflake();
  },
  beforeDestroy() {
    clearInterval(this.intervalId);
  },
  methods: {
    createSnowflake() {
      if (this.i === 70) {
        clearInterval(this.intervalId);
      } else {
        this.i = this.i + 1;
        const snowflake = document.createElement("div");
    snowflake.classList.add("snowflake");
    snowflake.style.bottom = `${Math.random() * 1}vh`;
    snowflake.style.left = `${Math.random() * 100}%`;
    snowflake.style.animationDuration = `${Math.random() * 5 + 10}s`;
    snowflake.style.height = `${Math.random() * 100 + 10}px`;
    snowflake.style.width = snowflake.style.height ;
    
    
   
    
   
        
        this.$refs.snow.appendChild(snowflake);
        this.intervalId = setTimeout(this.createSnowflake, 1000);
      }
    },
   
  }
};
</script>

<style scoped>

</style>