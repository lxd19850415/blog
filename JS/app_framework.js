
var tempContext = null; // global variable 2d context
var isPress = false;
var pressPos={};


var mainDirector = null;

var screenW = 964;
var screenH = 400;

function Director(){
    var director = {};

    director.w = screenW;
    director.h = screenH;
    director.curScene = null;

    director.update = function(){

    };
    director.render = function(){
        //director.curScene.onDraw();
        director.update();
        window.requestAnimationFrame(director.render);

        director.curScene.onDraw();

    };
    director.runScene = function (scene_) {
        director.curScene =scene_;
    };
    return director;
}

function Point(x_,y_){
    this.x = x_;
    this.y = y_;
}
function Size(w_,h_){
    this.w = w_;
    this.h = h_;
}


//定义最顶级类
function Class() { }
Class.prototype.construct = function() {};
Class.extend = function(def) {
    var classDef = function() {
        if (arguments[0] !== Class) { this.construct.apply(this, arguments); }
    };

    var proto = new this(Class);
    var superClass = this.prototype;

    for (var n in def) {
        var item = def[n];
        if (item instanceof Function) item.$ = superClass;
        proto[n] = item;
    }

    classDef.prototype = proto;

    //赋给这个新的子类同样的静态extend方法
    classDef.extend = this.extend;
    return classDef;
};


var Node = Class.extend({
    construct: function() { /* optional constructor method */ },
    point : new Point(0,0),
    size : new Size(1,1),
    parent : null,
    children : new Array(),
    tag : 0,
    visible:true,

    setVisible: function(visible_) {
        this.visible = visible_;
    },

    onDrawEx: function() {
        return "Node onDrawEx";
    },


    onDraw : function(){
        if(this.visible == true){
            this.onDrawEx();
        }
        //console.log("Node onDraw children.length : " + this.children.length);
        for(var i=0;i<this.children.length;i++){
            if(this.children[i].visible == true){
                this.children[i].onDrawEx();
            }
        }
    },

    xyIsIn : function(x_,y_){
        var realX = this.point.x - this.size.w / 2;
        var realY = this.point.y - this.size.h / 2;

        if(x_ >= realX && x_<= realX + this.size.w
            && y_ >= realY && y_ <= realY + this.size.h){
            return true;
        }else{
            return false;
        }
    },

    setPosition : function(x_,y_){
        this.point = new Point(x_,y_);
    },

    setSize : function(w_,h_){
        this.size = new Size(w_,h_);
    },

    getPosition : function(){
        return this.point;
    },

    getSize : function(){
        return this.size;
    },

    addChild : function(child){
        this.children.push(child);
        child.parent = this;
    },

    removeFromParent : function(){

        for(var i=0;i<this.parent.children.length;i++){
            if(child == this.parent.children[i]){
                this.parent.children.splice(i,1);
            }
        }
    },
    setTag: function(tag_) {
        this.tag = tag_;
    },

    getTag: function() {
        return this.tag;
    }
});

var DrawNode= Node.extend({
    color:"blue",
    type:"rect",
    transparent:255,
    setColor:function(color_){
        this.color = color_;
    },
    setType:function(type_){
        this.type = type_;
    },
    setTransparent:function(transparent_){
        if(transparent_ < 0 ){
            this.transparent = 0;
        }else if(transparent_ > 1){
            this.transparent = 1;
        }
        this.transparent = transparent_;
    },
    onDrawEx:function(){
        tempContext.fillStyle=this.color;
        tempContext.globalAlpha = this.transparent;
        if(this.type == "rect"){
            var x = this.point.x - (this.size.w / 2);
            var y = this.point.y - (this.size.h / 2);
            //console.log("DrawNode onDrawEx type: rect tag: " + this.getTag() + "  x:  " + x + "  y:  " + y);
            tempContext.fillRect(x, y, this.size.w, this.size.h);
        }else if(this.type == "arc"){
            //console.log("DrawNode onDrawEx type: arc tag: " + this.getTag() );
            tempContext.beginPath();
            tempContext.arc(this.point.x,this.point.y,this.size.w / 2,0,Math.PI*2,true); //Math.PI*2是JS计算方法，是圆
            tempContext.closePath();
            tempContext.stroke();
        }else if(this.type == "circle"){
            //console.log("DrawNode onDrawEx type: circle tag: " + this.getTag() );
            tempContext.beginPath();
            tempContext.arc(this.point.x,this.point.y,this.size.w / 2,0,Math.PI*2,true); //Math.PI*2是JS计算方法，是圆
            tempContext.closePath();
            tempContext.fill();
        }
        tempContext.globalAlpha = 1;
    }
});


var ButtonDraw= Node.extend({
    color:"blue",
    type:"rect",
    transparent:255,
    text:"",
    font:"30px Courier New",
    fontColor:"black",

    setColor:function(color_){
        this.color = color_;
    },
    setType:function(type_){
        this.type = type_;
    },
    setTransparent:function(transparent_){
        if(transparent_ < 0 ){
            this.transparent = 0;
        }else if(transparent_ > 1){
            this.transparent = 1;
        }
        this.transparent = transparent_;
    },
    setText:function(text_){
        this.text = text_;
    },
    setFont:function(font_){
        this.font = font_;
    },
    setFontColor:function(fontColor_){
        this.fontColor = fontColor_;
    },
    onDrawEx:function(){
        tempContext.fillStyle=this.color;
        tempContext.globalAlpha = this.transparent;
        if(this.type == "rect"){
            var x = this.point.x - (this.size.w / 2);
            var y = this.point.y - (this.size.h / 2);
            //console.log("ButtonDraw onDrawEx type: rect tag: " + this.getTag() + "  x:  " + x + "  y:  " + y);
            tempContext.fillRect(x, y, this.size.w, this.size.h);

            tempContext.textAlign='center';//文本水平对齐方式
            tempContext.textBaseline='middle';//文本垂直方向，基线位置
            tempContext.fillStyle = this.fontColor;
            tempContext.font = this.font;
            tempContext.fillText(this.text, this.point.x, this.point.y);

        }else if(this.type == "arc"){
            //console.log("ButtonDraw onDrawEx type: arc tag: " + this.getTag() );
            tempContext.beginPath();
            tempContext.arc(this.point.x,this.point.y,this.size.w / 2,0,Math.PI*2,true); //Math.PI*2是JS计算方法，是圆
            tempContext.closePath();
            tempContext.stroke();

            tempContext.textAlign='center';//文本水平对齐方式
            tempContext.textBaseline='middle';//文本垂直方向，基线位置
            tempContext.fillStyle = this.fontColor;
            tempContext.font = this.font;
            tempContext.fillText(this.text, this.point.x, this.point.y);
        }else if(this.type == "circle"){
            //console.log("ButtonDraw onDrawEx type: circle tag: " + this.getTag() );
            tempContext.beginPath();
            tempContext.arc(this.point.x,this.point.y,this.size.w / 2,0,Math.PI*2,true); //Math.PI*2是JS计算方法，是圆
            tempContext.closePath();
            tempContext.fill();

            tempContext.textAlign='center';//文本水平对齐方式
            tempContext.textBaseline='middle';//文本垂直方向，基线位置
            tempContext.fillStyle = this.fontColor;
            tempContext.font = this.font;
            tempContext.fillText(this.text, this.point.x, this.point.y);
        }
        tempContext.globalAlpha = 1;
    },
    onClick:function(self){
        console.log("ButtonDraw onClick");
    }
});


var Layer= Node.extend({
    color:"blue",
    transparent:255,
    setColor:function(color_){
        this.color = color_;
    },
    setTransparent:function(transparent_){
        if(transparent_ < 0 ){
            this.transparent = 0;
        }else if(transparent_ > 1){
            this.transparent = 1;
        }
        this.transparent = transparent_;
    },
    onDrawEx:function(){
        tempContext.fillStyle = this.color;
        tempContext.globalAlpha = this.transparent;
        //console.log("Layer onDrawEx color: " + this.color + " transparent: " + this.transparent );
        if(this.transparent < 255){
            tempContext.fillRect(0, 0, mainDirector.w, mainDirector.h);
        }
        tempContext.globalAlpha = 1;
    }
});

var Scene= Node.extend({

    onDrawEx:function(){
        //console.log("Scene onDrawEx " );
        tempContext.fillStyle="white";
        tempContext.(0, 0, mainDirector.w, mainDirector.h);
    }
});

function init(){
    var lastTime = 0;
    var prefixes = 'webkit moz ms o'.split(' '); //各浏览器前缀

    var requestAnimationFrame = window.requestAnimationFrame;
    var cancelAnimationFrame = window.cancelAnimationFrame;

    var prefix;
//通过遍历各浏览器前缀，来得到requestAnimationFrame和cancelAnimationFrame在当前浏览器的实现形式
    for( var i = 0; i < prefixes.length; i++ ) {
        if ( requestAnimationFrame && cancelAnimationFrame ) {
            break;
        }
        prefix = prefixes[i];
        requestAnimationFrame = requestAnimationFrame || window[ prefix + 'RequestAnimationFrame' ];
        cancelAnimationFrame  = cancelAnimationFrame  || window[ prefix + 'CancelAnimationFrame' ] || window[ prefix + 'CancelRequestAnimationFrame' ];
    }

//如果当前浏览器不支持requestAnimationFrame和cancelAnimationFrame，则会退到setTimeout
    if ( !requestAnimationFrame || !cancelAnimationFrame ) {
        requestAnimationFrame = function( callback, element ) {
            var currTime = new Date().getTime();
            //为了使setTimteout的尽可能的接近每秒60帧的效果
            var timeToCall = Math.max( 0, 16 - ( currTime - lastTime ) );
            var id = window.setTimeout( function() {
                callback( currTime + timeToCall );
            }, timeToCall );
            lastTime = currTime + timeToCall;
            return id;
        };

        cancelAnimationFrame = function( id ) {
            window.clearTimeout( id );
        };
    }

//得到兼容各浏览器的API
    window.requestAnimationFrame = requestAnimationFrame;
    window.cancelAnimationFrame = cancelAnimationFrame;
}

function gameStart(canvasName_){
    mainDirector = new Director();

    var canvas = document.getElementById(canvasName_);
    console.log(canvas.parentNode.clientWidth);
    console.log(canvas.parentNode.clientHeight);

    canvas.width = canvas.parentNode.clientWidth = mainDirector.w;
    canvas.height = canvas.parentNode.clientHeight = mainDirector.h;
    if (!canvas.getContext) {
        console.log("Canvas not supported. Please install a HTML5 compatible browser.");
        return;
    }
    // get 2D context of canvas and draw rectangel
    tempContext = canvas.getContext("2d");

    // key event - use DOM element as object
    canvas.addEventListener('keydown', doKeyDown, true);
    canvas.focus();
    // key event - use window as object
    window.addEventListener('keydown', doKeyDown, true);
    // mouse event
    canvas.addEventListener("mousedown", doMouseDown, false);
    canvas.addEventListener('mousemove', doMouseMove, false);
    canvas.addEventListener('mouseup', doMouseUp, false);

    //mainDirector.render();

    window.requestAnimationFrame(mainDirector.render);
}


function getPointOnCanvas(canvas, x, y) {
    var bbox = canvas.getBoundingClientRect();
    return { x: x - bbox.left * (canvas.width / bbox.width),
        y: y - bbox.top * (canvas.height / bbox.height)
    };
}

function doMouseDown(event) {
    var x = event.pageX;
    var y = event.pageY;
    var canvas = event.target;
    pressPos = getPointOnCanvas(canvas, x, y);
    x = pressPos.x;
    y = pressPos.y;
    console.log("mouse down at point( x:" + pressPos.x + ", y:" + pressPos.y + ")");


    isPress = true;

    var nodes = mainDirector.curScene.children;
    for(var i=0;i<nodes.length;i++){
        if(nodes[i].onClick != null){
            if(nodes[i].xyIsIn(pressPos.x,pressPos.y)){
                nodes[i].onClick(nodes[i]);
            }
        }

    }
}

function doMouseMove(event) {
    var x = event.pageX;
    var y = event.pageY;
    var canvas = event.target;
    var loc = getPointOnCanvas(canvas, x, y);


}


function doMouseUp(event) {
    console.log("mouse up now");
    if (isPress) {
        doMouseMove(event);
        isPress = false;
    }
}



function doKeyDown(e) {
    var keyID = e.keyCode ? e.keyCode :e.which;
    if(keyID === 38 || keyID === 87) { // up arrow and W

        e.preventDefault();
    }
    if(keyID === 39 || keyID === 68) { // right arrow and D

        e.preventDefault();
    }
    if(keyID === 40 || keyID === 83) { // down arrow and S

        e.preventDefault();
    }
    if(keyID === 37 || keyID === 65) { // left arrow and A

        e.preventDefault();
    }
}

