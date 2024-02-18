<head>
    <meta charset="UTF-8">
    <title>Turbo 8 morphing demo: Index</title>
    <script src="../js/turbo.js" data-turbo-track="reload"></script>
    <link rel="stylesheet" href="../css/style.css" />
    <meta name="turbo-refresh-method" content="morph">
    <meta name="turbo-refresh-scroll" content="preserve">

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
