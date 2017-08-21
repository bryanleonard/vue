let Growler = new Vue({
  el: '#growler',
  data: {
    appName: 'Growler',
    query:'',
    emailMessage: '',
    isValChecked: 'true',
    searchIndexes:[],
    searchIndex: 'beers',
    selectSearchIndex: 'pubs',
    selectSearchIndexes: ['beers', 'pubs'],
    lazyQuery: '',

  },
  methods: {
    	executeSearch: function() {
    		console.log(this);
    		alert(this, this.query)
    	},
    	eventParam: function(evt) {
    		console.log(evt, evt.target.innerText);
    	},
    	eventParamToken: function(t, e) {
    		let msg='Token: ' + t + ' Query: ' + this.query + ' Button: ' + e.target.innerText;
    		console.log(msg);
    	}
    }

});

// Vue.config.devtools = true;
// v-on shorthand syntax is @
// <button @click="executeSearch"...>