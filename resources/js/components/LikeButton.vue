<template>
<div>
    <span 
    class="like-btn" 
    @click="likeReceta" :class="{'like-active' : this.like}"
    ></span>
    <p> {{cantidadLikes}} me gusta </p>
</div>
</template>
<script>
export default {
    props: ["recetaId", "like", "likes"],
    data : function() {
        return {
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
                console.log(respuesta);
            })
            .catch(error => {
                console.log(error);
            })
        }
    },
    computed: {
        cantidadLikes: function () {
            return this.likes
        }
    }
}
</script>
