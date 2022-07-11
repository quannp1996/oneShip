<template>
<div>
	<div class="admin-form-item-label">
		<label :for="name" class="admin-form-item-required" :title="name" v-text="lable"></label>
	</div>
	<div class="admin-form-item-control">
		<div class="dropdown dropdown-custom">
			<button class="dropdown-toggle unvalid" type="button" :id="bindDropdown"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<div class="dropdown-custom-input" v-text='selectedText'></div>
			</button>
			<div class="dropdown-menu" aria-disabled="true" :aria-labelledby="bindDropdown">
				<a class="dropdown-item" href="javascript:;" @click="switchOption(province)" v-for="province in provinces" v-text="province.name"></a>
			</div>
		</div>
	</div>
</div>
</template>
<script>
  module.exports = {
    props: ['lable', 'change', 'name', 'object', 'selected'],
    data() {
		return {
			selectedText: '',
			bindDropdown: Math.random(),
			provinces: window.provinces,
		}
	},
	watch: {
		selected: function(){
			var selectedProvince = this.provinces.filter(item => {
				return item.code == this.selected;
			})
			if (selectedProvince && selectedProvince.length) {
				this.selectedText = selectedProvince[0].name;
			}
		}
	},
	
	mounted() {
		if(typeof this.selected){
			var selectedProvince = this.provinces.filter(item => {
				return item.code == this.selected;
			})
		}
	},
    methods: {
		switchOption: function(province){
			this.selectedText = province.name;
			this.object.province_id = province.code;
			if(typeof this.change != 'undefined') this.change.call(this, province, this.object);
		}
	},
  };
</script>