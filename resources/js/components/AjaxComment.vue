<template>
    <div>
       <button id="subButton" class="btn btn-primary ml-4" 
        style="background-color:black; border-color:black"
        @click="subscribeUser"
         v-text="buttonText"></button> 
    </div>
</template>

<script>
    export default {
        props: ['user','subs'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return{
                status: this.subs,
            }
        },

        methods:{ 
            subscribeUser() {
               axios.post('/subscribe/' + this.user)
                    .then(response => {
                        this.status = ! this.status;
                        console.log(response.data);
                }) 
            }          
        },
        computed:{
            buttonText(){
                return (this.status) ? 'SUBSCRIBED' : 'SUBSCRIBE';
            }
        }
        
    }
</script>
