<template>
    <div class="container" style="padding-top:25px">
         <div class="main-font">My Illustration</div>
         <div class="text">You haven't created any illustration. Let's go to create one.</div>
    </div>
</template>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .main-font{
        font-family: $bold-font;
        font-size: 20px;
        font-weight: 500;
        color: $secondary-color;
        letter-spacing: 1px;
    }

    .text{
        font-family: $primary-font;
        font-size: 20px;
        font-weight: 500;
        color: rgb(173, 173, 173);
        letter-spacing: 1px;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: 0;
    }

     @media (min-width: 1200px) {
      .container{
          max-width: 1200px;
      }
    }


</style>