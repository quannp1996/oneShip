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
				<a class="dropdown-item" href="javascript:;" @click="switchOption(district)" v-for="district in lists" v-text="district.name"></a>
			</div>
		</div>
	</div>
</div>
</template>
<script>
  module.exports = {
    props: ['city_code', 'lable', 'change', 'name', 'object', 'selected'],
    data() {
		return {
			lists: [],
			selectedText: '',
			bindDropdown: Math.random(),
		}
	},
	watch: {
		city_code: function(){
			this.lists = window.districts.filter(item => {
				return item.province_id == this.city_code;
			})
		},

		selected: function(){
			var selectedDistrict = window.districts.filter(item => {
				return item.code == this.selected;
			})
			if (selectedDistrict && selectedDistrict.length) {
				this.selectedText = selectedDistrict[0].name;
			}
		}
	},

    methods: {
		switchOption: function(district){
			this.selectedText = district.name;
			this.object.district_id = district.code;
			if(typeof this.change != 'undefined') this.change.call(this, district, this.object);
		}
	},
  };
</script>