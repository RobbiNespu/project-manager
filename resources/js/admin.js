$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
     return this.href == url;
    }).addClass('active').parent();

    while(true){
        if (element.is('li')){
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
    
  //Animate tiles
    var animationTime = 300; 

    var tiles = document.querySelectorAll('.tile');
    var lastTile = 0;
    var start = 1;

    for(var i=0; i<tiles.length; i++)
    {
    	$(tiles[i]).hide();
    	
    	setTimeout(function(){
    		var current = $(tiles[lastTile++]);
    		current.show();
    		current.css('animation','appear-left-short 0.6s');
    	}, start);
    	
    	start += animationTime;
    }

    // Animate panels later
    var panels = document.querySelectorAll('.panel-animated');
    var lastPanel = 0;
    var panelTime = 100;
    
    for(var i=0; i<panels.length; i++)
    {
    	$(panels[i]).css('opacity','0');
    	
    	setTimeout(function(){
    		var current = $(panels[lastPanel++]);
    		current.css('animation','appear-bottom-short 0.8s');
    		current.css('opacity','1.0');
    	}, start);
    	
    	start += animationTime + panelTime;
    }
    
});


