<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link href="{{ asset('css/font-awesome/css/all.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    
    </head>
    <body>
        <div id="root"></div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        /*
        $('[data-toggle="popover"]').popover();
        
        // Hide submenus
        $('#body-row .collapse').collapse('hide'); 

        // Collapse/Expand icon
        $('#collapse-icon').addClass('fa-angle-double-left'); 
        
        
        
        // Collapse click
        $('[data-toggle=sidebar-colapse]').on('click',function() {
            SidebarCollapse();
            
        });
        $('#customize-toggle').click(function() {
            $('.customize').toggleClass('customize-show customize-hidden');
        })
        function replaceClass() {
            let SeparatorTitle = $('.sidebar-separator-title');
            let sidebarContainer = $('#sidebar-container');
            if ( SeparatorTitle.hasClass('d-flex') 
            && sidebarContainer.hasClass('sidebar-collapsed')) {
                SeparatorTitle.removeClass('d-flex');
            } else {
                    SeparatorTitle.addClass('d-flex');
            }
        }
        replaceClass()
        
        
        function SidebarCollapse () {
        
        $('.menu-collapsed').toggleClass('d-none');
            $('.submenu-icon').toggleClass('d-none');
            $(".sidebar-submenu").toggleClass('d-none');
            
            $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
            
            // Treating d-flex/d-none on separators with title
            replaceClass()
            
            // Collapse/Expand icon
            $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
        }
        $('[data-toggle=sidebar-colapse]').click();
        $('#sidebar-container .drop-menu').hover(function(event) {
            const str = $(this).children(":first").attr('href');
            const href = str.replace(/^#/, '');
                $(".sidebar-submenu").each(function () {
                    if ($(this).attr('id') === href && $('#sidebar-container').width() === 55) {
                    if(event.type == "mouseenter") {
                    $(this).addClass('drop-right');
                    $(this).removeClass('collapse d-none');
                    }
                    if(event.type == "mouseleave") {
                    $(this).removeClass('drop-right');
                    $(this).addClass('collapse d-none');
                    }
                }
                })
        })
*/
    </script>
    </html>
