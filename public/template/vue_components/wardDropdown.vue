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
				<a class="dropdown-item" href="javascript:;" @click="switchOption(ward)" v-for="ward in lists" v-text="ward.name"></a>
			</div>
		</div>
	</div>
</div>
</template>
<script>
  module.exports = {
    props: ['district_code', 'lable', 'change', 'name', 'object', 'selected'],
    data() {
		return {
			lists: [],
			selectedText: '',
			bindDropdown: Math.random()
		}
	},
	watch: {
		
		district_code: function(){
			this.lists = window.wards.filter(item => {
				return item.district_id == this.district_code;
			})
		},

		selected: function(){
			var selectedWard = window.wards.filter(item => {
				return item.code == this.selected;
			})
			if (selectedWard && selectedWard.length) {
				this.selectedText = selectedWard[0].name;
			}
		}
	},
    methods: {
		switchOption: function(ward){
			this.selectedText = ward.name;
			this.object.ward_id = ward.code;
			if(typeof this.change != 'undefined') this.change.call(this, ward, this.object);
		}
	},
  };
</script>