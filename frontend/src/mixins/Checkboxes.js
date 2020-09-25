export const CheckboxesMixin = {
	data(){
		return{
			CheckBoxesMixin: {
				checked: {}
			}
		}
	},
	methods: {
		CheckboxesMixin_DeleteSelected(){
			let selectedIdArr = [];

			for(let index in this.CheckBoxesMixin.checked){
				let currentObj = this.CheckBoxesMixin.checked[index];

				if(currentObj.id){
					selectedIdArr.push(currentObj.id);
				}
			}

			this.$axios
			({
				method: 'delete',
				url: '/operadora/delete',
				data: {
					ids: selectedIdArr
				}
			})
			.then(response => {
				this.setOperatorsList();
			});
		},
		CheckboxesMixin_DisableSelected(){
			let selectedIdArr = [];

			for(let index in this.CheckBoxesMixin.checked){
				let currentObj = this.CheckBoxesMixin.checked[index];

				if(currentObj.id){
					selectedIdArr.push(currentObj.id);
				}
			}

			this.$axios
			.put('/operadora/deactivate', {
				ids: selectedIdArr
			})
			.then(response => {
				this.setOperatorsList();
			});

		},
	}
}
