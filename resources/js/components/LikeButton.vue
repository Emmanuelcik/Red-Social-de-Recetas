<template>
<div>
    <span 
    class="like-btn" 
    @click="likeReceta" :class="{'like-active' : isActivo}"
    ></span>
    <p> {{cantidadLikes}} me gusta </p>
</div>
</template>
<script>
export default {
    props: ["recetaId", "like", "likes"],
    data : function() {
        return {
            isActivo: this.like,
            totalLikes: this.likes
        }
    },
    // mounted() {
    //     console.log(this.like);
    // },
    methods: {
        likeReceta(){
            axios.post("/recetas/" + this.recetaId)
            .then(respuesta => {
                // console.log(respuesta);
                if( respuesta.data.attached.length > 0 ){
                    
                    this.$data.totalLikes++;
                }else if (respuesta.data.detached.length > 0){
                    this.$data.totalLikes--;
                }
                this.isActivo = !isActivo;
            })
            .catch(error => {
                if(error.response.status === 401) {
                    window.location = "/register";
                }
            })
        }
    },
    computed: {
        cantidadLikes: function () {
            return this.totalLikes
        }
    }
}
</script>
