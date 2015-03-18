function extend(e,t) {
	for(var n in t) e[n]=t[n];
    return e
}

function defaults(e,t) {
	for(var n in t) e.hasOwnProperty(n)||(e[n]=t[n]);
    return e
}

function Promise() {
	var e=[],t=!1;
    this.resolve = function() {
    t || (t=!0, e.forEach(function(e) {
            e()
        })
    )},
    this.then = function(n) {
        return t?n(): e.push(n),this
    }
    .bind(this)
}

function get(e,t,n) {
    var o = new XMLHttpRequest;
    o.onreadystatechange = function(){
        if (4==o.readyState) {
            if (200==o.status) return t(o.responseText);
            if (n) return n(o.status+" "+o.statusText);
            throw o.status+" "+o.statusText
        }
    },
    o.open("GET",e,!0),
    o.send(null)
}

Promise.all = function(e) {
    var t = new Promise,
    n = 0,
    o = function(){
        n++,
        n===e.length&&t.resolve()
    };
    return e.forEach(function(e) {
        e.then(o)
    }),t
},function() {
        var e,
        t=this,
        n=( t.Sound || { },[]);
        t.addEventListener("load",function() {
            t.AudioContext = t.AudioContext || t.webkitAudioContext,
            o._ready =! 0;
            try {
                o.ctx = e = new t.AudioContext,
                o.has=!0,
                n.forEach(function(e){
                    e.call(o)
                })
            }
            catch(s) {
                delete o.ctx,o.has=!1
            }
            n.length=0
        },!1);
        var o = t.Sound = function(e,t) {
            o.get(e, function(e){
                this.buffer = e,
                this._ready =! 0,
                isFunction(t) && t.call(this)
            }
            .bind(this))
        };
        extend(o, {
            _ready: !1,
            ready:function(e){
                return o._ready?void e.call(o):void n.push(e)
            },noConflict:function() {
                return t.Sound = previousAudio,this
            },get:function(t,n) {
                var o=new XMLHttpRequest;
                o.open("GET",t,!0),
                o.responseType="arraybuffer",
                o.onload=function(){
                    e.decodeAudioData(o.response,function(e){
                        isFunction(n) && n(e)
                    },function(e) {
                        console.log("Error loading",t,e)
                    })
                },o.send()
            }
        }),extend(o.prototype, {
            stop: function(t){
                if(!this.source) return this;
                var n = defaults(t|| { }, { time:0, ramp:0 });
                return n.ramp && this.gain.gain.linearRampToValueAtTime(.01,n.time+e.currentTime+n.ramp),
                isFunction(this.source.stop)?this.source.stop(n.time+e.currentTime+n.ramp):isFunction(this.source.noteOff) && this.source.noteOff(n.time+e.currentTime+n.ramp),
                this
            }, 
            play:function(t) {
                this.gain = e.createGain(),
                this.gain.connect(e.destination);
                var t=defaults(t|| { }, {time: 0, loop: !1, volume: 1, ramp: 0, duration: 0 }),
                n = e.currentTime+t.time;
                this.gain.gain.setValueAtTime(0,n),
                this.gain.gain.linearRampToValueAtTime(t.volume,n+t.ramp),
                this.source = e.createBufferSource(),
                this.source.buffer = this.buffer,
                this.source.offset = e.currentTime+.25*Math.random(),
                this.source.loop = t.loop,this.source.connect(this.gain);
                var o = this.source.buffer.length/44100;
                return isFunction(this.source.start)?this.source.start(n,e.currentTime%o):isFunction(this.source.noteOn)&&this.source.noteOn(n,e.currentTime%o),
                t.duration&&(this.gain.gain.setValueAtTime(t.volume,n+t.duration-t.ramp),
                this.gain.gain.linearRampToValueAtTime(0,n+t.duration)),this
            }
        })
    } (),function(e) {
        e.Assets = function(e){
            return e = e.substring(e.indexOf("!")+1),
            Assets.loaded[e]?Assets.loaded[e]: void console.error("Request for unloaded asset: "+e)
        },extend(Assets, {
            Types: { },
            loaded: { },
            promises: { },
            basePath:"",
            getExtension:function(e) {
                return/(?: \.([^.]+))?$/.exec(e)[1]
            },
            getType:function(e) {
                var t,
                n = e,
                o = /^(.*)!(.*)/.exec(e);
                return o?(t=Assets.Types[o[1]],n=o[2]): t=Assets.Types[Assets.getExtension(e)],
                t?{ loader:t, path:n } :void console.error("Unrecognized file type: "+e)
            },
            load:function(e) {
                e = defaults(e,{
                    files: [],
                    basePath:Assets.basePath,
                    progress:function(){ }
                });
                var t=0,
                n=[];
                return e.files.forEach(function(o) {
                    var s = Assets.getType(o),
                    i=s.loader,
                    r=s.path,
                    a=Assets.promises[r];
                    a || (a=Assets.promises[r]=new Promise, i(e.basePath+r,function(e){ Assets.loaded[r]=e,a.resolve() })),
                    a.then(function() {
                        t++,
                        e.progress(t/e.files.length, t, e.files.length)
                    }),
                    n.push(a)
                }),
                Promise.all(n)
            }
        })
    }(this),
    function(e) {
        function t(e,t){
            var n=new Image;
            n.onload=function(){
                t(n)
            },
            n.src=e
        }
        var n=e.Assets.Types;
        n.text = get,
        n.html = get,
        n.vs = get,
        n.fs = get,
        n.glsl = get,
        n.json = function(e,t,n) {
            get(e,function(e){ t(JSON.parse(e) )}, n)},
        n.png = t,
        n.jpg = t,
        n.jpeg = t,
        n.gif = t,
        n.texture = function(e,t,n) {
            THREE.ImageUtils.loadTexture(e,THREE.UVMapping,t,n)
        },
        n.texturecube=function(e,t,n) {
            var o = [];
            _.each(["px","nx","py","ny","pz","nz"],
                function(t){o.push(e.replace("*",t)) }
            ),
            THREE.ImageUtils.loadTextureCube(o,THREE.UVMapping,t,n)
        };
        var o=new Promise;
        Sound.ready(o.resolve);
        var s = function(e,t) {
            o.then(function(){
                var n = new Sound(e,function(){ t(n) })
            })
        };
        n.mp3 = s,
        n.ogg = s,
        n.wav = s
    }(this);
    var UA = navigator.userAgent,
    ANDROID = !!UA.match(/Android/gi),
    BLACKBERRY = !!UA.match(/BlackBerry/gi),
    IOS = !!UA.match(/iPhone|iPad|iPod/gi),
    OPERAMINI = !!UA.match(/Opera Mini/gi),
    IEMOBILE = !!UA.match(/IEMobile/gi),
    WEBOS = !!UA.match(/webOS/gi),
    ARORA = !!UA.match(/Arora/gi),
    CHROME = !!UA.match(/Chrome/gi),
    EPIPHANY = !!UA.match(/Epiphany/gi),
    FIREFOX = !!UA.match(/Firefox/gi),
    IE = !!UA.match(/MSIE/gi),
    MIDORI = !!UA.match(/Midori/gi),
    OPERA = !!UA.match(/Opera/gi),
    SAFARI = !!UA.match(/Safari/gi),
    HANDHELD = ANDROID || BLACKBERRY || IOS|| OPERAMINI || WEBOS,
    TOUCH = "ontouchstart"in window,
    WEBGL = function() {
        try{
            return !(!window.WebGLRenderingContext || !document.createElement("canvas").getContext("webgl") && !document.createElement("canvas").getContext("experimental-webgl"))
        }
        catch(e) {
            return !1
        }
    }(),
    WEB_AUDIO = !!window.AudioContext || !!window.webkitAudioContext,
    URL_SAVE = !1,
    DEEP_LINK = !0,
    PIXEL_RATIO = Math.min(2,window.devicePixelRatio||1),
    SMALL_BREAKPOINT = 640,
    LOCK_LANDSCAPE = !1,
    FONT_FAMILY = "Fugue Regular",
    HOVER_DISTANCE_SQUARED = Math.pow(25,2),
    MOBILE_HOVER_DISTANCE_SQUARED = Math.pow(30,2),
    FOOTER_FADE = !ANDROID,
    FULLSCREEN = HANDHELD&&(document.fullscreenEnabled || document.mozFullScreenEnabled || document.webkitFullscreenEnabled),
    IMAGE_ASSETS=["textures/gem.png","textures/normals.png","textures/patterns.png","textures/disc.png","img/1000.gif","img/1000square.gif"],TEXT_ASSETS=["shaders/disc.vs","shaders/disc.fs","data/experiments.json"],
    ASSETS_BASE_PATH = "1000/",
    ASSETS = [];
    !function(e) {
        ASSETS=ASSETS.concat(IMAGE_ASSETS),
        ASSETS=ASSETS.concat(TEXT_ASSETS),
        WEB_AUDIO&&ASSETS.push("mp3/drag.mp3"),
        Assets.load({files: ASSETS,basePath:ASSETS_BASE_PATH});
        var t= { };
        if(e.toggleClass = function(e,n) {
            1 === arguments.length && (n=!t[e]),
            t[e]=n,
            n?document.body.classList.add(e): document.body.classList.remove(e)
            },
            window.FontFace) {
                var n;
                n=new FontFace("Fugue Regular","url('1000/fonts/fugue_regular.eot?#iefix') format('embedded-opentype'), url('1000/fonts/fugue_regular.woff') format('woff')", {  }),
                n.load(),
                n=new FontFace("Fugue Regular","url('1000/fonts/icomoon.eot?#iefix-l6dpue') format('embedded-opentype'), url('1000/fonts/icomoon.woff?-l6dpue') format('woff'), url('1000/fonts/icomoon.ttf?-l6dpue') format('truetype'), url('1000/fonts/icomoon.svg?-l6dpue#icomoon') format('svg')", { }),
                n.load()
            }}(this),
            ["FULLSCREEN","HANDHELD","TOUCH","LOCK_LANDSCAPE","FOOTER_FADE"].forEach(function(e) {
                toggleClass(e.replace(/_/g,"-").toLowerCase(),this[e])
            },this);