<template>
    <div class="container" style="padding-top:25px">
        <div class="main-font">My Profile</div>
        <div class="d-flex row">
            <div class="col-6">
                <ValidationObserver v-slot="{ handleSubmit }">
                    <form @submit.prevent="handleSubmit(updateProfile)">
                        <div class="d-flex py-4">
                            <!-- <img class="profile" src="/img/profile.jpg" alt="" > -->
                            <div>
                                <template v-if="!currentUser.profile_image_url" >
                                    <img class="profile" src="/img/default.png" alt="">
                                </template>
                                <template v-else>
                                    <div class="profile">{{currentUser.profile_image_url}}</div>
                                </template>
                            </div>
                            <div class="my-auto ml-5">
                                <button type="submit" class="btn upload text"><i class="fas fa-upload fa-sm pr-2"></i>Upload new picture</button>
                            </div>
                        </div>
                        <div class="form-group col-10 p-0 m-0">
                            <ValidationProvider name="Name" rules="required|alpha" v-slot="{ errors }">
                                <label  class="text">Name</label>
                                <input type="text" id="name" class="form-control form-text" placeholder="Enter your username" v-model="userForm.name">
                                <span class="error-messsage">{{ errors[0] }}</span>
                            </ValidationProvider>
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group col-10 p-0 m-0 mt-4">
                            <ValidationProvider name="E-mail" rules="required|email" v-slot="{ errors }">
                                <label class="text">Email</label>
                                <input type="email" id="email"  class="form-control form-text" placeholder="Enter email" v-model="userForm.email">
                                <span class="error-messsage">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <button type="submit" class="btn col-10 p-o save-but">SAVE CHANGES</button>
                    </form>
                </ValidationObserver>
            </div>
            <div class="w-50">
                <img class="bg-img" src="/img/profile-bg.png" alt="">
            </div>
        </div>
    </div>
</template>

<script>
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate/dist/vee-validate.full';

export default {

    components: {
        ValidationProvider,
        ValidationObserver,
    },

    data() {
        return {
            userForm: {
                name: '',
                email: '',  
            },
            
            error: null,
        }
    },
    watch: {
        // currentUser (newData){
        //         this.userForm = newData;
        //     }
        },

    created () {
        this.userForm = JSON.parse(JSON.stringify(this.$store.getters.currentUser));
    

    },

    computed: {          
        currentUser(){
            return this.$store.getters.currentUser;
        },
    },

   
    methods: {
        //  updateProfile (){
        //     this.$store.dispatch('updateUser'); 
        //     var _this = this;
        //         // ajax call to POST this.profile then
        //     _this.$store.commit('update', 
        //         {
        //             // name: 'currentUser',
        //             data: this.userForm
        //         })
        // },

        getUser (){
            const token = localStorage.getItem('token')
            axios.get('/api/auth/userprofile',{
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
            .then(response => {
                this.userForm= response.data.user;
                // this.userForm.email = response.data.user.email;

            })
        },

        updateProfile () {
            const token = localStorage.getItem('token')
            axios.put('/update-profile', 
                {
                    name: this.userForm.name,    
                    email: this.userForm.email,
                })
                .then(response => {
                    this.userForm.name = response.data.name;
                    this.userForm.email = response.data.email; 
                    swal({
                        icon: "success",
                        text: "Update Succesfully!",
                    });   
                })
            }
    }

}
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .bg-img{
        width: 7in;
        float: right;
    }

    .form-control{
        border: 1px solid $primary-color;
    }

    .form-text{
        height: 46px;
    }

    .main-font{
        font-family: $bold-font;
        font-size: 20px;
        font-weight: 500;
        color: $secondary-color;
        letter-spacing: 1px;
    }

    .profile{
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .save-but{
        font-family: $primary-font;
        font-size: 20px;
        font-weight: 500;
        color: white;
        letter-spacing: 1px;
        // border: 1px solid $primary-color;
        background: $primary-color;
        margin-top: 35px;
    }

    .text{
        font-family: $primary-font;
        color: $primary-color;
    }

    .upload{
        width: 2.3in;
        height: 35px;
        border: 1px solid $primary-color;
        background: white;
    }

    @media (min-width: 1200px) {
      .container{
          max-width: 1200px;
      }
    }
</style>