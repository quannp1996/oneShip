const prizeVUE = new Vue({
  el: '#project_app__page',
  data: {
    fetchURL: api,
    projects: [],
    pagination: null,
  },

  mounted: async function () {
    await this.load();
  },

  methods: {
    load: async function (page = 1) {
      await $.get(this.fetchURL, {
        page: page,
        hasPagination: true
      }).then(json => {
        this.projects = this.projects.concat(json.data);
        this.pagination = json.meta.pagination;
      });
    },

    loadMore: async function () {
      await this.load(this.pagination.current_page + 1);
    },
  }
})