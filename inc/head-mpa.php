<head>
    <meta charset="UTF-8">
    <title>Turbo 8 morphing demo: Index</title>
    <link rel="stylesheet" href="../css/style.css"/>
    <script src="../js/turbo.js" data-turbo-track="reload"></script>


    <script>
      function debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
          clearTimeout(timer);
          timer = setTimeout(() => {
            func.apply(this, args)
          }, timeout)
        }
      }
    </script>
</head>
