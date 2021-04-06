<template>
    <div class="container d-flex">
        <h3 class="header-title pt-4">Illus Dream</h3>

        <!-- <div class="ml-auto mt-3 d-flex" role="group">
            <button @click="() => $router.push('*')" type="button" class="nav-button btn btn-default">Home</button>
            <button type="button" class="nav-button btn btn-default">Illustration Gallery</button>
            <button type="button" class="nav-button btn btn-default">Create Illustration</button> -->
            <!-- <button @click="() => $router.push('/signin')" type="button" class="nav-button btn btn-default">Sign In</button>  -->
            <!-- <button @click="onClick" type="button" class="nav-button btn btn-default">Sign In</button>  -->
            <!-- <login/>
            <register/>
        </div> -->

        <nav class="navbar navbar-expand-lg ml-auto p-0 mt-3">
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/dashboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Illustration Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Create Illustration</a>
                    </li>
                     <li class="nav-item">
                        <login/>
                        <register/>
                    </li>
                </ul>
            </div>    
        </nav>
    </div>
</template>

<script>
import login from '../account/Login.vue';
import register from '../account/Register.vue';
    export default {
        components:{
            login,
            register
        },

        data(){
            return{
                // showSignUp: true
            }
        },

        methods: {
           
        }


    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .header-title, button, a{
        font-family: $primary-font;
        color: $primary-color;
    }

    a, router-link{
        font-size: 18px;
        font-weight: 500;
        color:$primary-color;
        transition: all 150ms ease-in-out;
        padding-left: 1.5rem;

        &:hover{
            color:$secondary-color;
        }
    }


    button{
        font-size: 18px;
        font-weight: 500;
    }


    .nav-button{
        color:$primary-color;
        transition: all 150ms ease-in-out;

        &:hover{
            color:$secondary-color;
        }

        &:focus{
            box-shadow: none;
        }
    }

    @media (min-width: 1200px) {
      .container{
          max-width: 1200px;
      }
  }

</style>


