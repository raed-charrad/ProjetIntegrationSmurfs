<template>
    <div class="dash">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          
          
          <li class="nav-item">
            <a class="nav-link" href="/headerDash">
              <span data-feather="shopping-cart"></span>
              Entete
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/aboutDash">
              <span data-feather="users"></span>
              Qui sommes-nous ?
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/activitiesDash">
              <span data-feather="bar-chart-2"></span>
              Activités
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/boardDash">
              <span data-feather="layers"></span>
              Membres de bureau 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/projectsDash">
              <span data-feather="layers"></span>
              Projets 
            </a>
          </li>
        </ul>
    </div>
        
        
    </nav>
    </div>
</template>

<script>
export default {
    name: "sidebarDash"
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
  top: 15%;
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

</style>