<?php

$menu = array(
                //Home
                array(  'id_resource'=>1,
                        'id_parent'=>0,
                        'text'=>'Home',
                        'sref'=>'memo.dashboard',
                        'icon'=>'icon-speedometer'
                ),

                //PIC JRF
                array(  'id_resource'=>2,
                        'id_parent'=>0,
                        'text'=>'PIC JRF',
                        'sref'=>'#',
                        'icon'=>'icon-docs'
                ),
                array(  'id_resource'=>21,
                        'id_parent'=>2,
                        'text'=>'JRF Penjualan Unit',
                        'sref'=>'memo.jrfUnit',
                        'icon'=>'fa-shopping-cart',
                ),
                array(  'id_resource'=>22,
                        'id_parent'=>2,
                        "text"=>"JRF Bengkel",
                        "sref"=>"memo.jrfBengkel",
                        "icon"=>"icon-wrench",
                ),

                //Cetak Barcode
                array(  'id_resource'=>3,
                        'id_parent'=>0,
                        "text"=>"Cetak Barcode",
                        "sref"=>"memo.barcode",
                        "icon"=>"icon-printer"
                ),

                //Bengkel
                array(  'id_resource'=>4,
                        'id_parent'=>0,
                        "text"=>"Bengkel",
                        "sref"=>"#",
                        "icon"=>"icon-wrench",
                ),
                array(  'id_resource'=>41,
                        'id_parent'=>4,
                        "text"=>"Pembayaran Bengkel",
                        "sref"=>"memo.paymentGarage",
                        "icon"=>"fa-shopping-cart"
                ),
                array(  'id_resource'=>42,
                        'id_parent'=>4,
                        "text"=>"Laporan Harian Bengkel",
                        "sref"=>"memo.dailyGarageReport",
                        "icon"=>"icon-wrench"
                ),

                //Master
                array(  'id_resource'=>5,
                        'id_parent'=>0,
                        "text"=>"Master",
                        "sref"=>"#",
                        "icon"=>"icon-wallet",
                ),
                array(  'id_resource'=>51,
                        'id_parent'=>5,
                        "text"=>"Accessories",
                        "sref"=>"",
                        "icon"=>"fa-shopping-cart"
                ),
                array(  'id_resource'=>52,
                        'id_parent'=>5,
                        "text"=>"Subsidi Accessories",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),
                array(  'id_resource'=>53,
                        'id_parent'=>5,
                        "text"=>"Tipe Motor",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),
                array(  'id_resource'=>54,
                        'id_parent'=>5,
                        "text"=>"Warna Motor",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),
                array(  'id_resource'=>55,
                        'id_parent'=>5,
                        "text"=>"Mekanik",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),
                array(  'id_resource'=>56,
                        'id_parent'=>5,
                        "text"=>"Salesman",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),
                array(  'id_resource'=>57,
                        'id_parent'=>5,
                        "text"=>"Biro Jasa",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),
                array(  'id_resource'=>58,
                        'id_parent'=>5,
                        "text"=>"Leasing",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),
                array(  'id_resource'=>59,
                        'id_parent'=>5,
                        "text"=>"Master POS",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"

                ),
                array(  'id_resource'=>510,
                        'id_parent'=>5,
                        "text"=>"Subsidi",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"

                ),
                array(  'id_resource'=>511,
                        'id_parent'=>5,
                        "text"=>"Daftar Subsidi",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),
                array(  'id_resource'=>512,
                        'id_parent'=>5,
                        "text"=>"Supplier",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),
                array(  'id_resource'=>513,
                        'id_parent'=>5,
                        "text"=>"Harga Motor",
                        "sref"=>"#",
                        "icon"=>"icon-wrench"
                ),

                //Distribusi Unit
                array(  'id_resource'=>6,
                        'id_parent'=>0,
                        "text"=>"Distribusi Unit",
                        "sref"=>"login.out",
                        "icon"=>"icon-logout"

                ),

                //Edit User
                array(  'id_resource'=>7,
                        'id_parent'=>0,
                        "text"=>"Edit User",
                        "sref"=>"memo.editUser",
                        "icon"=>"icon-user"

                ),

                //Logout
                array(  'id_resource'=>8,
                        'id_parent'=>0,
                        "text"=>"Logout",
                        "sref"=>"login.out",
                        "icon"=>"icon-logout"

                ),


);
