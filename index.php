<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Color Canvas</title>
  
  </head>
  <body>
   
    <p>Please dont die while looking at this page,
    its just a test to see if this works</p>
    <canvas id="myCanvas" width="600" height="600" >
    </canvas>
    <canvas id="anaCanvas" width ="600" height = "600">
    </canvas>
    <script>
      function setPixel(imgData, x, y, r, g, b, a)
      {
        //window.alert("insideSetPixel");
        var i = (y * 4) + (x * 600);
        imgData.data[i+0]=r ;
        imgData.data[i+1]=g ;
        imgData.data[i+2]=b;
        imgData.data[i+3]=a;
        return imgData;
      }
      var incVal = 255/600;
      var c=document.getElementById("myCanvas");
      var ctx=c.getContext("2d");
      var imgData=ctx.createImageData(600,600);
      var can = document.getElementById("anaCanvas");
      var con = can.getContext("2d");
      var imgAna = con.createImageData(600, 600);
      var yVal = 0;
      var xVal = 0;
      /*
      for(var x = 0; x <= 2400; x++)
      {
        for(var y = 0; y <= 2400; y++)
        {
          imgData = setPixel(imgData, x, y, xVal
                            , yVal, 0, 255);
          yVal = yVal + incVal;
          if (yVal < 5 && x%100 == 0)
          {//window.alert("y = " + yVal + "y & x= "+ y+ " "+x);
            ctx.putImageData(imgData,0,0);
          }
        }
        yVal = 0;
        xVal = xVal + incVal;
        //if(x % 100 == 0)
        //window.alert("a cycle x = " + x);
        ctx.putImageData(imgData,0,0);
      }*/
      
      /**
      * creates a img data that is solid red
      */
      function createSolid(img)
      {
        for (var i = 0; i < img.data.length; i+=4)
        {
          img.data[i] = 255;
          img.data[i + 1] = 0;
          img.data[i + 2] = 0;
          img.data[i + 3] = 255;
        }
        return img;
      }
      
      /**
      * creates a img data that has the required gradint
      */
      function createDataImg(img)
      {
        var y = 0;
        var x = 0;
        var addTo = 255/600;
        for (var i=0;i<img.data.length;i+=4)
        {
          if (y  > 255 )
          {
            y = 0;
            x = x + addTo;
          }
          img.data[i+0]=0 + x ;
          img.data[i+1]=0 + y ;
          img.data[i+2]=0;
          img.data[i+3]=255;
          y = y + addTo;
        }
        return img;
      }
      //imgData
      imgAna = createDataImg(imgAna)
      ctx.putImageData(imgAna,0,0);
      window.requestAnimFrame = (function(callback)
      {
        return window.requestAnimationFrame || 
              window.webkitRequestAnimationFream||
              window.mozRequestAnimationFrame|| 
              window.oRequestAnimationFrame || 
              window.msRequestAnimationFrame ||
              function(callback) 
              {
                window.setTimeout(callback, 1000/60);
              };
      })();
      function animate()
      {  
        var d = new Date();
        var t = d.getTime();
        
        var can = document.getElementById("anaCanvas");
        var con = can.getContext("2d");
        var imgAna = con.createImageData(600, 600);
        var yVal = 0;
        var xVal = 0;
        if (t % 2 == 0 )
        {
          imgAna = createDataImg(imgAna);
        }
        else
        {
          imgAna = createSolid(imgAna);
        }
        con.putImageData(imgAna, 0, 0);
        requestAnimFrame(function()
          {
            animate();
          });
      }
      animate();
    </script>
    <li>
        <a href = "index.html">Assignments</a>
      </li>
  </body>
</html>