<!--
  - Copyright (c) by anime-free
  - Date: 2020.
  - User: Alukardua
  -->

<template>
  <div class="rating-full">
    <a id="plus" href="#" @click.prevent="plusVote(post)" v-bind:class="{ disabled: isVoted }">
      <span> {{count_plus}}</span>
    </a>
    <a id="minus" href="#" @click.prevent="minusVote(post)" v-bind:class="{ disabled: isVoted }">
      <span> {{count_minus}}</span>
    </a>
  </div>
</template>

<script>
export default {
  props: ['post', 'votes', 'count_plus', 'count_minus'],

  data: function () {
    return {
      isVoted: '',
    }
  },

  mounted() {
    this.isVoted = !!this.isVotes;
  },

  computed: {
    isVotes() {
      return this.votes;
    },
  },

  methods: {
    plusVote(post) {
      axios.post('/plus/' + post)
          .then(response => this.isVoted = true)
          .catch(response => console.log(response.data));
    },
    minusVote(post) {
      axios.post('/minus/' + post)
          .then(response => this.isVoted = true)
          .catch(response => console.log(response.data));
    },
  }
}
</script>
