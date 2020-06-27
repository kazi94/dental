<template>
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Prescriptions</h5>
            <div class="table-responsive" v-show="showprescriptions">
                <table class="mb-0 table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-primary float-right mt-1" v-show="showprescriptions">AJOUTER</button>
        </div>
    </div>
</template>

<script>
	export default {
		props : [
			'patient',
			'showprescriptions'
		],
		data() {
			return {};
		},
		methods : {

		},
		mounted() {
			console.log("Prescriptions Component mounted")
		},
	}
</script>