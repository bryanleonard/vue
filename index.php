<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<title>Learn Vue</title>
	<link rel="stylesheet" 
	  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" 
	  integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" 
	  crossorigin="anonymous">

	  <style>
		[v-cloak] {
		  display: none;
		}
	  </style>
  </head>
  <body>
	<section id="growler" class="container pt-3 pb-5" v-cloak>
	  
<!--       <h1>{{appName}}</h1> -->

	  <h2 v-text="appName" class="mb-5"></h2>


		<p>
			<input 
				type="text"
				v-model="query"
				placeholder="Search"
			><br>
			Input val: {{ query }}
		</p>
<hr>
		<p>
			<input type="checkbox" v-model="isValChecked"> Single check: {{ isValChecked }}
		</p>

<hr>

		<p>
			<textarea name="" id="" v-model="emailMessage"></textarea><br>
			Textarea: {{ emailMessage }}
		</p>

<hr>

		<p>
			<label for="beers">
				<input type="checkbox" id="beers" value="beers" v-model="searchIndexes">
				Beers
			</label>
			<br>
			<label for="breweries">
				<input type="checkbox" id="breweries" value="breweries" v-model="searchIndexes">
				Breweries
			</label>
			<br>searchIndexes: {{ searchIndexes }}
		</p>
		
<hr>

		<p>
			<label for="beers2">
				<input type="radio" id="beers2" value="beers" v-model="searchIndex">
				Beers
			</label>
			<br>
			<label for="breweries2">
				<input type="radio" id="breweries2" value="breweries" v-model="searchIndex">
				Breweries
			</label>
			<br>searchIndex: {{ searchIndex }}
		</p>

<hr>

	<p>
		<select name="selectSearchIndex" id="" v-model="selectSearchIndex">
			<option value="beers">Beers</option>
			<option value="breweries">Breweries</option>
			<option value="pubs">Pubs</option>
		</select><br>
		Selected: {{ selectSearchIndex }}
	</p>

	<p>
		<select name="selectSearchIndexes" multiple v-model="selectSearchIndexes">
			<option value="beers">Beers</option>
			<option value="breweries">Breweries</option>
			<option value="pubs">Pubs</option>
		</select><br>
		Selected: {{ selectSearchIndexes }}
	</p>

	<p>
			<input 
				type="text"
				v-model.lazy="lazyQuery"
				placeholder="Search"
			><br>
			Lazy Input val (remove focus): {{ lazyQuery }}
		</p>

<hr>

	<p>
		<input type="search" v-model="query" placeholder="search">&nbsp;
		<button type="button" v-on:click="executeSearch">Search</button>&nbsp;
		<button type="button" v-on:click="eventParam">Search</button>
		<button type="button" v-on:click="eventParamToken('token', $event)">Search</button>
	</p>


<hr>
	


	  
	</section>

	<!-- // https://unpkg.com/vue -->
	<script src="https://unpkg.com/vue@2.4.2/dist/vue.js"></script>
	<!-- 
	<script src="https://unpkg.com/vue@2.4.2/dist/vue.min.js"></script>  
	vue-devtools doesn't work with production files (.min)
	-->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="scripts.js">
	  
// <svg class="icon icon--site-logo" alt="DLC Home" role="img">
// <title>DLC Home</title>
// <desc>DLC Home</desc>
// <use x="0" y="0" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#dlc-logo"></use>
// </svg>



	</script>
  </body>
</html>
