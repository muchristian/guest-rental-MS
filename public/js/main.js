$(function () {
    $('[data-toggle="popover"]').popover();
        
        // Hide submenus
        $('#body-row .collapse').collapse('hide'); 

        // Collapse/Expand icon
        $('#collapse-icon').addClass('fa-angle-double-left'); 
        
        
        
        // Collapse click
        $('[data-toggle=sidebar-colapse]').click(function() {
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
  })
