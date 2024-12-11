<template>
    <div class="Main">
        <div class="section1">
            <HomeView/>
        </div>
        <header class="App-header">
            <img src="../assets/image.png" alt="" class="logo">
            <a class="boton" href="/Gallery">Galería</a>
        </header>
    </div>
   <Snow/>
</template>
<script>

import HomeView from './HomeView.vue'
import Snow from './Snow.vue';

export default {
  name: 'Main',
  components: {
    Snow,
    HomeView,
  }
}

</script>
<style scoped>

.Main {
  display: flex;
  flex-direction: column;
  justify-content: center; 
  overflow:hidden;
}

.App-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top:2rem;
}

.boton {
  font-family: 'Yuji Mai', cursive;
  position: absolute;
  bottom: 2vh;
  color: rgb(250, 58, 116);
  text-decoration: none;
  font-size: 50px;
  padding: 5px 5px;
  border-radius: 5px;
  z-index: 1;
}

.boton:hover {
  background-color: black;
  color: rgb(255, 255, 255); 
  transform: scale(1.1);
}

.section1 {
  top: 5vh;
  height: 50vh;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  
}

.section2 {
  top: 10vh;
  height: 20vh;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  
}

@media (max-width: 480px) {
  .boton {
    font-size: 20px;
    padding: 5px 10px;
    bottom: 15vh;
  }
  .section1 {
    top: 15vh;
    height: 10vh;
}

.section2 {
    display: none;
  
}
}
</style>