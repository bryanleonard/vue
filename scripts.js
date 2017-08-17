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
    lazyQuery: ''
  }

});

// Vue.config.devtools = true;
