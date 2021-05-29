<template>
  <div>
      <div id="navigation-mobile">
        <ul style="padding-top:25px">
            <li  @click="pageActive($route.path)">           
                <div class="nav-deco">
                    <router-link class="link" to="/"  :class="[(page == '/') ? 'active':'']">Home</router-link>
                </div>
            </li>
            <li @click="pageActive($route.path)">
                <div class="nav-deco">
                    <router-link class="link" to="/gallery" :class="[(page == '/gallery') ? 'active':'']">Illustration Gallery</router-link>
                </div>
            </li>
            <li @click.prevent="beforeCreate()">
                <div class="nav-deco">
                    <router-link class="link" to="#">Create Illustration</router-link>
                </div>
            </li>
            <div>
                <template v-if="!currentUser">
                    <li class="nav-item" >
                        <button @click.prevent="showModal" type="button" class="nav-button btn btn1 btn-default">Sign In</button>
                        <login ref="loginModal"></login>
                        <register/>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item">
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle p-0 dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div>
                                    <template v-if="!currentUser.profile_image_url" >
                                        <img class="profile" src="/img/default.png" alt="">
                                    </template>
                                    <template v-else>
                                        <div class="profile">{{currentUser.profile_image_url}}</div>
                                    </template>
                                </div>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right menu mt-3 border-0 shadow" style="width: 2.7in;">
                                <div class="d-flex user-info">
                                    <div>
                                        <template v-if="!currentUser.profile_image_url" >
                                            <img class="profile" src="/img/default.png" alt="">
                                        </template>
                                        <template v-else>
                                            <div class="profile">{{currentUser.profile_image_url}}</div>
                                        </template>
                                    </div>
                                    <div class="flex-column align-self-center pl-3">
                                        <div class="text text-break" style="font-size:18px">{{currentUser.name}}</div>
                                        <div class="text text-break" style="color: #47988F; font-size: 13px">{{currentUser.email}}</div>
                                    </div>
                                </div>
                                <hr class="my-2"/>
                                <button class="dropdown-item" type="button" @click.prevent="goProfile">My Profile</button>
                                <button class="dropdown-item" type="button" @click.prevent="goMyIllust">My Illustrations</button>
                                <button class="dropdown-item" type="button" @click.prevent="logout" >Sign Out</button>
                            </div>
                        </div>                        
                    </li>
                </template>
            </div>
            
        </ul>
      </div>
  </div>
</template>

<script>
import login from '../account/Login.vue';
import register from '../account/Register.vue';

export default {
    components:{
        login,
        register,
    },

    data(){
        return{
            page: this.$route.path ,  // for first load and in current path
            username: '',
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
        },
        beforeCreate () {
            if (!this.$store.state.isLoggedin) {
                swal({
                    icon: "warning",
                    text: "You are required to Login first before create the illustration!",
                })
                .then( res => {    
                    this.$refs.loginModal.show(res);
                })
            }
            else{
                this.$router.push('/createillus');    
            }
        },
        showModal () {
            this.$refs.loginModal.show()
        },

        goProfile () {
            this.$router.push('/profile'); 
        },

        goMyIllust () {
            this.$router.push('/my_illust');
        },
    },

    computed: {
        isLogged(){ 
            return this.$store.getters.isLoggedin
        },
        currentUser(){
            return this.$store.getters.currentUser
        },
    },
};
</script>

<style lang="scss" scoped>
 @import '../../sass/variables';

    .active{
        color: $quinary-color;
        background-image: linear-gradient($tertiary-color,$tertiary-color);
        background-position: bottom center; /*Adjust the background-position to move the line*/
        background-size: 100% 5px; /*Adjust the background size to control length and height*/
        background-repeat: no-repeat;
        padding-bottom: 10px; /* this can also control the position */
    }

    button{
        font-size: 18px;
        font-weight: 500;  
    }

    .btn{
        padding: 0;
    }

    .btn1{
        font-family: $primary-font;
        color: white;
        // font-size: 1.5rem;
        // font-weight: bold;
        margin-bottom: 20px;
        cursor: pointer;
        &:hover {
            color:$secondary-color;
        }
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

    .link{
        text-decoration: none;
        color: white;
    }

    #navigation-mobile {
        background-color: $primary-color;
        height:100vh;
        width: 245px;
        ul {
            list-style: none;
            width: 245px;
            padding-left: 40px;
            li {
                font-family: $primary-font;
                color: white;
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 20px;
                cursor: pointer;
                &:hover {
                    color:$secondary-color;
                }
            }
        }
    }

    .nav-button{
        color:white;
        transition: all 150ms ease-in-out;
        font-size: 20px;
        font-weight: 500;
        // font-family: $primary-font;

        &:hover{
            color:$secondary-color;
        }

        &:focus{
            box-shadow: none;
        }
    }

    .nav-deco {
        font-size: 20px;
        font-weight: 500;
        color:$primary-color;
        transition: all 150ms ease-in-out;

        &:hover{
            color:$secondary-color;
        }
    }

    .profile{
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 0px 3px 3px rgba(0, 0, 0, 0.25);

    }

    .user-info{
        padding: 0.25rem 1.5rem
    }

   

</style>
