<template lang="html">
	<transition name="modal">
		<div class="modal-mask">
			<div class="modal-wrapper container-fluid">
				<div class="modal-container col-12 col-md-6 col-lg-5">

					<div class="modal-header border-0 py-0">
						<slot name="header">
							<div class="ml-auto">
								<button class="modal-default-button bg-transparent border-0" @click="$emit('response', false)">
									<h4>X</h4>
								</button>
							</div>
						</slot>
					</div>

					<div class="modal-body">
						<slot name="body">
							<h5 class="font-weight-bold mb-5">{{ message }}</h5>
							<p>{{ messageDesc }}</p>
						</slot>
					</div>

					<div class="modal-footer border-0">
						<slot name="footer">
							<div class="mx-auto">
								<button class="btn btn-custom rounded-pill mr-2" @click="$emit('response', false)">
									NÃO
								</button>
								<button class="btn btn-custom accept rounded-pill ml-2" @click="$emit('response', true)">
									SIM
								</button>
							</div>
						</slot>
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
export default {
	data(){
		return{
			
		}
	},
	props:{
		message: {
			type: String,
			required: true
		},
		messageDesc: {
			type: String,
			required: true
		},
	}
}
</script>

<style lang="css" scoped>
h5{
	font-weight: 700;
}

.btn-custom{
	background-color: #EEEEEE;
	padding: 10px 80px;
	border: solid white 1px;
	-webkit-box-shadow: 0px 5px 7px 0px rgba(0,0,0,0.34);
	-moz-box-shadow: 0px 5px 7px 0px rgba(0,0,0,0.34);
	box-shadow: 0px 5px 7px 0px rgba(0,0,0,0.34);
}

.btn-custom.accept{
	background-color: #F39C12;
	color: white;
}

.modal-mask {
	position: fixed;
	z-index: 9998;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0, 0, 0, 0.5);
	display: table;
	transition: opacity 0.3s ease;
}

.modal-wrapper {
	display: table-cell;
	vertical-align: middle;
}

.modal-container {
	margin: 0px auto;
	padding: 20px 30px;
	color: #F39C12;
	background-color: #FFF9C3;
	border-radius: 10px;
	border: solid #F39C12 1px;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
	transition: all 0.3s ease;
	font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
	margin-top: 0;
	color: #42b983;
}

.modal-body {
	margin: 0px 0;
}

.modal-default-button {
	float: right;
}

/*
* The following styles are auto-applied to elements with
* transition="modal" when their visibility is toggled
* by Vue.js.
*
* You can easily play with the modal transition by editing
* these styles.
*/

.modal-enter {
	opacity: 0;
}

.modal-leave-active {
	opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
	-webkit-transform: scale(1.1);
	transform: scale(1.1);
}

</style>
