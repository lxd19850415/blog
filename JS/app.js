
document.write('<script src="JS/app_framework.js"></script>')

var bg_color="#666666";

var ball_color=new Array("blue","red","black","green","yellow","blue","red","black","green","yellow");

var row_count= 2;
var col_count = 4;
var offset_x = 60;
var offset_y = 40;
var btnW = 160;
var btnH = 100;
var len_x = 25;
var len_y = 15;

window.onload = function() {

    gameStart("event_canvas");
    var runScene = enter();
    mainDirector.runScene(runScene);
};

function enter(){
    //场景和层
    var mainScene = new Scene();
    var layer = new Layer();

    layer.setTransparent(0.5);
    layer.setColor(bg_color);

    mainScene.addChild(layer);

    for (var i=0;i<row_count;i++){
        for (var j=0;j<col_count;j++) {

            var btnName=null;
            var type = 1;
            var index = i * col_count + j;
            type = index + 1;

            console.log("enter type : " + type);

            if(type == 1){
                btnName = "安卓";
            }else if(type == 2){
                btnName = "cocos2dx";
            }else if(type == 3){
                btnName = "web";
            }else if(type == 4){
                btnName = "c/c++";
            }else if(type == 5){
                btnName = "lua";
            }else if(type == 6){
                btnName = "ios";
            }else if(type == 7){
                btnName = "openGL";
            }else if(type == 8){
                btnName = "其他";
            }

            var btn = new ButtonDraw();
            btn.setPosition(offset_x + j * (len_x + btnW), offset_y  + i * (len_y + btnH));
            btn.setSize(btnW,btnH);
            btn.setText(btnName);
            btn.setFontColor("white");
            btn.setColor(ball_color[index]);
            btn.setTag(type);
            btn.onClick = function(self_){
                var type = self_.getTag();
                console.log("enter getTag : " + type);
                var url = "/index.php?controller=index&method=assort&type=" + type;
                console.log("enter url : " + url);
                window.location.href=url;
            }
            layer.addChild(btn);
        }
    }

    return mainScene;
}


