<!-- You cannot use delete as a variable name because delete is a reserved word in JavaScript. Also, Vue.js will throw a compile error on the reserved word. -->
<template>
  <div id="app">
    <form action="" @submit.prevent="submit($event)">
      <p v-for="(item, index) in elems" :key="index">
        <input type="text" :class="{
          'form-group--error': item.valid == 0 || (firstField == -1 && secondField != -1 && item.value == '') || (item.valid == 1 && item.value == ''),
          'form-group--success': item.valid == 1 && item.value != '',
        }" v-model="item.value" required @focus="recordFocus(index)" />
        <span v-if="item.error">Please enter a value.</span>
        <button @click="remove(index)" type="button">delete</button>
      </p>
      <br />
      <div>
        <button @click="add" type="button" class="btn-primary edit">Add</button>
        &nbsp;
        <button @click="formSubmitted = 1;" type="submit" class="btn-primary edit">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
/**
 * REQUIREMENTS:
 *
 ** 1. Implement the "add" and "delete" functionality
 ** 2. Make the text input fields required by adding
 ** validation rules for the `value` attribute of each elements
 ** 3. On submit, vaidate the form and show an alert
 ** with the message "Success" (if the form is valid)
 ** or "Form not valid"
 ** 4. Make the text input elements reflect their state (error/succes)
 ** when the user tries to submit the form
 *
 * BONUS POINT A:
 * Make the text input elements change their state
 * under the following conditions:
 *    a) when the field is changed the first time
 *    b) on each keystroke afterwards
 * This means that if you start typing something in the first input
 * the field should not turn green as soon as I type the first letter
 * but it should turn green when I move the cursor to another field (blur)
 * However, if I return to tht same first input, on each keystroke
 * the status should be updated.
 *
 * Example:
 * 1. Type "abc" in the first field -> Nothing happens
 * 2. Move the cursor to the second field -> First field turns green
 * 3. Move the cursor back to the first field -> Nothing happens with the second field
 * 4. Hit Delete until the first field is empty -> As soon as the first field is empty, the field turns red
 *
 * BONUS POINT B:
 * Require that the first element in the list to be exactly "abc"
 * 
 * ! (What about a string that's different to 'abc'? should it be ignored or treated as incorrect (similar to empty))\
 * ! IF YES, replace input (line 6-10) with this:
 *     <input type="text" :class="{
          'form-group--error': item.valid == 0 || (firstField == -1 && secondField != -1 && item.value !== 'abc') || (item.valid == 1 && item.value !== 'abc'),
          'form-group--success': item.valid == 1 && item.value === 'abc',
        }" v-model="item.value" required @focus="recordFocus(index)" />
 *
 */

export default {
  name: "App",
  data() {
    return {
      firstField: -1,
      secondField: -1,
      elems: [
        {
          value: "",
          valid: -1,
        },
        {
          value: "",
          valid: -1,
        },
      ],
      formSubmitted: false,
    };
  },
  methods: {
    submit: function () { this.formSubmitted = true; },
    add: function () {
      this.elems.push({ value: "", valid: -1 })
      console.log("add");
    },
    remove: function (index) {
      this.elems.splice(index, 1);
    },
    recordFocus(index) {

      if (this.firstField === -1) {
        //1st click -> first element index
        this.firstField = index;
      }
      else if (this.secondField === -1) {
        // 2nd click -> second element index
        this.secondField = index;
      } else {
        // 3rd click -> reset 
        this.firstField = -1;
        this.secondField = -1;
      }

      if (this.firstField !== -1 && this.secondField !== -1)
        if (this.elems[this.firstField].value === "")
          this.elems[this.firstField].valid = 0;
        else
          this.elems[this.firstField].valid = 1;
    }
  },
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.form-group--error {
  border: 1px solid red;
}

.form-group--success {
  border: 1px solid green;
}

.pair {
  display: flex;
  grid-gap: 16px;
}
</style>
