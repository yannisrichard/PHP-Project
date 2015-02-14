 <?php

  $map = [
  __DIR__ .'/src/',
  __DIR__ .'/tests/',
  __DIR__ .'/app/',
  ];

  spl_autoload_register(function ($className) use ($map) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
      $namespace = substr($className, 0, $lastNsPos);
      $className = substr($className, $lastNsPos + 1);
      $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    if (file_exists ($fileName)) {
      require $fileName;
    } else {
      foreach ($map as $value) {
        if (file_exists($value.$fileName)) {
          require $value.$fileName;

          return;
         }
      }
    }
  });
