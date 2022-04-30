<template>
    <div class="dash" >
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/blogClub">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">

    
  <div class="row">
    <sidebarDash class="dash" />

    
  </div>
</div>

    </div>
</template>

<script>
import  sidebarDash from "./sidebarDash.vue";

export default{
    name:"dashboard",
    components: {
        sidebarDash
    }
}
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