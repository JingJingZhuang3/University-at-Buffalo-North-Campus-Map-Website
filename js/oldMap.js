let zoom=16;
let max_zoom=18;
let min_zoom=0;
let center = getTile(16, 43.0007353, -78.7888962);
let list = tile_list(center);
display(list);
document.getElementById("zoomIn").addEventListener("click", zoomIn);
document.getElementById("zoomOut").addEventListener("click", zoomOut);

function Tile(zoom, x, y){
  this.zoom=zoom;
  this.x=x;
  this.y=y;
  this.getZoom=function(){return this.zoom;}
  this.getX=function(){return this.x;}
  this.getY=function(){return this.y;}
  this.lati=function(){
    let temp=Math.PI - 2 * Math.PI * this.y /Math.pow(2,this.zoom);
    return (180/Math.PI*Math.atan(0.5*(Math.exp(temp)-Math.exp(-temp))));
  }
  this.long=function(){
    let temp= this.x/Math.pow(2,this.zoom);
    return temp * 360 - 180;
  }
  this.getURL=function() {
  let x = "http://tile.openstreetmap.org/" + this.zoom + "/" + this.x + "/" + this.y + ".png";
  let url=null;
  try {
    url = new URL(x);
  }catch(err) {
  }
    return url;
}
}

function getTile(zoom, lati, long){
  let longitudeInRadians = Math.PI * long / 180.0;
  let latitudeInRadians = Math.PI * lati / 180.0;

  let howManyTilesAtThisZoomLevel = Math.pow(2.0, zoom);

  let x = longitudeInRadians;
  let y = Math.log(Math.tan(latitudeInRadians) + (1.0 / Math.cos(latitudeInRadians)));

  x = (1 + (x / Math.PI)) / 2.0;
  y = (1 - (y / Math.PI)) / 2.0;

  x *= howManyTilesAtThisZoomLevel;
  y *= howManyTilesAtThisZoomLevel;
  return new Tile(zoom, parseInt(x), parseInt(y));
}

function tile_list(center_tile){
  let tiles=[];
  let zoom=center_tile.getZoom();
  let x=center_tile.getX();
  let y=center_tile.getY();
  if(zoom==0) {
  center=new Tile(0, 0, 0);
  for(var i =0; i<9; i++) { tiles[i]=center;}}
  else if(zoom==1){
    tiles=[
      new Tile(zoom, 0,1),
      new Tile(zoom, 1,1),
      new Tile(zoom, 0,1),
      new Tile(zoom, 0,0),
      new Tile(zoom, 1,0),
      new Tile(zoom, 0,0),
      new Tile(zoom, 0,1),
      new Tile(zoom, 1,1),
      new Tile(zoom, 0,1),
    ];
  }else{
    if(x<=0)x=1;
    if(y<1)y=1;
    tiles=[
      new Tile(zoom, x-1,y-1),
      new Tile(zoom, x,y-1),
      new Tile(zoom, x+1,y-1),
      new Tile(zoom, x-1,y),
      center,
      new Tile(zoom, x+1,y),
      new Tile(zoom, x-1,y+1),
      new Tile(zoom, x,y+1),
      new Tile(zoom, x+1,y+1),
    ];
  }
  return tiles;
}

function display(tiles){
  let index=0;
  for (var i=0;i<3;i++){
    for(var j=0;j<3;j++){
      let img = document.createElement("IMG");
      img.setAttribute("id", "IMAGES");
      img.setAttribute("src", tiles[index].getURL());
      img.setAttribute("style", "width:33.33%; height: auto;");
      index++;
      document.getElementById("row"+i).appendChild(img);
    }
  }
}

function zoomIn(){
  if(zoom<max_zoom){
    zoom++;
    empty();
    center=getTile(zoom, 43.0007353, -78.7888962);
    let temp = tile_list(center);
    display(temp);
  }
}

function zoomOut(){
  if(zoom>min_zoom){
    zoom--;
    empty();
    center=getTile(zoom, 43.0007353, -78.7888962);
    let temp = tile_list(center);
    display(temp);
  }
}
function empty() {
    while(document.getElementById("IMAGES")!=null){
      var element = document.getElementById("IMAGES");
      element.parentNode.removeChild(element);
    }

}
