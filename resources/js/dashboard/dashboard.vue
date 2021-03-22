<template>
    <div>
      <navigation-bar></navigation-bar>
      <div class="container d-flex mt-4">
        <div class="flex-column w-50 align-self-center">
            <div class="main-font">
              <div style="color: #264D59">CUSTOMISABLE</div>
              <div style="color: #43978D">ILLUSTRATION GALLERY</div>
            </div>
            <div class="sub-font mt-3" style="color: #D46C4E">
              <div>Create your own unique illustration,</div>
              <div>download free and beautiful</div>
              <div>illustration to complete your project</div>
            </div>
        </div>
        <img src="/img/Create.png" alt="Design Your Illustration" class="w-50">

        <!-- <div class="card">
          
        </div> -->
      </div>

       <div class="card container" style="width: 18rem;">
         <div class="circle rounded-circle"></div>
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>

    </div>
</template>

<script>
import NavigationBar from '../components/NavigationBar.vue';
export default {
  components: { NavigationBar },
 
};
</script>

<style lang="scss" scoped>
  @import '../../sass/variables';

  // .circle{
    
  // }

  img{
     width: 40%;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
  }
  
  .main-font{
    font-family: $primary-font;
    font-size: 35px;
    font-weight: 500;
    letter-spacing: 4px;
  }

   .sub-font{
    font-family: $primary-font;
    font-size: 20px;
  }

  @media (min-width: 1200px) {
      .container{
          max-width: 1200px;
      }
  }

</style>