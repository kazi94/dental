<template>
    <div class="demo-gallery" >
        <ul id="lightgallery" class="list-unstyled row" style="overflow-y: scroll; height: 200px">
            <li class="col-xs-6 col-sm-4 col-md-3" v-for="(radio,index) in patient.radios" style="padding-left: 0px; padding-right: 0px;" :data-src="radio.img_url" data-sub-html="text here">
                <a href="">
<<<<<<< HEAD
                    <img class="img-responsive" :src="radio.img_url" :alt="radio.id">
=======
                    <img class="img-responsive" :src="radio.img_url" :alt="radio.id" />
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
                </a>
            </li>
        </ul>
    </div>
</template>

<script>

	export default {
		props : [
			'patient',
		],
<<<<<<< HEAD
		data() 
		{
=======
		data() {
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
			return {

            };
		},
<<<<<<< HEAD
		methods : 
		{
=======
		methods : {
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
		},

		mounted() {
			console.log("Gallery Component mounted")
            lightGallery(document.getElementById('lightgallery'), {
                thumbnail:true
            });             
		},
	}
</script>