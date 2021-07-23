
<template>
    <input type="submit" href="#" class="btn btn-danger d-block w-100 mb-2" value="Eliminar" 
    v-on:click="eliminarReceta">

</template>

<script>
    export default {
        props: ["recetaId"],
        mounted() {
            console.log("Receta Actual", this.recetaId);
        },
        methods: {
            eliminarReceta(){
                this.$swal({
                    title: 'Deseas eliminar esta receta?',
                    text: "Una vez eliminada no se puede recuperar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                    cancelButtonText: "No"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const params = {
                                id: this.recetaId
                            }
                            //Enviar la peticion al servidor
                            axios.post(`/recetas/${this.recetaId}`, {params, _method: "delete"})
                                .then(respuesta => {
                                    this.$swal({
                                    title: "Receta a Eliminada",
                                    text: "Se eliminó la receta",
                                    icon: "success"
                                    })

                                    //Eliminar receta del DOM
                                    this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode)
                                })
                                .catch(error => {
                                    console.log(error);
                                })
                            
                        }
                    })
            }
        },
    }
</script>