<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Vue.js</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"
    		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    		crossorigin="anonymous">
  </head>
  <body>
    <section id="growler">
      
      <h1>{{appName}}</h1>

      <h2 v-text="appName"></h2>

    </section>

    <!-- // https://unpkg.com/vue -->
    <script src="https://unpkg.com/vue@2.4.2/dist/vue.js"></script>
    <!-- 
    <script src="https://unpkg.com/vue@2.4.2/dist/vue.min.js"></script>  
    vue-devtools doesn't work with production files (.min)
    -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="scripts.js"></script>
  </body>
</html>
