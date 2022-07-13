@extends('voyager::master')
@section('content')
    <div id="app">

        <div class="container">
            <h1 v-if="!isUpdate" class="main_title"> Создание теста</h1>
            <h1 v-else class="main_title"> Обновление теста</h1>
            <some class="create-form" />

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
    <script type="module">
	import some from '/components/news.js'
        var app = new Vue({
            el: '#app',
            components: {
                some
            },
            data() {
                return {
                    isUpdate: false,
                }
            },
            created() {
                const path = window.location.pathname.split("/").pop()
                if(path === "edit"){
                    this.isUpdate = true;
                }
            },

        })

    </script>
@endsection

<style>
    .create-form p {
        margin: 0
    }
    .main_title {
        margin: 30px;
    }
    .checkboxes{
        display: flex;
        justify-content: space-around;
    }
    .checkboxes-checkbox{
        text-align: center
    }
    .checkboxes-checkbox p {
        margin: 0
    }
    .checkboxes-checkbox input{
        width: 40px;
        height: 30px;
    }
    .create-form{
        display: flex;
        justify-content: center;
        text-align: left
    }
    .create-form form input{
    
        width: 100%;
    }
    .create-form form button{
    	margin-top: 20px;
    	width: 100%;
    }

    .btn-add-question {
        position: fixed;
        top: 58%;
        right: 2%;
        border-radius: 100%;
        z-index: 999;
    }

    .create-form .input-group {
        /* display: flex; */
    }

    .delete-start {
        transform: translateX(-1000px) transition:2s
    }

</style>

