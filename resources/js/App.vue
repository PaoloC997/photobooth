<template>
  <div class="App">

  <HomeView/>
  <header class="App-header">
    <img src="./assets/image.png" alt="" class="logo">
  </header>
 

</div>  
<Snow/>
</template>

<script>

import HomeView from './components/HomeView.vue';
import Snow from './components/Snow.vue';
import Button from './components/Button.vue';
export default {
  name: 'App',
  components: {
    Snow,
    HomeView,
    Button
  }
}
</script>

<style >
.App {
  display: flex;
  flex-direction: column;
  width:100vw;
  overflow:hidden;
}

.snow-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  pointer-events: none;
  z-index: -1;
}

.snow {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: radial-gradient(rgb(219, 216, 199), rgb(240, 227, 234));
      background-position: 0% 0%;
}
     
.snowflake {
      position: absolute;
      background-image: url('./assets/pngwing.com.png');
      background-size: 100% 100%;
      animation: fall  linear infinite;  
    }
    
    .App-header {
    height: 50vh;
    width: 50vw;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 50vh;
  }

  .logo {
    width: 20vw;
    height: auto;
    margin-bottom: 2rem;
    position:relative;
    margin-left:auto;
    margin-right:auto;
  }

  @media (max-width: 768px) {
    .App-header {
      top: 30vh;
    }
    .logo {
      width: 30vw;
      margin-bottom: 10px;
    }
  }

  @media (max-width: 480px) {
    .App-header {
      top: 30vh;
    }
    .logo {
      width: 60vw;
      margin-bottom: 5px;
    }
  }



    @keyframes fall {
      0% {
        transform: translateY(0) ;
        opacity: 0 ;
      }
     
      100% {
        transform: translateY(-100vh) rotate(60deg) ;
        opacity: 1;
      }
    }
    

   

</style>