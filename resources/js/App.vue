<template>
  <div>
    <router-view />
  </div>
</template>



<style >
body {
  width: 100%;
  height: 100%;
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
      background-image: radial-gradient(rgb(255, 255, 255), rgb(245, 209, 217));
      background-position: 0% 0%;
     
    }
     
    .snowflake {
      position: absolute;
      
      
        
      background-image: url('./assets/pngwing.com.png');

      background-size: 100% 100%;
      animation: fall  linear infinite;
    
    
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
    
  


  .logo {
    width: 18vw;
    height: auto;
    
    animation-name: beat;
    animation-duration: 1.5s;
    animation-timing-function: ease-in-out;
    animation-iteration-count: infinite;
    
  }
  
  @keyframes beat {
    0% {
      transform: scale(1);
    }
    8% {
      transform: scale(1.1);
    }
    13% {
      transform: scale(1);
    }
    18% {
      transform: scale(1.1);
    }
    23% {
      transform: scale(1);
    }
    
    }

  


/* Media query para móviles en posición de pie */
@media (max-width: 480px) {
  .boton {
    font-size: 20px;
    padding: 5px 10px;
  }


  .section1 {
    margin-top: 20vh;
    height: 3vh;
  }

  .section2 {
    display: none;
  }
  .logo {
    width: 50vw;
    height: auto;
    top: 20vh;
    position: relative;
  }
}

</style>