<html>
  <head>
    <title>Site Error</title>
    <style>
      body {
        margin:0;
        padding:30px;
        font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;
      }
      h1 {
        margin:0;
        font-size:48px;
        font-weight:normal;
        line-height:48px;
      }
      em {
        color: #7f8c8d;
      }
    </style>
    <style type="text/css">
    </style>
  </head>
  <body style="">
    <h1>
      Site Error
    </h1>
    <p>
      A website error has occurred. The website administrator has been notified
      of the issue. Sorry for the temporary inconvenience.
    </p>
    <p>
      <em><?php echo $e->getMessage(); ?></em>
    </p>
  </body>
</html>
