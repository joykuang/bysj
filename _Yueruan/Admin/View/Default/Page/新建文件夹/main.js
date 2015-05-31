 $(function(){
    //初始化
    $('.active > .item-link > .link-arrow').removeClass('uk-icon-angle-right').addClass('uk-icon-angle-down');
    $('.item-link').on('click',function(){
        var current = $(this);
        var submenu = current.siblings('.sub-menu');
        var count = submenu.length;
        if (count == 0) {
            current.off('click');
        } else {
            //将菜单右边的箭头重新初始化
            $('.item-link > .link-arrow').removeClass('uk-icon-angle-down').addClass('uk-icon-angle-right');
            if (current.siblings('.sub-menu').css('display') == 'none') {
                $('.sidebar-item > .sub-menu').slideUp(160);
                current.siblings('.sub-menu').slideDown(120);
            }
            current.find('.link-arrow').removeClass('uk-icon-angle-right').addClass('uk-icon-angle-down');
        }
        
    });
    
    //侧边栏开关
    /*
    var sidebarToggle = false;
    var count = 0;
    $('.sidebar-switcher').on('click', function(){
        if (sidebarToggle == false) {
            $('.item-link').off('click');
            $('.cms').addClass('sidebar-open');
            $(this).find('.link-icon').removeClass('uk-icon-arrow-circle-left').addClass('uk-icon-arrow-circle-right');
            $('.tooltip-about, .tooltip-switcher').attr('data-uk-tooltip', '{pos:"right"}');
            $('.tooltip-about').attr('title', '关于DaoCMS');
            $('.tooltip-switcher').attr('title', '折叠菜单');
        } else {
            $('.cms').removeClass('sidebar-open');
            $(this).find('.link-icon').removeClass('uk-icon-arrow-circle-right').addClass('uk-icon-arrow-circle-left');
            sidebarEvent();
            $('.tooltip-about, .tooltip-switcher').removeAttr('data-uk-tooltip');
            $('.tooltip-about, .tooltip-switcher').removeAttr('title');
            
            //重新注册事件
            $('.item-link').on('click',function(){
                var current = $(this);
                var dom = current.siblings('.sub-menu');
                var count = dom.length;
                if (count == 0) {
                    dom.find('.item-link').off('click');
                } else {
                    $('.item-link > .link-arrow').removeClass('uk-icon-angle-down').addClass('uk-icon-angle-right');
                    if (current.siblings('.sub-menu').css('display') == 'none') {
                        $('.sidebar-item > .sub-menu').slideUp(160);
                        current.siblings('.sub-menu').slideDown(120);
                        current.find('.link-arrow').removeClass('uk-icon-angle-right').addClass('uk-icon-angle-down');
                    }
                }
            });
            
            $('.item-link').trigger('click');
        }
        
        sidebarToggle =(!sidebarToggle);
        count++;
        
        console.log('函数正在执行第 #'+count+' 次\n');
        console.log('当前切换器状态为 '+sidebarToggle+' \n');
    });
*/
    
    /*
    $('#selectAll').on('click', function(){
        if(this.checked){
            $("input[name='articleID[]']").each(function(){
                this.checked = true;
            }); 
        }else{ 
            $("input[name='articleID[]']").each(function(){
                this.checked = false;
            }); 
        }         
    });
    
    $('[data-uk-switcher]').on('show.uk.switcher', function(event, area){
    
            var article_thumbnail = $('.article-thumbnail');
            var article_thumbnail_width = article_thumbnail.width();
            var article_thumbnail_height= (article_thumbnail_width / 16) * 9;
            article_thumbnail.height(article_thumbnail_height);
    
    });


var progressbar = $("#progressbar"),
            bar         = progressbar.find('.uk-progress-bar'),
            settings    = {

            type:           'json',
            action:        '/test.php', // upload url

            allow :         '*.(jpg|jpeg|gif|png|bmp)', // allow only images

            loadstart: function() {
                bar.css("width", "0%").text("0%");
                progressbar.removeClass("uk-hidden");
            },

            progress: function(percent) {
                percent = Math.ceil(percent);
                bar.css("width", percent+"%").text(percent+"%");
            },

            allcomplete: function(response) {

                bar.css("width", "100%").text("100%");

                setTimeout(function(){
                    progressbar.addClass("uk-hidden");
                }, 250);

                alert(response);
            }
        };

        var select = UIkit.uploadSelect($("#upload-select"), settings),
            drop   = UIkit.uploadDrop($("#upload-drop"), settings);
*/
 });