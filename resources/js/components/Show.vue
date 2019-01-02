<template>
    <div class="container" ref="container">
        with reference
        <div class="row" ref="main_content"></div>

        with v-html
        <div class="row" v-for="(theme,index) in themes" v-html="themes[index].html_data"  ref="tanvir" :style="themes[index].action_data.css">
            
        </div> 
    </div>
    
</template>
<script>

export default {
        name: 'app',

        components: {
         
        },

        watch: {


        },

        data() {
            return {

                content_types:[],
                content_types_data:[],
                news     : "",
                blog     : "",
                themes   : "",
                
            }
        },


         created() {
             this.apiTheme();
          },
    
        mounted(){
             

        },
        beforeUpdate(){
           this.apiData(); 
            for (var index in this.themes) {
             this.$refs.main_content.innerHTML = this.themes[index].html_data;
             this.$refs.main_content.style = this.themes[index].action_data.css;
            }
            // this.$refs.main_content.innerHTML = this.themes[0].html_data;
            // this.$refs.main_content.style = this.themes[0].action_data.css;
            
        },

        methods: {
                 apiData(){

                    var length = this.content_types.length;

                    for (var i = 0; i< length ; i++){
                        var content_type = this.content_types[i];
                        var endpoint     = 'https://private-586dc-nptestcontenttype.apiary-mock.com/content_type/';
                        var limit        = 10;
                        var required     = "required";
                        console.log(content_type)
                         this.$http.get(endpoint+content_type+'/'+limit+'/'+required)
                               .then((response) =>  {
                                        this.content_types_data.push(response.data[0]); 
                                           return "success";

                                  })
                                 .catch(error => {
                                      console.log(error)
                                     });
                        console.log(this.content_types_data)
                   
                    }
                 },

                 apiTheme(){
                    this.$http.get('https://private-35f054-nptesttheme.apiary-mock.com/themes')
                   .then((response) =>  {

                            this.themes = response.data; 
                              for (var index in this.themes) {
                                 this.content_types.push(this.themes[index].action_data.content_type) ;
                               }
                            console.log(this.themes);
                            return "success";

                      })
                     .catch(error => {
                          console.log(error)
                         });
                 }
        }
    }
</script>

<style scoped>

</style>