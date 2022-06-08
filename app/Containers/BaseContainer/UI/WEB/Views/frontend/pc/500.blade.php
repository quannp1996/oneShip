<html lang="en"><head>
  <meta charset="UTF-8">
  <link rel="apple-touch-icon" type="image/png" href="https://static.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">
  <meta name="apple-mobile-web-app-title" content="CodePen">
  <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">
  <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">
  <title>500 Error</title>
  <style>
      @import url("https://fonts.googleapis.com/css?family=VT323");
      :root{
          --width: 280px;
          --height: 180px;
      }

      body{ background: #6BA1CA; }

      .error-500{
          position: absolute;
          top: 50%; left: 50%;
          transform: translate(-50%, -50%);
          font-family: 'VT323';
          color: #1E4B6D;
          text-shadow: 1px 1px 1px rgba(255, 255, 255, .3);
      }

      .error-500:after{
          content: attr(data-text);
          display: block;
          margin-top: calc(var(--height) / 10 + 15px);
          font-size: 28pt;
          text-align: center;
      }

      spaguetti{
          width: var(--width);
          height: var(--height);
          filter: drop-shadow(0 0 0.75rem rgba(0, 0, 0, .2));
          display: block;
          margin: 0 auto;
          position: relative;
      }

      plate{
          width: 100%;
          height: calc(var(--height) / 2.5);
          background: #CAD7E4;
          position: absolute;
          bottom: 0;
          border-radius: 0 0 50px 50px;
          z-index: 4;
      }

      plate:before{
          content: '500 Spaghetti Error';
          position: absolute;
          top: 50%; left: 50%;
          transform: translate(-50%, -50%);
          text-transform: uppercase;
          font-weight: bold;
          color: rgba(0, 0, 0, .2);
          text-align: center;
      }

      plate:after{
          content: '';
          width: calc(var(--width) / 2);
          height: calc(var(--height) / 10);
          background: #B5C3D0;
          position: absolute;
          top: 100%; left: 50%;
          transform: translateX(-50%);
      }

      pasta{
          width: calc(var(--width) / 4);
          height: calc(var(--width) / 4);
          border: 5px solid #DEA631;
          background: #EED269;
          border-radius: 50%;
          position: absolute;
          bottom: calc(calc(var(--height) / 2.5) / 3); right: 10px;
          box-shadow: calc(-1 * calc(var(--width) / 4) - 60px) 10px 1px 10px #EED269, calc(-1 * calc(var(--width) / 4) - 60px) 10px 0 15px #DEA631;
          z-index: 2;
      }

      pasta:before{
          content: '';
          width: calc(var(--width) / 4);
          height: calc(var(--width) / 4);
          border: 5px solid #DEA631;
          background: #EED269;
          border-radius: 50%;
          position: absolute;
          bottom: -5px; right: 60px;
          box-shadow: calc(-1 * calc(var(--width) / 4) - 30px) 10px 1px 1px #EED269, calc(-1 * calc(var(--width) / 4) - 30px) 10px 0 5px #DEA631;
      }

      pasta:after{
          content: '';
          width: calc(var(--width) / 3);
          height: calc(var(--width) / 4);
          border: 5px solid #DEA631;
          background: #EED269;
          border-radius: 50%;
          position: absolute;
          bottom: -15px; right: 100px;
          box-shadow: calc(var(--width) / 4) 10px 1px 1px #EED269, calc(var(--width) / 4) 10px 0 5px #DEA631;
      }

      meat{
          width: 24px;
          height: 24px;
          border-radius: 50%;
          background: #B64C19;
          position: absolute;
          bottom: calc(var(--height) / 2.5); right: 64px;
          box-shadow: -150px -2px 0 0 #B64C19, -50px -7px 0 0 #B64C19, -100px 8px 0 0 #B64C19;
          z-index: 3;
      }

      fork{
          width: 20px;
          height: calc(var(--height) - 30px);
          background: #D3D3D3;
          border-right: 3px solid #B7B7B7;
          border-radius: 50px 50px 0 0;
          position: absolute;
          bottom: 25%; left: 75%;
          transform: translate(-75%, 0%) rotate(25deg);
      }
  </style>
  <script>
      window.console = window.console || function(t) {};
  </script>
  <script>
      if (document.location.search.match(/type=embed/gi)) {
          window.parent.postMessage("resize", "*");
      }
  </script>
</head>
<body translate="no">
<div class="error-500" data-text="Oh no! Our spaghetti code is not working properly. We will be back soon!">
  <spaguetti>
      <fork></fork>
      <meat></meat>
      <pasta></pasta>
      <plate></plate>
  </spaguetti>
</div>
<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
<script id="rendered-js">
  const error = document.querySelector(".error-500");
  let i = 0,data = "",text = error.getAttribute("data-text");

  let typing = setInterval(() => {
      if (i == text.length) {
          clearInterval(typing);
      } else {
          data += text[i];
          document.querySelector(".error-500").setAttribute("data-text", data);
          i++;
      }
  }, 100);
  //# sourceURL=pen.js
</script>


</body></html>