<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Admin Prosalud',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Pro</b>Salud',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'pacientes',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'text' => 'Pedir Cita',
            'url' => '/paciente/pedir-cita',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Mis Citas',
            'url' => '/paciente/mis-citas',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Buscar profesionales',
            'url' => '/paciente/buscar-profesionales',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Buscar proveedores',
            'url' => '/paciente/buscar-proveedores',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Emergencias',
            'url' => '/pacientes/buscar/emergencias',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Mis recetas',
            'url' => '/paciente/mis-recetas',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Presupuestos solicitados',
            'url' => '/paciente/presupuestos',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Mis pruebas',
            'url' => '/paciente/mis-pruebas',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Mi historial médico',
            'url' => '/paciente/mi-historial-medico',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Mis valoraciones',
            'url' => '/paciente/mis-valoraciones',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Mis datos',
            'url' => '/paciente/mis-datos',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Notificaciones',
            'url' => '/paciente/notificaciones',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Contactar administrador',
            'url' => '/paciente/contactar-administrador',
            'icon' => '',
            'can'  => 'solo-paciente',
        ],
        [
            'text' => 'Mis estadísticas',
            'url' => '/profesional/mis-estadisticas',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Mis citas presenciales',
            'url' => '/profesional/mis-citas-presenciales',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Mis citas de videconsulta',
            'url' => '/profesional/mis-citas-videoconsulta',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Mis pacientes / Historiales',
            'url' => '/profesional/mis-pacientes',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Recetas de farmacia',
            'url' => '/profesional/recetas-farmacia-digitales',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Pedidos de laboratorio',
            'url' => '/profesional/pedidos-laboratorio',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Pedidos de imágenes',
            'url' => '/profesional/pedidos-imagenes',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Valoraciones y comentarios',
            'url' => '/profesional/valoraciones-comentarios',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Mis datos',
            'url' => '/profesional/mis-datos',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Mis planes',
            'url' => '/profesional/mis-planes',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Notificaciones',
            'url' => '/profesional/notificaciones',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Preguntas y Respuestas',
            'url' => '/profesional/preguntas-respuestas',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],
        [
            'text' => 'Contactar administrador',
            'url' => '/profesional/contactar-administrador',
            'icon' => '',
            'can'  => 'solo-profesional',
        ],




        [
            'text' => 'Mis estadísticas',
            'url' => '/proveedor/mis-estadisticas',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],
        [
            'text' => 'Mis datos',
            'url' => '/proveedor/mis-datos',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],
        [
            'text' => 'Mis citas',
            'url' => '/proveedor/mis-citas',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],
        [
            'text' => 'Mis clientes/pacientes',
            'url' => '/proveedor/mis-clientes-pacientes',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],
        [
            'text' => 'Mis pedidos/presupuestos',
            'url' => '/proveedor/mis-pedidos-presupuestos',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],
        [
            'text' => 'Compartir resultados',
            'url' => '/proveedor/compartir-resultado',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],
        [
            'text' => 'Mis planes',
            'url' => '/proveedor/mis-planes',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],
        [
            'text' => 'Mis valoraciones',
            'url' => '/proveedor/mis-valoraciones',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],
        [
            'text' => 'Notificaciones',
            'url' => '/proveedor/notificaciones',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],
        [
            'text' => 'Contactar administrador',
            'url' => '/proveedor/contactar-administrador',
            'icon' => '',
            'can'  => 'solo-proveedor',
        ],



        [
            'text' => 'Inicio',
            'url' => '/admin',
            'icon' => 'fas fa-home',
            'can'  => 'solo-admin',
        ],
        [
            'text' => 'Ajustes',
            'url'  => '#',
            'icon' => 'fas fa-cogs',
            'can'  => 'solo-admin',
            'submenu' => [
                ['text' => 'Categorias Profesionales', 'url' => '/admin/categorias-profesionales', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Métodos de Pago', 'url' => '/admin/metodos-pago', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Planes', 'url' => '/admin/planes', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Seguros Médicos', 'url' => '/admin/seguros-medicos', 'icon' => '', 'can' => 'solo-admin'],
            ],
        ],
        [
            'text' => 'Blog',
            'url'  => '#',
            'icon' => 'fas fa-blog',
            'can'  => 'solo-admin',
            'submenu' => [
                ['text' => 'Listado', 'url' => '/admin/blog/articulos', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Categorías', 'url' => '/admin/blog/categorias', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Etiquetas', 'url' => '/admin/blog/etiquetas', 'icon' => '', 'can' => 'solo-admin'],
            ],
        ],

        ['text' => 'Citas', 'url' => '/admin/citas', 'icon' => 'fas fa-calendar-check', 'can' => 'solo-admin'],
        ['text' => 'Documentos Profesional', 'url' => '/admin/documentos-profesional', 'icon' => 'fas fa-file-alt', 'can' => 'solo-admin'],
        ['text' => 'Emergencias', 'url' => '/admin/emergencias', 'icon' => 'fas fa-ambulance', 'can' => 'solo-admin'],
        ['text' => 'Especialidades', 'url' => '/admin/especialidades', 'icon' => 'fas fa-stethoscope', 'can' => 'solo-admin'],
        [
            'text' => 'Expertos',
            'url'  => '#',
            'icon' => 'fas fa-user-tie',
            'can'  => 'solo-admin',
            'submenu' => [
                ['text' => 'Preguntas', 'url' => '/admin/preguntas-expertos', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Respuestas', 'url' => '/admin/respuestas-expertos', 'icon' => '', 'can' => 'solo-admin'],
            ],
        ],
        ['text' => 'Facturación', 'url' => '/admin/facturacion', 'icon' => 'fas fa-file-invoice-dollar', 'can' => 'solo-admin'],


        [
            'text' => 'Informes de Consulta',
            'url'  => '#',
            'icon' => 'fas fa-file-medical-alt',
            'can'  => 'solo-admin',
            'submenu' => [
                ['text' => 'Listado', 'url' => '/admin/informes-consulta', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Recetas', 'url' => '/admin/recetas', 'icon' => '', 'can' => 'solo-admin'],
            ],
        ],
        [
            'text' => 'Medicamentos',
            'url'  => '#',
            'icon' => 'fas fa-pills',
            'can'  => 'solo-admin',
            'submenu' => [
                ['text' => 'Listado', 'url' => '/admin/medicamentos', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Intervalo', 'url' => '/admin/intervalo-medicamentos', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Presentación', 'url' => '/admin/presentacion-medicamentos', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Vías de Administración', 'url' => '/admin/vias-administracion-medicamentos', 'icon' => '', 'can' => 'solo-admin'],
            ],
        ],
        [
            'text' => 'Regiones',
            'url'  => '#',
            'icon' => 'fas fa-map-marked-alt',
            'can'  => 'solo-admin',
            'submenu' => [
                ['text' => 'Listado', 'url' => '/admin/regiones', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Provincias', 'url' => '/admin/provincias', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Ciudades', 'url' => '/admin/ciudades', 'icon' => '', 'can' => 'solo-admin'],
            ],
        ],
        [
            'text' => 'Usuarios',
            'url'  => '#',
            'icon' => 'fas fa-users',
            'can'  => 'solo-admin',
            'submenu' => [
                ['text' => 'Listado', 'url' => '/admin/usuarios', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Administradores', 'url' => '/admin/administradores', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Pacientes', 'url' => '/admin/pacientes', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Profesionales', 'url' => '/admin/profesionales', 'icon' => '', 'can' => 'solo-admin'],
                ['text' => 'Proveedores', 'url' => '/admin/proveedores', 'icon' => '', 'can' => 'solo-admin'],
            ],
        ],
        ['text' => 'Valoraciones', 'url' => '/admin/valoraciones', 'icon' => 'fas fa-star', 'can' => 'solo-admin'],


        [
            'text' => 'Cerrar sesión',
            'icon' => 'fas fa-sign-out-alt cerrarSesion',
            'url'  => 'cerrar-sesion',
            'class' => 'cerrarSesion',
            'can'  => '',
            'logout' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
        App\AdminLTE\Menu\Filters\ProfesionalDocumentosAprobadosFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
