<template>
	<div class="plain-bg py-5 min-vh-100">
		<AlertModal v-if="alertModal.showModal" @response="resolveModalCallback" :message="alertModal.message" :messageDesc="alertModal.messageDesc"/>
		<div class="container">
			<div class="row">
				<div class="col-12 mb-5">
					<h4 class="text-left">MANTER OPERADORA</h4>
					<div class="border-bottom border-dark">

					</div>
				</div>
			</div>
			<div class="mt-3 p-5 bg-white rounded sub_container-border">

				<div class="row">
					<div class="col-12 mb-4 mb-md-0 col-md-3">
						<div class="position-relative">
							<label class="select-label" for="">LISTAR OPERADORA</label>
							<b-form-select @change="setOperatorFilter" class="border-dark" v-model="operatorTypesSelect.selected" :options="operatorTypesSelect.options" :value-field="operatorTypesSelect.valueField" :text-field="operatorTypesSelect.textField" :disabled="operatorsTable.isEditing">
							</b-form-select>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="position-relative">
							<label class="select-label" for="">STATUS</label>
							<b-form-select @change="setStatusFilter" class="border-dark" v-model="statusSelect.selected" :options="statusSelect.options" :value-field="statusSelect.valueField" :text-field="statusSelect.textField" :disabled="operatorsTable.isEditing"></b-form-select>
						</div>
					</div>
				</div>

				<div class="row my-4">
					<div class="col-12">
						<button @click="addNewItem()" class="btn add_btn float-left rounded-pill py-2 px-4 text-dark" type="button" name="button">
							<b-icon icon="plus" aria-hidden="true"></b-icon> NOVO
						</button>
					</div>
				</div>

				<div v-if="statusSelect.selected !== 0" class="row my-4">
					<div class="row no-gutters col-12">
						<div class="mr-3 py-2 mb-2 mb-md-0 ">
							<b-form-checkbox @change="setTableAllCheckboxes" class="" size="lg"><span class="font-default ml-2">Marcar todos</span></b-form-checkbox>
						</div>
						<div class="mr-3 mb-2 mb-md-0 ">
							<button @click="confirmAndCallbackFunction(deleteSelected)" class="font-default btn add_btn float-left rounded px-3 border text-dark h-100" type="button" name="button">
								<img  class="mr-3 my-1" src="@/assets/lixeira.png" alt="">
								EXCLUIR
							</button>
						</div>
						<div class="">
							<button @click="confirmAndCallbackFunction(disableSelected)" class="font-default btn add_btn float-left rounded px-3 border text-dark h-100" type="button" name="button">
								<img  class="mr-3 py-1" src="@/assets/switchLogo.png" alt="">
								HABILITAR E DESABILITAR
							</button>
						</div>
					</div>
				</div>

				<div class="row my-4">
					<div class="col-12">
						<b-table id="opTable" ref="opTable" striped hover class="custom-table" responsive :items="operatorsTable.items" :fields="operatorsTable.fields" borderless :filter="operatorsTable.filter" :filter-function="filterTable">

							<template class="actions" v-if="statusSelect.selected !== 0" v-slot:cell(actions)="row">

								<div v-if="operatorsTable.currentEdit !== row.index" class="row no-gutters actions_container">
									<b-form-checkbox @change="setTableCheckboxes(row.item, $event)" :checked="row.item.checked" class="opCheckbox" size="lg"></b-form-checkbox>
									<button @click="setEditOn(row.index)" class="bg-transparent border-0" type="button" name="button"><img class="ml-2 pencil_icon" src="@/assets/pencil_1.png" alt=""></button>
									<b-form-checkbox :checked="row.item.ativo" :value="1" :unchecked-value="0" switch class="switch_icon ml-2" size="lg" disabled></b-form-checkbox>
								</div>
								<div v-else class="row no-gutters actions_container">
									<div class="mx-auto">
										<button @click="commitOperator(row.item)" class="btn finish_editing_btn ok_btn border border-white text-white rounded-circle px-2" type="button" name="button">ok</button>
										<button @click="cancelEditOn()" class="btn finish_editing_btn cancel_btn border border-white text-white rounded-circle px-2 ml-2" type="button" name="button">X</button>
									</div>
								</div>
							</template>

							<template v-slot:cell(desc)="row">
								<b-form-input v-model="row.item.desc" :disabled="operatorsTable.currentEdit !== row.index" class="py-0 my-0 bg-transparent" :class="[operatorsTable.currentEdit !== row.index ? 'border-0 ' : '']" :value="row.item.desc"></b-form-input>
							</template>

							<template v-slot:cell(tipo_operadora.nome)="row">
								<div v-if="row.item.tipo_operadora">
									{{ row.item.tipo_operadora.nome }}
								</div>
								<div v-else>
									<b-form-select class="border-dark" v-model="selectNewObjType.selected" :options="selectNewObjType.options" :value-field="selectNewObjType.valueField" :text-field="selectNewObjType.textField"></b-form-select>
								</div>
							</template>

						</b-table>
					</div>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
import AlertModal from '@/components/AlertBox';
import { CheckboxesMixin } from '@/mixins/Checkboxes.js'

export default {
	name: 'Home',
	mixins: [
		CheckboxesMixin
	],
	data(){
		return{
			alertModal: {
				showModal: false,
				response: false,
				callbackFunction: null,
				message: "",
				messageDesc: ""
			},
			operatorTypesSelect: {
				selected: null,
				valueField: "id",
				textField: "nome",
				options: [
					{
						id: null,
						nome: "Todas"
					}
				],
			},
			statusSelect: {
				selected: null,
				valueField: "active",
				textField: "nome",
				options: [
					{
						active: null,
						nome: "Todos"
					},
					{
						active: 1,
						nome: "Ativos"
					},
					{
						active: 0,
						nome: "Inativos"
					},
				],
			},
			selectNewObjType:{
				selected: 1,
				valueField: "id",
				textField: "nome",
				options: [

				],
			},
			operatorsTable:{
				isEditing: false,
				currentEdit: null,
				filter: {
					operator: '',
					status: ''
				},
				fields: [
					{ key: 'actions', label: ''},
					{ key: 'tipo_operadora.nome', label: 'Operadora'},
					{ key: 'desc', label: 'Descrição'},
				],
				items: [

				]
			},
		}
	},
	components: {
		AlertModal
	},
	created(){
		this.$axios
		.get('/tipo_operadora')
		.then(response => {
			this.operatorTypesSelect.options.push(...response.data);
			this.selectNewObjType.options.push(...response.data);
		});

		this.setOperatorsList();
	},
	methods:{
		setEditOn(index){
			this.operatorsTable.currentEdit = index;
		},
		cancelEditOn(){
			this.operatorsTable.currentEdit = null;
			this.setOperatorsList();
		},
		commitOperator(object){
			if (object.id) {
				this.$axios
				.put('/operadora/' + object.id, {
					desc : object.desc
				})
				.then(response => {
					this.setOperatorsList();
				});
			}else{
				this.$axios
				.post('/operadora', {
					desc : object.desc,
					tipo_operadoras_id: this.selectNewObjType.selected,
				})
				.then(response => {
					this.setOperatorsList();
				});
			}

			this.operatorsTable.currentEdit = null;
			this.setOperatorsList();
		},
		setOperatorsList(){
			this.$axios
			.get('/operadora')
			.then(response => {
				response.data.forEach((item, i) => {
					response.data[i].checked = false;
				});

				this.operatorsTable.items = response.data;
				this.$refs.opTable.refresh()
				this.operatorsTable.isEditing = false;
			});
		},
		setTableAllCheckboxes(value){
			if (value) {
				this.operatorsTable.items.forEach((item, i) => {
					if(item.id){
						this.operatorsTable.items[i].checked = true;
						this.CheckBoxesMixin.checked[item.id] = item;
					}
				});
			}else{
				this.operatorsTable.items.forEach((item, i) => {
					if(item.id){
						this.operatorsTable.items[i].checked = false;
						delete this.CheckBoxesMixin.checked[item.id];
					}
				});
			}
		},
		setTableCheckboxes(obj, value){
			if (value) {
				this.CheckBoxesMixin.checked[obj.id] = obj;
			}else{
				delete this.CheckBoxesMixin.checked[obj.id];
			}
		},
		setOperatorFilter(id){
			if(id == null){
				this.operatorsTable.filter.operator = '';
				return;
			}

			for(let index in this.operatorTypesSelect.options){
				let current = this.operatorTypesSelect.options[index];
				if(current.id === id){
					this.operatorsTable.filter.operator = current.nome;
					return;
				}
			}

			this.operatorsTable.operator = '';
		},
		setStatusFilter(value){
			if (value === 1) {
				this.operatorsTable.filter.status = 1;
			}else if(value === 0){
				this.operatorsTable.filter.status = 0;
			}else{
				this.operatorsTable.filter.status = '';
			}
		},
		addNewItem(){
			this.resetFilters();
			if (this.operatorsTable.items.length) {
				if(this.operatorsTable.items[0].id){
					this.operatorsTable.isEditing = true;
					this.operatorsTable.items.unshift({ativo:1, desc:""});
					this.$refs.opTable.refresh();
					this.operatorsTable.currentEdit = 0;
				}
			}else{
				this.operatorsTable.isEditing = true;
				this.operatorsTable.items.unshift({ativo:1, desc:""});
				this.$refs.opTable.refresh();
				this.operatorsTable.currentEdit = 0;
			}
		},
		filterTable(row, filter){
			let operatorFilterIsTrue = false;
			let statusFilterIsTrue = false;

			if (this.operatorsTable.isEditing == true) {
				return true;
			}

			if(row.tipo_operadora.nome == filter.operator || !filter.operator){
				operatorFilterIsTrue = true;
			}

			if((row.ativo == filter.status) || filter.status === ''){
				statusFilterIsTrue = true;
			}

			if(operatorFilterIsTrue && statusFilterIsTrue){
				return true;
			}

			return false;
		},
		resetFilters(){
			this.operatorsTable.filter.status = '';
			this.operatorsTable.filter.operator = '';
		},
		deleteSelected(){
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
		disableSelected(){
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
		confirmAndCallbackFunction(callbackFunc){
			if(Object.keys(this.CheckBoxesMixin.checked).length !== 0){
				this.alertModal.callbackFunction = callbackFunc;
				this.alertModal.message = "Tem certeza que deseja desativar esse item?";
				this.alertModal.messageDesc = "Ao desativar este item você só poderá consulta-lo, mas não poderá mais reativar-lo.";

				this.alertModal.showModal = true;
			}
		},
		resolveModalCallback(value){
			this.alertModal.showModal = false;
			this.alertModal.response = value;
			if(this.alertModal.response){
				this.alertModal.callbackFunction();
			}
		},
	}
}
</script>

<style scoped media="screen">
.select-label{
	position: absolute;
	left: 10px;
	top: -10px;
	background-color: white;
	padding: 0 8px;
	font-size: 12px;
	font-weight: 700;
}

.plain-bg{
	background-color: #E5E5E5;
}

.sub_container-border{
	border: solid #8A8A8A 1px;
}

.add_btn{
	background-color: #ebe6e6;
	border: solid #fff 2px;

	-webkit-box-shadow: 0px 0px 5px 0px rgba(158,158,158,1);
	-moz-box-shadow: 0px 0px 5px 0px rgba(158,158,158,1);
	box-shadow: 0px 0px 5px 0px rgba(158,158,158,1);
}

.font-default{
	font-size: 15px;
	line-height: 15px;
}

.vertical-align-center{
	position: absolute;
	top: 50%;
	left: 50%;
}

.container-border{
	border: solid black 1px;
}

.pencil_icon{
	margin-top: 6px;
}

.switch_icon{
	margin-top: 6px;
}

.finish_editing_btn{
	width: 34px;
	height: 34px;
	line-height: 17px;
}

.finish_editing_btn.ok_btn{
	background-color: #20E47B;
}

.finish_editing_btn.cancel_btn{
	background-color: #F45959;
}
</style>

<style media="screen">
td{
	vertical-align: middle !important;
	text-align: left;
	border-left: solid white 1px !important;
}

td[aria-colindex="1"]{
	width: 1px;
}

th div{
	vertical-align: middle;
	text-align: left;
}

.actions_container{
	width:135px;
}

.custom-checkbox.b-custom-control-lg .custom-control-label::before, .input-group-lg .custom-checkbox .custom-control-label::before{
	width: 1.75rem !important;
	height: 1.75rem !important;
}

.custom-checkbox.b-custom-control-lg .custom-control-label::after, .input-group-lg .custom-checkbox .custom-control-label::after{
	top: 0.0125rem !important;
	left: -2.175rem !important;
	width: 2.45rem !important;
	height: 2.45rem !important;
}

.custom-control-input {
	position: absolute;
	left: 0;
	z-index: -1;
	width: 1.75rem;
	height: 1.75rem;
	opacity: 0;
}

.custom-checkbox.b-custom-control-lg, .input-group-lg .custom-checkbox {
	font-size: 1.25rem;
	line-height: 1.7;
	padding-left: 1.875rem;
}
</style>
