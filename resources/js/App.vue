<template>
    <div>
      <NavigationMobile />
      <div class="content" :class="{'open': showNav}">
          <!-- <div v-if="mobileView" class="d-flex pt-2"> -->
          <div v-if="$route.path !='/createillus'" >
            <div v-if="mobileView" class="d-flex">
                <div class="navigation-icon m-3"
                  @click="showNav = !showNav">
                  <i class="fas fa-bars"></i>
                </div>
                <h3 class="header-title m-3">Illus Dream</h3>
            </div>
          </div>
          <div v-if="!mobileView">
            <navigation-bar></navigation-bar>
          </div>
          <router-view></router-view> 
      </div> 
    </div>
</template>

<script>
import NavigationBar from './components/NavigationBar.vue';
import NavigationMobile from './components/NavigationMobile.vue';

  export default {
    name: 'app',
    components: { 
      NavigationBar, 
      NavigationMobile
    },
      data() {
          return {
            mobileView: true,
            showNav: false,
          }
      },
      methods: {
        handleView() {
          this.mobileView = window.innerWidth <= 995;
        }
      },
      created() {
        this.handleView();
        window.addEventListener('resize', this.handleView);
      }
  };
</script>


<style lang="scss" scoped>
  @import '../sass/variables';
  .content{
      position: absolute;
      top: 0px;
      // width: calc(100% - 60px);
      // height: calc(100vh - 60px);
      width: 100%;
      height: 100vh;
      // box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
      background-color: white;
      transition: 1s transform cubic-bezier(0,.12,.14,1);
  }

  .header-title{
    font-family: $primary-font;
    color: $primary-color;
  }

  .navigation-icon {
    cursor: pointer;
      i {
        font-size: 2rem;
        color: $primary-color;
      }
  }

  .open{
    transform: translate(250px);
  }

  

</style>

