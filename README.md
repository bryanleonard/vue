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
  - `data: { accentColor: 'accent-color, headers: 'headers'}`<br>
  `v-bind:class="[accentColor, headers]"`






