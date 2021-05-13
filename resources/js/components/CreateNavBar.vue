<template>
  <div class="d-flex" id="wrapper">
    
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <!-- <div class="sidebar-heading">Therichpost </div> -->
       <div class="list-group list-group-flush">
            <div class="sidenav flex-column">
                <button @click="backHome()" style="padding: 6px 15px" class="list-group-item list-group-item-action"><i class="fas fa-home fa-2x"></i>Home</button>
                <button  class="list-group-item list-group-item-action"><i class="fas fa-users fa-2x"></i>Character</button>
                <button  class="list-group-item list-group-item-action"><i class="fas fa-vector-square fa-2x"></i>Element</button>                           
                <button  class="list-group-item list-group-item-action"><i class="far fa-file-image fa-2x"></i>Background</button>
            </div>
       </div>
                    
      <!-- <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
      </div> -->
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container-fluid">
        <h1 class="mt-4">Simple Sidebar</h1>
        <p>Add your content</p>
        
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
</template>
<script>
export default {
   methods: {
        backHome() {
             this.$router.push('/'); 
        },
    },

    mounted(){
        //toggle sidebar
        $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        });
    },
  
}
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

     /* The sidebar menu */
    .sidenav {
        width: 95px; /* Set the width of the sidebar */
        position: fixed; /* Fixed Sidebar (stay in place on scroll) */
        z-index: 1; /* Stay on top */
        // top: 1; /* Stay at the top */
        background-color: white;
        overflow-x: hidden; /* Disable horizontal scroll */
        // padding-top: 20px;

    }
    
    .sidenav button {
        padding: 6px 10px;
        outline: none;
        display: block;
        color: $secondary-color;
        font-family: $bold-font;
        border: none;
        background: none;
        font-size: 14px;
        margin-bottom: 10px;

        &:focus{
            background: #FFF4CA;
            color: #D46C51;
            box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.35);

            
        }
    }

    #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        -webkit-transition: margin .25s ease-out;
        -moz-transition: margin .25s ease-out;
        -o-transition: margin .25s ease-out;
        transition: margin .25s ease-out;
    }
    
    #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
    }
    
    #sidebar-wrapper .list-group {
        width: 15rem;
    }
    
    #page-content-wrapper {
        min-width: 100vw;
    }
    
    #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
    }
    
    @media (min-width: 768px) {
        #sidebar-wrapper {
        margin-left: 0;
        }
    
        #page-content-wrapper {
        min-width: 0;
        width: 100%;
        }
    
        #wrapper.toggled #sidebar-wrapper {
        margin-left: -15rem;
        }
    }
    .bg-light {
        background-color: lightyellow!important;
    }
    #page-content-wrapper{background-color: lightblue;}
</style>