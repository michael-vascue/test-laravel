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
      </div>

      &nbsp;

      <div class="container d-flex mt-5">
        <div class="card mr-auto">
          <i class="align-self-center fas fa-download fa-5x circle rounded-icon1"/>
          <div class="card-body">
            <h3 class="card-text">Download Free</h3>
          </div>
        </div>

        <div class="card mr-auto">
         <i class="align-self-center fas fa-fingerprint fa-5x circle rounded-icon2"/>
          <div class="card-body">
            <h3 class="card-text">Unique and Creative</h3>
          </div>
        </div>

        <div class="card">
         <i class="align-self-center fas fa-pencil-ruler fa-5x circle rounded-icon3"></i>
          <div class="card-body">
            <h3 class="card-text">Customisable</h3>
          </div>
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

  .card{
    border:none;
    background-color: transparent;
  }

  .card-text{
    font-family: $bold-font;
    color: $primary-font;
  }

  .circle{
    width: 150px;
    height: 150px;
    text-align: center;
    color: white;
    line-height: 135px;
    background-repeat: no-repeat;
    background-size: 150px 140px;

    &.rounded-icon1{
      background-image: url(/img/Ellipse9.svg);
    }

     &.rounded-icon2{
      background-image: url(/img/Ellipse11.svg);
    }

     &.rounded-icon3{
      background-image: url(/img/Ellipse12.svg);
    }
  }

  img{
     width: 40%;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
  }
  
  .main-font{
    font-family: $bold-font;
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