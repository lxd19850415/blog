
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

    var typeData = getAllTypeData();
    for (var i=0;i<row_count;i++){
        for (var j=0;j<col_count;j++) {

            var btnName=null;
            var type = 1;
            var index = i * col_count + j;
            type = index + 1;

            type = typeData[index].typeid;
            btnName = typeData[index].typename;

            console.log("enter type : " + type);
            console.log("enter btnName : " + btnName);

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


