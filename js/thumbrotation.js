redtubeRotation = {
	thumbs : 16,
	frameRate : 800,
	timer : null,
	thumb : 0,
	img  : new Image(),
	thepath : null,
	thumbUrl : function (o)
	{
		var path = o.src;
		var pos = path.indexOf(".jpg");
		if (pos != -1)
			path = path.substring(0, pos-2);
		return path;
	},
	change : function (o, i)
	{
		thumb = (i + 1) % this.thumbs;
		var path = this.thumbUrl(o);
		if (i<=16){
		o.src = path + ")" + i + ".jpg";
		this.img.src = path + ")" + i + ".jpg";}
		else{
		o.src = path + i + ".jpg";
		this.img.src = path + i + ".jpg";}
		i = i % this.thumbs;
		i++;	
		this.timer = setTimeout(function () { redtubeRotation.change(o, i) }, this.frameRate);
	},	
	start : function (o)
	{
		thepath = o.src;
		clearTimeout(this.timer);
		var path = this.thumbUrl(o);
		this.change(o, 1);
	},
	end : function (o)
	{
		clearTimeout(this.timer);
		o.src = thepath;
	}
};
youpornRotation = {
	thumbs : 16,
	frameRate : 1000,
	timer : null,
	thumb : 0,
	img  : new Image(),
	thepath : null,
	thumbUrl : function (o)
	{
		var path = o.src;
		var pos = path.indexOf(".jpg");
		var test = path.substring(pos-2, pos);
		if (pos != -1){
			if(test>=10 && test<=16){
				path = path.substring(0, pos-3);
			}else {
				path = path.substring(0, pos-2);}
		}
		return path;
	},
	change : function (o, i)
	{
		thumb = (i + 1) % this.thumbs;
		var path = this.thumbUrl(o);
		if (i<=16){
		o.src = path + ")" + i + ".jpg";
		this.img.src = path + ")" + i + ".jpg";}
		if (i>17){
		o.src = path + i + ".jpg";
		this.img.src = path + i + ".jpg";
		}
		i = i % this.thumbs;
		i++;	
		this.timer = setTimeout(function () { youpornRotation.change(o, i) }, this.frameRate);
	},	
	start : function (o)
	{
		thepath = o.src;
		clearTimeout(this.timer);
		var path = this.thumbUrl(o);
		this.change(o, 1);
	},
	end : function (o)
	{
		clearTimeout(this.timer);
		o.src = thepath;
	}
};
xvideosRotation = {
	thumbs : 30,
	frameRate : 500,
	timer : null,
	thumb : 0,
	img  : new Image(),
	thepath : null,
	thumbUrl : function (o)
	{
		var path = o.src;
		var pos = path.indexOf(".jpg");
		var pos2 = path.lastIndexOf(".jpg");
		var test = path.substring(pos-2, pos);
		if (pos != -1){
			if(test=="30"){
				path = path.substring(0, pos-3);
			}else if(test>9){
				path = path.substring(0, pos-3);
			}else {
				path = path.substring(0, pos-2);}
		}
		return path;
	},
	change : function (o, i)
	{
		thumb = (i + 1) % this.thumbs;
		var path = this.thumbUrl(o);
		o.src = path + "." + i + ".jpg";
		this.img.src = path + "." + i + ".jpg";
		i = i % this.thumbs;
		i++;	
		this.timer = setTimeout(function () { xvideosRotation.change(o, i) }, this.frameRate);
	},	
	start : function (o)
	{
		thepath = o.src;
		clearTimeout(this.timer);
		var path = this.thumbUrl(o);
		this.change(o, 1);
	},
	end : function (o)
	{
		clearTimeout(this.timer);
		o.src = thepath;
	}
};
vpornRotation = {
	thumbs : 16,
	frameRate : 800,
	timer : null,
	thumb : 0,
	img  : new Image(),
	thepath : null,
	thumbUrl : function (o)
	{
		var path = o.src;
		var pos = path.indexOf(".jpg");
		if (pos != -1)
			path = path.substring(0, pos-1);
		return path;
	},
	change : function (o, i)
	{
		thumb = (i + 1) % this.thumbs;
		var path = this.thumbUrl(o);
		if (i<=16){
		o.src = path + i + ".jpg";
		this.img.src = path + i + ".jpg";}
		else{
		o.src = path + i + ".jpg";
		this.img.src = path + i + ".jpg";}
		i = i % this.thumbs;
		i++;	
		this.timer = setTimeout(function () { vpornRotation.change(o, i) }, this.frameRate);
	},	
	start : function (o)
	{
		thepath = o.src;
		clearTimeout(this.timer);
		var path = this.thumbUrl(o);
		this.change(o, 1);
	},
	end : function (o)
	{
		clearTimeout(this.timer);
		o.src = thepath;
	}
};
var hRotator = {'timer':0,'cache':{},'id':0,'curr':false, 'stopped':true, 'clicked':false,'time':0};
hRotator.click = function(e) {
    if (typeof(Modernizr) != 'undefined' && Modernizr.touch && !hRotator.clicked && ($.now() - hRotator.time)<300 ) {
        hRotator.clicked = true;
        e.stopPropagation();    
        e.preventDefault();
        if (hRotator.stopped) hRotator.start.call(this);
    }
}
hRotator.start2 = function(el) {
    var t = $(el);
    t.bind('mouseout',hRotator.stop);
    hRotator.start.call(el);
}
hRotator.start = function(e) {
    var t = $(this);
    hRotator.stop();
    hRotator.curr = t;
    hRotator.id = t.attr('id');
    hRotator.time = $.now();
    hRotator.curr.css('background-position','0 0');
    if (!hRotator.cache[hRotator.id]) {
        img = new Image();
        img.loaded = false;
        hRotator.cache[hRotator.id] = img;
        img.vid = hRotator.id;
    } else img = hRotator.cache[hRotator.id];
    hRotator.stopped = false;
    if (!img.loaded) {
        t.parent().append('<span></span>');
        hRotator.loader = $('span',t.parent());
        $(img).bind('load',hRotator.onLoad);
        img.src = t.attr('sprite');
    } else {
        hRotator.begin();
    }
}
hRotator.stop = function() {
    hRotator.stopped = true;
    hRotator.clicked = false;
    clearTimeout(hRotator.timer);
    if (hRotator.curr) {
        hRotator.curr.css({'background-image':''});
        if (hRotator.loader) {
            hRotator.loader.remove();
            hRotator.loader = false;
        }
    }
    hRotator.id = false; hRotator.curr = false; hRotator.loader = false;
}
hRotator.onTime =  function(num) {
    clearTimeout(hRotator.timer);
    if (hRotator.stopped) {
        hRotator.stop();
        return true;
    }
    num++;
    if (num>9) num=0;
    pos = (num*-200)+'px 0px';
    hRotator.curr.css({'background-position':pos});
    hRotator.timer = setTimeout('hRotator.onTime('+num+')',500);
}
hRotator.onLoad = function(e) {
    this.loaded = true;
    if (this.vid != hRotator.id) {
        return true;
    }
    hRotator.begin();
}
hRotator.begin = function() {
    if (hRotator.loader) {
        hRotator.loader.remove();
        hRotator.loader = false;
    }
    hRotator.curr.css({'background-position': '0 0'});
	hRotator.curr.css({'background-size': 'auto 150px'});
    hRotator.curr.css({'background-image':'url('+hRotator.curr.attr('sprite')+')'});
    hRotator.onTime(-1);
}