<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>
          <div class="card-body">I'm an example component.</div>
        </div>
        <div class="card">
          <div class="card-header">Another component</div>
          <div class="card-body">
            Laravel + Vue.js
            <p><input type="text" v-model="test" /></p>
            <p><input type="text" v-model="test2" /></p>
            <p><input type="text" v-model="test3" /></p>
            <p><input type="text" v-model="test4" /></p>
          </div>
          <div>
            <p>{{ test }}</p>
            <p>{{ test2 }}</p>
            <p>{{ test3 }}</p>
            <p>{{ test4 }}</p>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Another component</div>
          <div class="card-body">
            Testing Laravel + Vue.js
            <input type="text" v-model="test2" />
          </div>
          <div>
            <p>{{ test2 }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
        <div class="card-header">Last Component</div>
        <div class="card-body">
            <span v-bind:title="message">
                Hover your mouse over me for a few seconds
                to see my dynamically bound title!
            </span>
        </div>
    </div>
  </div>
</template>

<script>
// @js-check
export default {
  data: () => {
    return {
      test: "",
      test2: "",
      test3: "",
      test4: "",
      message: "ihuuuuuuuu",
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
