<template>
    <div class="container d-flex pt-2">
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
                    <li class="nav-item" @click="pageActive($route.path)">
                        <!-- <a class="nav-link" aria-current="page" href="/dashboard">Home</a> -->
                        <div class="nav-link">
                            <router-link class="link" to="/dashboard" :class="[(page == '/dashboard') ? 'active':'']">Home</router-link>
                        </div>
                    </li>
                    <li class="nav-item" @click="pageActive($route.path)">
                        <div class="nav-link">
                            <router-link class="link" to="/gallery" :class="[(page == '/gallery') ? 'active':'']">Illustration Gallery</router-link>
                        </div>
                    </li>
                    <li class="nav-item" @click.prevent="beforeCreate($route.path)">
                        <div class="nav-link">
                            <router-link class="link" to="#" :class="[(page == '/createillus') ? 'active':'']">Create Illustration</router-link>
                        </div>
                    </li>
                    <div>
                        <li class="nav-item" v-if="!currentUser">
                            <button @click.prevent="showModal" type="button" class="nav-button btn btn1 btn-default" style="padding:8px">Sign In</button>
                            <login ref="loginModal"></login>
                            <register/>
                        </li>
                        <li class="nav-item"  v-else>
                            <div class="btn-group">
                                <button type="button" class="btn dropdown-toggle p-0 dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="profile" src="/img/profile.jpg" alt="">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right menu mt-3 border-0 shadow" style="width: 2.7in;">
                                    <div class="d-flex user-info">
                                        <img class="profile" src="/img/profile.jpg" alt="">
                                        <div class="flex-column align-self-center pl-3">
                                            <div class="text text-break" style="font-size:18px">{{currentUser.name}}</div>
                                            <div class="text text-break" style="color: #47988F; font-size: 13px">{{currentUser.email}}</div>
                                        </div>
                                    </div>
                                    <hr class="my-2"/>
                                    <button class="dropdown-item" type="button">My Profile</button>
                                    <button class="dropdown-item" type="button">My Illustrations</button>
                                    <button class="dropdown-item" type="button" @click.prevent="logout" >Sign Out</button>
                                </div>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>    
        </nav>
    </div>
</template>

<script>
import login from '../account/Login.vue';
import register from '../account/Register.vue';
import { mapGetters } from 'vuex';

    export default {
        components:{
            login,
            register,
        },

        data(){
            return{
                page: this.$route.path ,  // for first load and in current path
                username: ''
               
            }
        },

        methods: {
            pageActive(e) {
                this.page = e;
            },
            logout(){
                this.$store.commit('logout');
                swal({
                            icon: "success",
                            text: "You logout sucessfully!",
                })
                // this.$router.push('/login');
            },
            beforeCreate (e) {
                if (!this.$store.state.isLoggedin) {
                    // this.$router.push({ name: 'login' })
                    swal({
                            icon: "warning",
                            text: "You are required to Login first before create the illustration!",
                    })
                    .then( res => {    
                        this.$refs.loginModal.show(res);
                    })
                }else{
                    this.page = e;
                    this.$router.push('/createillus');
                    
                }
            },
            showModal () {
                this.$refs.loginModal.show()
            }


        },

         computed: {
            isLogged(){ 
                return this.$store.getters.isLoggedin
            },
            currentUser(){
                return this.$store.getters.currentUser
            },



            //  ...mapGetters([
            //     'currentUser',
            // ]),
        },

       

        mounted() {
            // this.beforeCreate();
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .active{
        color: $quinary-color;
        background-image: linear-gradient($quinary-color,$quinary-color);
        background-position: bottom center; /*Adjust the background-position to move the line*/
        background-size: 60% 2px; /*Adjust the background size to control length and height*/
        background-repeat: no-repeat;
        padding-bottom: 10px; /* this can also control the position */
    }
    button{
        font-size: 18px;
        font-weight: 500;
            
    }

    .dropdown{
        width: 50px;
        height: 50px;
        border: none;
        
        &:focus{
            outline: 0 !important; 
            border: 0;
            box-shadow: none;
        }
        
    }

    .dropdown-item:focus{
        background-color: $primary-color;
        opacity: 1;
    }

    .dropdown-toggle{
        border-radius: 50%;

        &::after{
            content: none;
        }
    }

    .header-title, button, a, .text{
        font-family: $primary-font;
        color: $primary-color;
    }

    img{
         box-shadow: 0px 3px 3px rgba(0, 0, 0, 0.25);
    }

    .link{
        text-decoration: none;
    }

    .user-info{
        padding: 0.25rem 1.5rem
    }

    .nav-link {
        font-size: 18px;
        font-weight: 500;
        color:$primary-color;
        transition: all 150ms ease-in-out;

        &:hover{
            color:$secondary-color;
        }
    }

    .nav-item {
        padding-left: 1.5rem;
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

    .profile{
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    @media (min-width: 1200px) {
      .container{
          max-width: 1200px;
      }
  }

</style>


