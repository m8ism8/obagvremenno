

    export default{
        template: `
        <div> 
            <form @submit.prevent="sendFormData()">
            <div class="checkboxes">
                <div class="checkboxes-checkbox">
                    <p> Показывать</p>
                    <input  type="checkbox" name="is_constructor"  v-model="show">
                </div>
            </div> 
                
                <p> Название </p>
                <input type="text" v-model="title">

                <p> Второй текст </p> 
                <input type="text" v-model="subtitle">

                <div class="multiple__item" v-for="(item, index) in items" :key="index">
                    <p>Фотография</p>
                    <input type="file"  :ref="'uploadFile' + index" >
                    <p>текст</p>
                    <input type="text" v-model="item.text">
                </div>
                <p></p>
                <button @click.prevent="items.push({file:null,text:'',})">Добавить новые поля</button>
                <input type="submit" value="dsajkdjaslfjas" style="margin-top: 50px"> 
            </form>
        </div>
        `,
        methods:{
            uploadMin(event){
                var file = this.$refs.mainTitle.files[0]
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.mainImage =  reader.result
                }
                reader.readAsDataURL(file);
                
            },
            sendFormData(){
                console.log(this.$refs);
                var itemss = []
                Object.values(this.$refs).forEach((element,index)=>{
                console.log(element)
                	if(element.length === 1){
                        itemss.push(element[0].files[0])
                    }
                    else{
                        itemss.push(element.files[0])
                    }
                })

                            console.log(Object.keys(this.$refs).length)
                Object.keys(this.$refs).forEach((element,index) => {
                    var reader = new FileReader();
                    let file = null
                    
                            console.log(this.$refs[element][0].files[0])
                            file = itemss[index]
                            reader.onload = (e) => {
                                this.itemImages.push(reader.result)
                            }
                            reader.readAsDataURL(file);
                    
                });
                this.items.forEach((element, index) => {
                	element.file = this.itemImages[index]
                    this.wholeArray.push({
                        title: this.title,
                        show: this.show,
                        isMain: this.isMain,
                        preview_image: this.mainImage,
                        text: element.text,
                        image: element.file,
                    })
                });
                
                axios.post('https://api.obagofficial.kz/api/sales-create', {
                    image: this.wholeArray
                })
                this.wholeArray = []
            },
        },
        data(){
            return{
                wholeArray: [],
                title: '',
                subtitle: '',
                isMain: false,
                itemImages: [],
                mainImage: null,
                show: false,
                items: [{
                    file: null,
                    text: '',
                }]
            }
        }
    }
