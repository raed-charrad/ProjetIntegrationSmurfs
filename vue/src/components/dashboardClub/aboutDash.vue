<template>
  <div class="dash">
    <header
      class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"
    >
      <a class="navbar-brand col-md-3 col-lg-9 me-0 px-3" href="/blogClub"
        >Club name</a
      >

      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3" href="#">Sign out</a>
        </div>
      </div>
    </header>

    <div class="container-fluid">
      <sidebarDash class="dash" />
      <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div
            class="
              d-flex
              justify-content-between
              flex-wrap flex-md-nowrap
              align-items-center
              pt-3
              pb-2
              mb-3
              border-bottom
            "
          >
            <h1 class="h2">Ajouter une longue description</h1>
          
            <div class="btn-toolbar mb-2 mb-md-0"></div>
          </div>
         
          <form @submit.prevent="createDescription" v-if="update==false" >
            <div class="mb-3">
              <label for="longDesc" class="form-label"
                >Saisir une longue description</label
              >
              <input
                type="textarea"
                class="form-control"
                v-model="longDescription"
                required
                
              />
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
          </form>

          <form @submit.prevent="submitEdit" v-if="update==true" >
            <div class="mb-3">
              <label for="longDesc" class="form-label"
                >Saisir une longue description</label
              >
              <input
                type="textarea"
                class="form-control"
        
                v-model="longDescription"
                required
                
              />
            </div>
            <button type="submit" class="btn btn-warning">Edit</button>
          </form>

          <div v-if="created==true">
            <h2>Longue description</h2>
            <ol class="list-group list-group" v-for="(item, index) in abouts" :key="index">
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-0 me-auto">
                  
                  <p>{{item.longDescription}}</p>
                  
                </div><br>
                <div class="badge bg-warning rounded-pill btn btn-sm" @click="updateDescription(item.id)" ><b-icon-pen></b-icon-pen></div>
                <div class="badge bg-danger rounded-pill btn btn-sm" @click="deleteDescription(item.id)"><b-icon-trash></b-icon-trash></div>
              </li>
            </ol>
            
            
          </div>
          
          

          <br /> <br />
          
          
          <canvas
            class="my-4 w-100"
            id="myChart"
            width="900"
            height="380"
          ></canvas>
          <div>
      
        </div>
        
          <h2>Section title</h2>
        </main>
      </div>
    </div>
    
  </div>
</template>

<script>

import sidebarDash from "./sidebarDash.vue";


export default {
  name: "aboutDash",
  components: {
    sidebarDash, 
  },
  data(){
      return {
            abouts:[],
            longDescription: "",
            created : false,
            update : false,
            id : null,
            
      }
  },
  created(){
    this.$http.get('http://localhost:8000/api/1/about/getAll').then(response => {
        // console.log(response.data.data);
        if (response.data.data!=undefined){
          this.abouts = response.data.data
         
          this.created=true
        }
          
        })
  },
  methods: {
    createDescription(){
      let newAbout = {
        longDescription: this.longDescription,
        idClub: 1
      }
      this.$http.post("http://localhost:8000/api/1/about/create", newAbout).then( ()=> {
       
        this.created = true;
        
       this.$http.get('http://localhost:8000/api/1/about/getAll').then(response => {
       
          this.abouts = response.data.data
          
        })
        
       alert("Description ajoutée");
      });
      
  },
  deleteDescription(id){
    
    this.$http.delete("http://localhost:8000/api/1/about/delete/"+id).then(() => {
     
      this.abouts = this.abouts.filter(item => item.id != id)
      alert("Description supprimée");
    })
    this.$http.get('http://localhost:8000/api/1/about/getAll').then(response => {
       
          this.abouts = response.data.data
          
        })
 
  },
  updateDescription(id){
   
    this.update = true;
    this.id = id;
    for (var i = 0; i < this.abouts.length; i++) {
      if (this.abouts[i].id == id) {
        this.longDescription = this.abouts[i].longDescription;
      }
    }
    
    
  },
  submitEdit(){
    let newAbout = {
      id: this.id,
      longDescription: this.longDescription,
      idClub: 1
    }
    this.$http.put("http://localhost:8000/api/1/about/update/"+this.id, newAbout).then(() => {
      
    
      this.created = true;
      
      this.abouts = this.abouts.filter(item => item.id != this.id)
      this.abouts.push(newAbout)
      
     alert("Description modifiée");
     this.update = false;
     this.longDescription = "";
    
    });
    
  
  }
  
  },
  
    
};
</script>
<style scoped>


.dash > div {
  font-size: .875rem;
}

.dash > .feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}

/*
 * Sidebar
 */

.dash > .sidebar {
  position: fixed;
  top: 0;
  /* rtl:raw:
  right: 0;
  */
  bottom: 0;
  /* rtl:remove */
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 48px 0 0; /* Height of navbar */
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

@media (max-width: 767.98px) {
  .sidebar {
    top: 5rem;
  }
}

.dash > .sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

.dash > .sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.dash > .sidebar .nav-link .feather {
  margin-right: 4px;
  color: #727272;
}

.dash > .sidebar .nav-link.active {
  color: #2470dc;
}

.dash > .sidebar .nav-link:hover .feather,
.dash > .sidebar .nav-link.active .feather {
  color: inherit;
}

.dash > .sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}

/*
 * Navbar
 */

.dash > .navbar-brand {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, .25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.dash > .navbar .navbar-toggler {
  top: .25rem;
  right: 1rem;
}

.dash > .navbar .form-control {
  padding: .75rem 1rem;
  border-width: 0;
  border-radius: 0;
}

.dash > .form-control-dark {
  color: #fff;
  background-color: rgba(255, 255, 255, .1);
  border-color: rgba(255, 255, 255, .1);
}

.dash > .form-control-dark:focus {
  border-color: transparent;
  box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}
.dash > .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }

</style>