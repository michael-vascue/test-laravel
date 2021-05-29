<template>
    <div class="flex-column">
        <!-- top navigation bar -->
        <div class="header" style="background-color: #264D59; padding: 0 25px">
            <nav class="navbar navbar-expand-md col-12">
                <h3 class="col-2 header-title m-0 p-0">Illus Dream</h3>
                <div class="col-10 collapse navbar-collapse m-0 p-0">
                    <div class="navbar-nav pt-1 w-100" style="height:55px; font-size:16px;">
                        <button class="btn1 nav-item nav-link d-flex flex-column"
                            @click="undo()" :disabled="!canUndo">
                            <i class="align-self-center fas fa-undo-alt fa-lg"></i>
                            <span>Undo</span>
                        </button>
                        <button class="btn1 nav-item nav-link d-flex flex-column"
                            @click="redo()" :disabled="!canRedo">
                            <i class="align-self-center fas fa-redo-alt fa-lg"></i>
                            <span>Redo</span>
                        </button>
                        <button class="btn1 nav-item nav-link d-flex flex-column"
                            @click="clear()">
                            <i class="align-self-center fas fa-eraser fa-lg"></i>
                            <span>Clear All</span>
                        </button>
                        <div class="nav-item nav-link d-flex flex-column">
                            <input v-model="board.name" class="title" type="text" placeholder="Untitled">
                        </div>
                        <div class="nav-item nav-link d-flex flex-column ml-auto pr-0">
                            <div class="btn-group">
                                <button 
                                    @click.prevent="save()"
                                    type="button" 
                                    class="btn1 btn text3 border-right-0 pt-1" 
                                    style="font-size:16px">Save
                                    <i class="far fa-save fa-lg pl-2" style="line-height: 1"></i>
                                </button>
                                <button type="button" class="btn1 btn dropdown-toggle dropdown-toggle-split text" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right p-0 text-center">
                                    <a class="dropdown-item text2" href="#">PNG <i class="fas fa-download fa-lg pl-2"></i></a>
                                    <a class="dropdown-item text2" href="#">SVG <i class="fas fa-download fa-lg pl-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
      
     <!-- side navigation bar -->
            <div class="container mx-0" style="width:100%; max-width: 100vw">
                <div class="row">
                    <div class="sidenav col-1 px-0">
                        <div class="flex-column menu" id="menu">
                            <button class="btn2" @click="backHome()" style="padding: 6px 19px"><i class="fas fa-home fa-2x"></i>Home</button>                           
                            <button class="btn2" v-for="drawer in drawers" :key="drawer.id" :class="{activeBtn:drawer.id == selected}" @click.prevent="activated(drawer.id)" >
                                <span v-html="drawer.icon"></span>{{drawer.text}}
                            </button>                          
                        </div>
                    </div>

                    
                    <div v-if="!active" class="sub-sidenav col-3" >
                        <div class="flex-column">
                             <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input v-model="search" type="text" class="form-control text" placeholder="Search...">
                            </div>
                            <v-swatches 
                                v-model="color"
                                popover-x="left"
                                show-fallback
                                fallback-input-type="color"
                                shapes="circles"
                                :swatch-style="{ padding: '1px 0'}"
                                :trigger-style="{ width: '30px', height: '30px' }"
                            ></v-swatches>
                            <div class="row p-3">
                                <div v-for="drawer in drawers" :key="drawer.id">
                                    <div v-if="drawer.id === selected">
                                        <div class="column" v-for="item in filterIllustrations" :key="item.id">
                                            <div class="card" style="width: 7rem;height: 7rem">
                                                <div class="card-body">
                                                    <span class="center"
                                                    :style="defaultColor" 
                                                    v-html="item.svg" 
                                                    draggable="true"
                                                    @dragstart="startDrag(item.id)"
                                                    ></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space col-8">
                        <div 
                            id="drop_zone" 
                            @dragover.prevent 
                            @dragleave.prevent 
                            @drop="onDrop" 
                            class="workspace"
                        >
                            <Moveable
                                class="moveable"
                                @drag="handleDrag"
                                @scale="handleScale"
                                @rotate="handleRotate"
                                @groupDrag="handleGroupDrag"
                                v-bind="moveable"
                                v-for="(wp, index) of board.workspace"
                                :key="index"
                            >
                            <span :style="defaultColor"  v-html="wp.svg"></span>
                            <!-- <span v-html="workspace"></span> -->
                                <!-- <img :src="wp.svg" /> -->
                            </Moveable>
                        
                        </div>
                    </div>
                </div>
            </div> 
    </div>
</template>

<script>
import Moveable from "vue-moveable";
import VSwatches from 'vue-swatches'
import 'vue-swatches/dist/vue-swatches.css'

export default {
    components: {
        Moveable,
        VSwatches
    },
    data() {
        const workspace = [];
        const history = Object.assign(workspace);
        const historyIndex = history.length - 1
        return{
            active: 'false', 
            color: '#47988F',
            history: history,
            historyIndex: historyIndex,
            isDragging: false,
            moveable: {
                dragArea: false,
                draggable: true,
                throttleDrag: 1,
                keepRatio: true,
                scalable: true,
                throttleScale: 0.01,
                rotatable: true,
                throttleRotate: 0.2,
                pinchable: true, // ["draggable", "resizable", "scalable", "rotatable"]
                origin: false,
            },
            search: '',
            selected: undefined,
            selectedItemId: -1,
            board: {
                workspace: workspace,
                name: '',
            },
            // workspace: workspace,          
            drawers: [
                {
                    id: 1,
                    text: "Character",
                    icon: '<i class="fas fa-users fa-2x"></i>',
                    items: [
                        {
                            id: 1,
                            name: 'stand',
                            svg: '<svg xmlns="http://www.w3.org/2000/svg" width="43.808" height="145.733" viewBox="0 0 43.808 145.733">' +
                                ' <g id="Group_9" data-name="Group 9" transform="translate(-1183.765 -369.402)">' +
                                        '<path id="Path_84" data-name="Path 84" d="M568.051,437.983a3.832,3.832,0,0,0,2.548-2.014,3.887,3.887,0,0,0,.1-3.263l14.106-32.131-8.069-2.049-11.328,32.228a3.892,3.892,0,0,0-1.865,4.8,3.841,3.841,0,0,0,4.5,2.432Z" transform="translate(626.349 12.29)" fill="#fff5cd"/>' +
                                        '<path id="Path_85" data-name="Path 85" d="M596.337,403.246l-7.848-3.7a1.737,1.737,0,0,1-.7-2.522l4.77-7.262a4.748,4.748,0,0,1,6.342-2.3,4.821,4.821,0,0,1,2.277,6.394l-2.466,8.318a1.725,1.725,0,0,1-.942,1.083A1.7,1.7,0,0,1,596.337,403.246Z" transform="translate(610.773 19.676)" class="color"/>' +
                                        '<path id="Path_86" data-name="Path 86" d="M335.588,436.026h-4.367l-2.077-16.982h6.445Z" transform="translate(875.771 74.841)" fill="#fff5cd"/>' +
                                        '<path id="Path_87" data-name="Path 87" d="M601.913,678.834h-14.08v-.18a5.5,5.5,0,0,1,5.481-5.525h8.6Z" transform="translate(610.56 -163.699)" fill="#2f2e41"/>' +
                                        '<path id="Path_88" data-name="Path 88" d="M376.588,436.026h-4.367l-2.077-16.982h6.445Z" transform="translate(849.374 74.841)" fill="#fff5cd"/>' +
                                        '<path id="Path_89" data-name="Path 89" d="M642.913,678.834h-14.08v-.18a5.5,5.5,0,0,1,5.48-5.525h8.6Z" transform="translate(584.164 -163.699)" fill="#2f2e41"/>' +
                                        '<path id="Path_90" data-name="Path 90" d="M616.008,525.689q-.059,0-.119,0l-5.022-.375a1.617,1.617,0,0,1-1.448-1.268L600.7,475.788a.534.534,0,0,0-1.055.157l3.1,47.544a1.624,1.624,0,0,1-.421,1.224,1.6,1.6,0,0,1-1.177.519H597.32a1.6,1.6,0,0,1-1.493-1.027c-9.617-25.391-6.134-75.143-6.107-75.643l.356-.359h0l19.155,3.335.041.04c6.545,4.847,9.377,61.606,8.336,72.4a1.943,1.943,0,0,1-.474,1.245,1.6,1.6,0,0,1-1.126.465Z" transform="translate(609.755 -19.546)" fill="#2f2e41"/>' +
                                        '<ellipse id="Ellipse_17" data-name="Ellipse 17" cx="8.748" cy="8.82" rx="8.748" ry="8.82" transform="translate(1192.936 381.911)" fill="#fff5cd"/>' +
                                        '<path id="Path_91" data-name="Path 91" d="M609.9,406.117a1.321,1.321,0,0,1-.265-.027l-22.468-2.907a1.889,1.889,0,0,1-1.335-2.014l2.15-11.968c-2.85-3.591-.157-12.866,1.584-15.21l-.673-1.837a2.3,2.3,0,0,1-.03-1.483,1.817,1.817,0,0,1,.846-1.074l9.118-4.884a1.509,1.509,0,0,1,2.115.987l1.788,4.879-.027.014c4.282,2.314,8.075,4.6,5.226,16.813l3.572,16.863a2.1,2.1,0,0,1-.594,1.418A1.445,1.445,0,0,1,609.9,406.117Z" transform="translate(611.851 34.067)" class="color"/>' +
                                        '<path id="Path_92" data-name="Path 92" d="M553.047,416.918a3.759,3.759,0,0,1,.4.441l17.622-1.228,1.89-3.884,6.187,2.11-2.684,7.2a2.849,2.849,0,0,1-2.883,1.854l-20.039-1.532a3.723,3.723,0,0,1-4,1.438,3.78,3.78,0,0,1-.693-7.017,3.715,3.715,0,0,1,4.207.613Z" transform="translate(637 3.497)" fill="#fff5cd"/>' +
                                        '<path id="Path_93" data-name="Path 93" d="M613.881,399.861a1.626,1.626,0,0,1,.052-1.345l3.634-7.236a4.444,4.444,0,0,1,5.621-2.857,4.5,4.5,0,0,1,2.834,5.667l-1.4,8.014a1.616,1.616,0,0,1-.758,1.108,1.591,1.591,0,0,1-1.327.145l-7.681-2.578a1.606,1.606,0,0,1-.976-.918Z" transform="translate(593.868 18.911)" class="color"/>' +
                                        '<ellipse id="Ellipse_18" data-name="Ellipse 18" cx="7.124" cy="7.182" rx="7.124" ry="7.182" transform="translate(1199.474 369.402)" fill="#2f2e41"/>' +
                                        '<path id="Path_94" data-name="Path 94" d="M567.6,323.04a3.7,3.7,0,0,1-2.062-.174A2.47,2.47,0,0,1,564.312,321c-1.327-8.891,6.172-8.16,7.059-8.545a9.724,9.724,0,0,0,1.568-1.154,7.283,7.283,0,0,1,4.1-.909,11.724,11.724,0,0,1,4.979.614,7.481,7.481,0,0,1,3.309,3.075,15.6,15.6,0,0,1,1.641,4.285,10.778,10.778,0,0,1,.279,5.253,6.455,6.455,0,0,1-5.848,4.725,4.873,4.873,0,0,0-2.544-5.324,7.3,7.3,0,0,0-4.85-.582,21.183,21.183,0,0,1-3.217.4C569.724,322.886,568.451,322.949,567.6,323.04Z" transform="translate(625.804 68.782)" fill="#2f2e41"/>' +
                                    '</g>' +
                                '</svg>'
                        },
                        {
                            id: 2,
                            name: 'point',
                            svg: '<svg xmlns="http://www.w3.org/2000/svg" width="60.573" height="139.408" viewBox="0 0 60.573 139.408">' +
                                '<g id="Group_10" data-name="Group 10" transform="translate(-364.839 -95.836)">' +
                                    '<path id="Path_101" data-name="Path 101" d="M406.917,367.962a3.321,3.321,0,0,0-2.721,1.012,3.674,3.674,0,0,0-1.007,2.835l-11.1,5.118,5.294,3.581,9.727-5.409a3.618,3.618,0,0,0-.2-7.137Z" transform="translate(15.37 -246.348)" fill="#fff5cd"/>' +
                                    '<ellipse id="Ellipse_26" data-name="Ellipse 26" cx="8.334" cy="8.733" rx="8.334" ry="8.733" transform="translate(369.187 97.763)" fill="#fff5cd"/>' +
                                    '<path id="Path_102" data-name="Path 102" d="M110.666,433.556h4.16l1.979-16.814h-6.14Z" transform="translate(281.939 -202.537)" fill="#fff5cd"/>' +
                                    '<path id="Path_103" data-name="Path 103" d="M345.178,671.685h8.193a5.35,5.35,0,0,1,5.221,5.471v.178H345.178Z" transform="translate(46.365 -442.089)" fill="#2f2e41"/>' +
                                    '<path id="Path_104" data-name="Path 104" d="M59.666,433.556h4.16L65.8,416.742h-6.14Z" transform="translate(315.633 -202.537)" fill="#fff5cd"/>' +
                                    '<path id="Path_105" data-name="Path 105" d="M294.178,671.685h8.193a5.35,5.35,0,0,1,5.221,5.471v.178H294.178Z" transform="translate(80.06 -442.089)" fill="#2f2e41"/>' +
                                    '<path id="Path_106" data-name="Path 106" d="M293.522,546.53a1.634,1.634,0,0,1-.517-1.195l-.2-63.006,21.724-.877.16-.006,3.573,37.793.448,24.076a1.572,1.572,0,0,1-1.348,1.62l-5.273.65a1.479,1.479,0,0,1-1.171-.373,1.629,1.629,0,0,1-.533-1.154l-.939-25.578-4.558-15.924a.5.5,0,0,0-.558-.3.526.526,0,0,0-.411.5l-1.774,41.872a1.569,1.569,0,0,1-1.338,1.506l-6.089.785a1.477,1.477,0,0,1-1.2-.388Z" transform="translate(80.965 -319.492)" fill="#2f2e41"/>' +
                                    '<path id="Path_107" data-name="Path 107" d="M277.416,405.1l-6.436-27.389c-2.005-8.534,2.576-17.127,10.212-19.155a12.475,12.475,0,0,1,10.556,1.972,15.823,15.823,0,0,1,6.338,10.948l4.2,32.424a1.653,1.653,0,0,1-.35,1.252,1.5,1.5,0,0,1-1.123.563l-21.879.6h-.04A1.552,1.552,0,0,1,277.416,405.1Z" transform="translate(95.698 -240.023)" class="color"/>' +
                                    '<path id="Path_108" data-name="Path 108" d="M332.544,384.227l-16.317-8.305a5.871,5.871,0,0,1-.151-10.254,5.272,5.272,0,0,1,5.732.413l13.2,9.88,14.252-5.947a1.473,1.473,0,0,1,1.673.386l1.922,2.126a1.648,1.648,0,0,1,.408,1.285,1.612,1.612,0,0,1-.679,1.153l-12.759,8.772a7.134,7.134,0,0,1-7.283.491Z" transform="translate(67.532 -244.457)" class="color"/>' +
                                    '<path id="Path_109" data-name="Path 109" d="M281.411,314.339a4.21,4.21,0,0,1-1.9-.411c-.266-.122-.542-.223-.807-.346-2.343-1.083-3.886-4.067-3.941-7.071a11.032,11.032,0,0,1,3.176-7.84,11.188,11.188,0,0,1,6.936-3.136c2.7-.246,5.735.573,7.242,3.26a3.269,3.269,0,0,1,.444,2.447,1.622,1.622,0,0,1-.369.678c-.673.716-1.344.178-2.03.13-.943-.065-1.79.848-2.095,1.918a6.866,6.866,0,0,0,.075,3.339l0,.02a1.9,1.9,0,0,1-.29,1.484,1.731,1.731,0,0,1-1.258.747,7.768,7.768,0,0,1-2.5,0,1.372,1.372,0,0,0-1.864.451,2.8,2.8,0,0,0-.236.814c-.332,1.812-.256,1.7-.588,3.516Z" transform="translate(92.887 -199.658)" fill="#2f2e41"/>' +
                                    '<path id="Path_110" data-name="Path 110" d="M275.343,498.593a3.712,3.712,0,0,0,.582-2.963,3.55,3.55,0,0,0-1.794-2.37l1.563-12.6-5.663,2.894-.616,11.521a3.68,3.68,0,0,0,1.473,4.518,3.332,3.332,0,0,0,4.456-1Z" transform="translate(96.598 -318.986)" fill="#fff5cd"/>' +
                                    '<path id="Path_111" data-name="Path 111" d="M274.229,423.209a1.5,1.5,0,0,1-.318.078l-5.716.757a1.481,1.481,0,0,1-1.2-.388,1.634,1.634,0,0,1-.517-1.2l.045-41.822a5,5,0,0,1,4.126-4.987h0a4.675,4.675,0,0,1,4.011,1.343,5.182,5.182,0,0,1,1.469,4.135l-1.661,18.023.778,22.5a1.591,1.591,0,0,1-1.016,1.567Z" transform="translate(98.362 -251.277)" class="color"/>' +
                                '</g>' +
                                '</svg>'
                        },
                    ]
                },
                {
                    id: 2,
                    text: "Element",
                    icon: '<i class="fas fa-vector-square fa-2x"></i>',
                    items: [
                        {
                            id: 1,
                            name: 'location',
                            svg: '<svg xmlns="http://www.w3.org/2000/svg" width="910.908" height="529.584" viewBox="0 0 910.908 529.584">' +
                                '<g id="Group_58" data-name="Group 58" transform="translate(0 -175.412)">' +
                                    '<ellipse id="Ellipse_436" data-name="Ellipse 436" cx="48.503" cy="98.965" rx="48.503" ry="98.965" transform="translate(648.814 443.805)" fill="#3f3d56"/>' +
                                    '<path id="Path_298" data-name="Path 298" d="M837.384,802.263c19.426-116.551.2-232.682,0-233.84l-3.779.64c.2,1.153,19.315,116.673,0,232.571Z" transform="translate(-144.546 -97.502)" fill="#cacaca"/>' +
                                    '<rect id="Rectangle_50" data-name="Rectangle 50" width="3.833" height="49.74" transform="translate(652.802 524.872) rotate(-61.858)" fill="#cacaca"/>' +
                                    '<rect id="Rectangle_51" data-name="Rectangle 51" width="49.741" height="3.833" transform="translate(699.099 556.718) rotate(-28.158)" fill="#cacaca"/>' +
                                    '<ellipse id="Ellipse_437" data-name="Ellipse 437" cx="94.866" cy="193.564" rx="94.866" ry="193.564" transform="translate(718.989 192.58)" fill="#e6e6e6"/>' +
                                    '<path id="Path_299" data-name="Path 299" d="M947.834,800.179c37.944-227.66.383-454.492,0-456.756l-3.779.64c.383,2.259,37.834,228.48,0,455.487Z" transform="translate(-144.546 -97.502)" fill="#cacaca"/>' +
                                    '<rect id="Rectangle_52" data-name="Rectangle 52" width="3.833" height="97.287" transform="translate(727.657 349.519) rotate(-61.858)" fill="#cacaca"/>' +
                                    '<rect id="Rectangle_53" data-name="Rectangle 53" width="97.287" height="3.833" transform="translate(818.207 415.025) rotate(-28.158)" fill="#cacaca"/>' +
                                    '<path id="Path_300" data-name="Path 300" d="M738.076,800.787h-504.6a7.008,7.008,0,0,1-7-7V474.942a7.008,7.008,0,0,1,7-7h504.6a7.008,7.008,0,0,1,7,7V793.788a7.008,7.008,0,0,1-7,7Z" transform="translate(-144.546 -97.502)" fill="#e4e4e4"/>' +
                                    '<path id="Path_301" data-name="Path 301" d="M279.884,506.579a3,3,0,0,0-3,3V759.151a3,3,0,0,0,3,3H691.671a3,3,0,0,0,3-3V509.579a3,3,0,0,0-3-3Z" transform="translate(-144.546 -97.502)" fill="#fff"/>' +
                                    '<path id="Path_302" data-name="Path 302" d="M695.671,570.859V555.044H637.437V505.579H621.622v49.465H517.947V505.579H502.133v49.465H342.227V505.579H326.412v49.465H271.117v15.815h55.294v61.5H271.117v15.815h55.294v65.9H271.117v15.815H411.636V763.15h15.815V729.886h74.681V763.15h15.815V729.886H695.671V714.071H517.947V648.176H695.671V632.361H637.437v-61.5Zm-193.538,0v19.329H342.227V570.859ZM342.227,606H502.133v26.358H342.227Zm0,108.068v-65.9h69.41v65.9Zm159.906,0H427.451v-65.9h74.681Zm119.49-81.71H517.947v-61.5H621.622Z" transform="translate(-144.546 -97.502)" fill="#e6e6e6"/>' +
                                    '<circle id="Ellipse_438" data-name="Ellipse 438" cx="20.208" cy="20.208" r="20.208" transform="translate(345.286 524.559)" class="color"/>' +
                                    '<path id="Path_303" data-name="Path 303" d="M910.513,705H0v-2.182H910.908Z" fill="#cacaca"/>' +
                                    '<circle id="Ellipse_439" data-name="Ellipse 439" cx="124.655" cy="124.655" r="124.655" transform="translate(243.261 175.412)" class="color"/>' +
                                    '<path id="Path_304" data-name="Path 304" d="M369.135,502.707l-39.382-67.274-39.382-67.274,77.952-.469,77.952-.469L407.7,434.964Z" class="color"/>' +
                                    '<circle id="Ellipse_440" data-name="Ellipse 440" cx="44.724" cy="44.724" r="44.724" transform="translate(324.193 254.559)" fill="#fff"/>' +
                                '</g>' +
                                '</svg>'
                        },
                        {
                            id: 2,
                            name: 'plant',
                            svg: '<svg xmlns="http://www.w3.org/2000/svg" width="508.729" height="530.623" viewBox="0 0 508.729 530.623">' +
                                '<g id="Group_59" data-name="Group 59" transform="translate(0)">' +
                                    '<path id="Path_336" data-name="Path 336" d="M307.688,809.444c-4.337,1.229-8.874-.206-13.341-.267s-9.679,2.092-10.774,7.06c-1.471,6.672,5.33,11.7,11.153,13.364,22.6,6.451,46.523-1.922,69.621,1.493,9.734,1.439,19.2,4.96,28.986,5.8,22.4,1.922,44.288-10.3,66.719-8.918,11.238.69,22.161,4.783,33.4,5.44,26.891,1.571,53.422-16.534,79.747-10.047,7.434,1.832,14.413,5.567,21.778,7.729,18.621,5.468,38.225.594,56.971-4.282,3.722-.968,8.21-2.853,8.668-7.2.506-4.8-4.295-7.8-8.289-9.334-43.677-16.752-90.44-25.627-136-17.884-10.367,1.762-20.705,4.38-31.185,4.207-23.195-.383-44.509-14.259-67.28-19.335-43.147-9.618-86.288,12.82-125.9,34.673" transform="translate(-218.84 -306.476)" class="color" opacity="0.1"/>' +
                                    '<path id="Path_337" data-name="Path 337" d="M429.615,602.735H413.438V730.808s104.412,31.674,205.884,0V602.735Z" transform="translate(-262.064 -241.926)" fill="#3f3d56"/>' +
                                    '<ellipse id="Ellipse_445" data-name="Ellipse 445" cx="101.471" cy="14.46" rx="101.471" ry="14.46" transform="translate(151.375 347.037)" fill="#3f3d56"/>' +
                                    '<ellipse id="Ellipse_446" data-name="Ellipse 446" cx="101.471" cy="14.46" rx="101.471" ry="14.46" transform="translate(151.375 347.037)" opacity="0.1"/>' +
                                    '<path id="Path_338" data-name="Path 338" d="M671.606,251.675c-25.6,88.611-113.276,143.49-113.276,143.49s-46.176-88.788-20.578-177.4S651.027,74.276,651.027,74.276,697.2,163.064,671.606,251.675Z" transform="translate(-300.806 -43.885)" fill="#3f3d56"/>' +
                                    '<path id="Path_339" data-name="Path 339" d="M389.455,251.675c25.6,88.611,113.276,143.49,113.276,143.49s46.176-88.788,20.578-177.4S410.033,74.276,410.033,74.276,363.857,163.064,389.455,251.675Z" transform="translate(-251.525 -43.885)" class="color"/>' +
                                    '<path id="Path_340" data-name="Path 340" d="M362.266,285.94c70.241,64.031,78.82,162.461,78.82,162.461s-105.3-5.384-175.544-69.415-78.821-162.462-78.821-162.462S292.025,221.909,362.266,285.94Z" transform="translate(-186.721 -97.193)" fill="#3f3d56"/>' +
                                    '<path id="Path_341" data-name="Path 341" d="M646.509,285.94C576.268,349.971,567.688,448.4,567.688,448.4s105.3-5.384,175.545-69.415,78.82-162.462,78.82-162.462S716.749,221.909,646.509,285.94Z" transform="translate(-313.324 -97.193)" fill="#3f3d56"/>' +
                                    '<ellipse id="Ellipse_447" data-name="Ellipse 447" cx="32.353" cy="30.297" rx="32.353" ry="30.297" transform="translate(221.963 0)" class="color"/>' +
                                    '<path id="Path_342" data-name="Path 342" d="M277.111,407.875c2.294,7.8,10.264,12.537,10.264,12.537s4.251-7.9,1.957-15.691-10.264-12.537-10.264-12.537S274.817,400.08,277.111,407.875Z" transform="translate(-216.534 -163.022)" class="color"/>' +
                                    '<path id="Path_343" data-name="Path 343" d="M341.362,479.322c-2.469,7.748,1.6,15.726,1.6,15.726s8.075-4.584,10.544-12.332-1.6-15.726-1.6-15.726S343.832,471.574,341.362,479.322Z" transform="translate(-237.847 -191.056)" class="color"/>' +
                                    '<path id="Path_344" data-name="Path 344" d="M802.4,562.676c-6.061,5.759-6.459,14.594-6.459,14.594s9.427-.5,15.488-6.262,6.459-14.594,6.459-14.594S808.464,556.916,802.4,562.676Z" transform="translate(-389.178 -224.567)" class="color"/>' +
                                    '<path id="Path_363" data-name="Path 363" d="M227.111,527.876c2.294,7.8,10.264,12.537,10.264,12.537s4.251-7.9,1.957-15.691-10.264-12.537-10.264-12.537S224.817,520.081,227.111,527.876Z" transform="translate(-199.918 -207.992)" class="color"/>' +
                                '</g>' +
                                '</svg>'                             
                        }
                        
                    ]
                    
                },
                {
                    id: 3,
                    text: "Background",
                    icon: '<i class="far fa-file-image fa-2x"></i>',
                    items: [
                        {
                            id: 1,
                            name: 'mountain',
                            svg: '<svg xmlns="http://www.w3.org/2000/svg" width="916" height="510.366" viewBox="0 0 916 510.366">' +
                                '<g id="Group_60" data-name="Group 60" transform="translate(-366 -467)">' +
                                    '<circle id="Ellipse_448" data-name="Ellipse 448" cx="73" cy="73" r="73" transform="translate(541.807 517.96)" class="color"/>' +
                                    '<path id="Path_364" data-name="Path 364" d="M636.807,425.96H40.957l214.17-306.22L338.877,0l63.75,91.14Z" transform="translate(366 467)" fill="#f2f2f2"/>' +
                                    '<path id="Path_365" data-name="Path 365" d="M610.779,115.96l-216.823,310H827.6l-216.823-310-216.823,310H827.6Z" transform="translate(366 467)" fill="#f2f2f2"/>' +
                                    '<path id="Path_366" data-name="Path 366" d="M480.877,156.317l4.93,85.96L469.516,365.972s134.567,70.848,134.929,74.076S576.1,534.113,576.1,534.113l202.708,48.164Z" transform="translate(224 310.683)" fill="#e6e6e6"/>' +
                                    '<path id="Path_367" data-name="Path 367" d="M752.779,272.277l35.351,83.178,62.677,125.822,37.1,18.969s-2.433,29.463-2.268,33.247,83.96,48.784,83.96,48.784Z" transform="translate(224 310.683)" fill="#e6e6e6"/>' +
                                    '<path id="Path_368" data-name="Path 368" d="M1057,582.277H143a1,1,0,0,1,0-2h914a1,1,0,0,1,0,2Z" transform="translate(224 310.683)" fill="#ccc"/>' +
                                    '<circle id="Ellipse_449" data-name="Ellipse 449" cx="78.237" cy="78.237" r="78.237" transform="translate(490.334 677.316)" fill="#ccc"/>' +
                                    '<path id="Path_369" data-name="Path 369" d="M286.8,392.614a78.243,78.243,0,0,0,130.365,82.8,78.243,78.243,0,1,1-130.365-82.8Z" transform="translate(224 310.683)" opacity="0.2"/>' +
                                    '<path id="Path_370" data-name="Path 370" d="M202.785,288.553H203l3.868,221.813H198.7Z" transform="translate(366 467)" fill="#3f3d56"/>' +
                                    '<circle id="Ellipse_451" data-name="Ellipse 451" cx="94.235" cy="94.235" r="94.235" transform="translate(666.807 573.96)" class="color"/>' +
                                    '<path id="Path_373" data-name="Path 373" d="M606.622,294.57A94.242,94.242,0,0,1,449.6,394.305,94.243,94.243,0,1,0,606.622,294.57Z" transform="translate(224 310.683)" opacity="0.2"/>' +
                                    '<path id="Path_374" data-name="Path 374" d="M394.783,201.2h-.259l-4.66,267.171H399.7Z" transform="translate(366 467)" fill="#3f3d56"/>' +
                                    '<path id="Path_375" data-name="Path 375" d="M680.763,272.9l12.795-10.233c-9.94-1.1-14.024,4.324-15.7,8.615-7.765-3.224-16.219,1-16.219,1l25.6,9.294a19.371,19.371,0,0,0-6.481-8.677Z" transform="translate(224 310.683)" fill="#3f3d56"/>' +
                                    '<path id="Path_376" data-name="Path 376" d="M697.346,193.146l12.795-10.233c-9.94-1.1-14.024,4.324-15.7,8.615-7.765-3.224-16.219,1-16.219,1l25.6,9.294a19.372,19.372,0,0,0-6.481-8.677Z" transform="translate(224 310.683)" fill="#3f3d56"/>' +
                                    '<path id="Path_377" data-name="Path 377" d="M789.474,277.1l12.795-10.233c-9.94-1.1-14.024,4.324-15.7,8.615-7.765-3.224-16.219,1-16.219,1l25.6,9.294a19.372,19.372,0,0,0-6.481-8.677Z" transform="translate(224 310.683)" fill="#3f3d56"/>' +
                                '</g>' +
                                '</svg>'                         
                        }
                    ]
                }
            ],
            userID: ''
        }
    },

    computed: {
        canUndo() {
            return this.historyIndex > 0
        },
        canRedo() {
            return this.history.length - 1 - this.historyIndex > 0
        },
         defaultColor () {
            return {
                '--color': this.color,
            }
        },

        filterIllustrations () {
            return this.drawers[this.selected-1].items.filter((item) =>{
                return item.name.toLowerCase().match(this.search);
            });
        },
        getDropZone() {
            console.log(this.$refs.dropZone);
            return this.$refs.dropZone;
        },
    },

    methods: {

        activated(id) {
            this.drawers.find(drawer => drawer.id === id)
            this.selected = id;
            this.active = !this.active;
        },

        backHome() {
             this.$router.push('/'); 
        },

        startDrag (itemID) {
            this.selectedItemId = itemID;
        },

        onDrop () {
            if (this.selected === -1 || this.selectedItemId === -1) {
                return;
            }
            const selectedItem = this.drawers[this.selected - 1].items.find(
                (item) => item.id === this.selectedItemId
            );
            if (selectedItem) {
                this.board.workspace.push(selectedItem);
            }       
        },
        handleDrag({ target, transform }) {
            console.log("onDrag", transform);
            target.style.transform = transform;
        },
        handleScale({ target, transform }) {
            console.log("onScale", transform);
            target.style.transform = transform;
        },

        handleRotate({ target, transform }) {
            console.log("onRotate", transform);
            target.style.transform = transform;
        },
        handlePinch({ target }) {
            console.log('onPinch', target);
        },
        handleGroupDrag({ targets, events }){
            const frames = targets.map(() => ({translate: [0, 0],}));
            events.forEach(({ target, beforeTranslate }, i) => {
                const frame = frames[i];
                frame.translate = beforeTranslate;
                target.style.transform = `translate(${beforeTranslate[0]}px, ${beforeTranslate[1]}px)`;
            });
        },
        clearAllStates() {
            Object.keys(this.states).forEach((key) => {
                this.moveable[key] = false;
            });
        },
        clear() {
            this.board.workspace = []
            // this.log(this.workspace)
        },
        undo() {
            if (this.canUndo) {
                this.historyIndex -= 1
                this.board.workspace = this.history[this.historyIndex]
            }
        },
        redo() {
            if (this.canRedo) {
                this.historyIndex += 1
                this.board.workspace = this.history[this.historyIndex]
            }
        },

        save() {
            const postData = {
                'illustration_svg': this.board.workspace,
                'name': this.board.name,
            }
            axios.post('/new-illustration', postData
            // {
            //     userID: this.userID,
            // }
            ).then(response => {
                // this.workspace = response.data.workspace
                swal({
                    icon: "success",
                    text: "Save Succesfully!",
                });
            })
        }
    },
}
</script>

<style scoped>
    ::v-deep .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        height: 91%;
    }

    ::v-deep .color {
        align-self: center;
        fill: var(--color);
    }

    ::v-deep svg {
        height: 93px;
        width: 93px;
    }
    
</style>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .card{
        border-radius: 10px;
        border:none;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.40);
    }

    .card-body{
        padding: 10px 11px 10px 10px
    }

     /* Three image containers (use 25% for four, and 50% for two, etc) */
    .column {
        float: left;
        margin: 10px
        // width: 33.33%;
        // padding: 30px 0px;
    }

    .header{
        height: 55px;
    }

    .btn{
        border: 2px solid white;
        border-radius: 20px;
        height: 35px
    }

    .dropdown-menu{
        border: none;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.40);
    }

    .dropdown-item:focus{
        background:$secondary-color;
        color: white;
    }

    .header-title, .text{
        font-family: $primary-font;
        color: white;
    }

    .nav-item, .text3{
        font-family: $bold-font;
        color: white;
    }
    .navbar{
        padding: 0;
    }

    .navbar-brand{
        padding-bottom: 0;
    }

    .row{
       height: calc(100vh - 55px);
    }

    // search box
    .form-group input{
        color: $primary-color;
    }

    .has-search .form-control {
        padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }

    .moveable {
        width: 100px;
    }

    /* The sidebar menu */
    .sidenav {
        height: 100%; /* Full-height: remove this if you want "auto" height */
        width: 95px; /* Set the width of the sidebar */
        left: 0;
        background-color: white;
        overflow-x: hidden; /* Disable horizontal scroll */
        padding-top: 20px;
        box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.35);

    }

    .sidenav button {
        padding: 6px 15px;
        outline: none;
        display: block;
        color: $secondary-color;
        font-family: $bold-font;
        border: none;
        background: none;
        font-size: 14px;
        margin-bottom: 10px;
    }

    button.activeBtn{
        background: #FFF4CA;
        color: #D46C51;
        box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.35);      
    }

    .btn2:hover{
        color: $quartery-color;
    }

    .btn1:hover{
        color: $tertiary-color;
    }

    .sub-sidenav {
        height: 100%; /* Full-height: remove this if you want "auto" height */
        width: 3in; /* Set the width of the sidebar */
        background-color: #F1F1F1;
        overflow-x: hidden; /* Disable horizontal scroll */
        padding-top: 20px;
        box-shadow: inset 2px 0px 6px rgba(0, 0, 0, 0.10);
        transition: all 0.2s; /* for the animation */

    }

    .space{
        height: 100%;
        width: 100%;
        padding: 55px 25px;
    }

    .text{
        font-family: $primary-font;
    }

    .text2{
        font-family: $primary-font;
        color: $primary-color;
    }

    .title{
        background: none;
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 2px solid white;
        color: white;

        &:focus{
            outline: none;
        }

        &::placeholder{
            color: #C3C3C3;
        }
    }

    .workspace {
        background: white;
        border-radius: 10px;
        border: 1px solid $primary-color;
        height: 100%;
        width: 100%;
    }


</style>

