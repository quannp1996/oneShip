
 <!DOCTYPE html>
 <html lang="en">
 <body>
 <div id="app">
     <div class="d-block text-center my-3 my-lg-5" style="text-align: center">
         <img src="{{asset('template/images/404_'. app()->getLocale() .'.'. (app()->getLocale() == 'vi' ? 'jpg' : 'png'))}}" alt="">
     </div>
 </div>

 </body>

 </html>