<template>
    <div class='cc zero' style="height:100vh;">
        <div class="">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="#">Features</a>
                <a class="nav-item nav-link" href="#">Pricing</a>
                <a class="nav-item nav-link disabled" href="#">Disabled</a>
                </div>
            </div>
            </nav>
        </div>

        <div class='row margin-top-30'>
            <div class="col-12 text-center">
                <button type="button" class="btn btn-primary">Void Fissures</button>
            </div>
        </div>
        <div class='row justify-content-center margin-top-30'>
            <div class="col-lg-8 col-10">
                <input class="form-control" type="text" placeholder="Search for relics or items drops" v-model="info.campo1">
            </div>
        </div>
        <div class='row justify-content-center margin-top-15'>
            <div class="col-lg-8 col-10 text-center">
                <button type="button" @click="get_relics" class="btn btn-info">Lith</button>
                <button type="button" class="btn btn-info">Meso</button>
                <button type="button" class="btn btn-info">Neo</button>
                <button type="button" class="btn btn-info">Axi</button>
                <button type="button" class="btn btn-info">Lith</button>
                <button type="button" class="btn btn-info">H/V</button>
                <button type="button" class="btn btn-warning">Best Relics</button>
            </div>
        </div>
        <div class='row justify-content-center margin-top-15' v-if="info.relics !== null && info.items !== null && relic_search(rc.relic_name)" v-for="rc in info.relics" v-bind:key="rc.relic">
            <div class="col-md-10 col-12 border margin-top-15 p-0" style="height:210px;background-color:#ddd;">
                <div class="row h-100">
                    <div class="col-md-4 col-auto reliquia-tabela p-2">
                        <span class="badge badge-info" @click="get_relic_link(rc.relic_name)">{{rc.relic_name}}</span><br>
                        <label>Price:<span class="badge items-price">{{rc.price}}</span></label>
                    </div>
                    <div class="col-md-5 col p-2">
                        <ul class="items-ul">
                            <li @click="get_item_link(rc.COMMON1)">{{info.items[rc.COMMON1].item_name}}<span class='items-price'>{{info.items[rc.COMMON1].price}}</span></li>
                            <li @click="get_item_link(rc.COMMON2)">{{info.items[rc.COMMON2].item_name}}<span class='items-price'>{{info.items[rc.COMMON2].price}}</span></li>
                            <li @click="get_item_link(rc.COMMON3)">{{info.items[rc.COMMON3].item_name}}<span class='items-price'>{{info.items[rc.COMMON3].price}}</span></li>
                            <li @click="get_item_link(rc.UNCOMMON1)">{{info.items[rc.UNCOMMON1].item_name}}<span class='items-price'>{{info.items[rc.UNCOMMON1].price}}</span></li>
                            <li @click="get_item_link(rc.UNCOMMON2)">{{info.items[rc.UNCOMMON2].item_name}}<span class='items-price'>{{info.items[rc.UNCOMMON2].price}}</span></li>
                            <li @click="get_item_link(rc.RARE)">{{info.items[rc.RARE].item_name}}<span class='items-price'>{{info.items[rc.RARE].price}}</span></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-auto d-flex align-items-start pr-3" style="justify-content: space-around;flex-direction:column;padding:30px 10px;">
                        <span><span :class="get_badge_class(rc.intact)"> &nbsp;</span>INTACT: <b>{{rc.intact}}</b></span>
                        <span><span :class="get_badge_class(rc.exceptional)"> &nbsp;</span>EXCEPTIONAL: <b>{{rc.exceptional}}</b></span>
                        <span><span :class="get_badge_class(rc.flawless)"> &nbsp;</span>FLAWLESS: <b>{{rc.flawless}}</b></span>
                        <span><span :class="get_badge_class(rc.radiant)"> &nbsp;</span>RADIANT: <b>{{rc.radiant}}</b></span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>

import $ from 'jquery';

export default {

    computed: {
        console: () => console,
        window: () => window,
    },

    methods:{

        relic_search(relic)
        {
            return relic.toUpperCase().includes(this.info.campo1.toUpperCase());
        },

        get_item_link(cod)
        {
            window.open('https://warframe.market/items/' + this.info.items[cod].item_name.toLowerCase().replace(/ /g, "_"), "_blank");
        },

        get_relic_link(cod)
        {
            window.open('https://warframe.market/items/' + cod.toLowerCase().replace(/ /g, "_") + "_relic", "_blank");
        },

        get_badge_class(v)
        {
            if(v < 20) return 'badge2 b-black';
            if(v < 30) return 'badge2 b-yellow';
            if(v < 40) return 'badge2 b-orange';
            return 'badge2 b-red';
        },

        load_page_info()
        {
            this.get_items();
        },

        get_relics(){
            return axios.post('api/get_all_relic_info', "")
                .then((res) => {
                    if(res.status === 200)
                    {
                        this.info.relics = res.data;
                        this.organize_relics();
                    }
                });
        },

        organize_relics()
        {
            this.info.relics.forEach((el,key) =>{
                this.info.relics[key].intact = el.intact.toFixed(2);
                this.info.relics[key].exceptional = el.exceptional.toFixed(2);
                this.info.relics[key].flawless = el.flawless.toFixed(2);
                this.info.relics[key].radiant = el.radiant.toFixed(2);
                this.info.relics[key].price = Math.round(el.price)
            });
            console.log("ao", this.info.relics);
        },

        get_items(){
            return axios.post('api/items', "")
                .then((res) => {
                    if(res.status === 200)
                    {
                        this.organize_items(res.data);
                    }
                });
        },

        organize_items(items)
        {
            console.log(items)
            items.forEach(el => {
                this.info.items[el.item_cod] = el;
                this.info.items[el.item_cod].price = Math.round(el.price)
            });
            this.get_relics();
        },
    },

   data(){
       return{
           fundo:{
               backgroundColor:"#16a085",
           },
           info:{
               relics: null,
               items: [],
               campo1: "",
           }
       }
       
   },



   created()
   {
       this.$root.$emit('body-background-color', "#f0f");
       this.load_page_info();
       $('body').css( "background-color", "#333" );
   }
}
</script>


<style>
    @media (min-width: 0px){
    body{font-size:0.7rem;}
    }
    @media (min-width: 760px){
    body{font-size:0.9rem;}
    }
    @media (min-width: 1200px){
    body{font-size:1rem;}
    }
    @media (min-width: 1600px){
    body{font-size:1.1rem;}
    }

    .row
    {
        margin: 0 !important;
    }
</style>

<style scoped>

    .items-price
    {
        color: #333 !important;
        margin-left: 6px;
    }

        .items-price::after
    {
        content: url('../../images/plat2.png');
        position: relative;
        top:3px;
        left: 2px;
    }

    .reliquia-tabela{
        display: flex;
        text-align:center;
        justify-content:center;
        align-items: center;
        flex-direction: column;
        font-size: 1.4em;
    }

    .badge2{
        font-size:10px;
        width:16px;
        height:8px;
        display: inline-block;
        margin-right: 5px;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    .b-red{box-shadow:0 1px 10px 2px #FF0000;background-color:#FF0000;}
    .b-yellow{box-shadow:0 1px 5px #d4cb2a;background-color:#d4cb2a;}
    .b-orange{box-shadow:0 1px 5px #ea741a;background-color:#ea741a;}
    .b-black{background-color:#222222;}

    .profit-ul
    {
        color:#af509a;
        text-align:left;
        padding: 0;
        margin: 0;
        font-family: "russo one";
    }

    .items-ul
    {
        list-style-type: none;
        color:#b78b00;
        text-align:left;
        font-size: 1em;
        padding: 0;
        margin: 0;
        font-family: "russo one";
        height: 100%;
        padding: 15px 0;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    .badge-info
    {
        padding: 10px 20px !important;
        font-size: 0.8em !important;
    }

    .items-ul > li
    {
        cursor: pointer;
    }

    .items-ul > li:hover
    {

        text-decoration: underline;
    }

    .items-ul > li:nth-child(-n+3)
    {
        color:#613508;
    }

        .items-ul > li:nth-child(4), li:nth-child(5)
    {
        color: #555;
    }

    .margin-top-15
    {
        margin-top: 15px !important;
    }

    .margin-top-30
    {
        margin-top: 30px !important;
    }

    .margin-top-45
    {
        margin-top: 45px !important;
    }

    .margin-bottom-30
    {
        margin-bottom: 30px !important;
    }

    .margin-bottom-45
    {
        margin-bottom: 45px !important;
    }

    
</style>
