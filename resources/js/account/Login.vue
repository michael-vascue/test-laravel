<template>
    <div>
        <!-- <a @click.prevent="show" class="nav-link" href="/#signup">Sign In</a> -->
        <button @click.prevent="show" type="button" class="nav-button btn btn1 btn-default" style="padding-top:9px">Sign In</button>
        <modal name="login" :width="500" :height="500" styles="border-radius:71px">
            <!-- <div class="container">
                <div>
                    <h6 class="msg-title">LOG IN TO YOUR ACCOUNT</h6>
                    <form action="#" method="post">
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="border" ref="email" placeholder="Enter your email address">
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" class="border" ref="email" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="px-4 py-2 rounded">LOG IN</button>
                        </div>
                        <div>
                            <p>New to Illus Dream?<a href="#">Sign Up</a></p>
                        </div>
                    </form>
                </div>
               
            </div> -->
           <div class="container px-4 py-5 mx-auto">
                <div class="card card0">
                    <div class="d-flex flex-lg-row flex-column-reverse">
                        <div class="card card1">
                            <div slot="top-right">
                                <button @click="$modal.hide('login')" class="btn1" style="float: right">
                                    <i class="fas fa-window-close fa-2x"></i>
                                </button>
                            </div> 
                            <div class="row justify-content-center"> 
                                <div class="col-md-8 col-10">                                               
                                    <h5 class="msg-info text-center">LOG IN TO YOUR ACCOUNT</h5>
                                    <div class="form-group"><input type="text" id="email" name="email" placeholder="Enter your email address" class="form-control"> </div>
                                    <div class="form-group"><input type="password" id="psw" name="psw" placeholder="Enter your password" class="form-control"> </div>
                                    <div class="row justify-content-center my-3 px-3"> <button class="main-btn btn1 btn-block btn-color">LOG IN</button> </div>        
                                </div>
                            </div>
                            <div class="bottom">
                                <div href="#" class="d-flex sm-text mx-auto col-md-8 px-2">
                                    <div class="bottom-text">New to Illus Dream?</div> 
                                    <button class="main-btn btn2 btn-white ml-2">Sign Up</button>
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
    export default {

        methods:{
          show(){
            this.$modal.show('login');
            
          },
          hide(){
            this.$modal.hide('login');
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
        font-family: $primary-font;
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

    button:after{
        -webkit-filter: blur(8px);
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
        border: none
    }

    .card1 {
        width: 100%;
        
    }

    .heading {
        margin-bottom: 60px !important
    }

    // ::placeholder {
    //     color: #000 !important;
    //     opacity: 1
    // }

    // :-ms-input-placeholder {
    //     color: #000 !important
    // }

    // ::-ms-input-placeholder {
    //     color: #000 !important
    // }

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
        color: $primary-color;
        background-color: none;
        // padding: 8px 40px;
        cursor: pointer;
        border: none;
    }

    .btn-white:hover {
        color: #fff;
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

    // @media screen and (max-width: 992px) {
    //     .card1 {
    //         width: 100%;
    //     }

    //     .right {
    //         margin-top: 100px !important;
    //         margin-bottom: 100px !important
    //     }
    // }

    // @media screen and (max-width: 768px) {
    //     .container {
    //         padding: 10px !important
    //     }

    //     .right {
    //         margin-top: 50px !important;
    //         margin-bottom: 50px !important
    //     }
    // }
}

</style>

