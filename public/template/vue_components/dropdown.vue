<template>
<div>
	<div class="admin-form-item-label">
		<label :for="name" class="admin-form-item-required" :title="name" v-text="lable"></label>
	</div>
	<div class="admin-form-item-control">
		<div class="dropdown dropdown-custom">
			<button class=" dropdown-toggle" type="button" :id="bindDropdown"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<div class="dropdown-custom-input" v-text='selectedText'></div>
			</button>
			<div class="dropdown-menu" aria-disabled="true" :aria-labelledby="bindDropdown">
				<a class="dropdown-item" href="javascript:;" @click="switchOption(province)" v-for="province in lists" v-text="province.name"></a>
			</div>
		</div>
	</div>
</div>
</template>
<script>
  module.exports = {
    props: ['lists', 'lable', 'change', 'name', 'object', 'first_text'],
    data() {
		return {
			selectedText: this.first_text,
			bindDropdown: Math.random()
		}
	},
    methods: {
		switchOption: function(province){
			this.selectedText = province.name
			if(typeof this.change != 'undefined') this.change.call(this, province, this.object);
		}
	},
  };
</script>