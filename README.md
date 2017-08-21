## vue

[https://github.com/ecofic/course-vue-getting-started](https://github.com/ecofic/course-vue-getting-started)

[https://unpkg.com/vue@2.4.2/dist/vue.min.js](https://unpkg.com/vue@2.4.2/dist/vue.min.js)

_instance of Vue = view_

### Lifecyle of a View
#### new Vue()

Includes before and after points for each stage

1. creation - beforeCreate, created
  1. beforeCreate
  2. Initalize State
  3. created
  (after created, template is compiled)
2. mounting - beforeMount, mounted
  1. beforeMount
  2. Create Virtual DOM
  3. mounted
  (after created, Vue begins listening for data changes which trigger updating)
3. updating - beforeUpdate, updated
  1. beforeUpdate
  2. Re-render Virtual DOM (with patches. only change what needs changed)
  3. updated
4. destroy  - beforeDestroy, destroyed
  1. beforeDestroy
  2. Teardown of Virtual DOM
  3. destroyed

**Note:** destroy only gets called when method is explicitly called. Doesn't get called on page navigation changes, for example.

### Data and Property Values
Accepts Primitive values - 123, "abc", 2017-02-14, [1,2,3]
Doesn't accept native objects like Number, String, Date, and Array
Stick with raw data

### Binding Data
Can use Semantic syntax or Declaritive syntax. Your choice. Can also create one-time bindings.

* Semantic bindings-  use {{ ... }} Ex.` <h1>{{appName}}</h1>` 
* Declarative bindings -  created via directives, all begin with "v-"<br>
Ex. `<h2 v-text="appName"></h2>` "v-text" might also be referred to as the "text-directive"
* One-time bindings - `<h1 v-once>{{appName}}</h1>`

**Note:** you can pass html in your data (though you should avoid it) - use `v-html` to output. `<h2 v-html="appName"></h2>`

### v-bind
`<img src v-bind:src="appLogo">` or `<img :src="appLogo">`

##### Can bind to style attributes (but please don't)
- from JS object 
  - `<h2 v-bind:style="{color: color}">{{appName}}</h2>`
  - `<h2 v-bind:style="{fontFamily: fontFamily}">{{appName}}</h2>`
  - `data: { appStyle: {color: '#fff', fontFamily: 'arial', .... }}`<br>
  `v-bind:style="appStyle"`

- or an array
  - `data: { accentColor: {color: #333}, headers: {fontSize: '20rem', fontFamily: 'arial', .... }}`<br>
  `v-bind:style="[accentColor, headers]`

- bind to CSS classes
  - ```
    data: { 
      accentColor: 'accent-color, 
      headers: 'headers'
    }

    v-bind:class="[accentColor, headers]"
    ```
  - ```
    // OR
    data: { ..., 
      headerStyles: ['accent-color', 'headers']
    }

    v-bind:class="headerStyles"
    ```
  
  - ```
    // OR
    data: {
      isOnline: false
    }
    .headers { color: #000; }
    ```
    ```
    v-bind:class="{ 
      'headers': true, 
      'accent-color': isOnline
    }"
    ```

### Javascript Expressions
A line of code that produces a value <br>
// Ex., **not** let x = location.host.includes('localhost')<br>
// just location.host.includes('localhost'), which will evaluate to true of false
<p>Just use {{ ... }}</p>

```
let growler = new Vue({
  el: $growler,
  data: {
    appName: 'Growler',
    isOnline: false
  }
});
```
```
<h2
  v-text="appName" 
  v-bind:style="{color: isOnline ? #'fff' : '#000' }"
>...
```

### Binding with Forms
**Text fields** 
```
let growler = new Vue({
  el: $growler,
  data: {
    appName: 'Growler',
    query: ''
  }
});

<input v-model="query" placeholder="Search">
```

### Modifying Bound values (can be chained)
1. trim string values
  `<input v-model.trim="query" placeholder="Search">`
2. convert input values to numbers (uses parseFloat, automatically trims)
  `<input v-model.number="result" placeholder="2+3=">`

### Lazy Binding HTML (HTML onchange event)
* Fires when an **input** element's value is modified
* Fires after an input element has lost the focus
`<input v-model.lazyLOC ="query" placeholder="Search">`



### Event capturing (avoid doing this)
```
// Propagating events from top-to-bottom
  <div v-on:click.capture="grandparentClick">
    <div c-on:click.capture="parentClick">
      <button type="button" v-on:click.capture="executeSearch">Search</button>
    </div>
  </div>
```



### Prevent modifier (much like JS preventDefault)
```
let growler = new Vue({
  el: $growler,
  data: {
    appName: 'Growler',
    query: ''
  },
  methods: {
    executeSearch: function() {
      if (this.query) {
      ...do something
      } else {
      alert('you didn\'t so stuff)
    }
    }
  }
});

// Note btn type
<button type="submit" v-on:click.prevent="executeSearch">Search</button>
```

### Stop modifier - VERY useful
```
// Need stop modifier to actually prevent propagation
// Can apply to parent els to stop propagation further up.
<button type="submit" v-on:click.stop="executeSearch">Search</button>
```

### Once modifier
//Doesn't stop propagation
```
data: {
  query: '',
  isRunning: false
}
methods: {
  executeSearch: function() {
    this.isRunning ' true';
    document.forms[0].submit();
  }
}
<button type="button" 
  v-on:click.once="executeSearch" 
  v-bind:disabled="isRunning">Search</button>
```



### Bypass Event Propagation by chaining
```
<div v-on:click.stop.self="parentClick">
  <button type="button" 
    v-on:click="executeSearch">Search</button>
  </div>
```

### Handling keypress event
```
<form action="" v-on:submit.prevent>
  <input type="search" 
    v-model="query"
    v-on:keyup="evaluateKey"
    v-on:keyup.enter="executeSearch"
    >
  <button v-on:click.once="executeSearch">
    Search
  </button>
</form>
```

### Custom Key Modifiers
```
Vue.config.keyCodes = {
  f1: 112
};

<div id="growler" v-on:keydown.f1="openInfo"></div>
```

### Mouse interactions, can use with mouseup and mousedown
examples: module-04/altering-events/reacting-to-mouse-events
*left* modifier: interacts with left mouse button
*middle* modifier: interacts with middle mouse button
*right* modifier: interacts with right mouse button
```
<div v-on:mousedown.left="onBlockClick">...</div>
<div v-on:click.left="onBlockClick">...</div>
<div v-on:click="onBlockClick">...</div>

<div v-on:mousedown.right="onBlockClick">...</div>
// must use showContextMenu event to disable right-click menus
data: {
  showContextMenu: false
  ...
}
<div v-on:contextmenu.prevent="onBlockClick"></div>
<ul id="myContextMenu"
  v-if="showContextMenu"
  v-on:blur="closeContextMenu"
  v-bind:style="{key: value}">
  <li>...</li>
</ul>
```

### Look into keyboard shortcuts using key modifiers for fun results. (using things like ctrl+click behaviors)

### Rendering conditionally on load (v-cloak)
module-05/rendering-elements-conditionall/on-load/example-01.html

## Rendering conditionally during runtime
```
//great for small examples, 
<div v-if="beers.length===0"> IF </div>
<div v-else-if="beers.length===1"> ELSEIF </div>
<div v-else> ELSE </div>

//for larger recordsets, this changes CSS property. Doesn't re-write the DOM like if/else
<div v-show="beers.length === 0"> nothing </div>
<div v-show="beers.length > 0"> Something </div>
```


SAVE10EMAIL

