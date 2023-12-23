@extends('layouts.apps')

@section('content')
<style>
 .leaflet-print-button{
    display: flex;
  align-items: center;
  justify-content: center;
 
 }
 .leaflet-delete-button{
    display: flex;
    align-items: center;
    justify-content: center;
    padding-right: 2px
 }

 .custom-control-btn{
    margin-right: 5vw;
 }
</style>

    <div class="card" id="card_map">
        <div id="map" class="map_part" style=""></div>
    </div>
    @include('maps/modal_info')
    @include('maps/modal_tools')
    @include('maps/modal_save')
    @include('maps/action_button')
    @include('maps/tematik')
    @include('maps/search')
    @include('maps/print_peta')

    @include('maps/ready')

<script>
    $(document).ready(function () {
        // $('#kt_aside').attr('data-kt-aside-minimize', 'on');
        // $('#kt_aside_toggle').click()
        // setTimeout(() => {
            
        //     map.invalidateSize();
        // }, 100);
    });

    var googleDefault =  L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
      maxZoom: 19,
      subdomains:['mt0']
  })
    var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        osm = L.tileLayer(osmUrl, {
            maxZoom: 20,
            zoom: 13,
            attribution: osmAttrib
        }),
        // map = L.Map('map', {
        //     renderer: L.canvas(),
        //     center: new L.LatLng(-7.6357943324575, 112.88264323166)
        // }),
        map = new L.Map('map', {center: new L.LatLng(-7.6357943324575, 112.88264323166), zoom: 13,maxZoom:25,position: 'topright'}),
        drawnItems = L.featureGroup().addTo(map);
        map2 = new L.Map('map2', {center: new L.LatLng(-7.6357943324575, 112.88264323166), zoom: 13,maxZoom:25,position: 'topright'});
        
      
    googleHybrid = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 30,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google'
    });
    googleSatelite = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 40,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google'
    });
    googleSatelite2 = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 40,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google'
    });

    
    googleSatelite2.addTo(map2)
    L.Control.Button = L.Control.extend({
        options: {
            position: 'topleft'
        },
        onAdd: function (map2) {
            
            var container = L.DomUtil.create('div', 'leaflet-bar leaflet-delete-div');
            var button = L.DomUtil.create('a', 'leaflet-delete-button', container);
            button.innerHTML = '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Devices/Printer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/><rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/></g></svg><!--end::Svg Icon--></span>'
            L.DomEvent.disableClickPropagation(button);

            L.DomEvent.on(button, 'click', function(){
                toastr.success("Warning", "Silahkan Tungggu, Gambar Segera Terunduh!")

                var scale = 4;
                var image= document.getElementById('map2')
                
                const options = {
                    width: image.clientWidth * scale,
                            height: image.clientHeight * scale,
                            style: {
                            transform: 'scale('+scale+')',
                            transformOrigin: 'top left'
                            }
                };
                domtoimage.toPng(image,options)
                    .then(function (dataUrl) {
                        const link = document.createElement('a');
                        link.href = dataUrl;
                        link.download = kel_name+' BLOK '+$('#print_blok').val().slice(-3)+'.png';

                        // Trigger a click event on the anchor element to initiate the download
                        link.click();

                    })
                    .catch(function (error) {
                        console.error("Error capturing map:", error);
                    });
            });
            button.title = "Refresh Tematik";
            return container;
        },
        onRemove: function(map2) {},
    });
    var control = new L.Control.Button()
    control.addTo(map2);
    

    L.control.layers({
        "OSM": osm,
        "Google Hybrid": googleHybrid,
        "Google Satelit": googleSatelite.addTo(map)
    }, {
        'drawlayer': drawnItems,
    }, {
        position: 'topright',
        collapsed: true
    }).addTo(map);
    // Find the target div with both classes
    var divCustomTopRight = '<div class="custom-control-btn leaflet-control"">'
        divCustomTopRight += '<span class="col-form-label" id="breadcumb_desa"></span>'
        divCustomTopRight += '<button type="button" id="btn_searchs" style="margin-right:1vw" onclick="$(\'#modalSearch\').modal(\'show\')">'+
            '<svg id=svgSearch xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0,0,256,256"style="fill:#000000;"><g id="gFill" fill="#000000" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M21,3c-9.39844,0 -17,7.60156 -17,17c0,9.39844 7.60156,17 17,17c3.35547,0 6.46094,-0.98437 9.09375,-2.65625l12.28125,12.28125l4.25,-4.25l-12.125,-12.09375c2.17969,-2.85937 3.5,-6.40234 3.5,-10.28125c0,-9.39844 -7.60156,-17 -17,-17zM21,7c7.19922,0 13,5.80078 13,13c0,7.19922 -5.80078,13 -13,13c-7.19922,0 -13,-5.80078 -13,-13c0,-7.19922 5.80078,-13 13,-13z"></path></g></g></svg>'+
            '</button>'
        divCustomTopRight += '<button type="button" onclick="$(\'#modal_tools\').modal(\'show\')"><svg xmlns="http://www.w3.org/2000/svg" id="svgNineDot" width="30" height="30" viewBox="0 0 100 100"><circle cx="20" cy="20" r="10" fill="black" />  <circle cx="50" cy="20" r="10" fill="black" />  <circle cx="80" cy="20" r="10" fill="black" />  <circle cx="20" cy="50" r="10" fill="black" />  <circle cx="50" cy="50" r="10" fill="black" />  <circle cx="80" cy="50" r="10" fill="black" />  <circle cx="20" cy="80" r="10" fill="black" />  <circle cx="50" cy="80" r="10" fill="black" />  <circle cx="80" cy="80" r="10" fill="black" /></svg></button>'
       
        divCustomTopRight +='</div>'
    $('.leaflet-control-container').append(str)
    // Convert the HTML string to a DOM element
    var parser = new DOMParser();
    var newDiv = parser.parseFromString(divCustomTopRight, 'text/html').body.firstChild;

    // Find the target div with the three classes
    var targetDiv = document.querySelector('.leaflet-control-layers.leaflet-control');
    // var targetDiv = document.querySelector('.leaflet-control-layers.leaflet-control-layers-expanded.leaflet-control');

    if (targetDiv) {
        // Insert the new div before the target div
        targetDiv.parentElement.insertBefore(newDiv, targetDiv);
    } else {
        console.log('Target div not found.');
    }





   //======================= Layer control ====================
   var str = '<div class="">' +
                 '<div style="" class="form-check"><input type="checkbox" checked class="gaucher form-check-input" id="daftarDesa" name="gaucher[]" onchange="getDesa()"><label id="tmbl_layer_wilayah" for="daftarDesa">Daftar Desa</label></div>' +  
                 '<div style="" class="form-check"><input type="checkbox" class="gaucher form-check-input" id="1" name="gaucher[]" onchange="processCheck(this)"><label id="tmbl_layer_ori" for="1"> Objek Pajak</label></div>' + 
                 '<div style="" class="form-check"><input type="checkbox" class="gaucher  form-check-input" id="2" name="gaucher[]" onchange="processCheck(this)"><label id="tmbl_layer_bangunan" for="2"> Bangunan</label></div>' + 
                 '<div style="" class="form-check"><input type="checkbox" class="gaucher  form-check-input" id="3" name="gaucher[]" onchange="processCheck(this)"><label id="tmbl_layer_blok" for="3"> Blok</label></div>' +
               
                  '</div>';
    $('.leaflet-control-layers-list').append(str)
 
    L.Control.Button = L.Control.extend({
                options: {
                    position: 'topleft'
                },
                onAdd: function (map) {
                    
                    var container = L.DomUtil.create('div', 'leaflet-bar leaflet-delete-div');
                    var button = L.DomUtil.create('a', 'leaflet-delete-button', container);
                    button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>'
                    button.style.display = 'flex'
                    button.alignItems = 'center'
                    button.justifyContent = 'center'
                    button.paddingRight = '2px'
                    L.DomEvent.disableClickPropagation(button);

                    L.DomEvent.on(button, 'click', function(){
                        editableLayers.clearLayers()
                        LTematik.clearLayers()
                        $('.div_detail').css('display','none')
                    });
                    button.title = "Refresh Tematik";
                    return container;
                },
                onRemove: function(map) {},
            });
            var control = new L.Control.Button()
            control.addTo(map);

            L.Control.Button = L.Control.extend({
                options: {
                    position: 'topleft'
                },
                onAdd: function (map) {
                    
                    var container = L.DomUtil.create('div', 'leaflet-bar leaflet-delete-div');
                    var button = L.DomUtil.create('a', 'leaflet-print-button', container);
                    button.innerHTML = '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Devices/Printer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/><rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/></g></svg><!--end::Svg Icon--></span>'
                    L.DomEvent.disableClickPropagation(button);

                    L.DomEvent.on(button, 'click', function(){
                        $('#modal_print').modal('show')
                        $('#btn_cari_peta').click()
                        printNop.clearLayers()
                        printBlok.clearLayers()
                        printBg.clearLayers()
                        setTimeout(function() {
                            map2.invalidateSize();
                        }, 10);
                    });
                    
                    button.title = "Print Blok";
                    button.style = "display:none";

                    return container;
                },
                onRemove: function(map) {},
            });
            var control = new L.Control.Button()
            control.addTo(map);

    var divCustomTopLeft = '<div class="custom-control-btn leaflet-control"">'
        divCustomTopLeft += '<span class="col-form-label" style="color:white" id="breadcumb_desa"></span>'
        divCustomTopLeft +='</div>'
    // $('.leaflet-top.leaflet-right').append(str)
    // Convert the HTML string to a DOM element
    var parser = new DOMParser();
    var newDiv = parser.parseFromString(divCustomTopLeft, 'text/html').body.firstChild;

    var targetDiv = document.querySelector('.leaflet-bar.leaflet-delete-div.leaflet-control');

    if (targetDiv) {
        // Insert the new div before the target div
        targetDiv.parentElement.insertBefore(newDiv, targetDiv);
    } else {
        console.log('Target div not found.');
    }


    //======================= button lihat ====================
    //======================= position zoom  ====================
    map.removeControl(map.zoomControl);
    L.control.zoom({
        position: 'topleft'
    }).addTo(map);

    var activeBasemap=osm
    map.on('baselayerchange', function (e) {
    // Update the active basemap when the user changes it
            // if (map.hasLayer(marker)) {
            //             marker.clearLayers()
            // };

        activeBasemap = e.name;
        console.log('Active basemap changed to: ' + e.name);
        reload_layer()
    });

    console.log('Initial active basemap: ' + activeBasemap);

</script>
@include('maps/layer')
@include('maps/drawing')
    @endsection
