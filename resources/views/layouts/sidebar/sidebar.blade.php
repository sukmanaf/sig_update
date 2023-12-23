
@php

$user = Auth::user();
if ($user == null) {
    return redirect()->route('login');
}
$role = $user->getRoleNames()->first();

@endphp
<div class="page d-flex flex-row flex-column-fluid">
    <!--begin::Aside-->
    <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: false, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle" data-kt-toggle-state="active">
        


        <!--begin::Brand-->
        <div class="aside-logo flex-column-auto" id="kt_aside_logo">
            <!--begin::Logo-->
            <a href="../../demo1/dist/index.html"> <img alt="Logo" src="{{asset('logo.png')}}" class="h-25px logo" /> </a>
            <!--end::Logo-->
            <!--begin::Aside toggler-->
            <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg--><span class="svg-icon svg-icon-1 rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                            <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                        </svg>
                    </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Aside toggler-->
        </div>
        <!--end::Brand-->
        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid">
            <!--begin::Aside Menu-->
            <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                <!--begin::Menu-->
                <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <div class="menu-item">
                            <a class="menu-link" href="{{url('smartmap')}}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                    <span class="svg-icon svg-icon-2 icon-size-1">
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/maps/map002.svg-->
                                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                            <path d="M8.7 4.19995L4 6.30005V18.8999L8.7 16.8V19L3.1 21.5C2.6 21.7 2 21.4 2 20.8V6C2 5.4 2.3 4.89995 2.9 4.69995L8.7 2.09998V4.19995Z" fill="currentColor"/>
                                            <path d="M15.3 19.8L20 17.6999V5.09992L15.3 7.19989V4.99994L20.9 2.49994C21.4 2.29994 22 2.59989 22 3.19989V17.9999C22 18.5999 21.7 19.1 21.1 19.3L15.3 21.8998V19.8Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M15.3 7.19995L20 5.09998V17.7L15.3 19.8V7.19995Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M8.70001 4.19995V2L15.4 5V7.19995L8.70001 4.19995ZM8.70001 16.8V19L15.4 22V19.8L8.70001 16.8Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M8.7 16.8L4 18.8999V6.30005L8.7 4.19995V16.8Z" fill="currentColor"/>
                                            </svg></span>
                                            <!--end::Svg Icon-->
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Smartmap</span>
                            </a>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion"> <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"></path>
                                        <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"></path>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span> <span class="menu-title">Tematik</span> <span class="menu-arrow"></span> </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item" onclick="tematik('jenisTanah')">
                                <a href="javascript:void(0)"  class="menu-link">
                                    <div>
                                        <!-- <input type="checkbox" class="gaucher hd btn_jenis_tanah" id="5" name="gaucher[]" onchange="processCheck(this)"> -->
                                        <label id="" class="ml-30 " for="51"> Jenis Tanah</label>
                                    </div>
                                </a>
                            </div>
                            <div class="menu-item" onclick="modalTematik('kelasTanah')">
                                <a href="javascript:void(0)"  class="menu-link">
                                    <div>
                                        <!-- <input type="checkbox" class="gaucher hd btn_jenis_tanah" id="5" name="gaucher[]" onchange="processCheck(this)"> -->
                                        <label id="" class="ml-30 " for="51"> Kelas Tanah</label>
                                    </div>
                                </a>
                            </div>
                            <div class="menu-item" onclick="tematik('jenisPenggunaanBangunan')">
                                <a class="menu-link" href="javascript:void(0);">
                                    <div>
                                        <!-- <input type="checkbox" class="gaucher hd btn_jenis_bangunan" id="6" name="gaucher[]" onchange="processCheck(this)"> -->
                                        <label id="" class="ml-30 " for="61"> Jenis Bangunan</label>
                                    </div>
                                </a>
                            </div>
                            <div class="menu-item" onclick="modalTematik('kelasBangunan')">
                                <a href="javascript:void(0)"  class="menu-link">
                                    <div>
                                        <!-- <input type="checkbox" class="gaucher hd btn_jenis_tanah" id="5" name="gaucher[]" onchange="processCheck(this)"> -->
                                        <label id="" class="ml-30 " for="51"> Kelas Bangunan</label>
                                    </div>
                                </a>
                            </div>
                            <div class="menu-item" onclick="tematik('nilaiIndividu')">
                                <a class="menu-link" href="javascript:void(0);" >
                                    <!-- <input type="checkbox" class="gaucher hd btn_npwp" id="8" name="gaucher[]" onchange="processCheck(this)"> -->
                                    <label id="" class="ml-30 " for="81"> Nilai Individu</label>
                                </a>
                            </div>
                            <div class="menu-item" onclick="tematik('nik')">
                                <a class="menu-link" href="javascript:void(0);" >
                                    <!-- <input type="checkbox" class="gaucher hd btn_npwp" id="8" name="gaucher[]" onchange="processCheck(this)"> -->
                                    <label id="" class="ml-30 " for="81"> NIK</label>
                                </a>
                            </div>
                            <div class="menu-item" onclick="modalTematik('zonaNilaiTanah')">
                                <a class="menu-link" href="javascript:void(0);">
                                    <!-- <input type="checkbox" class="gaucher hd btn_znt" id="11" name="gaucher[]" onchange="processCheck(this)"> -->
                                    <label id="" class="ml-30 " for="111"> Zona NIlai Tanah</label>
                                </a>
                            </div>
                            <div class="menu-item" onclick="modalTematik('ketetapanPerBuku')">
                                <a class="menu-link" href="javascript:void(0);">
                                    <!-- <input type="checkbox" class="gaucher hd btn_znt" id="11" name="gaucher[]" onchange="processCheck(this)"> -->
                                    <label id="" class="ml-30 " for="111"> Ketetapan per Buku</label>
                                </a>
                            </div>
                            <div class="menu-item" onclick="modalTematik('statusPembayaran')">
                                <a class="menu-link" href="javascript:void(0);">
                                    <!-- <input type="checkbox" class="gaucher hd btn_znt" id="11" name="gaucher[]" onchange="processCheck(this)"> -->
                                    <label id="" class="ml-30 " for="111"> Status Pembayaran</label>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion"> <span class="menu-link">
                        <span class="menu-icon">
                            <svg fill="currentColor" height="24" width="24" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 487.3 487.3" xml:space="preserve" stroke="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M487.2,69.7c0,12.9-10.5,23.4-23.4,23.4h-322c-12.9,0-23.4-10.5-23.4-23.4s10.5-23.4,23.4-23.4h322.1 C476.8,46.4,487.2,56.8,487.2,69.7z M463.9,162.3H141.8c-12.9,0-23.4,10.5-23.4,23.4s10.5,23.4,23.4,23.4h322.1 c12.9,0,23.4-10.5,23.4-23.4C487.2,172.8,476.8,162.3,463.9,162.3z M463.9,278.3H141.8c-12.9,0-23.4,10.5-23.4,23.4 s10.5,23.4,23.4,23.4h322.1c12.9,0,23.4-10.5,23.4-23.4C487.2,288.8,476.8,278.3,463.9,278.3z M463.9,394.3H141.8 c-12.9,0-23.4,10.5-23.4,23.4s10.5,23.4,23.4,23.4h322.1c12.9,0,23.4-10.5,23.4-23.4C487.2,404.8,476.8,394.3,463.9,394.3z M38.9,30.8C17.4,30.8,0,48.2,0,69.7s17.4,39,38.9,39s38.9-17.5,38.9-39S60.4,30.8,38.9,30.8z M38.9,146.8 C17.4,146.8,0,164.2,0,185.7s17.4,38.9,38.9,38.9s38.9-17.4,38.9-38.9S60.4,146.8,38.9,146.8z M38.9,262.8 C17.4,262.8,0,280.2,0,301.7s17.4,38.9,38.9,38.9s38.9-17.4,38.9-38.9S60.4,262.8,38.9,262.8z M38.9,378.7 C17.4,378.7,0,396.1,0,417.6s17.4,38.9,38.9,38.9s38.9-17.4,38.9-38.9C77.8,396.2,60.4,378.7,38.9,378.7z"></path> </g> </g> </g></svg>
                            <!--end::Svg Icon-->
                        </span> <span class="menu-title">Informasi</span> <span class="menu-arrow"></span> </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="javascript:void(0);"> <span id="tmbl_layer_jenis_tanah" class="ml-30 menu-title" for="5">Data Objek Pajak Tanpa Peta </span> </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="javascript:void(0);"> <span id="tmbl_layer_jenis_bangunan" class="ml-30 menu-title" for="6"> Cetak Masal Info Rinci</span> </a>
                            </div>
                            
                        </div>
                    </div>
                    @if($role == 'admin')

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion"> <span class="menu-link">
                        <span class="menu-icon">
                            <svg fill="currentColor" height="24" width="24" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 487.3 487.3" xml:space="preserve" stroke="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M487.2,69.7c0,12.9-10.5,23.4-23.4,23.4h-322c-12.9,0-23.4-10.5-23.4-23.4s10.5-23.4,23.4-23.4h322.1 C476.8,46.4,487.2,56.8,487.2,69.7z M463.9,162.3H141.8c-12.9,0-23.4,10.5-23.4,23.4s10.5,23.4,23.4,23.4h322.1 c12.9,0,23.4-10.5,23.4-23.4C487.2,172.8,476.8,162.3,463.9,162.3z M463.9,278.3H141.8c-12.9,0-23.4,10.5-23.4,23.4 s10.5,23.4,23.4,23.4h322.1c12.9,0,23.4-10.5,23.4-23.4C487.2,288.8,476.8,278.3,463.9,278.3z M463.9,394.3H141.8 c-12.9,0-23.4,10.5-23.4,23.4s10.5,23.4,23.4,23.4h322.1c12.9,0,23.4-10.5,23.4-23.4C487.2,404.8,476.8,394.3,463.9,394.3z M38.9,30.8C17.4,30.8,0,48.2,0,69.7s17.4,39,38.9,39s38.9-17.5,38.9-39S60.4,30.8,38.9,30.8z M38.9,146.8 C17.4,146.8,0,164.2,0,185.7s17.4,38.9,38.9,38.9s38.9-17.4,38.9-38.9S60.4,146.8,38.9,146.8z M38.9,262.8 C17.4,262.8,0,280.2,0,301.7s17.4,38.9,38.9,38.9s38.9-17.4,38.9-38.9S60.4,262.8,38.9,262.8z M38.9,378.7 C17.4,378.7,0,396.1,0,417.6s17.4,38.9,38.9,38.9s38.9-17.4,38.9-38.9C77.8,396.2,60.4,378.7,38.9,378.7z"></path> </g> </g> </g></svg>
                            <!--end::Svg Icon-->
                        </span> <span class="menu-title">Management User</span> <span class="menu-arrow"></span> </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link" href="{{url('muser')}}"> User Login </a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="menu-item">
                            <a class="menu-link" href="{{url('usulan')}}">
                                <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16"> <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/> <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/> <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/> </svg>
                                </span>
                                <span class="menu-title">Usulan</span>
                            </a>
                        </div>
                    @endif
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside menu-->
    </div>
    <!--end::Aside-->
    <!--begin::Wrapper-->
    <div class="wrapper d-flex flex-column flex-row-fluid" style="padding-top: 0px!important" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" style="" class="header align-items-stretch">
            <!--begin::Container-->
            <div class="container-fluid d-flex align-items-stretch justify-content-between">
                <!--begin::Aside mobile toggle-->
                <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg--><span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                    <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                                </svg>
                            </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::Aside mobile toggle-->
                <!--begin::Mobile logo-->
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                    <a href="../../demo1/dist/index.html" class="d-lg-none"> <img alt="Logo" src="{{asset('logo.png')}}" class="h-30px" /> </a>
                </div>
                <!--end::Mobile logo-->
                <!--begin::Wrapper-->
                <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                    <!--begin::Navbar-->
                    <!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modImport">
                        Import
                    </button> -->
                    <div>
                        <span id="breadcumb"></span>
                        <span id="breadcumb_desa"></span>
                    </div>
                    <div class="d-flex align-items-stretch" id="kt_header_nav">
                        <!--begin::Menu wrapper-->
                        <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                            <!--begin::Menu-->
                            <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true"> </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::Navbar-->
                    <!--begin::Toolbar wrapper-->
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf

                        <div  class="d-flex align-items-stretch flex-shrink-0" style="margin-top:10px">
                        <!--begin::Search-->

                            {{-- <div title="Pencarian" class="d-flex align-items-stretch ms-1 ms-lg-3">
                                <!--begin::Search-->
                            
                                <div class="d-flex align-items-center" data-kt-search-element="toggle" id="kt_header_search_toggle">
                                    <div class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px">
                                                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg--><span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                                </svg>
                                                    
                                            </span>
                                                </a>
                                    </div>
                                </div>
                                <!--end::Search-->
                            </div> --}}

                        <!--end::Search-->
                        <!--begin::Activities-->
                        <!--end::Notifications-->
                        <!--begin::Chat-->
                            <!-- @if($role == 'admin') -->

                                {{-- <div class="d-flex align-items-center ms-1 ms-lg-3">
                                    <!--begin::Menu wrapper-->
                                    <div class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px " id="kt_drawer_chat_toggle">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg--><span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                                </svg>
                                            </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Menu wrapper-->
                                
                                </div> --}}
                            <!-- @endif -->
                        <div title="Logout" class="d-flex align-items-center ms-1 ms-lg-3" id="" onclick="event.preventDefault(); this.closest('form').submit();">
                            <!--begin::Menu wrapper-->
                            
                                        <a class="menu-link" href="{{ route('logout') }}" >
                                        </a>
                            <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Navigation/Sign-out.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "/>
                                <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"/>
                                <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                            </div>
                            <!--begin::User account menu-->
                            <!--end::User account menu-->
                            <!--end::Menu wrapper-->
                        </div>
                    </form>
                    </div>
                    <!--end::Toolbar wrapper-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div style="" class=" d-flex flex-column flex-column-fluid" id="kt_content">
            <div class="card">
                @yield('content')                    
            </div>
        </div>
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    
    <!--end::Footer-->
</div>

<script>
    
</script>
