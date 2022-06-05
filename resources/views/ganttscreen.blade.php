
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>How to capture website screen shot from url in php</title>
  
  
 </head>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
 <body>
 <div id="capture" style="padding: 10px; background: #f5da55">
    <h4 style="color: #000; ">Hello world!</h4>
</div>
<button onclick="screenshot()">yy</button>
 </body>
 
<script>
    function screenshot(){
        html2canvas(document.querySelector("#capture")).then(canvas => {
    document.body.appendChild(canvas)
});
    }
    
 </script>
 
 
</html>
