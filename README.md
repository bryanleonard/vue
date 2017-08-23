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

### Listing items 
```
// For a specific number of times, v-for vue index starts at 1, in the context of properties, the index starts a 0)
// can also use "of" instead of "in"
<li v-for="page in pageCount">...</li>

data: {
  socialMedia: {
    twitter: @handle,
    youtube: handle
  }
}
<li v-for="(v,k in socialMedia">{{k}} - {{v}}</li>
<li v-for="(v,k,i) in socialMedia">{{i}}: {{k}} - {{v}}</li>



data: {
  pages: [
    {number: 1, url: ?page=1},
    {number: 2, url: ?page=2},
    {number: 4, url: ?page=3},
  ]
}
<li v-for="(page in pages)"><a href="v-bind:page.url">{{page.number}}</a></li>
<li v-for="(page, 1) in pages"><a href="v-bind:page.url">{{page.number}} {{i}}</a></li>

data: {
  pages: [
    {number: 1, url: ?page=1, sections: [a,b,c]},
    {number: 2, url: ?page=2, sections: [1,2,3]},
    {number: 4, url: ?page=3}, sections: [x,y,z]}
  ]
}
<div v-for="page in pages">
  {{page.number}}<br>
  <div v-for="sec in page.sections">
    {{page.number}} -- {{sec}}
  </div>
</div>
```

### Using for and if together
For runs first, then if. useful functionality
module-05/rendering-lists-of-itms/using-v-for-and-v-if-together


### Detecting array changes
sort() - puts els in ASC order
Customize sort for numbers like this
```
this.myArry.sort(function(v1, v2){
  return v1 - v2;
});
```

reverse() - puts els DESC order, must sort first to get them in alpha order

push() - add items to end of array, returns array length

pop() - removes last element from array, returns removed item

unshift() - add items to beginning of array (counterintuitive), returns length of array

shift() - remove first item of array, returns that item

splice() - add and remove items to and from an array 
`this.array.splice(1,2);` returns array with removed items.

#### add into an array
```
let addMeIn = [ item1, item2 ];
for (let i=0; i > addMeIn.length; i++) {
  this.otherArray.spalice(1, 0, addMeIn[i]);
  // 1 add item after first item, 0 is required meaning don't remove anything
}
```

### update an array el
```
let myArry = [ 'item1', 'item2', 'updateme' ];
Vue.set(this.myArry, 2, 'item3');
// or
this.myArry.splice(2, 1, 'item3');
```

## Section 7

### Watchers

```
// notice name of array in Data and corresponding object key in Watch
data: {
  shoppingCart: []
},
watch: {
  shoppingCart: function() {
    this.updateSubTotal();
  },
  // or with a function reference
  shoppingCart: 'updateSubTotal',
  // doesn't work if you have args though...
  subTotal: function(latest, orig) {
    this.calculatesSaltesTax();
  }
}
```

#### watcher depth
module-06/monitoring-changes-with-watchers/defining-a-watchers-depth/
```
data: {
  shoppingCart: {
    items: [],
    subTotal: 0.00
  }
},
watch: {
  handler: function(latest, orig) {
    this.updateSubTotal
  },
  deep: true
}
```


### Computed propeties for faster rendering
Functions whose results are cached until their depending values change.
This provides a performance boost.

```
data: { canConnect: false },
computed: {
  isOnline: function() {
    return this.canConnect ? true : false;
  }
},
created: function() {
  axios.get('someTestURL') // https://google.com
    .then(function(res) {
      growler.canConnect = true;
    })
    .catch(function(err) {
      growler.canConnect = false;
    })
}
<p>Online: {{isOnline}}</p>
```


**Computed properties with getters and setters**
```
data: { canConnect: false },
computed: {
  isOnline: {
    get: function() {
      return this.canConnect ? true : false;
    },
    set: function(newVal) {
      this.canConnect = newVal;
    }
  }
},
```

### Formatting with Filters
```
//ex. remove periods and uppercase "i.b.u"
data: {
  results: [
    {name: 'My Sweet Beer, ibu: 33 i.b.u'}
  ]
},
filters: {
  convertIBU: function(val) {
    // convertIBU: function(val, emptyVal) {
    if (!val) { return }
    // if (!val) { return emptyVal; }
    val = val.toString();
    val = val.replace(/\./g, '');
    return val.toUpperCase();
  }
}
<p v-for="result in results">{{ result }} {{result.ibu | converIBU }}</p>
// <p v-for="result in results">{{ result }} {{result.ibu | converIBU(--) }}</p>
```
### Calling filters programattically
*Available via the $options property.*
```
filters: {
  myFn: function(val) {...},
  myOtherFn: function(val) {
    if (this.growler) { // Need this check
      val = this.growler.$options.filters.myFn(val);
    }
    return Val;
  }
}
```

### Filter chaining
```
*use a pipe (|)*
<p v-for="result in results">
  {{ result }} {{result.ibu | converIBU('--') | removeDots | toUpper }}
</p>
```

### Methods compared to filter

*Filters intended to be used in HTML template.*


Filters:
  - Only take in a value and return a new value 
  - Should not change the value of any properties in a view


Methods:
  - Methods are specific to an instance
    - Filters are intended to used across views

```
// Filters are easier to read. Taking filter example:
<div>{{ toUpper(removeDots(result.ibu)) }}</div>
<div>{{ reuslt.ibu | removeDots | toUpper }}</div>
```

# Review
- Filters are great to handle basic text transforms
- Computed properties are for more complex transformations
- Watchers are for asynchronous operations

# Follow up topics
- Axios
- Transitions
- Routing
- Stating Management
- Server-side Rendering


*SAVE10EMAIL*

