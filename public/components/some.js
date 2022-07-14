
	
	import * as {Editor} from './tinymce-vue.js'
    export default{
        template: `
        <div> 
            <form @submit.prevent="sendFormData()">
            <tinymce-editor
  api-key="hfcfgp0vufrmoiwj7oo4j5nrk8jw0e9wqkmj0qwl0dro5hfy"
></tinymce-editor>
            <div class="checkboxes">
                <div class="checkboxes-checkbox">
                    <p> Показывать</p>
                    <input  type="checkbox" name="is_constructor"   v-model="show">
                </div>
                <div class="checkboxes-checkbox">
                    <p> На главной </p>
                    <input type="checkbox" v-model="isMain">
                </div>
            </div> 
                <p> Картинка на главной </p>
                <input type="file" @change="uploadMin" required ref="mainTitle">
                
                <p> Название </p>
                <editor type="text" id="mytextarea" v-model="title"/>    
=
                <div class="multiple__item" v-for="(item, index) in items" :key="index">
                    <p>Фотография</p>
                    <input type="file"  required  :ref="'uploadFile' + index" >
                    <p>текст</p>
                    <input type="text"  required id="mytextarea" v-model="item.text">
                </div>
                <p></p>
                <button @click.prevent="items.push({file:null,text:'',})">Добавить новые поля</button>
                <input type="submit" value="Сохранить" style="margin-top: 50px"> 
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
                    switch (element) {
                        case 'mainTitle':
                            file = this.$refs.mainTitle.files[0]
                            reader.onload = (e) => {
                                this.mainImage =  reader.result
                                if(this.itemImages.length === Object.keys(this.$refs).length){
                                    this.mainMethod();
                                }
                            }
                            reader.readAsDataURL(file);
                            break;
                    
                        default:
                            console.log(this.$refs[element][0].files[0])
                            file = itemss[index]
                            reader.onload = (e) => {
                                this.itemImages.push(reader.result)
                                if(this.itemImages.length === Object.keys(this.$refs).length-1){
                                    this.mainMethod();
                                }
                            }
                            reader.readAsDataURL(file);
                            break;
                    }
                });
            },
            mainMethod(){
                this.items.forEach((element, index) => {
                	element.file = this.itemImages[index]
                    this.wholeArray.push({
                        title: this.title,
                        show: this.show,
                        is_main: this.isMain,
                        preview_image: this.mainImage,
                        text: element.text,
                        image: element.file,
                    })
                });
                let url = window.location.pathname.split("/").pop()
                if(url === 'create'){
                axios.post('https://api.obagofficial.kz/api/sales-create', {
                    sales: this.wholeArray,
                    products: [
                        {
                            id: 1
                        },
                        {
                            id: 22
                        }
                    ]
                }).then(res=>{
                    window.location.href="/admin/sales"
                })
                }
                else{
                let fulladress = window.location.pathname.split("/")
                fulladress.pop()
                let urlId = fulladress.pop()
                let sendUrl = 'https://api.obagofficial.kz/api/sales-change/' + urlId
                 axios.put(sendUrl, {
                 	sales: this.wholeArray,
                 	products: [
                 	{
                 	    id: 1
                 	},
                 	{
                 	    id: 22
                 	},
                 	],
                 	id: Number(urlId)
                 }).then(res=>{
                    window.location.href="/admin/sales"
                })
		}
                this.wholeArray = []
            
            },
        },
        data(){
            return{
                wholeArray: [],
                title: '',
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
