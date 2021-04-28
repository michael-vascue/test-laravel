<template>
    <div>
        <div>
          <navigation-bar></navigation-bar>
          <router-view></router-view>
        </div>
       
    </div>
</template>

<script>
import NavigationBar from './components/NavigationBar.vue';

  export default {
    name: 'app',
    components: { 
      NavigationBar, 
    },

    // data(){
    //   return{
    //     activeModal:0,
    //   }
    // },

    // methods: {
    //         showModal: function() {
    //             return this.activeModal === id 
    //         },
    //         toggleModal: function () {
    //             if(this.activeModal !== 0) {
    //                 this.activeModal = 0
    //                 return false
    //             }
    //             this.activeModal = id
    //         }
    //     }
  };
</script>

<style lang="scss" scoped>

</style>
