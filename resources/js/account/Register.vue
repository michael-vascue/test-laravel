<template>
    <div>
        <modal name="register" :adaptive="true" :width="420" :height="470" styles="border-radius:45px">
           <div class="container px-4 py-4 mx-auto">
                <div class="card card0">
                    <div class="d-flex flex-lg-row flex-column-reverse">
                        <div class="card">

                            <div slot="top-right">
                                <button @click="$modal.hide('register')" class="btn1 pr-2" style="float: right">
                                    <i class="fas fa-window-close fa-2x"></i>
                                </button>
                            </div> 

                             <ValidationObserver v-slot="{ handleSubmit }">
                                <div class="row justify-content-center">                                      
                                    <form class="col-md-10 col-10"
                                        autocomplete="off"
                                        @submit.prevent="handleSubmit(register)"
                                    >
                                        <div class="form-group row" v-if="regError">
                                            <p class="error"> {{regError}} </p>
                                        </div>
                                        <h5 class="msg-info text-center">Get Started With Illus Dream</h5>

                                        <!------------username------------>
                                        <div class="form-group">
                                            <ValidationProvider name="Name" rules="required|alpha" v-slot="{ errors }">
                                                <input placeholder="Enter your username" class="form-control"
                                                    type="text"
                                                        id="name"
                                                        v-model="formRegister.name"
                                                >
                                                <span class="error-messsage">{{ errors[0] }}</span>
                                            </ValidationProvider>
                                        </div>

                                        <!------------email------------>
                                        <div class="form-group">
                                            <ValidationProvider name="E-mail" rules="required|email" v-slot="{ errors }">
                                                <input placeholder="Enter your email address" class="form-control"
                                                        type="email"
                                                        id="email"
                                                        v-model="formRegister.email"                                                  
                                                        >
                                                <span class="error-messsage">{{ errors[0] }}</span>
                                            </ValidationProvider>                                                
                                        </div>

                                        <!------------password------------>
                                        <div class="form-group">
                                            <ValidationProvider name="Password" vid="password" rules="required|confirmedBy:@confirm" 
                                            v-slot="{ errors }">
                                                <input placeholder="Enter your password" class="form-control"
                                                    type="password"
                                                    id="password"
                                                    v-model="formRegister.password"                                                
                                                >
                                                <span class="error-messsage">{{ errors[0] }}</span>
                                            </ValidationProvider>                                           
                                        </div>

                                        <!------------confirm password------------>
                                        <div class="form-group">
                                            <ValidationProvider name="Confirm" vid="confirm" rules="required" v-slot="{ errors }">
                                                <input name="Confirm_psw" placeholder="Confirm your password" class="form-control"
                                                    type="password"
                                                    id="confirm_password"
                                                    v-model="formRegister.password_confirmation"                                               
                                                >
                                                <span class="error-messsage">{{ errors[0] }}</span>
                                            </ValidationProvider>                                               
                                        </div>

                                        <div class="row justify-content-center my-3 px-3">
                                            <button type="submit" class="main-btn btn1 btn-block btn-color">SIGN UP</button>
                                        </div>
                                    </form>                               
                                </div>
                            </ValidationObserver>

                            <div class="bottom">
                                <div href="#" class="d-flex sm-text ml-4 col-md-8">
                                    <div class="bottom-text">Already signed up?</div> 
                                    <button @click.prevent="showLogin" class="main-btn btn2 btn-white" >Log In</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
import {registerUser} from '../auth';
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate/dist/vee-validate.full';

    extend("confirmedBy", {
        params: ['target'],
        // Target here is the value of the target field
        validate(value, { target }) {
            return value === target;
        },
        // here it is its name, because we are generating a message
        message: 'Password confirmation does not match'
    });

    export default {
        components: {
            ValidationProvider,
            ValidationObserver,
        },

        data() {
            return {
                formRegister: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                error: null,
            }
        },

        methods:{
            show(){
                this.$modal.show('register');
            },

            showLogin(){
                this.$modal.show('login');
                this.$modal.hide('register');
            },

            hide(){
                this.$modal.hide('register');
            },

            register() {
                registerUser(this.$data.formRegister)
                    .then(res => {
                        console.log(res);
                        this.$store.commit("registerSuccess", res);
                        this.$modal.show('login');
                        this.$modal.hide('register');
                    })
                    .catch(error => {
                        this.$store.commit("registerFailed", {error});
                        })
            }
        },

        computed:{
            regError(){
                return this.$store.getters.regError
            }
            }
      
    };
    
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .blur-content{
        filter: blur(5px); 
    }

    .bottom-text{
        color: $secondary-color;
        font-family: $bold-font;
    }

    button{
        font-family: $primary-font;
        color: $primary-color;
        background: none;
        border: none;

        &.btn1{
            font-size: 18px;
            font-weight: 500;
        }

        &.btn2{
            font-size: 14.4px;
        }
    }

    .close{
        background-color: $primary-color;
        border: none;
        color: white;
        padding: 12px 16px;
        font-size: 16px;
        border-radius: 5px;
    }

    .nav-button{
        color:$primary-color;
        transition: all 150ms ease-in-out;

        &:hover{
            color:$secondary-color;
        }

        &:focus{
            box-shadow: none!important;
        }
    }

    body {
        color: $primary-color;
        font-family: $primary-font;
        overflow-x: hidden;
        height: 100%;
        background-image: none;
        background-repeat: no-repeat
    }

    input,
    textarea {
        background-color: none;
        border-radius: 7px !important;
        padding: 12px 15px;
        width: 100%;
        box-sizing: border-box;
        border: 1px solid $primary-color !important;
        font-size: 16px;
        color: $primary-color;
        font-weight: 400
    }

    input:focus,
    textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid $primary-color !important;
        outline-width: 0;
        font-weight: 400
    }

    .main-btn:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }

    .card {
        border-radius: 0;
        border: none;
        width: 100%;
    }


    .heading {
        margin-bottom: 60px !important
    }

    ::placeholder {
        color: #000 !important;
        opacity: 0.5
    }

    :-ms-input-placeholder {
        color: $primary-color !important
    }

    ::-ms-input-placeholder {
        color: $primary-color !important
    }

    .form-control-label {
        font-size: 12px;
        margin-left: 15px
    }

    .msg-info {
        font-family: $bold-font;
        color: $primary-color;
        margin-bottom: 30px;
    }

    .btn-color {
        font-family: $bold-font;
        border-radius: 7px;
        color: #fff;
        background-color: $primary-color;
        padding: 7px 15px;
        cursor: pointer;
        border: none !important;
        // margin-top: 40px
    }

    .btn-color:hover {
        color: #fff;
        background-color: $secondary-color;
    }

    .btn-white {
        // border-radius: 50px;
        color: $quinary-color;
        background-color: none;
        // padding: 8px 40px;
        cursor: pointer;
        border: none;
        text-decoration: underline;
    }

    .btn-white:hover {
        color: $quartery-color;
        background-image: none;

    a {
        color: #000
    }

    a:hover {
        color: #000
    }

    .bottom {
        width: 100%;
        margin-top: 50px;

    }

    .sm-text {
        font-size: 15px;
    }


}

</style>

