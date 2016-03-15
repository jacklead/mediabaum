<html>
   <head>
   	  <meta charset="utf-8" />
      <title><?= $title ?></title>
   </head>
   <body>
      <div id="wrapper">
         <div id="header">
            <?= $header ?>
         </div>
         <div id="main">
            <div id="content">
               <h2><?= $title ?></h2>
               <div class="post">
                  <?= $content ?>
               </div>
            </div>
            <div id="sidebar">
               <?= $sidebar ?>
            </div>
         </div>
         <div id="footer">
            <?= $footer ?>
         </div>
      </div>
   </body>
</html>