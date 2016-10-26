
// calling the auto update function in our script
timer();
//function to auto update time..
function timer(){
 var now = new Date,
     hours = now.getHours(),
     ampm  = hours<=11 ? ' AM' : ' PM'
     minutes = now.getMinutes(),
     seconds = now.getSeconds(),
      date=now.getDate();
      month=now.getMonth();
      year=now.getFullYear();
      var t_str= "";
      t_str+=[(date<10 ? "0"+date:date),(month<10 ? "0"+month : month),year].join("-");
      t_str=t_str+"<br>";
      hours=(hours>12)?hours-12:hours;
      t_str += [hours>10 ? hours:"0"+hours,
              (minutes < 10 ? "0" + minutes : minutes),
              (seconds < 10 ? "0" + seconds : seconds)]
                 .join(':') + ampm;
 document.getElementById('date').innerHTML = t_str;
 setTimeout(timer,1000);
}
