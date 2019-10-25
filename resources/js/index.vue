<template>
    <div id="main">
        <header id="header">
            <navigationMenu></navigationMenu>
        </header>
        <main class="">
            <div class="container mt">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>
<script>
    import navigationMenu from './components/Nav.vue'
  export default {
    data() {
      return {
        //
      }
    },
     components: {
      navigationMenu
    }
  }
</script>
