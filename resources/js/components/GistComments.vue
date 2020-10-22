<template>
  <div>
    <gist-comment
      v-for="comment in comments"
      :key="comment.id"
      :gist-id="gistId"
      :comment="comment"
    ></gist-comment>
    <div v-if="loading">Loading comments...</div>
  </div>
</template>

<script>
export default {
  props: {
    gistAuthor: String,
    gistId: String,
  },
  data: function () {
    return {
      comments: [],
      loading: true,
    };
  },
  mounted() {
    this.loadComments();
  },
  methods: {
    loadComments() {
      axios
        .get(`/${this.gistAuthor}/${this.gistId}/comments.json`)
        .then((response) => {
          this.comments = response.data;
          this.loading = false;
        })
        .catch(() => {
          alert("Something went wrong loading the comments.");
        });
    },
  },
};
</script>
