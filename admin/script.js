 $(function(){
     $('.link-title').each(function(){
        var current = $(this);
        if (current.siblings('.sub-menu').length == 0) current.parent().parent().addClass('single');
    });      
     
     $('.link-title').on('click',function(){
        var current = $(this);
        if (current.siblings('.sub-menu').css('display') == 'none') {
            $('.sidebar-item-link > .sub-menu').slideUp(160);
            current.siblings('.sub-menu').slideDown(120);
        }
    }); 
    
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

/*
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