var loadFile=function(event){
  var out=document.getElementById('output');
  out.style.display="block";
  out.src=URL.createObjectURL(event.target.files[0]);
};
var loadImg=function(event){
  var out=document.getElementById('display');
  out.style.display="block";
  out.src=URL.createObjectURL(event.target.files[0]);
};
